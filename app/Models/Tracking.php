<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'reference',
    ];

    protected $date = [
    	'created_at',
    	'updated_at'
    ];

    public function statuses() {
        return $this->belongsToMany(Status::class, 'tracking_status')->withPivot('tracking_id');
    }
}
