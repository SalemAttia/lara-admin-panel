



## Simple REST API With Dashboard

### install

##### - run this cmd

- git clone https://github.com/ahmedsalemA/Team-REST-API-MODULE.git 
- composer install
- (don't forget to edit your .env )
- php artisan migrate
- sudo composer dump-autoload
- php artisan db:seed
- php artisan serve

#### Log in 
- Click this link <a href="http://127.0.0.1:8000/dashboard/login">http://127.0.0.1:8000/dashboard/login</a>
  <br>email :- Judith@test.com
  <br>password :- secret
- you can find docs for Apis <a href="http://127.0.0.1:8000/docs/index.html">http://127.0.0.1:8000/docs/index.html</a>
- enjoy now :) 
##### - second step import json into post man for test your api

<i> this file in the public folder {{ App.postman_collection.json }}
import this file on post-man </i>

#### check your  Modules in this dir {app/Modules}
<b>in this dir you can find Team module with Users Module it's a way for create app using modules all routes 
in views and controllers db migrations models will be in folder </b>

<b> check too crud generation i created for this module it help you to create
module easy by write cmd </b>

#### Examples
- php artisan generate:adminModule Salem --cols=name:string:required,age:integer:required:integer --filter=name --icons='fa fa-users'

