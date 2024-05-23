<?php

namespace App\Models;

use App\Traits\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDevice extends Model
{
    use HasFactory, ActivityLogger;
    protected $guarded = [];

    protected $memoryType;
    protected $format;

    public function __construct(
        string $memoryType = 'Mem',
        string $format = 'h',
        array $attributes = []
    ) {
        parent::__construct($attributes);
        $this->memoryType = $memoryType;
        $this->format = $format;
    }

    /**
     * @return string|null
     * for linux / unix
     */
    public function getFree(): ?string
    {
        try {
            return exec("free " . $this->format . " | grep " . $this->memoryType . "| awk '{print $4}'");
        } catch (\Throwable $throwable) {
            return null;
        }
    }
    // for window
    public function getFreeWindow(): ?string
    {
        try {
            $output = shell_exec('wmic OS get FreePhysicalMemory /Value');
            if ($output) {
                $lines = explode("\n", trim($output));
                foreach ($lines as $line) {
                    if (strpos($line, 'FreePhysicalMemory') !== false) {
                        $parts = explode('=', $line);
                        if (isset($parts[1])) {
                            return intval($parts[1]) / 1024 . ' MB';
                        }
                    }
                }
            }
        } catch (\Throwable $throwable) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getTotal(): ?string
    {
        try {
            $output = shell_exec('wmic computersystem get TotalPhysicalMemory /Value');

            if ($output) {
                $lines = explode("\n", trim($output));
                foreach ($lines as $line) {
                    $parts = explode('=', $line);
                    if (count($parts) === 2 && trim($parts[0]) == 'TotalPhysicalMemory') {
                        $totalMemoryBytes = (int)$parts[1];
                        // $totalMemoryMB = $totalMemoryBytes / 1048576; // Chuyển đổi từ bytes sang MB
                        // return round($totalMemoryMB, 2) . ' MB';
                        $totalMemoryGB = $totalMemoryBytes / (1024 * 1024 * 1024); // Chuyển đổi từ bytes sang GB
                        return round($totalMemoryGB, 2) . ' GB';
                    }
                }
            }
        } catch (\Throwable $throwable) {
            // Bắt các lỗi có thể xảy ra và trả về null
            return null;
        }

        return null;
    }


    /**
     * @return string|null
     * Thông tin bộ nhớ đã sử dụng
     */
    public function getUsed(): ?string
    {
        try {
            // Chạy lệnh wmic để lấy thông tin bộ nhớ đã sử dụng trên Windows
            $output = shell_exec('wmic OS get FreePhysicalMemory /Value');

            if ($output) {
                $lines = explode("\n", trim($output));
                foreach ($lines as $line) {
                    $parts = explode('=', $line);
                    if (count($parts) === 2 && trim($parts[0]) == 'FreePhysicalMemory') {
                        // Giá trị FreePhysicalMemory trả về là byte, chuyển đổi sang MB
                        $usedMemoryBytes = (int)$parts[1];
                        $usedMemoryMB = $this->getTotal() - ($usedMemoryBytes / 1048576); // Tính toán bộ nhớ đã sử dụng
                        return round($usedMemoryMB, 2) . ' MB';
                    }
                }
            }
        } catch (\Throwable $throwable) {
            // Bắt các lỗi có thể xảy ra và trả về null
            return null;
        }

        return null;
    }


    /**
     * @return string|bool|float|null
     */
    public function getFreePercentage()
    {
        try {
            $result = exec("free | grep " . $this->memoryType . "| awk '{print $4/$2 * 100.0}'");
            if ($this->round && is_numeric($result)) {
                return round($result, 2);
            }

            return $result;
        } catch (\Throwable $throwable) {
            return null;
        }
    }
    public function getFreePercentageWindow(): ?string
    {
        try {
            $output = shell_exec('wmic OS get FreePhysicalMemory,TotalVisibleMemorySize /Value');

            if ($output) {
                $lines = explode("\n", trim($output));
                $memoryInfo = [];

                foreach ($lines as $line) {
                    $parts = explode('=', $line);
                    if (count($parts) === 2) {
                        $memoryInfo[$parts[0]] = $parts[1];
                    }
                }
                if (isset($memoryInfo['FreePhysicalMemory']) && isset($memoryInfo['TotalVisibleMemorySize'])) {
                    $freeMemory = (int)$memoryInfo['FreePhysicalMemory'];
                    $totalMemory = (int)$memoryInfo['TotalVisibleMemorySize'];

                    // Tính toán tỷ lệ phần trăm bộ nhớ trống
                    $percentageFree = ($freeMemory / $totalMemory) * 100.0;

                    // Làm tròn kết quả nếu cần thiết
                    return round($percentageFree, 2) . '%';
                }
            }
        } catch (\Throwable $throwable) {
            return null;
        }
    }

    /**
     * @return string|bool|float|null
     */
    public function getUsedPercentage()
    {
        try {
            $result = exec("free | grep " . $this->memoryType . "| awk '{print $3/$2 * 100.0}'");
            if ($this->round && is_numeric($result)) {
                return round($result, 2);
            }
            return $result;
        } catch (\Throwable $throwable) {
            return null;
        }
    }

    public function getServerLoadWindow(): ?array
    {
        try {
            $output = shell_exec('wmic cpu get LoadPercentage /Value');

            if ($output) {
                $lines = explode("\n", trim($output));
                foreach ($lines as $line) {
                    $parts = explode('=', $line);
                    if (count($parts) === 2 && trim($parts[0]) == 'LoadPercentage') {
                        $loadPercentage = (int)$parts[1];
                        return ['LoadPercentage' => $loadPercentage];
                    }
                }
            }
        } catch (\Throwable $throwable) {
            return null;
        }

        return null;
    }

    //get wifi name 
    // OK
    public function getWifiSSID()
    {
        $output = shell_exec('netsh wlan show interfaces');
        if ($output) {
            if (preg_match('/SSID\s*:\s*(.*)/i', $output, $matches)) {
                return $matches[1];
            } else {
                return 'SSID not found';
            }
        } else {
            return 'Command failed';
        }
    }
    public function getComputerName(): ?string
    {
        try {
            $output = shell_exec('hostname');
            return trim($output);
        } catch (\Throwable $throwable) {
            return null;
        }
    }

    public function getProcessorInfo(): ?string
    {
        try {
            $output = shell_exec('wmic cpu get name');
            return trim($output);
        } catch (\Throwable $throwable) {
            return null;
        }
    }

    public function getOSInfo(): ?string
    {
        try {
            $output = shell_exec('wmic os get caption');
            return trim($output);
        } catch (\Throwable $throwable) {
            return null;
        }
    }
    public function getDiskInfo(): ?array
    {
        try {
            // Lấy thông tin về ổ đĩa cứng sử dụng lệnh wmic
            $output = shell_exec('wmic logicaldisk get size,freespace,caption');
            $lines = explode("\n", trim($output));

            $diskInfo = [];
            foreach ($lines as $line) {
                $parts = preg_split('/\s+/', trim($line));
                if (count($parts) === 3 && $parts[0] != 'Caption') {
                    $diskInfo[] = [
                        'caption' => $parts[0],
                        'size' => round($parts[1] / (1024 * 1024 * 1024), 2), // Dung lượng tổng, chuyển đổi sang GB
                        'freeSpace' => round($parts[2] / (1024 * 1024 * 1024), 2), // Dung lượng trống, chuyển đổi sang GB
                    ];
                }
            }

            return $diskInfo;
        } catch (\Throwable $throwable) {
            return null;
        }
    }
}
