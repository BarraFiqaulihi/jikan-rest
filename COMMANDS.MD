# Artisan Commands

Artisan commands are run in the root of the project directory where the `artisan` file is present.
For an entire list of commands, you can run `php artisan list`

## Index
- [Serve](#serve)
- [Queue](#queue)
    - [Clear](#queue-clear)
- [Cache](#cache)
    - [Remove](#cache-remove)
    - [Change Cache Driver](#cache-change-cache-driver)
    - [Change Cache Method](#cache-change-cache-method)
- [Indexer](#indexer)
    - [Anime](#indexer-anime)
    - [Manga](#indexer-manga)
    - [Incremental](#indexer-incremental)

## Commands

### Serve
Command: `serve`
Example: `php artisan serve`

Serve the application on the PHP development server

### Queue

#### Queue: Clear
Command: `queue:clear`

Example: `php artisan queue:clear`

This will empty any cache updater jobs that are currently in queue if you're using the [Queue Cache Method](https://github.com/jikan-me/jikan-rest/blob/master/README.md#06-configuring-how-jikan-handles-expired-cache-optional)

### Cache

#### Cache: Remove
Command: `cache:remove {key}`

Example: `php artisan cache:remove request:anime:d6092f2422f084452c84555f17c7ba047e6998d3`

This will remove the cache of a specific request. You can retrieve any request's hash key by visiting the request.

In v2-v3, the request hash key is defined in the JSON response body as `request_hash`.

In v3.4+, the request is defined in the response headers as `X-Request-Hash` as well.

In v4+, the request is defined only in the response header.

#### Cache: Change Cache Driver
Command: `cache:driver {driver}`

Example: `cache:driver redis`

[Read more on how it works](https://github.com/jikan-me/jikan-rest/blob/master/README.md#05-configuring-how-jikan-caches-optional)

#### Cache: Change Cache Method
Command: `cache:method {method}`

Example: `cache:method queue`

[Read more on how it works](https://github.com/jikan-me/jikan-rest/blob/master/README.md#06-configuring-how-jikan-handles-expired-cache-optional)

### Indexer
#### Indexer: Anime
Since v4 uses MongoDB as a means to index cache on some endpoints, having a built cache is important since it
works best for endpoints like search or top.

`Indexer:Anime` uses [https://github.com/purarue/mal-id-cache](https://github.com/purarue/mal-id-cache) to fetch available MAL IDs and indexes them.

This function only needs to be run once. Any entry's cache updating will automatically be taken care of if it's expired, and a client makes a request for that entry.

⚠ This is strictly for performance and experience and providing better search functionality. Don't build your own anime database as that's against MyAnimeList's Terms of Service.

Command:
```
indexer:anime
    {--failed : Run only entries that failed to index last time}
    {--resume : Resume from the last position}
    {--reverse : Start from the end of the array}
    {--index=0 : Start from a specific index}
    {--delay=3 : Set a delay between requests}
```

Example: `indexer:anime --reverse --delay=5 --failed`

This translates to running entries that previously failed to index or update, in reverse, with a delay of 5 seconds between each request.

#### Indexer: Manga
Since v4 uses MongoDB as a means to index cache on some endpoints, having a built cache is important since it
works best for endpoints like search or top.

`Indexer:Manga` uses [https://github.com/purarue/mal-id-cache](https://github.com/purarue/mal-id-cache) to fetch available MAL IDs and indexes them.

This function only needs to be run once. Any entry's cache updating will automatically be taken care of if it's expired, and a client makes a request for that entry.

⚠ This is strictly for performance and experience and providing better search functionality. Don't build your own anime database as that's against MyAnimeList's Terms of Service.

Command:
```
indexer:manga
    {--failed : Run only entries that failed to index last time}
    {--resume : Resume from the last position}
    {--reverse : Start from the end of the array}
    {--index=0 : Start from a specific index}
    {--delay=3 : Set a delay between requests}
```

Example: `indexer:manga`

This simply translates to running the indexer without any additional configuration.

#### Indexer: Incremental
Incrementally indexes media entries from MAL.
This command will compare the latest version of MAL ids from the [mal_id_cache](https://github.com/purarue/mal-id-cache)
github repository and compares them with the downloaded ids from the previous run. If no ids found from the previous run, a full indexing session is started.

Command:
```
indexer:incremental {mediaType*}
    {--failed : Run only entries that failed to index last time}
    {--resume : Resume from the last position}
    {--delay=3 : Set a delay between requests}
```
