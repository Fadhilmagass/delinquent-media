<?php

namespace App\Enums\Article;

enum Status: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}