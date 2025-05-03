<?php declare(strict_types=1);

namespace App\Models\Tenants\Roles;

enum RoleDataOption: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case UPLOADER = 'uploader';
    case HOLDING_MANAGER = 'holding-manager';
    case MANAGER = 'manager';
    case HOLDING_ADMIN = 'holding-admin';
    case API_CLIENT = 'api-client';

}
