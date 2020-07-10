<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{

    public function tags() {
        return $this->belongsToMany('App\Tag', 'pertanyaan_tag', 'pertanyaan_id', 'tag_id');
    }
}
