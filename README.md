# Manager

## The flow

1. When GitHub send notification of push event, we received the notification, build own notification with relevant data and save it on database with waiting status.
2. After save the notification on database, we will send the notification id to queue and generate GitHubPushEventNotificationReceivedEvent ~_ill crazy with this context where everything seems to be the same_~
3. When the GitHubPushEventNotificationReceivedEvent are generated, the event listener trigger the worker
4. When worker are triggered, it consumn the first notification on queue.
5. After consume the first notification on queue, it will consult the notification data on database
6. If the notification are about merge alterations in production environment branch, the worker change status to processing and initiate the scritp to pull alterations in prod env.
7. If failed, we need to revert it. Otherwise, if apply alterations with success, we need to set the status from processing to finalized.
8. finally we need to remove the notification from queue, and consult the queue again to check if have more notifications to repeat the process or finalize the flow.

## TASKS

### Notification Flow

- [x] receive the notification
- [x] validate the signature
- [x] define if is deployable push notification default branch
- [ ] get commits of push in github rest api to avoid unlist all commit when push have more than 10 commits (10 commits are the max quantity of commits listed in push notification) [Future Feature]
- [x] save the notification on database
- [ ] insert the notification on queue
- [ ] send deploy queued to github (https://docs.github.com/en/rest/deployments?apiVersion=2022-11-28) [Future Feature]
- [ ] throw event
- [x] return response

### Deployment Flow [Future Feature]

- [ ] react when event are throwed
- [ ] trigger the worker
- [ ] consumn first queue message
- [ ] send deploy start to github (https://docs.github.com/en/rest/deployments?apiVersion=2022-11-28)
- [ ] run the deploy script (git reset --hard, git fetch origin, git checkout {defaultBranch}, git pull origin {defaultBranch})
- [ ] remove current message from queue
- [ ] save deployment execution status on database
- [ ] send deploy status to github (https://docs.github.com/en/rest/deployments?apiVersion=2022-11-28)

### Implantation Flow

TODO: segregate the notification on Notification Flow when are new project
maybe only change the script on deploy to create folder first, but have chance to pass argument if is new project deployment
