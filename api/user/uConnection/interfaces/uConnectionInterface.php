<?php
require_once('api/user/User.php');
interface uConnectionInterface{
    public function createUser(User $username): int;
    public function getUserId($username): int;
}

?>