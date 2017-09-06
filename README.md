# slim3-todos-example

> Todos example API using [Slim Framework 3](https://www.slimframework.com/) and [SQLite 3](http://www.sqlite.org/).

## Usage

To install dependencies:

	composer install

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
