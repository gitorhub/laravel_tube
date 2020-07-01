<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name, primary key, timestamp filan değişebilir istenirse buradan
    // protected $table="posts";
    // protected $primaryKey='item_id';
    // public $timestamps=true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
