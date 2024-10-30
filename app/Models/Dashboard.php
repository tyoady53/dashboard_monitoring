<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table = 'dash_monitoring_regnos';
    protected $guarded = [
    ];
    // No primary key and no auto-incrementing
    public $incrementing = false;

    // If your table has no primary key at all, you can leave this as null
    protected $primaryKey = null;
}
