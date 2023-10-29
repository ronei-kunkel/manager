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

## GitHub Request Push Example

```json
{
  "ref": "refs/heads/production",
  "before": "b15c276fc25f1f6f7d47517d60b557cba54edc6b",
  "after": "835b2cc0ae4bd329a7c4bccbdd961e779411ecf8",
  "repository": {
    "id": 684956336,
    "node_id": "R_kgDOKNOasA",
    "name": "larawater",
    "full_name": "ronei-kunkel/larawater",
    "private": false,
    "owner": {
      "name": "ronei-kunkel",
      "email": "ronei.kunkel@gmail.com",
      "login": "ronei-kunkel",
      "id": 41250984,
      "node_id": "MDQ6VXNlcjQxMjUwOTg0",
      "avatar_url": "https://avatars.githubusercontent.com/u/41250984?v=4",
      "gravatar_id": "",
      "url": "https://api.github.com/users/ronei-kunkel",
      "html_url": "https://github.com/ronei-kunkel",
      "followers_url": "https://api.github.com/users/ronei-kunkel/followers",
      "following_url": "https://api.github.com/users/ronei-kunkel/following{/other_user}",
      "gists_url": "https://api.github.com/users/ronei-kunkel/gists{/gist_id}",
      "starred_url": "https://api.github.com/users/ronei-kunkel/starred{/owner}{/repo}",
      "subscriptions_url": "https://api.github.com/users/ronei-kunkel/subscriptions",
      "organizations_url": "https://api.github.com/users/ronei-kunkel/orgs",
      "repos_url": "https://api.github.com/users/ronei-kunkel/repos",
      "events_url": "https://api.github.com/users/ronei-kunkel/events{/privacy}",
      "received_events_url": "https://api.github.com/users/ronei-kunkel/received_events",
      "type": "User",
      "site_admin": false
    },
    "html_url": "https://github.com/ronei-kunkel/larawater",
    "description": "Larawater é um sistema para gerenciar a quantidade de vezes que um usuário bebeu água. Desenvolvido usando clean architecture e domain driven design",
    "fork": false,
    "url": "https://github.com/ronei-kunkel/larawater",
    "forks_url": "https://api.github.com/repos/ronei-kunkel/larawater/forks",
    "keys_url": "https://api.github.com/repos/ronei-kunkel/larawater/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/ronei-kunkel/larawater/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/ronei-kunkel/larawater/teams",
    "hooks_url": "https://api.github.com/repos/ronei-kunkel/larawater/hooks",
    "issue_events_url": "https://api.github.com/repos/ronei-kunkel/larawater/issues/events{/number}",
    "events_url": "https://api.github.com/repos/ronei-kunkel/larawater/events",
    "assignees_url": "https://api.github.com/repos/ronei-kunkel/larawater/assignees{/user}",
    "branches_url": "https://api.github.com/repos/ronei-kunkel/larawater/branches{/branch}",
    "tags_url": "https://api.github.com/repos/ronei-kunkel/larawater/tags",
    "blobs_url": "https://api.github.com/repos/ronei-kunkel/larawater/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/ronei-kunkel/larawater/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/ronei-kunkel/larawater/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/ronei-kunkel/larawater/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/ronei-kunkel/larawater/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/ronei-kunkel/larawater/languages",
    "stargazers_url": "https://api.github.com/repos/ronei-kunkel/larawater/stargazers",
    "contributors_url": "https://api.github.com/repos/ronei-kunkel/larawater/contributors",
    "subscribers_url": "https://api.github.com/repos/ronei-kunkel/larawater/subscribers",
    "subscription_url": "https://api.github.com/repos/ronei-kunkel/larawater/subscription",
    "commits_url": "https://api.github.com/repos/ronei-kunkel/larawater/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/ronei-kunkel/larawater/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/ronei-kunkel/larawater/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/ronei-kunkel/larawater/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/ronei-kunkel/larawater/contents/{+path}",
    "compare_url": "https://api.github.com/repos/ronei-kunkel/larawater/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/ronei-kunkel/larawater/merges",
    "archive_url": "https://api.github.com/repos/ronei-kunkel/larawater/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/ronei-kunkel/larawater/downloads",
    "issues_url": "https://api.github.com/repos/ronei-kunkel/larawater/issues{/number}",
    "pulls_url": "https://api.github.com/repos/ronei-kunkel/larawater/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/ronei-kunkel/larawater/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/ronei-kunkel/larawater/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/ronei-kunkel/larawater/labels{/name}",
    "releases_url": "https://api.github.com/repos/ronei-kunkel/larawater/releases{/id}",
    "deployments_url": "https://api.github.com/repos/ronei-kunkel/larawater/deployments",
    "created_at": 1693381617,
    "updated_at": "2023-10-25T04:21:46Z",
    "pushed_at": 1698207956,
    "git_url": "git://github.com/ronei-kunkel/larawater.git",
    "ssh_url": "git@github.com:ronei-kunkel/larawater.git",
    "clone_url": "https://github.com/ronei-kunkel/larawater.git",
    "svn_url": "https://github.com/ronei-kunkel/larawater",
    "homepage": "http://143.244.177.128/larawater/",
    "size": 564,
    "stargazers_count": 1,
    "watchers_count": 1,
    "language": "PHP",
    "has_issues": true,
    "has_projects": true,
    "has_downloads": true,
    "has_wiki": true,
    "has_pages": false,
    "has_discussions": false,
    "forks_count": 0,
    "mirror_url": null,
    "archived": false,
    "disabled": false,
    "open_issues_count": 7,
    "license": null,
    "allow_forking": true,
    "is_template": false,
    "web_commit_signoff_required": false,
    "topics": [
      "clean-architecture",
      "ddd"
    ],
    "visibility": "public",
    "forks": 0,
    "open_issues": 7,
    "watchers": 1,
    "default_branch": "production",
    "stargazers": 1,
    "master_branch": "production"
  },
  "pusher": {
    "name": "ronei-kunkel",
    "email": "ronei.kunkel@gmail.com"
  },
  "sender": {
    "login": "ronei-kunkel",
    "id": 41250984,
    "node_id": "MDQ6VXNlcjQxMjUwOTg0",
    "avatar_url": "https://avatars.githubusercontent.com/u/41250984?v=4",
    "gravatar_id": "",
    "url": "https://api.github.com/users/ronei-kunkel",
    "html_url": "https://github.com/ronei-kunkel",
    "followers_url": "https://api.github.com/users/ronei-kunkel/followers",
    "following_url": "https://api.github.com/users/ronei-kunkel/following{/other_user}",
    "gists_url": "https://api.github.com/users/ronei-kunkel/gists{/gist_id}",
    "starred_url": "https://api.github.com/users/ronei-kunkel/starred{/owner}{/repo}",
    "subscriptions_url": "https://api.github.com/users/ronei-kunkel/subscriptions",
    "organizations_url": "https://api.github.com/users/ronei-kunkel/orgs",
    "repos_url": "https://api.github.com/users/ronei-kunkel/repos",
    "events_url": "https://api.github.com/users/ronei-kunkel/events{/privacy}",
    "received_events_url": "https://api.github.com/users/ronei-kunkel/received_events",
    "type": "User",
    "site_admin": false
  },
  "created": false,
  "deleted": false,
  "forced": false,
  "base_ref": null,
  "compare": "https://github.com/ronei-kunkel/larawater/compare/b15c276fc25f...835b2cc0ae4b",
  "commits": [
    {
      "id": "6ed5e7b36914ba37a3a8569308faf77a76df90a0",
      "tree_id": "cbd11d9d7e44c68d03a516962f3849aea7975fdc",
      "distinct": false,
      "message": "Add title to README",
      "timestamp": "2023-10-25T01:19:44-03:00",
      "url": "https://github.com/ronei-kunkel/larawater/commit/6ed5e7b36914ba37a3a8569308faf77a76df90a0",
      "author": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "committer": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "added": [

      ],
      "removed": [

      ],
      "modified": [
        "README.md"
      ]
    },
    {
      "id": "f6e182a97de205e9f6cd4d92b8fedd6a807817a7",
      "tree_id": "45e56c7f0f4a6486be395cc3a0ce972fb820e51b",
      "distinct": false,
      "message": "Add EN Description in README",
      "timestamp": "2023-10-25T01:23:26-03:00",
      "url": "https://github.com/ronei-kunkel/larawater/commit/f6e182a97de205e9f6cd4d92b8fedd6a807817a7",
      "author": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "committer": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "added": [

      ],
      "removed": [

      ],
      "modified": [
        "README.md"
      ]
    },
    {
      "id": "03c06d33036bf9fbdc994f18593c55e270bf04ac",
      "tree_id": "689a665464bb53cbd52ec3acc507a7e170d6ef7e",
      "distinct": false,
      "message": "Add PT-BR Description in README",
      "timestamp": "2023-10-25T01:24:01-03:00",
      "url": "https://github.com/ronei-kunkel/larawater/commit/03c06d33036bf9fbdc994f18593c55e270bf04ac",
      "author": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "committer": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "added": [

      ],
      "removed": [

      ],
      "modified": [
        "README.md"
      ]
    },
    {
      "id": "835b2cc0ae4bd329a7c4bccbdd961e779411ecf8",
      "tree_id": "689a665464bb53cbd52ec3acc507a7e170d6ef7e",
      "distinct": true,
      "message": "Merge pull request #34 from ronei-kunkel/teste\n\nUpdating README",
      "timestamp": "2023-10-25T01:25:55-03:00",
      "url": "https://github.com/ronei-kunkel/larawater/commit/835b2cc0ae4bd329a7c4bccbdd961e779411ecf8",
      "author": {
        "name": "Ronei Kunkel",
        "email": "ronei.kunkel@gmail.com",
        "username": "ronei-kunkel"
      },
      "committer": {
        "name": "GitHub",
        "email": "noreply@github.com",
        "username": "web-flow"
      },
      "added": [

      ],
      "removed": [

      ],
      "modified": [
        "README.md"
      ]
    }
  ],
  "head_commit": {
    "id": "835b2cc0ae4bd329a7c4bccbdd961e779411ecf8",
    "tree_id": "689a665464bb53cbd52ec3acc507a7e170d6ef7e",
    "distinct": true,
    "message": "Merge pull request #34 from ronei-kunkel/teste\n\nUpdating README",
    "timestamp": "2023-10-25T01:25:55-03:00",
    "url": "https://github.com/ronei-kunkel/larawater/commit/835b2cc0ae4bd329a7c4bccbdd961e779411ecf8",
    "author": {
      "name": "Ronei Kunkel",
      "email": "ronei.kunkel@gmail.com",
      "username": "ronei-kunkel"
    },
    "committer": {
      "name": "GitHub",
      "email": "noreply@github.com",
      "username": "web-flow"
    },
    "added": [

    ],
    "removed": [

    ],
    "modified": [
      "README.md"
    ]
  }
}
```
