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

## The system design concept

### Event

- id
- Platform
  - hash
  - name
  - url
- {EventType}
  - id
  - hash
  - ...

## Data by EventType

### push

- id
- hash
- Repository
  - id
  - name
  - description
  - Platform
  - Owner
    - id
    - nickName
    - email
    - image
  - cloneUrl
  - defaultBranch
- Merger
  - id
  - nickName
  - image
- Commits

      to populate this values, need to consume the https://docs.github.com/en/rest/commits/commits?apiVersion=2022-11-28
  - Commit
    - id
    - message
    - Author
      - id
      - email
      - nickName
    - Commiter

          when is a merge commit in GitHub, the Commiter have different values of Author, but have the same key attributes
    - timestamp
  - Commit
    - ...
  - Commit
    - ...
- targetBranchReference