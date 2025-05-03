<?php declare(strict_types=1);

namespace Tests;

use App\Models\Tenants\Roles\RoleDataOption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected bool $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        Carbon::setTestNow('01-01-2020');
        App::setLocale('en');
        $this->actingAsSuperAdmin();
        $this->withoutVite();
        $this->withoutExceptionHandling();
        //        $this->markTestSkipped('Skipping all tests to test the pipeline');
    }

    protected function actingAsSuperAdmin(): void
    {
        $user = User::whereHasRoleName(RoleDataOption::SUPER_ADMIN->value)->first();
        $this->actingAs($user);
    }

    protected function logout(): void
    {
        auth()->logout();
    }
}
