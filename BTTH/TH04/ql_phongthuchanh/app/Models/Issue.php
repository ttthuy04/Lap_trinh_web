<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['computer_id', 'reported_by', 'reported_date', 'description', 'status'];
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
