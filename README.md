# People Portal API 

## Installation

Clone the repository and run the below command

```bash
cd {path_to_the_project}
composer install
cp .env.example .env
php artisan key:generate
```
#### Configuration
* Create a MySQL database
* Open the .env file and configure the database as below

```bash
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE="{your_database_name}"
DB_USERNAME="{your_database_user}"
DB_PASSWORD="{your_database_user_password}"

```
#### Database Migration
Run the Passport installation
```bash
php artisan migrate
```
#### API Authentication 
Passport package installation
```bash
php artisan passport:install
``` 
Copy the Password access client ID and Client Secret from Terminal and add them to the ```.env``` file as below.
```
PASSWORD_ACCESS_CLIENT_ID={Client ID}
PASSWORD_ACCESS_CLIENT_SECRET={secret}
```

### Generate random data
```
php artisan db:seed
```
