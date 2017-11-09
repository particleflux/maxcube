<?php

namespace particleflux\MaxCube\tests\commands;


use particleflux\MaxCube\commands\CommandQ;
use particleflux\MaxCube\tests\TestCase;


class CommandQTest extends TestCase
{
    public function testBuild()
    {
        $command = new CommandQ();
        $this->assertSame("q:\r\n", $command->generate());
    }
}
