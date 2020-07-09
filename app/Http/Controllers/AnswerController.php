<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();

        return view('answer.answer', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $question = Question::where('id', $id)->first();

        return view('answer.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Answer::create([
            'isi' => $request['isi'],
            'question_id' => $request['question_id'],
            'user_id' => Auth::user()->id
        ]);

        return redirect('/answer/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        $answer->user->poin_reputasi = 0;
        if ($answer->vote == 1) {
            $answer->user->poin_reputasi += 10;
        } else if ($answer->vote == 2) {
            $answer->user->poin_reputasi--;
        }

        return view('answer.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::find($id);

        return view('answer.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Answer::where('id', $id)->update([
            'isi' => $request['isi']
        ]);

        return redirect('/answer/');
    }

    public function vote(Request $request, $id)
    {
        $answer = Answer::find($id);

        if ($request['vote'] == 1) {
            Answer::where('id', $id)->update([
                'vote' => ($answer['vote'] + 1)
            ]);

            User::where('id', $answer['user_id'])->update([
                'poin_reputasi' => ($answer->user['poin_reputasi'] + 10)
            ]);
        } else if ($request['vote'] == 2 && $answer->user['poin_reputasi'] >= 15) {
            Answer::where('id', $id)->update([
                'vote' => ($answer['vote'] - 1)
            ]);

            User::where('id', $answer['user_id'])->update([
                'poin_reputasi' => ($answer->user['poin_reputasi'] - 1)
            ]);
        }

        // dd($answer->user['poin_reputasi']);

        return redirect('/answer/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::destroy($id);

        return redirect('/answer/');
    }
}
