<?php declare(strict_types=1);

namespace App\Providers;

use App\Services\SendGridService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $this->app->get(SendGridService::class)->send(
                $notifiable->email,
                'Verifica tu dirección de correo',
                "Por favor verifica tu dirección: $url",
                "<p>Haz clic <a href=\"$url\">aquí</a> para verificar tu dirección.</p>"
            );

            return (new MailMessage)
                ->subject('Verificación en Cholita')
                ->line('Te hemos enviado un correo de verificación.')
                ->line('Si no lo recibes, revisa tu carpeta de spam o inténtalo de nuevo.');
        });

        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            app(SendGridService::class)->send(
                $notifiable->email,
                'Restablece tu contraseña en Cholita',
                "Recibimos una solicitud para restablecer tu contraseña. Haz clic en el siguiente enlace: $url",
                "<p>Recibimos una solicitud para restablecer tu contraseña.</p><p><a href=\"$url\">Haz clic aquí para restablecerla</a></p><p>Este enlace expirará en 60 minutos.</p>"
            );

            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Solicitud de restablecimiento')
                ->line('Te hemos enviado un enlace para restablecer tu contraseña.')
                ->line('Si no solicitaste esto, puedes ignorar este correo.');
        });
    }
}
