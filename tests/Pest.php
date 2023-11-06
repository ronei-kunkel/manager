<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(Tests\TestCase::class)->in('Behavior', 'E2E');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
  return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function gitHubPushEventDeployableWebhookSentPayload()
{
  return '{
  "ref": "refs/heads/main",
  "before": "36df0b6680a7c8ce54789a7636b66266688ac864",
  "after": "cae90d8e65702aa26963f6070e6ed2c6f4502c78",
  "repository": {
    "id": 709702927,
    "node_id": "R_kgDOKk01Dw",
    "name": "manager",
    "full_name": "ronei-kunkel/manager",
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
    "html_url": "https://github.com/ronei-kunkel/manager",
    "description": "Manager is an app to manage the versioning of any apps running over my infra-digitalocean project of infrastructure. Written using Laravel php framework, following DDD concepts and written over clean architecture.",
    "fork": false,
    "url": "https://github.com/ronei-kunkel/manager",
    "forks_url": "https://api.github.com/repos/ronei-kunkel/manager/forks",
    "keys_url": "https://api.github.com/repos/ronei-kunkel/manager/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/ronei-kunkel/manager/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/ronei-kunkel/manager/teams",
    "hooks_url": "https://api.github.com/repos/ronei-kunkel/manager/hooks",
    "issue_events_url": "https://api.github.com/repos/ronei-kunkel/manager/issues/events{/number}",
    "events_url": "https://api.github.com/repos/ronei-kunkel/manager/events",
    "assignees_url": "https://api.github.com/repos/ronei-kunkel/manager/assignees{/user}",
    "branches_url": "https://api.github.com/repos/ronei-kunkel/manager/branches{/branch}",
    "tags_url": "https://api.github.com/repos/ronei-kunkel/manager/tags",
    "blobs_url": "https://api.github.com/repos/ronei-kunkel/manager/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/ronei-kunkel/manager/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/ronei-kunkel/manager/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/ronei-kunkel/manager/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/ronei-kunkel/manager/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/ronei-kunkel/manager/languages",
    "stargazers_url": "https://api.github.com/repos/ronei-kunkel/manager/stargazers",
    "contributors_url": "https://api.github.com/repos/ronei-kunkel/manager/contributors",
    "subscribers_url": "https://api.github.com/repos/ronei-kunkel/manager/subscribers",
    "subscription_url": "https://api.github.com/repos/ronei-kunkel/manager/subscription",
    "commits_url": "https://api.github.com/repos/ronei-kunkel/manager/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/ronei-kunkel/manager/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/ronei-kunkel/manager/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/ronei-kunkel/manager/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/ronei-kunkel/manager/contents/{+path}",
    "compare_url": "https://api.github.com/repos/ronei-kunkel/manager/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/ronei-kunkel/manager/merges",
    "archive_url": "https://api.github.com/repos/ronei-kunkel/manager/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/ronei-kunkel/manager/downloads",
    "issues_url": "https://api.github.com/repos/ronei-kunkel/manager/issues{/number}",
    "pulls_url": "https://api.github.com/repos/ronei-kunkel/manager/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/ronei-kunkel/manager/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/ronei-kunkel/manager/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/ronei-kunkel/manager/labels{/name}",
    "releases_url": "https://api.github.com/repos/ronei-kunkel/manager/releases{/id}",
    "deployments_url": "https://api.github.com/repos/ronei-kunkel/manager/deployments",
    "created_at": 1698222120,
    "updated_at": "2023-10-31T19:03:58Z",
    "pushed_at": 1698784047,
    "git_url": "git://github.com/ronei-kunkel/manager.git",
    "ssh_url": "git@github.com:ronei-kunkel/manager.git",
    "clone_url": "https://github.com/ronei-kunkel/manager.git",
    "svn_url": "https://github.com/ronei-kunkel/manager",
    "homepage": "",
    "size": 150,
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
    "open_issues_count": 0,
    "license": null,
    "allow_forking": true,
    "is_template": false,
    "web_commit_signoff_required": false,
    "topics": [

    ],
    "visibility": "public",
    "forks": 0,
    "open_issues": 0,
    "watchers": 1,
    "default_branch": "main",
    "stargazers": 1,
    "master_branch": "main"
  },
  "pusher": {
    "name": "igencee",
    "email": "138839654+igencee@users.noreply.github.com"
  },
  "sender": {
    "login": "igencee",
    "id": 138839654,
    "node_id": "U_kgDOCEaGZg",
    "avatar_url": "https://avatars.githubusercontent.com/u/138839654?v=4",
    "gravatar_id": "",
    "url": "https://api.github.com/users/igencee",
    "html_url": "https://github.com/igencee",
    "followers_url": "https://api.github.com/users/igencee/followers",
    "following_url": "https://api.github.com/users/igencee/following{/other_user}",
    "gists_url": "https://api.github.com/users/igencee/gists{/gist_id}",
    "starred_url": "https://api.github.com/users/igencee/starred{/owner}{/repo}",
    "subscriptions_url": "https://api.github.com/users/igencee/subscriptions",
    "organizations_url": "https://api.github.com/users/igencee/orgs",
    "repos_url": "https://api.github.com/users/igencee/repos",
    "events_url": "https://api.github.com/users/igencee/events{/privacy}",
    "received_events_url": "https://api.github.com/users/igencee/received_events",
    "type": "User",
    "site_admin": false
  },
  "created": false,
  "deleted": false,
  "forced": false,
  "base_ref": null,
  "compare": "https://github.com/ronei-kunkel/manager/compare/36df0b6680a7...cae90d8e6570",
  "commits": [
    {
      "id": "2f603dbb6eb88b28e031da7eeb42bf3fab00aff3",
      "tree_id": "0b89dc16824fa7668dc3548c51a8da9bfbdffe99",
      "distinct": false,
      "message": "[DATABASE] Migrations",
      "timestamp": "2023-10-31T17:19:48-03:00",
      "url": "https://github.com/ronei-kunkel/manager/commit/2f603dbb6eb88b28e031da7eeb42bf3fab00aff3",
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
        "database/migrations/2023_10_31_111230_create_user_table.php",
        "database/migrations/2023_10_31_111231_create_platform_table.php",
        "database/migrations/2023_10_31_111231_create_repository_table.php",
        "database/migrations/2023_10_31_111232_create_notification_table.php",
        "database/migrations/2023_10_31_112232_create_notified_event_table.php",
        "database/migrations/2023_10_31_134220_create_event_push_table.php",
        "database/migrations/2023_10_31_135855_create_commit_table.php"
      ],
      "removed": [

      ],
      "modified": [
        "config/database.php",
        "src/Notification/Application/Builder/EventBuilder.php",
        "src/Shared/Domain/Entity/Commit/Commit.php",
        "src/Shared/Domain/Entity/Repository/Repository.php"
      ]
    },
    {
      "id": "cae90d8e65702aa26963f6070e6ed2c6f4502c78",
      "tree_id": "0b89dc16824fa7668dc3548c51a8da9bfbdffe99",
      "distinct": true,
      "message": "Merge pull request #4 from ronei-kunkel/migrations\n\n[DATABASE] Migrations",
      "timestamp": "2023-10-31T17:27:27-03:00",
      "url": "https://github.com/ronei-kunkel/manager/commit/cae90d8e65702aa26963f6070e6ed2c6f4502c78",
      "author": {
        "name": "iGencee",
        "email": "138839654+igencee@users.noreply.github.com",
        "username": "igencee"
      },
      "committer": {
        "name": "GitHub",
        "email": "noreply@github.com",
        "username": "web-flow"
      },
      "added": [
        "database/migrations/2023_10_31_111230_create_user_table.php",
        "database/migrations/2023_10_31_111231_create_platform_table.php",
        "database/migrations/2023_10_31_111231_create_repository_table.php",
        "database/migrations/2023_10_31_111232_create_notification_table.php",
        "database/migrations/2023_10_31_112232_create_notified_event_table.php",
        "database/migrations/2023_10_31_134220_create_event_push_table.php",
        "database/migrations/2023_10_31_135855_create_commit_table.php"
      ],
      "removed": [

      ],
      "modified": [
        "config/database.php",
        "src/Notification/Application/Builder/EventBuilder.php",
        "src/Shared/Domain/Entity/Commit/Commit.php",
        "src/Shared/Domain/Entity/Repository/Repository.php"
      ]
    }
  ],
  "head_commit": {
    "id": "cae90d8e65702aa26963f6070e6ed2c6f4502c78",
    "tree_id": "0b89dc16824fa7668dc3548c51a8da9bfbdffe99",
    "distinct": true,
    "message": "Merge pull request #4 from ronei-kunkel/migrations\n\n[DATABASE] Migrations",
    "timestamp": "2023-10-31T17:27:27-03:00",
    "url": "https://github.com/ronei-kunkel/manager/commit/cae90d8e65702aa26963f6070e6ed2c6f4502c78",
    "author": {
      "name": "iGencee",
      "email": "138839654+igencee@users.noreply.github.com",
      "username": "igencee"
    },
    "committer": {
      "name": "GitHub",
      "email": "noreply@github.com",
      "username": "web-flow"
    },
    "added": [
      "database/migrations/2023_10_31_111230_create_user_table.php",
      "database/migrations/2023_10_31_111231_create_platform_table.php",
      "database/migrations/2023_10_31_111231_create_repository_table.php",
      "database/migrations/2023_10_31_111232_create_notification_table.php",
      "database/migrations/2023_10_31_112232_create_notified_event_table.php",
      "database/migrations/2023_10_31_134220_create_event_push_table.php",
      "database/migrations/2023_10_31_135855_create_commit_table.php"
    ],
    "removed": [

    ],
    "modified": [
      "config/database.php",
      "src/Notification/Application/Builder/EventBuilder.php",
      "src/Shared/Domain/Entity/Commit/Commit.php",
      "src/Shared/Domain/Entity/Repository/Repository.php"
    ]
  }
}';

}
