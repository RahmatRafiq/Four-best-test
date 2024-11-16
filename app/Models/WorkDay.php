<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    use HasFactory;

    protected $fillable = ['position_id', 'date', 'check_in', 'check_out'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
