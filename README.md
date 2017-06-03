Happiness Level Meter
=====================

INSTALL
-------
composer install && d:d:c && d:m:m -n


VOTE
----

`POST /happiness_levels`

```json
{
  "level": "string",
  "entrypoint": "string"
}
```

RESULTS
-------
Optional date format: `YYYY-MM-DD`

`GET /happiness_levels/statistics`

`GET /happiness_levels/statistics/{from}`

`GET /happiness_levels/statistics/{from}/{to}`