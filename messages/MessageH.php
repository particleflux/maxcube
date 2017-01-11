<?php

namespace particleflux\MaxCube\messages;


use particleflux\MaxCube\models\Cube;

class MessageH extends Message
{

    public function parse()
    {
        $cube = new Cube();

        list(
            $cube->serial,
            $cube->rfAddress,
            $cube->firmwareVersion,
            $cube->unknown,
            $cube->httpConnectionId,
            $cube->dutyCycle,
            $cube->freeMemorySlots,
            $cubeDate,
            $cubeTime
            ) = explode(',', $this->rawMessage);

        $cube->firmwareVersion = implode('.', str_split(ltrim($cube->firmwareVersion, '0')));
        $cube->dutyCycle = hexdec($cube->dutyCycle);
        $cube->freeMemorySlots = hexdec($cube->freeMemorySlots);
        $cube->cubeDate = sprintf('%04d-%02d-%02d', hexdec(substr($cubeDate, 0, 2)) + 2000, hexdec(substr($cubeDate, 2, 2)), hexdec(substr($cubeDate, 4, 2)));
        $cube->cubeTime = sprintf('%02d:%02d', hexdec(substr($cubeTime, 0, 2)), hexdec(substr($cubeTime, 2, 2)));

        return $cube;
    }
}