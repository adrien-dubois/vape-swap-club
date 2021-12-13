# Vape Swap Club

This is a project for a bargain website around vape stuff based-on an e-commerce website.

You'll can sell your vape stuff, but just high end / moders pieces. To be part of the club, you have to sell / research a certain kind of vape stuff.

## Project

The purpose of this project is to just back to the basics. After long time on Symfony, I don't want to miss my PHP skills.

So I'm making all functionnality of an E-Commerce website from scratch : cart / commands / orders / announce / authentication / acl / voters etc...

This is a E-Commerce website, with register / account. Sell/buy by announces. 

A simple user can make a request to became vendor and post his own products.

### `Technos`

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

### `Features`

- Register / Authentication system
- Profile section with information & customize
- Voter system to make a personal permission access system
- Internal personnal Messenger to discuss with vendors
- Stripe paiment module
- Cart system
- Backoffice for admins to manage website
- Contact form to message the webmaster
- A vendor form to send a request for become vendor

### `Install`

If you want to install it, you'll have to :

- Make a composer install
- Create a DataBase named `vapeswap`
- Make the tables, I put two sql files into `docs` directory if you want to import it directly. One with datas, other is empty.
- Make a config.ini and configure it as explained in the config.ini.dist in `\app\`
- Run with PHP server, you can run the `server.sh` script if you want
