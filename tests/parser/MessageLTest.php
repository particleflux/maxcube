<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 1/11/17
 * Time: 10:48 PM
 */

namespace particleflux\MaxCube\tests\parser;


use particleflux\MaxCube\messages\MessageL;
use particleflux\MaxCube\models\Device;
use particleflux\MaxCube\tests\TestCase;


class MessageLTest extends TestCase
{
    /**
     * @dataProvider parseProvider
     *
     * @param string $rawMessage
     * @param mixed[][] $decodedAttributes
     */
    public function testParse($rawMessage, $decodedAttributes)
    {
        $message = new MessageL($rawMessage);
        $devices = $message->parse();
        $this->assertInternalType('array', $devices);
        $this->assertCount($deviceCount = count($devices), $decodedAttributes);

        for ($i = 0; $i < $deviceCount; ++$i) {
            $this->assertInstanceOf(Device::class, $devices[$i]);

            foreach ($decodedAttributes[$i] as $name => $value) {
                $this->assertObjectHasAttribute($name, $devices[$i], "expected attribute $name missing");
                $this->assertSame(
                    $value,
                    $devices[$i]->$name,
                    "Attribute $name has wrong value '{$devices[$i]->$name}', expected '$value'"
                );
            }
        }

    }

    public function parseProvider()
    {
        return [
            'single-device' => [
                'CxUK4gkSGWQ9AK8A',
                [
                    [
                        'rfAddress'     => '150ae2',
                        'mode'          => Device::MODE_MANUAL,
                        'valvePosition' => 100,
                        'temperature'   => 30.5,
                        'isDst'          => true,
                        'isGatewayKnown' => true,
                        'isPanelLocked'  => false,
                        'isLinkError'    => false,
                        'isBatteryLow'   => false,
                    ],
                ],
            ],
            'multi-device (maxcube-protocol-github example)'  => [
                'Cw/a7QkSGBgoAMwACw/DcwkSGBgoAM8ACw/DgAkSGBgoAM4A',
                [
                    [
                        'rfAddress'      => '0fdaed',
                        'mode'           => Device::MODE_AUTO,
                        'valvePosition'  => 24,
                        'temperature'    => 20,
                        'isDst'          => true,
                        'isGatewayKnown' => true,
                        'isPanelLocked'  => false,
                        'isLinkError'    => false,
                        'isBatteryLow'   => false,
                    ],
                    [
                        'rfAddress'     => '0fc373',
                        'mode'          => Device::MODE_AUTO,
                        'valvePosition' => 24,
                        'temperature'   => 20,
                        'isDst'          => true,
                        'isGatewayKnown' => true,
                        'isPanelLocked'  => false,
                        'isLinkError'    => false,
                        'isBatteryLow'   => false,
                    ],
                    [
                        'rfAddress'     => '0fc380',
                        'mode'          => Device::MODE_AUTO,
                        'valvePosition' => 24,
                        'temperature'   => 20,
                        'isDst'          => true,
                        'isGatewayKnown' => true,
                        'isPanelLocked'  => false,
                        'isLinkError'    => false,
                        'isBatteryLow'   => false,
                    ],
                ],
            ],
        ];
    }
}
