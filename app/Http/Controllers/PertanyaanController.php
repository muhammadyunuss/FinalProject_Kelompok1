<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use Illuminate\Support\Str;



class PertanyaanController extends Controller
{
    public function index(){
        $pertanyaan = Pertanyaan::get();
        return view('tabelpertanyaan', compact('pertanyaan'));
    }

    public function create(){
        return view('formpertanyaan');
    }

    public function store(Request $request){
        $pertanyaan = new Pertanyaan;

        $data = $request->all();
        $str = Str::lower($request->judul);
        $slug = Str::slug($str);
        $tagArr = explode(',', $request->tag);

        $new_item = Pertanyaan::create([
            "user_id" => $request["user_id"],
            "judul" => $request["judul"],
            "isi" => $request["isi"],
            "tag" => $request["tag"],
            "slug" => $slug
        ]);

        // dd($new_item);

        $tagsMulti  = [];
        foreach($tagArr as $strTag){
            $tagArrAssc["tag_name"] = $strTag;
            $tagsMulti[] = $tagArrAssc;
        }
        // dd($tagsMulti);
        // Create Tags baru
        foreach($tagsMulti as $tagCheck){
            $tag = Tag::firstOrCreate($tagCheck);
            $new_item->tags()->attach($tag->id);
        }
        return redirect('/pertanyaan');

    }

    public function edit($id){
        $getPertanyaan = Pertanyaan::find($id);
        $getPertanyaan =json_decode(json_encode($getPertanyaan),true);
        return view('editpertanyaan',compact('getPertanyaan'));
    }

    public function update($id,Request $request){

        $str = Str::lower($request->judul);
        $slug = Str::slug($str);
        $request['slug'] = $slug;
        $getPertanyaan = Pertanyaan::where('id', $id)->update($request->except('_token','_method'));
        return redirect('/pertanyaan');
    }

    public function destroy($id){
        Pertanyaan::where('id',$id)->delete();
        Jawaban::where('pertanyaan_id',$id)->delete();

        return redirect()->back();
    }
}
