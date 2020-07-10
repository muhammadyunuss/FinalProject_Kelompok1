<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;
use App\Pertanyaan;
use App\Tag;

class JawabanController extends Controller
{
    public function index($id=null){
        $jawaban = new Jawaban;
        // dd($id);
        $getJawaban = Jawaban::where('pertanyaan_id',$id)->get();
        $getPertanyaan = Pertanyaan::find($id);
        // dd($getPertanyaan);
        return view('jawabanpertanyaan',compact('getJawaban','getPertanyaan'));
    }

    public function store(Request $request, $id=null){
        // dd($request->all());
        $jawaban = new Jawaban;
        $data = $request->all();
        // unset($data["_token"]);
        // $pertanyaan = M_pertanyaan::save($data);
        // dd($pertanyaan);
        $jawaban->pertanyaan_id = $id;
        $jawaban->judul = $data['judul'];
        $jawaban->isi = $data['isi'];
        // dd($pertanyaan);
        $jawaban->save();
        return redirect("/jawaban/$id");

    }
}
