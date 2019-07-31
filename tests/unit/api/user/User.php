<?php
use PHPUnit\Framework\TestCase;

require_once('api/user/User.php');
require_once('api/config/Database.php');

class User_Test extends TestCase
{
    private $user;

    public function testConstructEmpty()
    {
        $this->expectException(ArgumentCountError::class);
        $this->user = new User();
    }

    public function testConstruct()
    {
        $db = new Database();
        $this->user = new User($db->connect2database());
        $this->assertInstanceOf(User::class, $this->user);
    }
}