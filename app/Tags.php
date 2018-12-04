<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id_tags';
    protected $table = 'tags';
    protected $fillable = array(
        'name_tags'
    );
    public $timestamps = false;
}
