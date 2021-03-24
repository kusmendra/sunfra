# sunfra

# Please follow these steps

# we used some thired party module like: vlucas/phpdotenv which help to protect confidential information (database info etc...)

1. Clone it or download it.

2. use command "composer install"  // will install all dependency

# Create .env file with database details like this

DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=api_demo
DB_USERNAME=kushisthebest
DB_PASSWORD=Mygoodpassword

# use command to start the Application 

php -S localhost:8008 -t public

# we used port 8008, but you can use any except 8010 (used for api instance)


# use comamnd for start API instance

php -S localhost:8010 -t api

# you can use any prot for API, but you have change the end point in application which I staticly defined ;)
