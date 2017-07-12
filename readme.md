# Workshops

Is a very basic single page application to test the Vue.js framework, it's connected
to an internal API built with the Laravel framework.

It uses Vue's features like:
- Templates
- Components
- Slots
- Broadcast / Emit
- Two way data binding

## How it works

You can add new teacher, courses and classrooms data as well as remove it.

![Screenshot of the forms to add new data](https://s20.postimg.org/mi3gj331p/homepage.png)

When adding new data instantly you will see that the new data appear below in the corresponding table and in the workshops table, the same happens when you remove data.

In the workshops table you can now select a teacher, course, classroom, day and time to add a new workshop.

![Screenshot of workshops table and form](https://s20.postimg.org/8n560m8ml/workshops.png)

All the data is sended to laravel and persisted in a database.

## Installation

Clone this repository

```
git clone https://github.com/warborn/workshops.git
```

Enter the project and install the dependencies
```
cd workshops
composer install
```

Create an **.env** by copying the **.env.example** file located at the root of the directory and generate a security key used by laravel
```
cp .env.example .env
php artisan key:generate
```

Change the following values in the newly created **.env** file accordingly:
```
DB_DATABASE=dbname
DB_USERNAME=dbuser
DB_PASSWORD=password
```

Setup the database schema and fireup the server
```
php artisan migrate
php artisan serve
```

Now you can check the app on [http://localhost:8000/](http://localhost:8000/)
