<?php

namespace GrahamC\Serial\DeviceLocator;

class Windows implements OperatingSystem
{
    protected function getList()
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
