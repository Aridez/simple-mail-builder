<?php

namespace Aridez\MailBuilder\Providers;

use Aridez\MailBuilder\Core\MailMessageBuilder;
use Illuminate\Support\ServiceProvider;

class MailBuilderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('mailbuilder', function ($app) {
            return new MailMessageBuilder();
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mailbuilder');

        if ($this->app->runningInConsole()) {
            // Publish views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/mailbuilder'),
            ], 'views');

        }
    }
}
