# DotEnv

Read '.env' file to a static array.

## Usage

### Read '.env' file(s)

Probably in your `index.php` after auto loader.

```php

use Zablose\DotEnv\Env;

// Auto loader

(new Env())->setArrays(['VAR_PROTECTED'])
    ->read(__DIR__.'/../.env')
    ->read(__DIR__.'/../.env-extra');

```

### Get ENV

```php

use Zablose\DotEnv\Env;

    $db_name = Env::get('DB_NAME', 'dotenv');
    $db_password = Env::get('DB_PASSWORD');

```

## What is supported?

> Look at [ENVs](./tests/data/envs) testing examples for more info.

### Variables

    USER=username
    EMAIL=${USER}@domain.com
    
### Arrays

    USER_0=Jane
    USER_1=Jack
    
### Value Types

| Type | Example |
| --- | --- |
| Boolean | DEBUG_ON=true |
| Float | PI=3.14 |
| Integer | RAM=128 |
| Null | LOG=null |
| String | GREETING=Welcome back! |

## Development

> Check submodule's [readme](https://github.com/zablose/docker-damp/blob/master/readme.md) for more details about
> development environment used.

### Hosts

Append to `/etc/hosts`.

```
127.0.0.1       dotenv.zdev
127.0.0.1       www.dotenv.zdev
```

## License

This package is free software distributed under the terms of the MIT license.
