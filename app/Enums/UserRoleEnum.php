<?php

namespace App\Enums;

enum UserRoleEnum: string {
    case MASTER = 'MASTER';
    case CUSTOMER = 'CUSTOMER';
    case EMPLOYEE = 'EMPLOYEE';
}