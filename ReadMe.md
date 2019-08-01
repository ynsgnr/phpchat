# Used Modules and Dependecies:
PHP7 and Composer is needed. Check `php.ini` and `composer.json` for more info

# Enviroment Values:
| Variable Name | Explanation                                                |
| ------------- |:----------------------------------------------------------:|
| DB_HOST          | sql host with port number                                  |
| DB_NAME       | db name                                                    |
| DB_USER       | db username                                                |
| DB_PASS          | user's password on db                                      |
| PHPRC         | project folder for using `php.ini` in this project         |
| EXT_PATH      | extenstion path (defult is `{PHP install directory}\ext` ) |

 # Run
 Run the api with  `php -S localhost:8000 router.php`

 # Endpoints
 ## V1
| Endpont                 | Input                                    | Returns
| ----------------------- |:----------------------------------------:|:--------------------------------------:|
| /api/v1/initsession     | username                                 | session_id |
| /api/v1/sendmessage     | session_id, username, context, reciever  | message_id |
| /api/v1/recievemessages | session_id, username                     | array of messages with sender, context, reciever, sendat |

Check `router.php` for more info

# Database Init
You can init the database using `initDatabaseTables()` function in  `Database` class.