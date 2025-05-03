<?php declare(strict_types=1);

namespace Tests\Feature\Auth;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_registration_screen_cant_be_rendered(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function test_new_users_cant_register(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
