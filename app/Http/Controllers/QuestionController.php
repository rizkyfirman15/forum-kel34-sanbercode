<?php

namespace App\Http\Controllers;
use App\AnswerComment;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::all();
        // dd($questions);
        // $tags= explode(',',$questions->tag);
        // dd($tags);
        return view('dashboard',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $comments=AnswerComment::where('question_id','1')->get();
        // dd($comments);
        return view('question.show',compact('question','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        Question::where('id',$question->id)
                  ->update([
                      'judul' => $request->judul,
                      'isi_pertanyaan' => $request->isi,
                      'tag' => $request->tag
                  ]);
                  return redirect('/dashboard')->with('status','Pertanyaan Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        // dd($question);
        $destroy=Question::destroy($question->id);
        if($destroy){
        return redirect('/dashboard')->with('status','Pertanyaan Berhasil Dihapus');
        }
        dd($destroy);
    }

    public function storecomment(Request $request){
        // dd($request);
        AnswerComment::create($request->all());
        return redirect('/question/'.$request->question_id);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnswerComment  $answercomment
     * @return \Illuminate\Http\Response
     */
    public function updatecomment(Request $request, AnswerComment $answercomment)
    {
        // dd($request->all());
        AnswerComment::where('id',$answercomment->id)
                    ->update([
                        'komentar'=>$request->komentar,
                    ]);
        return redirect('/question/'.$request->question_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnswerComment  $answercomment
     * @return \Illuminate\Http\Response
     */
    public function destroycomment(AnswerComment $answercomment)
    {
        // dd($answercomment);
        AnswerComment::destroy($answercomment->id);
        return redirect('/question/'.$answercomment->question_id);
    }

}
