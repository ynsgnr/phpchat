# Used Modules and Dependecies:
PHP7 and Composer is needed. Check `php.ini` and `composer.json` for more info

# Enviroment Values:
| Variable Name | Explanation                                                |
| ------------- |:----------------------------------------------------------:|
| DB_HOST       | sql host with port number                                  |
| DB_NAME       | db name                                                    |
| DB_USER       | db username                                                |
| DB_PASS       | user's password on db                                      |
| PHPRC         | project folder for using `php.ini` in this project         |
| EXT_PATH      | extenstion path (defult is `{PHP install directory}\ext` ) |

 # Run
 Run the api with  `php -S localhost:8000 router.php`

 # Endpoints
 ## V1
| Endpont                            | Method and Input                         | Returns
| ----------------------------------:|:----------------------------------------:|:--------------------------------------:|
| /api/v1/createUser                 | POST - username                           | - |
| /api/v1/sendmessage                | POST - username, context, reciever        | Location Header |
| /api/v1/recievemessages/{username} | GET                                       | array of messages with sender, context, reciever, sendat |
| /api/v1/message/{message_id}       | GET                                       | message with sender, context, reciever, sendat |

Check `router.php` for more info

# TODO
Since it is a simple example I didn't add authentication, it should be added using authenticate headers to protect 'RESTful'nes

# Database Init
You can init the database using `initDatabaseTables()` function in  `DatabaseInit` class.

# PostMan Tests:
You can use this postman link to display more info:
https://documenter.getpostman.com/view/5352982/SVYowM1r?version=latest