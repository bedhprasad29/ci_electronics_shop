## About Electronic Shop

A electronic shop is a website where shop owner can check the list of roles, products, categories and employees based on their role access. User can check their profile and change password as well.

## System requirement

- Composer version should be Composer 2.1.12
- PHP version should be PHP 7.4.10
- CodeIgniter framework v4.x

## Database setup

- database.default.hostname = localhost
- database.default.database = electronic_shop
- database.default.username = root
- database.default.password = 
- database.default.DBDriver = MySQLi

## Steps to configure app

- git clone https://bedhprasad29@bitbucket.org/bedhprasad29/electronics_shop.git (through HTTPS) or https://bitbucket.org/bedhprasad29/electronics_shop/src/master/
- Run the command
  - php spark migrate : Spark command to generate a database migration.
  - php spark db:seed AllSeeder : Seed the database with dummy records.
  - php spark serve : Serve to run project in local server
- Run the application by doing Signup
  - Else you can use my id: Email - admin@gmail.com, Password - 123456
  - All Seeder generated users have a default password - 123456 
- You can check the list of roles, products, categories and employees based on your role access.
- User can check their profile and change password as well.

## Commands used to create this project

- php spark migrate : spark command to generate a database migration
- php spark migrate:refresh : Drop all tables and re-run all migrations
- php spark make:seeder <SeederName> : Create a new seeder class
- php spark db:seed <SeederName> : Seed the database with records.
- php spark routes : Displays all of user-defined routes. Does NOT display auto-detected routes.
- php spark serve : Launches the CodeIgniter PHP-Development Server.
- php spark make:controller `ControllerName` : Create a new controller class
- php spark make:model `ModelName` : Create a new Eloquent model class
- php spark make:filter `FilterName` : Generates a new filter file.

## Third Party API's used

- JWT : to share access token information between a client and a server.