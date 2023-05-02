<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metadata extends Model
{
    use HasFactory;
    protected $table= "metadata";
    protected $fillable = ['metakey', 'meta_value'];
    protected $primaryKey = 'metakey';
}
