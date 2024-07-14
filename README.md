
## About The Project

This project has been created to demonstrate the use of Laravel 8 and Vue.js. The project is a simple application that allows users to create and read users. The project uses Laravel as the backend and Vue.js as the frontend. To run the project, you need to have follow the steps given below:
- Clone the repository.
- Copy the `.env.example` to `.env`.
- Enter database credentials as setup on your machine
- run `composer install`.
- run `php artisan migrate` to get all the tables.
- run `php artisan db:seed` and `php artisan db:seed --class=RoleSeeder` to get the admin user and roles populated.
- run `npm install`.
- run `npm run dev` to serve the site.
- Login with the following credentials:
    - email: admin@example.com
    - password: password
- go to `/users` to see the users.
- Note: 
  - Since there are roles introduced in the project, only the admin can create users
  - Since users need a password, the static password is set as `password` for all users created through the form submission.
