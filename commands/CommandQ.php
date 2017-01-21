<?php

namespace particleflux\MaxCube\commands;

/**
 * Class MessageQ
 *
 * Used to terminate connection
 */
class CommandQ extends Command
{
    const MESSAGE_TYPE = 'q';

    public function build()
    {
        return '';
    }
}