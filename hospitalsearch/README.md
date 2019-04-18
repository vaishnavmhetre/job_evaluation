# Hospital Search Task

Search for hospitals in local area


###### Prerequisites
   - Create a database of any desired name
   - Goto project directory (hospitalsearch)
   - Open up a terminal at the directory (be sure to have *php* in PATH)
   - Copy *.env.example* as **.env** in project directory
   - Open .env file and update the database configurations as per system configuration.
   - Put a random 32 letter string as APP_KEY in .env file (used for encryption) or run `php artisan key:generate` to automatically generate one for you
   - Run `php artisan migrate:fresh --seed` in project directory. It creates necessary tables and seeds some fake hospitals to test over

###### To spin up a local dev webserver for testing -
   - Goto project directory (hospitalsearch)
   - Open up a terminal at the directory (be sure to have *php* in PATH)
   - run `php artisan serve` and keep the terminal running
   - This shall create a *localhost:8000* webserver.
   - Use any client (eg. Postman) to test the features


###### URI Routes for testing -

- *POST* - `/hospitals/search/location` - Search for hospital in given location and distance
    - payload should contain *(JSON)* -
            
                {
                	"latitude": "numeric | valid between -90 to 90",
                	"longitude": "numeric | valid between -180 to 180"
                	"distance": "optional | numeric | valid between 1 to 10"
                }
    - Returns array of Hospital JSON object 
    - *Sample payload*

               {
                	"latitude": 27.76095000000002,
                	"longitude": -97.11523499999998
                }
    - > **Note**: I have supplied default distance as *"9999"* only for testing purpose, to verify that results are returned over fake data. You can modify the default distance to search for when not sent by user in class **App\Hospital.php** - `$deafultSearchDistanceFromOrigin`
    

>**Note**: The project files shall feel enormous but are for mere scaffolding and container creation. You can refer to `app` directory for the necessary code.

###### Follwing files need necessary attention for analysis -

- **Models**
    - app\Hospital.php


- **Geographical Query Logic (Trait)**
    -  app\Traits\Geography\Geography.php


- **Route Controllers**
    - app\Http\Controllers\HospitalController.php

These are the absolute necessary files to be considered enough for the analysis of implementation.
