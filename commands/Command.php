<?php

namespace particleflux\MaxCube\commands;

abstract class Command
{
    const MESSAGE_TYPE = '';

    public function generate() {
        return static::MESSAGE_TYPE . ':' . $this->build() . "\r\n";
    }

    abstract protected function build();
}