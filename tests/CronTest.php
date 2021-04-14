<?php

declare(strict_types=1);

namespace DavidLienhard;

use DavidLienhard\Cron\Cron;
use DavidLienhard\Cron\CronInterface;
use PHPUnit\Framework\TestCase;

class CronTest extends TestCase
{
    /**
     * @covers \DavidLienhard\Cron\Cron
    */
    public function testCanBeCreated(): void
    {
        $cron = new Cron;
        $this->assertInstanceOf(Cron::class, $cron);
        $this->assertInstanceOf(CronInterface::class, $cron);
    }
}
