<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingStatus extends Model
{
    use HasFactory;

    protected $table = 'tracking_status';

    protected $fillable = [
        'tracking_id',
        'status_id',
    ];

    protected $date = [
    	'created_at',
    	'updated_at'
    ];
}
