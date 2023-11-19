<?php declare(strict_types=1);

namespace HyperfTest;

trait FunctionsTrait
{
  public function githubExamplePayload()
  {
    return '{
        "zen": "Responsive is better than fast.",
        "hook_id": 100000000,
        "hook": {
          "type": "App",
          "id": 100000000,
          "name": "web",
          "active": true,
          "events": [
  
          ],
          "config": {
            "content_type": "json",
            "insecure_ssl": "0",
            "url": "http://base-url.com/url"
          },
          "updated_at": "2023-11-17T00:30:14Z",
          "created_at": "2023-11-17T00:30:14Z",
          "app_id": 100000,
          "deliveries_url": "https://api.github.com/app/hook/deliveries"
        }
      }';
  }
}