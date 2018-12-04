<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id_category';
    protected $table = 'category';
    protected $fillable = array(
        'name_category'
    );
    public $timestamps = false;
}
