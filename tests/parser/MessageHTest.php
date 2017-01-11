<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 1/11/17
 * Time: 9:40 PM
 */

namespace particleflux\MaxCube\tests\parser;


use particleflux\MaxCube\messages\MessageH;
use particleflux\MaxCube\models\Cube;


class MessageHTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider parseProvider
     *
     * @param string $rawMessage
     * @param array $decodedAttributes
     */
    public function testParse($rawMessage, $decodedAttributes)
    {
        $message = new MessageH($rawMessage);
        $cube = $message->parse();
        $this->assertNotNull($cube);
        $this->assertInstanceOf(Cube::class, $cube);

        foreach ($decodedAttributes as $name => $value) {
            $this->assertObjectHasAttribute($name, $cube, "expected attribute $name missing");
            $this->assertEquals($value, $cube->$name, "Attribute $name has wrong value '{$cube->$name}', expected '$value'");
        }
    }

    public function parseProvider()
    {
        return [
            [
                'KEQ0643784,09e4f5,0113,00000000,2bb2a0f3,00,32,11010b,143a,03,0000',
                [
                    'serial'           => 'KEQ0643784',
                    'rfAddress'        => '09e4f5',
                    'firmwareVersion'  => '1.1.3',
                    'unknown'          => '00000000',
                    'httpConnectionId' => '2bb2a0f3',
                    'dutyCycle'        => 0,
                    'freeMemorySlots'  => 50,
                    'cubeDate'         => '2017-01-11',
                    'cubeTime'         => '20:58',
                ],
            ],
            [
                'KEQ0523864,097f2c,0113,00000000,477719c0,00,32,0d0c09,1404,03,0000',
                [
                    'serial'           => 'KEQ0523864',
                    'rfAddress'        => '097f2c',
                    'firmwareVersion'  => '1.1.3',
                    'unknown'          => '00000000',
                    'httpConnectionId' => '477719c0',
                    'dutyCycle'        => 0,
                    'freeMemorySlots'  => 50,
                    'cubeDate'         => '2013-12-09',
                    'cubeTime'         => '20:04',

                ]
            ],
        ];
    }
}
