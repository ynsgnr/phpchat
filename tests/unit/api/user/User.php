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
        $db = new Database();
        $this->expectException(ArgumentCountError::class);
        $this->user = new User($db->connect2database());
    }
    
    public function testConstruct()
    {
        $db = new Database();
        $this->user = new User($db->connect2database(),"testuser");
        $this->assertInstanceOf(User::class, $this->user);
    }

    /**
     * @depends testConstruct
     */
    public function testUserid()
    {
        $db = new Database();
        $this->user = new User($db->connect2database(),"testuser");
        $this->assertEquals(1,$this->user->getUserId());
    }

    /**
     * @depends testConstruct
     */
    public function testCrateSession()
    {
        $db = new Database();
        $this->user = new User($db->connect2database(),"testuser");
        $this->assertInstanceOf("int", $this->user->createSession());
    }
}