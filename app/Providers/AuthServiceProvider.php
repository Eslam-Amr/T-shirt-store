<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        // Gate::define('viewAdminPanel', function ($user) {
        //     // return $user->hasRole('admin');
        //     if ($user['role'] == 'admin')
        //         return true;
        //     // return auth('admin');
        // });
        Gate::define('viewAdminPanel', function ($user) {
            // return $user->hasRole('admin');
            // if ($user['role'] == 'admin')
            //     return true;
            return  $user['role'] == 'admin';
            // return auth('admin');
        });

        // Gate::define('viewDesignerPanel', function ($user) {
        //     if ($user['role'] == 'designer')
        //         return true;

        // });
        Gate::define('viewDesignerPanel', function ($user) {
            return  $user['role'] == 'designer';

        });

        // return $user->hasRole('designer');
        // Gate::define('viewDesignerPanel', function ($designer) {

        //     return auth('designer');
        // });
        // return $designer->hasRole('designer');

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
    }
}
