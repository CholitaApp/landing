<?php declare(strict_types=1);

namespace App\Models\Tenants\Roles;

enum RoleDataOptionId: int
{
    case SUPER_ADMIN = 1;
    case ADMIN = 2;
    case UPLOADER = 3;
    case MANAGER = 4;
    case HOLDING_ADMIN = 5;
    case HOLDING_MANAGER = 6;
    case API_CLIENT = 7;

}
