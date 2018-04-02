<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = array(
            'Problem',
            'ProblemType',
            'Timetable',
            'Role',
            'RoleTeam',
            'UserRole',
            'UserRoleTeam',
            'Announce',
            'ExpoToken',
            'Notification',
            'Priority',
            'Assign',
            'Slip'
        );
        foreach ($models as $model) {
            $this->app->bind("App\Repositories\\{$model}RepositoryInterface", "App\Repositories\\{$model}Repository");
        }
    }
}
