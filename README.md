[![Build Status](https://status.continuousphp.com/git-hub/marabesi/use-case-management?token=53dd4925-c14d-4eba-ad1e-c1c3af3a768e)](https://continuousphp.com/git-hub/marabesi/use-case-management)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/f7ac33340a58440d83d4b991d04cd1f9)](https://www.codacy.com/app/matheus-marabesi/use-case-management?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=marabesi/use-case-management&amp;utm_campaign=Badge_Grade)
[![Build Status](https://travis-ci.org/marabesi/use-case-management.svg?branch=master)](https://travis-ci.org/marabesi/use-case-management)
[![HitCount](http://hits.dwyl.io/marabesi/use-case-management.svg)](http://hits.dwyl.io/marabesi/use-case-management)

# UseCaseManagement

UseCaseManagement is a project developed to help developers to keep requirements up to date. 
This tool has focus on use case and requirements, easy to update, easy to create and manage use cases.

## Why ?

The projects started as a prototype as a final paper to become a Software Engineer, 
it was developed along the MBA Software Engineering course.

More info and a brief tutorial can be found [here](https://marabesi.com/software%20engineering/2016/04/16/requirements-engineering-tool-use-case.html)

## Authors

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

Make sure to set up the permissions correctly, as follows:

```
chmod -R 755 storage/logs/ &&
chmod -R 755 storage/framework &&
chmod -R 755 bootstrap/cache
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
