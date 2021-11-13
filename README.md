# Vape Swap Club

This is a project for a bargain website around vape stuff on the base of an e-commerce website.

You'll can sell your vape stuff, but just high end / moders pieces. To be part of the club, you have to sell / research a certain kind of vape stuff.

## Project

/!\ __*WORK IN PROGRESS*__ /!\

The purpose of this project is to just back to the basics. After long time on Symfony, I don't want to miss my PHP Vanilla skills. I love PHP to much for that!

So I'm making all functionnality from scratch : cart / commands / orders / announce / authentication / acl etc...

This is a E-Commerce website, with register / account. Sell by announces or buy. I will think about a system to check originals

## Technos

- HTML
- CSS Vanilla
- JS Vanilla
- PHP personal framework with those dependencies:
    - Composer
    - Alto Router
    - Alto Dispatcher
    - Var Dump
    - PHP Mailer
    - Stripe

- For unit & fonctional tests :
    - PhpUnit
    - Spatie PhpUnit Watcher

## Install

If you want to test it, you'll have to :

    - Make a composer install
    - Create a DataBase named `vapeswap`
    - For the tables, you have in the `docs` directory 2 sql docs :
        - 1st which is the tables and some datas to start in the tables
        - 2nd which is the tables empty, no datas in, you are free to start    
          from scratch
    - Make a config.ini and configure it as explained in the config.ini.dist in `\app\`
    - Run with PHP server, you can run the `server.sh` script if you want
