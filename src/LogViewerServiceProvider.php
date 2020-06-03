<?php

namespace Dcat\Admin\Extension\LogViewer;

use Illuminate\Support\ServiceProvider;

class LogViewerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $extension = LogViewer::make();

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, LogViewer::NAME);
        }

        if ($lang = $extension->lang()) {
            $this->loadTranslationsFrom($lang, LogViewer::NAME);
        }

        if ($migrations = $extension->migrations()) {
            $this->loadMigrationsFrom($migrations);
        }

        $this->app->booted(function () use ($extension) {
            $extension->routes(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}