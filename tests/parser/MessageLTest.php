<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 1/11/17
 * Time: 10:48 PM
 */

namespace parser;


use particleflux\MaxCube\messages\MessageL;
use particleflux\MaxCube\models\Device;
use particleflux\MaxCube\tests\TestCase;


class MessageLTest extends TestCase
{
    /**
     * @dataProvider parseProvider
     *
     * @param string $rawMessage
     * @param array $decodedAttributes
     */
    public function testParse($rawMessage, $decodedAttributes)
    {
        $message = new MessageL($rawMessage);
        $devices = $message->parse();
        $this->assertInternalType('array', $devices);
        $this->assertEquals(count($decodedAttributes), count($devices));
//        $this->assertInstanceOf(Device::class, $devices);

//        foreach ($decodedAttributes as $name => $value) {
//            $this->assertObjectHasAttribute($name, $device, "expected attribute $name missing");
//            $this->assertEquals($value, $device->$name, "Attribute $name has wrong value '{$device->$name}', expected '$value'");
//        }
    }

    public function parseProvider()
    {
        return [
            'single-device' => [
                'CxUK4gkSGWQ9AK8A',
                [
                    [
                        'rfAddress' => '09e4f5',
                        'mode'      => Device::MODE_MANUAL,
                    ],
                ],
            ],
            'multi-device' => [
                'Cw/a7QkSGBgoAMwACw/DcwkSGBgoAM8ACw/DgAkSGBgoAM4A',
                [
                    [],
                    [],
                    []
                ],
            ],
        ];
    }
}
