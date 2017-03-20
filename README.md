# WordPress API Example

A simple example of how to build a JavaScript frontend that is powered by the WordPress API.


## Features of the Example
The following features and technologies are covered in this example:

### WordPress
- [ ] Homepage
- [ ] Blog
- [ ] Pages
- [ ] Custom Post Type
- [ ] Advanced Custom Fields
- [ ] Multi-language
- [ ] WooCommerce Shop

### Frontend
- [ ] Vue.js Frontend
- [ ] Server Side Rendered
- [ ] Pug Templates
- [ ] Webpack


## Prerequisites

- [PHP][] and [Composer][]
- [Docker][] and [Docker Compose][]


## Getting started

You have to run all of these commands from the `wordpress-api-example` folder.

- Create your `.env` file for the API (and edit the values):
  `cp api/.env.example api/.env`
- Install the API dependencies: `composer install -d api`
- Start the application: `docker-compose up -d`
- Open the application in the browser: https://localhost:8000

You can stop the application by running `docker-compose stop`.


[composer]: https://getcomposer.org/
[docker]: https://www.docker.com/get-docker
[docker compose]: https://docs.docker.com/compose/install/
[php]: https://secure.php.net/manual/en/install.php
