<?php

namespace TexLib\Analytics\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TexLib\Analytics\Analytics
 */
class Analytics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \TexLib\Analytics\Analytics::class;
    }
}
