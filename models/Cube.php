<?php

namespace particleflux\MaxCube\models;

class Cube
{
    /** @var string serial number of the cube */
    public $serial;


    public $rfAddress;
    public $firmwareVersion;
    public $unknown;
    public $httpConnectionId;
    public $dutyCycle;
    public $freeMemorySlots;
    public $cubeDate;
    public $cubeTime;

    /** @var Device[] connected devices */
    public $devices = [];
}
