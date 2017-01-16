<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 1/16/17
 * Time: 11:39 PM
 */

namespace particleflux\MaxCube\tests\parser;


use particleflux\MaxCube\messages\Message;
use particleflux\MaxCube\messages\MessageH;
use particleflux\MaxCube\messages\MessageL;
use particleflux\MaxCube\tests\TestCase;

class MessageTest extends TestCase
{
    public function testParse()
    {
        $message = Message::instantiate('');
        $this->assertNull($message);
        $message = Message::instantiate('asdf');
        $this->assertNull($message);
        $message = Message::instantiate("\x0a\x0d");
        $this->assertNull($message);
        $message = Message::instantiate('X:CxUK4gkSGWQ9AK8A');
        $this->assertNull($message);

        $message = Message::instantiate('H:KEQ0643784,09e4f5,0113,00000000,2bb2a0f3,00,32,11010b,143a,03,0000');
        $this->assertNotNull($message);
        $this->assertInstanceOf(MessageH::class, $message);

        $message = Message::instantiate('L:CxUK4gkSGWQ9AK8A');
        $this->assertNotNull($message);
        $this->assertInstanceOf(MessageL::class, $message);

    }
}
