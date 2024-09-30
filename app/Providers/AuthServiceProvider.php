<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Esta configuración no es necesaria porque traduce directamente el es.json
        // Así se haría si no estuviera
        /*VerifyEmail::toMailUsing(function ($notificable, $url) {
            return (new MailMessage)
                ->subject('Verifica tu cuenta')
                ->line('Tu cuenta ya está casi lista, solo tienes que pinchar en el siguiente enlace')
                ->action('Confirmar Cuenta', $url)
                ->line('Si no has creado esta cuenta puedes ignorar este mensaje');
        });*/
    }
}
