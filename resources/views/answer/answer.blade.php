@extends('adminlte.master')

@section('content')
    @foreach ($answers as $answer)
        <div class="card gedf-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-2">
                            <img class="rounded-circle" width="45" src="{{asset('images/user.jpg')}}"alt="">
                        </div>
                        <div class="ml-2 ">
                            <div class="h5 m-0 ">{{$answer->user->name}}</div>
                            <div class="h7 text-muted">{{$answer->user->email}}</div>
                        </div>
                    </div>
                    <div>
                    <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                <div class="h6 dropdown-header">Aksi</div>
                                <a class="dropdown-item" href="/answer/{{$answer->id}}/edit">Edit</a>
                                <form action="/answer/{{$answer->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style=" text-align: left!important;">
                <a class="card-link" href="/answer/{{$answer->id}}">
                    <h5 class="card-title">Menjawab: {{$answer->question->judul}}.</h5>
                </a>
        
                <p class="card-text">
                    {!! $answer->isi !!}
                </p>
            </div>
            <div class="card-footer">
                <span class="btn btn-primary mr-2">{{$answer->vote}}</span>
                <form action="/answer/{{$answer->id}}/vote" class="d-inline mr-3" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="vote" value=1 class="card-link btn btn-primary" style="color: rgb(255, 255, 255);"><i class="fa fa-arrow-up"></i> UpVote</button>
                    <button type="submit" name="vote" value=2 class="card-link btn btn-danger" style="color: rgb(255, 255, 255);"><i class="fa fa-arrow-down"></i> DownVote</button>
                </form>
                <a class="card-link" href="#"><i class="fa fa-comments"></i> Beri Komentar</a>
            </div>
        </div>
        <br>
    @endforeach

    <div class="container">
    </div>
    <a class="btn btn-primary" href="/question">Pertanyaan</a>
@endsection