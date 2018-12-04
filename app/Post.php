<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id_post';
    protected $table = 'post';
    protected $fillable = array(
        'id_user',
	    'id_tags',
        'id_category',
        'title_post',
        'content_post',
        'image_post',
        'publisheddate_post',
        'totalview_post'
    );
    public $timestamps = false;
}
