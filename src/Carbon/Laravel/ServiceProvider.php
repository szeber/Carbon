<?php

namespace Carbon\Laravel;

use Carbon\Carbon;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $service = $this;
        $this->app['events']->listen(version_compare(\App::version(), '5.5') >= 0 ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed', function () use ($service) {
            $service->updateLocale();
        });
        $service->updateLocale();
    }

    public function updateLocale()
    {
        $locale = $this->app['translator']->getLocale();
        Carbon::setLocale($locale);
    }
}
