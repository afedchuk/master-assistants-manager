<?php

namespace Afedchuk\AssistantManager;

use Illuminate\Support\ServiceProvider;

/**
 * Class AssistantServiceProvider
 * @package App
 */
class AssistantServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigration();
    }

    /**
     * Publish user assistants configuration
     */
    protected function publishConfig()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('assistant-manager.php'),
        ]);
    }

    /**
     * Publish user assistants migration
     */
    protected function publishMigration()
    {
        $timestamp = date('Y_m_d_His', time());
        $this->publishes([
            __DIR__ . '/../database/migrations/2018_08_02_000000_user_assistants_setup_tables.php' => database_path('migrations/' . $timestamp . '_user_assistants_setup_tables.php'),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
    }

    /**
     * Merges user's and assistant's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'assistant-manager'
        );
    }
}