<h1 align="center"><img src="public/appname.svg" width="500"></h1>

## Version 2.X is here!!

For Version 1.X, view [releases](https://www.texlabit.com//TexLabIt/releases). Continuation of Version 1.X support in **[v1-x-branch](https://www.texlabit.com//TexLabIt/tree/v1-x-branch)** branch.
</p>
<p align="center">
School Management and Accounting Software
</p>

[![Build Status](https://travis-ci.org/changeweb/TexLabIt.svg?branch=master)](https://travis-ci.org/changeweb/TexLabIt)
[![Linux](https://img.shields.io/travis/changeweb/TexLabIt/master.svg?label=linux)](https://travis-ci.org/changeweb/TexLabIt)
[![Code Climate](https://codeclimate.com/github/changeweb/TexLabIt/badges/gpa.svg)](https://codeclimate.com/github/changeweb/TexLabIt)
[![Latest release](https://img.shields.io/github/release/changeweb/TexLabIt/all.svg)](https://www.texlabit.com//TexLabIt/releases)
[![MadeWithLaravel.com shield](https://madewithlaravel.com/storage/repo-shields/1362-shield.svg)](https://madewithlaravel.com/p/TexLabIt/shield-link)
[![Discord](https://img.shields.io/discord/917848091107946556)](https://discord.gg/8sz6kpup99)

We like to challenge the quality of what we build to make it better. To do so, we try to make the product intuitive, beautiful, and user friendly. Innovation and hard work help to fulfill these requirements. I believe in order to innovate we need to think differently. A few months ago I discovered there was no open source free school management software that met my quality standards. I happen to know a bit of programming so I decided to make one. I also believe that working with more people can push the standard higher than working alone. So I decided to make it open source and free.

## Featured on Laravel News !!
![Screenshot_2019-04-07 Laravel News](https://user-images.githubusercontent.com/9896315/55683832-1b3c8c80-5966-11e9-8dfb-ab30a79a98ed.png)
See the news [here](https://laravel-news.com/unified-transform-open-source-school-management-platform)

## Framework used

- Laravel 8.X
- Bootstrap 5.X

<h1 align="center"><img src="public/docs/imgs/ut/Screenshot 2021-12-07 at 01-39-17 TexLabIt.png"></h1>

## Server Requirements

- PHP >= 7.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Testing

- We want testable softwares. Most parts of the software in the previous version 1.x were covered by tests. Lets cover version 2.x as well. You also can contribute by writing test case!
- To run Feature and Unit Tests run following commands:

    ```sh
    $ docker exec -it app sh
    // Inside container shell
    :/# php artisan test
    ```


### Steps to install:
1. Clone or donwload the repository.
2. Create **purify** folder in `storage/app/` directory.
3. Run `cp .env.example .env`.
4. Run `docker-compose up -d`.
5. Run `docker exec -it db sh`. Inside the shell, run:

    ```sh
    :/# mysql -u root -p
    ```

    Mysql **Root password**: `your_mysql_root_password` in the `docker-compose.yml` file. Then run following commands:

    ```sql
    mysql> SHOW DATABASES;
    mysql> GRANT ALL ON TexLabIt.* TO 'TexLabIt'@'%' IDENTIFIED BY 'secret';
    mysql> FLUSH PRIVILEGES;
    mysql> EXIT;
    ```
6. Finally, exit the container by running `exit` in the container shell.
7. Run `docker exec -it app sh`. Inside the shell, run following commands:

    ```sh
    :/# composer install
    :/# php artisan key:generate
    :/# php artisan config:cache
    :/# php artisan migrate:fresh --seed
    ```

    Then exit from the container.
8. Visit **http://localhost:8080**. Admin login credentials:

    - Email: texlab@it.com
    - Password: password

