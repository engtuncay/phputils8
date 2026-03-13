<?php
namespace Engtuncay\Phputils8\FiCores;

class SnowflakeId
{
    private int $machineId;
    private int $sequence = 0;
    private int $lastTimestamp = -1;

    public function __construct(int $machineId)
    {
        $this->machineId = $machineId;
    }

    public function generate(): int
    {
        $timestamp = (int)(microtime(true) * 1000);

        if ($timestamp == $this->lastTimestamp) {
            $this->sequence++;
        } else {
            $this->sequence = 0;
        }

        $this->lastTimestamp = $timestamp;

        return ($timestamp << 22) | ($this->machineId << 12) | $this->sequence;
    }
}