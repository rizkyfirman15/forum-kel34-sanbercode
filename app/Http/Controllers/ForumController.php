<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Pertanyaan;
use \App\User;
use \App\Jawaban;
use \App\Komen_Tanya;

class ForumController extends Controller
{

    public function index($pertanyaan_id)
    {

        $data_tanya = Pertanyaan::find($pertanyaan_id);
        $data_user = User::find($data_tanya['user_id']);
        return view('user.detail_forum.index', [
            'data_tanya' => $data_tanya,
            'data_user' => $data_user
        ]);
    }

    public function jawab($pertanyaan_id)
    {

        $data_tanya = Pertanyaan::find($pertanyaan_id);
        $data_user = User::find($data_tanya['user_id']);
        return view('user.detail_forum.jawab', [
            'data_tanya' => $data_tanya,
            'data_user' => $data_user
        ]);
    }

    public function jawabcreate(Request $request)
    {
        $isi = $request->all();
        unset($isi['_token']);
        $jawab = Jawaban::create($isi);

        return redirect('/pertanyaan/' . $isi['pertanyaan_id'] . '/detail');
    }
    // Dede
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //
        $pertanyaan = Pertanyaan::all();
        return view('dashboard', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pertanyaan $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function dashboardupdate(Request $request, Pertanyaan $pertanyaan)
    {
        //
        Pertanyaan::where('id', $pertanyaan->id)
            ->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                //   'tag' => $request->tag
            ]);

        return redirect('/dashboard')->with('status', 'Pertanyaan Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function dashboarddestroy(Pertanyaan $pertanyaan)
    {
        $destroy = Pertanyaan::destroy($pertanyaan->id);
        if ($destroy) {
            return redirect('/dashboard')->with('status', 'Pertanyaan Berhasil Dihapus');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function dashboardshow(Pertanyaan $pertanyaan)
    {
        $comments = Komen_Tanya::where('pertanyaan_id', $pertanyaan->id)->get();
        // dd($pertanyaan);
        return view('question.show', compact('pertanyaan', 'comments'));
    }

    public function storepertanyaankomentar(Request $request)
    {
        // dd($request);
        Komen_Tanya::create($request->all());
        return redirect('/pertanyaan/' . $request->pertanyaan_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Komen_Tanya  $komen_tanya
     * @return \Illuminate\Http\Response
     */
    public function updatepertanyaankomentar(Request $request, Komen_Tanya $komen_tanya)
    {
        // dd($request->all());
        Komen_Tanya::where('id', $komen_tanya->id)
            ->update([
                'isi' => $request->isi,
            ]);
        return redirect('/pertanyaan/' . $request->pertanyaan_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Komen_Tanya  $komen_tanya
     * @return \Illuminate\Http\Response
     */
    public function destroypertanyaankomentar(Komen_Tanya $komen_tanya)
    {
        // dd($answercomment);
        Komen_Tanya::destroy($komen_tanya->id);
        return redirect('/pertanyaan/' . $komen_tanya->pertanyaan_id);
    }
}
