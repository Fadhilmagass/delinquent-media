<?php

// app/Enums/Release/Type.php
namespace App\Enums\Release;

enum Type: string
{
    case ALBUM = 'Album';
    case EP = 'EP';
    case SINGLE = 'Single';
    case DEMO = 'Demo';
}