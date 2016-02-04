# UseCaseManagement (under development)

UseCaseManagement is a project developed to help developers to keep requirements up to date. 
This tool has focus on use case and requirements, easy to update, easy to create and manage use cases.

## Why ?

The projects started as a prototype as a final paper to become a Software Engineer, 
it was developed along the MBA Software Engineering course

## Auhors

* Carlos Wilker
* Carolina Camargo
* Matheus Marabesi

## What can I do ?

1. Create use cases to a given application
2. Manage use cases (create, delete, update)
3. Create revisions to each use cases as well as actors

## Setup

Clone the repository

```
git clone https://github.com/marabesi/use-case-management.git use-case
```

Create your own .env configuration with the following content (you must change the values to fit your own environment)

```
APP_ENV=local
APP_DEBUG=true

DB_HOST=localhost
DB_DATABASE=ucm
DB_USERNAME=postgres
DB_PASSWORD=123456
```

Run all tests (to be sure everything is ok)

```
phpunit
```

an you should see something like that (if don't fix the errors before continue)

```
PHPUnit 4.8.2 by Sebastian Bergmann and contributors.

.......................................

Time: 2.63 seconds, Memory: 57.50Mb

OK (39 tests, 85 assertions)
```

Go to the public folder and start a serve built-in the PHP

```
cd use-case/public

php -S localhost:8181
```

Chose a browser and open the link

```
firefox localhost:8181
```