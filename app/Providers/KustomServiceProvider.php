<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class KustomServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        //
    }

    public function register()
    {
        require_once app_path() . '/Helpers/Kustom.php';
    }
}
