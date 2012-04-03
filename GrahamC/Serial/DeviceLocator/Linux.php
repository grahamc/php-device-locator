<?php

namespace GrahamC\Serial\DeviceLocator;
use GrahamC\Serial\DeviceLocator\OperatingSystem as OperatingSystem;;

class Linux extends OperatingSystem
{
    public function getList()
    {
        return glob('/dev/cu.usbmodem*');
    }
}
