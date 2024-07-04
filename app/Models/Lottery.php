<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function getLatestResult()
    {
        return $this->results()->latest()->first();
    }
}
