<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $uploads = '/branchimg/';

    // public function getImageAttribute($photo)
    // {

    //     return $this->uploads . $photo;

    // }

}
