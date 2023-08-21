<?php

namespace App\Enums;

enum UserRole: int
{
    case Admin = 0;
    case Teacher = 1;
    case Student = 2;
}
