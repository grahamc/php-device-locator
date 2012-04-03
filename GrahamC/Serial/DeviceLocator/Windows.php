<?php

namespace GrahamC\Serial\DeviceLocator;
use GrahamC\Serial\DeviceLocator\OperatingSystem as OperatingSystem;;

class Windows implements OperatingSystem
{
    public function getList()
    {
        $data = shell_exec('reg query HKEY_LOCAL_MACHINE\HARDWARE\DEVICEMAP\SERIALCOMM');
        $data = explode("\n", trim($data));
        $devs = array();
        foreach ($data as $line) {
            if (trim($line) === $line) {
                continue;
            }

            $devs[] = end(explode("\t", $line));
        }

        return $devs;
    }
}
