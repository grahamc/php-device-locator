<?php

namespace GrahamC\Serial\DeviceLocator;

class Linux extends OperatingSystem
{
    public function getList()
    {
        return glob('/dev/cu.usbmodem*');
    }
}
