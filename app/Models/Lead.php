<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'type',
        'date', 'stage',
        'price',
        'department',
        'fio',
        'phone',
        'email',
        'pay',
        'device',
        'info',
        'order_number',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'referer_page'
    ];
}
