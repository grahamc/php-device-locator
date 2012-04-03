<?php

namespace GrahamC\Serial;

class DeviceLocator extends \GrahamC\PreferredList
{
    protected $locator;

    public static function getLocator()
    {
        if (class_exists('COM')) {
            $os = new DeviceLocator\Windows();
        } else {
            $os = new DeviceLocator\Linux();
        }

        return new self($os);
    }

    public function __construct(DeviceLocator\OperatingSystem $locator)
    {
        $this->locator = $locator;
    }

    public function rewind()
    {
        $this->list = $this->locator->getList();

        return parent::rewind();
    }

    protected function getListWindows()
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

    protected function getListNix()
    {
        return glob('/dev/cu.usbmodem*');
    }

    protected function isWindows()
    {
        return class_exists('COM');
    }
}

