<?php
/**
 * Created by PhpStorm.
 * User: cedricfarinazzol
 * Date: 6/22/18
 * Time: 5:26 PM
 */

namespace Monitoring;


class HardwareMonitoring
{
    private $_cpu_usage;
    private $_ram_usage;
    private $_cpu_temp;
    private $_gpu_temp;


    /**
     * HardwareMonitoring constructor.
     * @param bool $getData
     */
    public function __construct($getData = false)
    {
        $this->_cpu_temp = 0;
        $this->_cpu_usage = 0;
        $this->_ram_usage = 0;
        $this->_gpu_temp = 0;
        if ($getData)
        {
            $this->GetData();
        }
    }

    /**
     * Convert data to string
     * @return string
     */
    public function ToJson()
    {
        $data = array();
        $data["CpuUsage"] = $this->_cpu_usage;
        $data["RamUsage"] = $this->_ram_usage;
        $data["CpuTemp"] = $this->_cpu_temp;
        $data["GpuTemp"] = $this->_gpu_temp;
        return json_encode($data);
    }

    /**
     * @param int $speed
     */
    public function GetData($speed = 1)
    {
        //cpu usage
        $prevVal = shell_exec("cat /proc/stat");
        $prevArr = explode(' ',trim($prevVal));
        //Gets some values from the array and stores them.
        $prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
        $prevIdle = $prevArr[5];
        //Wait a period of time until taking the readings again to compare with previous readings.
        usleep($speed * 1000000);
        //Does the same as before.
        $val = shell_exec("cat /proc/stat");
        $arr = explode(' ',trim($val));
        //Same as before.
        $total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
        $idle = $arr[5];
        //Does some calculations now to work out what percentage of time the CPU has been in use over the given time period.
        $intervalTotal = intval($total - $prevTotal);
        $this->_cpu_usage = $intervalTotal/100;

        //RamUsage
        $this->_ram_usage = shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'");
        $this->_ram_usage = (int)str_replace('\n', '', $this->_ram_usage);

        //CpuTemp
        try
        {
            if (file_exists('/usr/bin/sensors') && exec('/usr/bin/sensors | grep -E "^(CPU Temp|Core 0)" | cut -d \'+\' -f2 | cut -d \'.\' -f1', $t))
            {
                if (isset($t[0]))
                    $this->_cpu_temp = (int)$t[0];
            }
            else
            {
                if (exec('cat /sys/class/thermal/thermal_zone0/temp', $t))
                {
                    $this->_cpu_temp = (int)round($t[0] / 1000);
                }
            }
        }
        catch (Exception $exception)
        {
            $this->_cpu_temp = 0;
        }

        //GpuTemp
        try
        {
            if (file_exists('/opt/vc/bin/vcgencmd') && exec('opt/vc/bin/vcgencmd measure_temp', $tgpu)) {
                $this->_gpu_temp = (int)str_replace('°C', '', $tgpu);
            }
        }
        catch (Exception $exception)
        {
            $this->_gpu_temp = 0;
        }
    }

    // Region:   Getters

    public function GetCpuUsage()
    {
        return $this->_cpu_usage;
    }

    public function GetRamUsage()
    {
        return $this->_ram_usage;
    }

    public function GetCpuTemp()
    {
        return $this->_cpu_temp;
    }

    public function GetGpuTemp()
    {
        return $this->_gpu_temp;
    }

    // EndRegion:  Getters
}