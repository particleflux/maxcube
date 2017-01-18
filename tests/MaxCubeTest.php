<?php

namespace particleflux\MaxCube\tests;


use particleflux\MaxCube\MaxCube;
use particleflux\MaxCube\messages\MessageH;
use particleflux\MaxCube\messages\MessageL;


class MaxCubeTest extends TestCase
{
    public function testHandleMsg()
    {
        $cube = new MaxCube('127.0.0.1');
        $messageH = new MessageH('KEQ0643784,09e4f5,0113,00000000,2bb2a0f3,00,32,11010b,143a,03,0000');
        $this->invokeMethod($cube, 'handleMessage', [$messageH]);
        $this->assertEquals($cube->getCube(), $messageH->parse());

        $messageL = new MessageL('Cw/a7QkSGBgoAMwACw/DcwkSGBgoAM8ACw/DgAkSGBgoAM4A');
        $this->invokeMethod($cube, 'handleMessage', [$messageL]);
        $this->assertEquals($cube->getCube()->devices, $messageL->parse());
    }
}
