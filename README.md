# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new [Slim Framework 3](https://www.slimframework.com/) application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Usage

To create the database:

	composer db

To run the application in development mode:

	composer start

To run the test suite:

	composer test

## API

### Todo

- GET `/todo`
- GET `/todo/{id}`
- POST `/todo` : _fields: `subject` and `status`_
- PUT `/todo/{id}` : _fields: `subject` and `status`_
- DELETE `/todo/{id}`
- GET `/todo/{id}/category`
- POST `/todo/{id}/category/{category_id}`

### Category

- GET `/category`
- GET `/category/{id}`
- POST `/category` : fields: `name`
- PUT `/category/{id}`
- DELETE `/category/{id}`
