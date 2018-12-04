<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id_comment';
    protected $table = 'comments';
    protected $fillable = array(
        'id_user',
        'message_comment',
        'date_comment'
    );
    public $timestamps = false;
}
