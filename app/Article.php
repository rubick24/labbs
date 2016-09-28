<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Article extends Model
{

    public function html(){
        $parser = new Parser();
        return $parser->makeHtml(Storage::get(($this->url)));
    }


    //relations
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }


    //scope
    public function scopeStatus($query,$status){
        //stat 0为未审核 1为审核通过 2为加精
        if($status<0||$status>2)
            return false;
        return $query->where('stat','=',$status);
    }

    public function scopeUpper($query,$upper=true){
        return $query->where('upper','=',$upper);
    }

}
