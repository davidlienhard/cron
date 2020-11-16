<?php

declare(strict_types=1);

namespace DavidLienhard;

use \PHPUnit\Framework\TestCase;
use \DavidLienhard\Cron;

class CronTest extends TestCase
{
    /**
     * @covers \DavidLienhard\Cron
    */
    public function testCanBeCreated(): void
    {
        $cron = new Cron;

        $this->assertInstanceOf(
            Cron::class,
            $cron
        );

        $this->assertInstanceOf(
            CronInterface::class,
            $cron
        );
    }
}
