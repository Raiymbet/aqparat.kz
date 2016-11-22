<?php

namespace App\Providers;
use App\Notification;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\VKontakte\Provider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //view()->share('notifications', Notification::all()->count());
        $this->bootVKontakteSocialite();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function bootVKontakteSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'vkontakte',
            function ($app) use ($socialite) {
                $config = $app['config']['services.vkontakte'];
                return $socialite->buildProvider(Provider::class, $config);
            }
        );
    }
}
