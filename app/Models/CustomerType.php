<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerType extends Model
{
    use HasFactory; use SoftDeletes;
    protected $fillable = ['name', 'details'];

    // public function checklistDetails()
    // {
    //     return $this->hasMany(CheckListDetails::class, 'id');
    // }
}