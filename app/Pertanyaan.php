<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = ['user_id','judul','isi','slug','tag'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'pertanyaan_tag', 'pertanyaan_id', 'tag_id');
    }
}
