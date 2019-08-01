<?php
use PHPUnit\Framework\TestCase;

require_once('api/message/Message.php');
require_once('api/config/Database.php');

class Message_Test extends TestCase
{
    private $message;

    public function testConstruct()
    {
        $this->message = new Message();
        $this->assertInstanceOf(Message::class, $this->message);
    }

    /**
     * @depends testConstruct
     */
    public function testSend()
    {
        $db = new Database();
        $this->message = new Message();
        $this->expectException(InvalidArgumentException::class);
        $this->message->send($db->connect2database());
    }

    /**
     * @depends testConstruct
     */
    public function testSendWithValues()
    {
        $db = new Database();
        $this->message = new Message();
        $this->message->sender = 1;
        $this->message->reciever = 7;
        $this->expectException(InvalidArgumentException::class);
        $this->message->send($db->connect2database());
    }

    /**
     * @depends testConstruct
     */
    public function testSendWithFullValues()
    {
        $db = new Database();
        $this->message = new Message();
        $this->message->sender = 1;
        $this->message->reciever = 7;
        $this->message->context = "Message";
        $this->assertIsNumeric($this->message->send($db->connect2database()));
    }
    
    /**
     * @depends testConstruct
     */
    public function testRecieve()
    {
        $db = new Database();
        $connection = $db->connect2database();
        $this->message = new Message();
        $user = new User($connection);
        $user->createSession("testuser");
        $this->assertIsArray($this->message->receiveAllMessages($connection,$user));
    }
}