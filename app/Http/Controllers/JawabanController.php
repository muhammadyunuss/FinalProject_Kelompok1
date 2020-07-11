<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jawaban;
use App\Pertanyaan;
use App\Tag;
use App\User;
use DB;

class JawabanController extends Controller
{
    public function index($id=null){
        $jawaban = new Jawaban;
        // dd($id);
        $getJawaban = Jawaban::where('pertanyaan_id',$id)->get();
        $getPertanyaan = Pertanyaan::find($id);
        $name = $getPertanyaan->user->name;

        return view('jawabanpertanyaan',compact('getJawaban','getPertanyaan','name'));
    }

    public function store(Request $request, $id=null){
        // dd($request->all());
        $jawaban = new Jawaban;
        $userId = Auth::user()->id;
        $data = $request->all();
        // unset($data["_token"]);
        // $pertanyaan = M_pertanyaan::save($data);
        // dd($pertanyaan);
        $jawaban->pertanyaan_id = $id;
        $jawaban->user_id = $userId;
        $jawaban->isi = $data['isi'];
        // dd($jawaban);
        $jawaban->save();
        return redirect("/jawaban/$id");

    }
}
