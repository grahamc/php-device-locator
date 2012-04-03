<?php

namespace GrahamC\Serial\DeviceLocator;
use GrahamC\Serial\DeviceLocator\OperatingSystem as OperatingSystem;;

class Linux implements OperatingSystem
{
    public function getList()
    {
        return glob('/dev/cu.usbmodem*');
    }
}
