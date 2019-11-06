Learning Laravel from scratch, LaraCast Youtube Channel.
=======================================================
The goal of this execrcise to learn the right way of doing things in Laravel
and build a blog. I will be going through tutorial on this youtube channel
laravel playlist, one by one.

After I finished to Turoial 9. It does a redoing of all examples , from with routes\web.php to TasksController.
So From tutorial 10 onwards we are creating a new

1. Install Larevel
    a. Via Composer Create-Project, you may also install Laravel by issuing the Composer create-project command in your terminal:
       #composer create-project --prefer-dist laravel/laravel blog
    b. Via Laravel Installer - First, download the Laravel installer using Composer:
       #composer global require laravel/installer

    Issue
    ======
    Once installed laravel, I was getting 403 forbidden error, also I was getting persmission issues accessing files from editor ?
    I had to make myself part of "www-data" group, I had to make "www-data" which is apache owner of the directory and give permissions

    Solved
    =======
    $usermod -a -G www-data irfan #make me part of "apache group".
    $chgrp www-data /var/www/html #change group owner to "owner apache".
    $chmod g+rwxs /var/www/html #give persmission o the group.

    Issues
    ======
    Routes were not working - enabling "Rewrite"

    Solved
    ======
    $sudo a2enmod rewrite
    $sudo systemctl restart apache2
    $sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf.bak
    $cd /etc/apache2/sites-available/
    $sudo nano 000-default.conf
    $ Add Section
      ServerAdmin webmaster@localhost
      DocumentRoot /var/www/html/laravel-crud/public
      <Directory /var/www/html/laravel-crud/public>
          Options Indexes FollowSymLinks MultiViews
          AllowOverride All
          Require all granted
      </Directory>

2. Routes & Views
    Notes
    =====
    \project\routes\web.php
    1. Routes are using closure function by default.
    2. You dont have to append .blade.php in calling views.
    3. dd() #stands for dump & die instead of var_dump();

3. Laravel Valet (Skipped, its some setup for macosx)
4. Database setup & Mysql admin
    Issue
    =====
    After installing mysql database, "Access denied" - I installed mysql according
    to this link https://hostadvice.com/how-to/how-to-install-apache-mysql-php-on-an-ubuntu-18-04-vps/
    1. $mysql -u root -p #does not work after setting password while installing
    mysql, which is default found out after.

    Solved
    ======
    Accordng to "Second fix" on this page", NEW Version of MYSQL does it this way, "Solution"
    https://stackoverflow.com/questions/39281594/error-1698-28000-access-denied-for-user-rootlocalhost
    1. $sudo mysql -u root -p
    2. ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'new-password';
    3. $sudo service mysql stop
    4. $sudo service mysql start
    5. $mysql -u root -p #should wok now with your password

    Process
    =======
    1. Install mysql, log-in, create blog database.
    2. Setup database settings in .env file - ".env" file, should be your single
       secure place to store all you passwords, api keys and sensitive information.
       and it should be in .gitignore file.
    3. $php artisan migrate #Creates laravel specific tables in mysql.
    4. /database/migrations/ #Migraions where migrations exists.

5. Pass Data To Your Views - From /routes/web.php
    1. Different ways to pass variables to view from routes if needed, example
       1,2,3,4 different way to asign variables to view, "so visiting url/route
       /laracast" shows ou value of assigned variable.
    2. Example 5, shows how to pass objects, arrays to views and have them loop
       results over using correct blade views "so visiting url/route
       /laracastviewloop" loops over array in blade templates.

6. Working With The Query Builder

    Process
    =======
    1. Create a database migrations.This creates a migration file in /database/migrations/create create_example_categories.php
    2. $php artisan make:migration create_tasks_table --create tasks
    3. --create special flag above tells, we are creating a table, instead of some other schema alteration.
    4. Now you can open the migration file "create_example_categories.php" and add your extra columns as needed before running migration below.
    5. $php artisan migrate #runs migrations and creates laravel and example_categories table.
    6. Examples 6 in routes/web.php of fetch db rows by ID  using query builder.
    7. Examples 7 in routes/web.php of fetch all db rows using query builder.

    Notes
    =====
    1. $php artisan make:???? command is used to create files
    2. $php artisan make:migration create_example_categories_table --create example_categories
    3. php artisan migrate:refresh #Clear cache and re-run migrations
    4. If you need to Chages a migration, i.e column, add, delete, data length
        1. change the file from "database/migration/create_example_categories.php" then
        2. $php artisan migration:refresh #Clear cache and re-run migrations
        $composer dump-autoload
    5. If you need to delete a migration
        1. delete the file from "database/migration" then
        2. $php artisan migration:refresh #Clear cache and re-run migrations
        $composer dump-autoload

7. Eloquent Model
    1. Create a model, which implemens Eloquent Model Class
       Notes: make sure eloquent model name is singular "Task" and migration/DB table as "tasks" plural
       $php artisan make:model Task #Created model \app\Task.php
    2. Create a public method inside App\Task isCompleted()
    2. Artisan Tinker - To Tinker with Task model
       $php artisan tinker
       >>>APP\Task::all() #Shows all records in the Database
       >>>APP\Task::where('id', '>', 2)->get() #Shows records by filter
       >>>APP\Task::pluck('title') #get all titles columns only for all rows
       >>>APP\Task::pluck('title')->first() #get first title columns only from all rows
    3. Replace old examples - Working with The Query Builder to Eloquent model
    4. You can generate Model, Migration, controller same time using artisan command for "DB Table"
    5. Create task entry in DB using artisan Tinker
       $php artisan tinker
       >>>$task = new APP\Task;
       >>>$task->title = 'orange';
       >>> $task->save()
    6. Query scopes to add getter methods to models which perform special query i.e
       public function isCompleted() return all rows which have completed as which can then
       be further binded. "Make Sure You Implement This In Your Project"
8. Controllers
    1. Tutorial upgrades all previous examples with this Controller chapter. It removies all logic from within routes into a sepeareted Conroller, which is the better ways of doing thigs.
    Previous Examples showed difference 2 different ways to access data , Model way and Query Builder way.
    Moves all above examples from within /web/routes to Controllers
    2. I have left the previous examples covered by routes/web.routes as routes/web.php.irfan.examples
9. Route Model Binding
    1. A very neat way of Querying/binding/returning Models to routes and Controllers
    Old Example
    1. We has a Task Model
    2. We have a Route::get('/examples/tasks/using-eloquent-model/{task_id}', 'TasksController@taskByEloquentModel');
    3. Contoller logic : public function taskByByQueryBuilder($id) { $task = DB::table('tasks')->find($id); }
    New SuperWay
    1. Rename {task_id} to match "Model Name", Route::get('/examples/tasks/using-eloquent-model/{task}', 'TasksController@taskByEloquentModel');
    2. Rename Contoller logic : public function taskByByQueryBuilder(Task $task) { Remove this //$task = DB::table('tasks')->find($id); }

10. Layouts & Views. Creating Post Project
    1. Delete default welcome.blade.php
    2. Create a master layout , /views/layouts/master.blade.php,
    3. Created blade based layout files
       1. Copied Bootstrap4 "Album" layout.
       2. Replaced bootstrap.css with CDN link.
       3. Copied album.css to /publi/css/album.css
    3. Create Posts, Model, Controller, Migration and \Views\Posts, Folder
    4. To create posts logic we need a model, controller, migration. So instead of creating all those
       with $artisan command one by one, we can use one artisan command to create them all. Artisan has a special flag for $artisan make:model -cm create migration and controller with a model.
    5. $artisan make:model Post -cm #Create Posts, Model, Controller, Migration

11. Form Request Data and CSRF, Create Records with Forms
      1. Build HTML form for creating blogs
      2. Add {{ csrf_field() }} to the form
      3. Use eloquent model for storing blogs to db, also added fillable columns to post model which
         is the preffered way to allow which fields are saved to the Database.
      4. Create a parent Model adding $fillable as its property then use that o inherit all our models.

12. Form Validation
      1. Add HTML "required" field for form inputs for browser Validation.
      2. HTML validaion added above can be overriden, and also some browsers may not implement it
         we need to add laravel server validation.
      3. Create error partial to show form errors.

13. Rendering posts
      1. Create post card visual looping partial posts\postcard.blade.php
      2. Use carbon date time libraray to format timestamsp $post->created_at->toFormattedDateString()
      2. All timestamps are carbon dates which is a library.

14. Laravel Mix and the Front End
    Notes: Works with resources\js and resources\sass folders
    =====
    1. Laravel&Mix are node dependecies, Laravel mix is a layer on top of webpack.
    2. When you run Laravel mix or $npm run etc, it takes your "SASS files from resources/sass directory and compile/minifies into /public/css/app.css"
    3. When you run Laravel mix or $npm run etc, it takes your "JS files from resources/js directory and compile/minifies into /public/js/app.js"
    4. We replace old bootstrap album.css with automated compiled app.css files in "master.layout" head section.

    Process
    =======
    1. Cleared files sass\app.scss and restarted this file according to tutorial.
    2. Installed nodeJS & Npm which is need by Laravel Mix, which usese webpack.
    3. $npm install #from root directory to install dependencies in project
    4. look at "package.json" shows you how to run commands for laravel mix
    5. Ran $npm run development to compile assets /js/app.js /css/app.css

15. Eloquent Relationships and Post Comments
    Notes
    =====
    1. Add comments table, to build relationship between blog and comments.
    2. Added "public function comments()" to Post.php for reltionship between blog/comments
    3. Added two dummy comments with post_id(3) linking to post with id(3)
       Use $php artisan tinker# to query relationship data.
       >>>$post = App\Post::find(3); #Get a post object
       >>>$post->comments #Get comments for the above post, do not call it as a method $post->comments()
    5. Added "public function post()" to Comment.php for belongsTo relationship between comments/blog
       Use $php artisan tinker# to query relationship data.
       >>>$c = App\Comment::first(); #Get first comment
    6. Add blog commets per blog to blog view

    Process
    =======
    1. $php artisan make:model Comment -m #Create comment table & migration

  16. Add Comments from Post Page The Way The Client Requests

    Process
    =======
    1. Create "Add cooment" form to showPost View.
    2. Create Comments contoller/routes/ to add comments.
    3. Moved create comment logic from contoller to Post Model.
    4. Add Comments and show on Post page.

    1. We could create funcionality, to add addComments to Posts Controller but good approach is to create a seperate
       Comments Conroller to handle this.
    2. $php artisan make:Controller CommentsController
    3. return back() in the controler sends user back to the page they posted form from.

  17. Rapid Authentication and Configuration

      Process
      =======
      1. Create auhentication resources using $php artisan
      2. Configure ath views to work with current layout.
      3. Register, login to test fucnionality.
      4. Test "Forgot your password" link did not work as I did not have any email server Setup
          Solution: In .env file change MAIL_DRIVER=smtp  MAIL_DRIVER=log
          Result: \storage\logs\log file was created with entry insead of email being sent.

      1. $php artisan make:auth #To create all auth related assets
      2. It will create \views\auth folders,
          1. Auth::routes(); in /routes/web.php
          2. Auth Views \views\auth\ folders
          3. New layout in layouts\app.blade.php
          4. Auth contollers in \app\Http\Contollers.
      3. To make the Auth views work with my master.blade.php,
          1. In all auth views I changed this @extends('layouts.app') to @extends('layouts.master')
          2. In all \Http\Controllers\Auth\* protected $redirectTo = '/home'; to protected $redirectTo = '/';

    18. Associating Posts/Comments With Users
        Process
        =======
        1. Modify previous code, i.e models to associate user with post and comments.
        2. Add "$table->integer('user_id');" to comment and post model.
        3. Add "Comment\User", "Post\User" Model relationship.

    19. I did not follow as it was just ovewriing AUTH cod we added in the previous execrcie.
        I think I wont have the need for this.

    20. Sql queries for Posts Archive
        Generate SQL group queries to list post archives in the sidebar

    21. View Composer
        Regiser $archives variable from the previous execrcise, ino global View, so we dont have to use it everyContoller to asign it to each view.
        It is regsitered for the sidebar.view using app servic provider.

    22. Testing
        Needs to be reviewed.

    23. DI Automatic Resolution and Repositories
        For making modulated repository, spiting fucntionality even more.

    24. Service Container
        =================
        Provides dependency injection containers, i.e
        App::bind("App/Billing/CrediCard")
        $creditCard = App:make("App\Billing\Stripe")
        $creditCard insance can be created anywhere in the code now


    25. Service provider
        ===============
        Basically, you use this to add Your Custom Class accessible to the rest of the code using Service containes and Service providers like the previous example 24. What you created in this is added to the service provider file.
