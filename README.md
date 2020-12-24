# laravel-yasumi

Wrapper class of package Yasumi/Yasumi for Laravel.

## Install

```bash
composer require shibuyakosuke/laravel-yasumi
```

Edit .env like below.

```bash
YASUMI_COUNTRY=Japan
YASUMI_LOCALE=ja_JP
```

## Usage

```php
$carbon = Carbon::make('2021-01-01');
$holiday = \Holiday::get($carbon);
dd($holiday); // '元日'
```

```php
$carbon = Carbon::make('2021-01-01');
$holiday = \Holiday::isHoliday($carbon);
dd($holiday); // true'
```