<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function jawaban() {
        return $this->belongsTo('App\Jawaban','pertanyaan_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'pertanyaan_tag', 'pertanyaan_id', 'tag_id');
    }
}
