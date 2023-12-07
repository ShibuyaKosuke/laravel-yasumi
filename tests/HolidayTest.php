<?php

declare(strict_types=1);

namespace ShibuyaKosuke\LaravelYasumi\Tests;

use Illuminate\Config\Repository;
use Illuminate\Support\Carbon;
use ShibuyaKosuke\LaravelYasumi\Holiday;

class HolidayTest extends TestCase
{
    public function testCanGetHolidays(): void
    {
        $config = new Repository([
            'yasumi' => [
                'country' => 'Japan',
                'locale' => 'ja_JP'
            ]
        ]);
        $holiday = new Holiday($config);
        $newYear = Carbon::make('2020-01-01');
        $holidayResult = $holiday->get($newYear);
        $this->assertEquals('元日', $holidayResult);
    }
}