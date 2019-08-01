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

    /**
     * @depends testConstruct
     */
    public function testCrateSession()
    {
        $db = new Database();
        $this->user = new User($db->connect2database());
        $this->assertIsNumeric($this->user->createSession("testuser"));
        $this->assertEquals(1,$this->user->getUserId());
    }

    /**
     * @depends testConstruct
     * @depends testCrateSession
     */
    public function testCheckSession()
    {
        $db = new Database();
        $this->user = new User($db->connect2database());
        $this->user->createSession("testuser");
        $this->assertEquals(true,$this->user->checkSession());
    }
}