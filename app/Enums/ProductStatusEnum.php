<?php

namespace App\Enums;

enum ProductStatusEnum: string {
    case DISABLE = 'disable';
    case ENABLED = 'enable';
    case SHOW = 'show';
    case HIDE = 'hide';
}