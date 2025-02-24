<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'markdown_content',
        'width',
        'height',
        'margin_top',
        'margin_right',
        'margin_bottom',
        'margin_left',
    ];
}
