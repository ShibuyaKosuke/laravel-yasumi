<?php

namespace ShibuyaKosuke\LaravelYasumi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Holiday
 * @package ShibuyaKosuke\LaravelYasumi\Facades
 */
class Holiday extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'holiday';
    }
}