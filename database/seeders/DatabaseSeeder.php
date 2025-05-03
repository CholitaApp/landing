<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tenants\Company;
use App\Models\Tenants\Roles\Role;
use App\Models\Tenants\Roles\RoleDataOption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert(
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => RoleDataOption::SUPER_ADMIN->value,
                'description' => 'Administrador del sistema',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table('roles')->insert(
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => RoleDataOption::ADMIN->value,
                'description' => 'Administrador de una compañia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table('roles')->insert(
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => RoleDataOption::UPLOADER->value,
                'description' => 'Ingresa informacion para la compañia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        Company::query()->updateOrCreate(
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'CholitaApp',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );


        $password = config('database.user_password_db_seeder', 'default');
        $hashedPassword = Hash::make((string)$password);

        User::query()->createQuietly(
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Gerardo',
                'role_id' => Role::where('name', RoleDataOption::SUPER_ADMIN->value)->first()->id,
                'email' => 'gerardo@cholita.app',
                'password' => $hashedPassword,
                'updated_at' => now(),
            ]
        );

    }
}
