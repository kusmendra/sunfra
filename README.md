# sunfra

# Please follow these steps

1. Clone it using command or download it.

git clone https://github.com/kusmendra/sunfra.git

# we used some third party module like: vlucas/phpdotenv which help to protect confidential information (database info etc...)

2. use command "composer install"  // you will get message like following (next 7 lines):

Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 2 installs, 0 updates, 0 removals
  - Installing symfony/polyfill-ctype (v1.22.1): Loading from cache
  - Installing vlucas/phpdotenv (v2.6.7): Loading from cache
Generating autoload files
2 packages you are using are looking for funding.


# Create .env file with database details like this

DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=api_demo
DB_USERNAME=kushisthebest
DB_PASSWORD=Mygoodpassword




# Import sql file (api_demo.sql) from root folder to database


# use command for start API instance

php -S localhost:8010 -t api           

// then you will see

[Thu Mar 25 01:24:56 2021] PHP 7.4.3 Development Server (http://localhost:8010) started

# you can use any port for API, but you have changed the end point in the application which I statically defined ;)

# use command to start the Application 

php -S localhost:8008 -t public 

// then you will see

[Thu Mar 25 01:25:16 2021] PHP 7.4.3 Development Server (http://localhost:8008) started

# we used port 8008, but you can use any except 8010 (used for api instance)