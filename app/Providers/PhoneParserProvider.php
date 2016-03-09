<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Slayerfat\PhoneParser\Interfaces\PhoneParserInterface;
use Slayerfat\PhoneParser\PhoneParser;

class PhoneParserProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PhoneParserInterface::class, function () {
            return new PhoneParser;
        });
    }
}
