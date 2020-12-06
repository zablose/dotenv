# DotEnv

[![Build Status](https://travis-ci.org/zablose/dotenv.svg?branch=master)](https://travis-ci.org/zablose/dotenv)

Read '.env' file to a static array.

## Installation

```
composer require zablose/dotenv
```

## Usage

### Read '.env' file(s)

Probably in your `index.php` after auto loader.

```php

use Zablose\DotEnv\Env;

// Auto loader

(new Env())->setArrays(['PROTECTED'])
    ->read(__DIR__.'/../.env')
    ->read(__DIR__.'/../.env-extra');

```

### Get ENV

```php

use Zablose\DotEnv\Env;

$db_name = Env::get('DB_NAME', 'dotenv');
$db_password = Env::get('DB_PASSWORD');

```

Or

> Works, if helper function is in use - added to the project's composer `autoload -> files` section.

```php

$db_name = env('DB_NAME', 'dotenv');
$db_password = env('DB_PASSWORD');

```

## What is supported?

> Look at [ENVs](./tests/data/envs) testing examples for more info.

### Variables

    USER=username
    EMAIL=${USER}@domain.com
    
### Arrays

    PROTECTED_0=_token
    PROTECTED_1=password
    
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

### Quick Start

    $ git clone -b 'dev' --single-branch --depth 1 https://github.com/zablose/dotenv.git dotenv
    $ cd dotenv
    $ git submodule update --init
    
    # Copy env file, then ammend it to your needs.
    $ cp .env.example .env
    
    $ docker-compose -p zdev up -d
    
    # To see post-script logs, while container is starting.
    $ tail -f docker-damp/logs/all.log
    
    # To enter container, using Bash shell.
    $ docker exec -it dotenv-damp bash
    
    (dotenv-damp)$ phpunit

## License

This package is free software distributed under the terms of the MIT license.
