Happiness Level Meter
=====================

Vote
----

`POST /happiness_levels`

```json
{
  "level": "string",
  "entrypoint": "string"
}
```

Get results
-----------
Optional date format: `YYYY-MM-DD`

`GET /happiness_levels/statistics`

`GET /happiness_levels/statistics/{from}`

`GET /happiness_levels/statistics/{from}/{to}`