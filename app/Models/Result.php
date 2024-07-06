<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function PrintedList()
    {
        return $this->hasOne(PrintedList::class);
    }




}
