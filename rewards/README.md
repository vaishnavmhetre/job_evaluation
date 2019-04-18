# Rewards Task

Assigns reward named *registraion* to the newly registered user.

###### To spin up a local dev webserver for testing -
   - Goto project directory (rewards)
   - Open up a terminal at the directory (be sure to have *php* in PATH)
   - run `php artisan serve` and keep the terminal running
   - This shall create a *localhost:8000* webserver.
   - Use any client (eg. Postman) to test the features


###### URI Routes for testing -

- *POST* - `/register` - Creates new User
    - payload should contain *(JSON)* -
            ```
                { 
                    "name" : "string",
                    "email" : "string | valid email",
                    "password": "string"
                }
            ```
    - Returns created User in *JSON Object*. 
        
        
- *GET* - `/users/{id}/rewards` - Returns rewards received by the User
    - URL contains *variable parameter* `{id}`. It should be replaced by the ID of desired user.
    - Returns array of JSON Object of Reward


>**Note**: The project files shall feel enormous but are for mere scaffolding and container creation. You can refer to `app` directory for the necessary code.

###### Follwing files need necessary attention for analysis -

- **Models**
    - app\User.php
    - app\Reward.php
    - app\UserReward.php (pivot)


- **Event Broadcasters and Listeners**
    -  app\Events\\*.php


- **Route Controllers**
    - app\Http\Controllers\UserController.php

These are the absolute necessary files to be considered enough for the analysis of implementation.