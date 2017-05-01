<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\ShortCreator\Encoder;
use App\ShortCreator\ShortCreator;
use App\ShortCreator\EncoderContract;
use App\ShortCreator\ShortCreatorContract;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EncoderContract::class, function () {
            return new Encoder();
        });

        $this->app->bind(ShortCreatorContract::class, function () {
            return new ShortCreator();
        });
    }
}
