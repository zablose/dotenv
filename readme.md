![](https://github.com/zablose/dotenv/actions/workflows/tests-on-master.yml/badge.svg)
![](https://github.com/zablose/dotenv/actions/workflows/tests-on-dev.yml/badge.svg)

# DotEnv

Read '.env' file or files to a static array.

## Installation

```
composer require zablose/dotenv
```

## Usage

### Read '.env' file(s)

Probably in your `index.php` after autoloader.

```php

use Zablose\DotEnv\Env;

// Autoloader

(new Env())->setArrays(['PROTECTED'])
    ->read(__DIR__.'/../.env')
    ->read(__DIR__.'/../.env-extra');

```

### Get ENV

```php

use Zablose\DotEnv\Env;

$db_name = Env::string('DB_NAME', 'dotenv');
$db_password = Env::string('DB_PASSWORD');
$db_port = Env::int('DB_PORT');

```

Or

> Works, if helper function is in use - added to the project's composer `autoload -> files` section.

```php

$db_name = env_string('DB_NAME', 'dotenv');
$db_password = env_string('DB_PASSWORD');
$db_port = env_int('DB_PORT');

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

| Type    | Example                |
|---------|------------------------|
| Boolean | DEBUG_ON=true          |
| Float   | PI=3.14                |
| Integer | RAM=128                |
| String  | GREETING=Welcome back! |

## Development

> Check submodule's [readme](https://github.com/zablose/docker-images/blob/main/readme.md) for more details about
> development environment used.

### Quick start

    $ git clone -b 'dev' --single-branch --depth 1 https://github.com/zablose/dotenv.git dotenv
    $ cd dotenv
    $ git submodule update --init
    
    # Copy env file, then ammend it to your needs.
    $ cp .env.example .env

    # Copy docker compose file, then ammend it, if needed.
    $ cp docker-compose.example.yml docker-compose.yml
    
    $ docker-compose up -d
    
    # To see post-script logs, while container is starting.
    $ tail -f ./logs/all.log
    
    # To enter container, using Bash shell.
    $ docker exec -it dotenv-php-fpm bash
    
    (dotenv-php-fpm)$ php vendor/bin/phpunit

### Build

* Merge changes from your branch to `master`;
* Create a new branch from updated `master` called like `build-2.0.0`;
* Run `php vendor/bin/phing prepare` to remove all irrelevant files and folders;
* Commit changes with message like `Prepare build.`;
* Merge branch `build-2.0.0` to `build` branch;
* Delete `build-*` branch;
* Use tag `2.0.0` on `build` branch to do the release.

> Obviously, replace example `2.0.0` version with yours.
