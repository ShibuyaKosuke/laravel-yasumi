<?php

declare(strict_types=1);

namespace ShibuyaKosuke\LaravelYasumi\Tests;

use Illuminate\Config\Repository;
use Illuminate\Support\Carbon;
use ReflectionException;
use ShibuyaKosuke\LaravelYasumi\Holiday;
use Yasumi\Exception\MissingTranslationException;

class HolidayTest extends TestCase
{
    /**
     * @dataProvider holidayDataProvider
     * @return array[]
     */
    public static function holidayDataProvider()
    {
        return [
            [ 'Japan', 'ja_JP', '2020-01-01', '元日' ],
            [ 'Japan', 'ja_JP', '2020-01-13', '成人の日' ],
            [ 'Japan', 'ja_JP', '2020-02-11', '建国記念の日' ],
            [ 'Japan', 'ja_JP', '2020-02-23', '天皇誕生日' ],
            [ 'Japan', 'ja_JP', '2020-02-24', '振替休日 (天皇誕生日)' ],
            [ 'Japan', 'ja_JP', '2020-03-20', '春分の日' ],
            [ 'Japan', 'ja_JP', '2020-04-29', '昭和の日' ],
            [ 'Japan', 'ja_JP', '2020-05-03', '憲法記念日' ],
            [ 'Japan', 'ja_JP', '2020-05-04', 'みどりの日' ],
            [ 'Japan', 'ja_JP', '2020-05-05', 'こどもの日' ],
            [ 'Japan', 'ja_JP', '2020-05-06', '振替休日 (憲法記念日)' ],
            [ 'Japan', 'ja_JP', '2020-07-23', '海の日' ],
            [ 'Japan', 'ja_JP', '2020-07-24', 'スポーツの日' ],
            [ 'Japan', 'ja_JP', '2020-08-10', '山の日' ],
            [ 'Japan', 'ja_JP', '2020-09-21', '敬老の日' ],
            [ 'Japan', 'ja_JP', '2020-09-22', '秋分の日' ],
            [ 'Japan', 'ja_JP', '2020-11-03', '文化の日' ],
            [ 'Japan', 'ja_JP', '2020-11-23', '勤労感謝の日' ],
            [ 'Japan', 'ja_JP', '2020-11-23', '勤労感謝の日' ],
            [ 'Spain', 'es', '2021-01-01', 'Año Nuevo' ],
            [ 'USA', 'en_US', '2020-01-01', 'New Year’s Day' ],
            [ 'USA', 'en_US', '2020-01-20', 'Dr. Martin Luther King Jr’s Birthday' ],
            [ 'USA', 'en_US', '2020-02-17', 'Washington’s Birthday' ],
            [ 'USA', 'en_US', '2020-05-25', 'Memorial Day' ],
            [ 'USA', 'en_US', '2020-07-03', 'Independence Day observed' ],
            [ 'USA', 'en_US', '2020-09-07', 'Labor Day' ],
            [ 'USA', 'en_US', '2020-10-12', 'Columbus Day' ],
            [ 'USA', 'en_US', '2020-11-11', 'Veterans Day' ],
            [ 'USA', 'en_US', '2020-11-26', 'Thanksgiving Day' ],
            [ 'USA', 'en_US', '2020-12-25', 'Christmas' ],
        ];
    }
    
    /**
     * @param string $country
     * @param string $locale
     * @param string $date
     * @param string $expectedHoliday
     * @throws ReflectionException
     * @throws MissingTranslationException
     * @dataProvider holidayDataProvider
     */
    public function testCanGetHolidays($country, $locale, $date, $expectedHoliday): void
    {
        $config = new Repository([
            'yasumi' => [
                'country' => $country,
                'locale'  => $locale,
            ],
        ]);
        $holiday = new Holiday($config);
        $newYear = Carbon::make($date);
        $holidayResult = $holiday->get($newYear);
        $this->assertEquals($expectedHoliday, $holidayResult);
    }
    
    /**
     * Test isHoliday method.
     *
     * @throws ReflectionException
     * @throws MissingTranslationException
     * @dataProvider holidayDataProvider
     */
    public function testIsHoliday($country, $locale, $date, $expectedHoliday): void
    {
        $config = new Repository([
            'yasumi' => [
                'country' => $country,
                'locale'  => $locale,
            ],
        ]);
        $holiday = new Holiday($config);
        $newYear = Carbon::make($date);
        $this->assertTrue($holiday->isHoliday($newYear));
    }
    
    /**
     * Test isBeforeHoliday method.
     *
     * @throws ReflectionException
     * @throws MissingTranslationException
     * @dataProvider holidayDataProvider
     */
    public function testIsDayBeforeHoliday($country, $locale, $date, $expectedHoliday): void
    {
        $config = new Repository([
            'yasumi' => [
                'country' => $country,
                'locale'  => $locale,
            ],
        ]);
        $holiday = new Holiday($config);
        $newYear = Carbon::make($date)->subDay();
        $this->assertTrue($holiday->isDayBeforeHoliday($newYear));
    }
}