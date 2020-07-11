<?php 

    use Illuminate\Support\Facades\Auth;
    use \App\Pertanyaan_Tag; 
    use \App\Tag;
    use \App\Vote_Pertanyaan;
    use \App\Pertanyaan;
    use Illuminate\Support\Facades\DB;

?>

@extends('adminlte.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<div class="row p-2">

    <div class="col-md-2 mb-2">
        @include('layouts.partials.leftbar')
    </div>

    <div class="col-md-8 mb-2">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card main">
                        <div class="card-body">
                            @foreach ($data_tanya ?? '' as $item)
                            <div class="card mb-2">
                                <div class="card-header bg-primary text-white">
                                    Dari : {{$item->name}}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12 text-center">
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="{{url('user/vote-tanya/' . $item->id . '/' . Auth::id() . '/up')}}" class="btn btn-secondary">
                                                                <i class="fa fa-arrow-up"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <a href="#" class="btn btn-secondary">
                                                                <?php
                                                                    
                                                                    $up_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$item->id, 'up_down'=>true])
                                                                            ->count();
                                                                    $down_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$item->id, 'up_down'=>false])
                                                                            ->count();
                                                                            
                                                                    echo $up_vote - $down_vote;

                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <a href="{{url('user/vote-tanya/' . $item->id . '/' . Auth::id() . '/down')}}" class="btn btn-secondary">
                                                                <i class="fa fa-arrow-down"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <h5 class="card-title" style="font-weight: bold">{{$item->judul}}</h5>
        
                                            <p p class="card-text">{!!$item->isi!!}</p>
                                            <div class="tag">
                                                <?php
                                                
                                                    $tag = Pertanyaan_Tag::where('pertanyaan_id', $item->id)
                                                                            ->get();
                                                ?>
                                                @foreach ($tag as $tag_id)
                                                    <?php
                                                        $tag_name = DB::table('tag')
                                                                ->select(DB::raw('nama_tag'))
                                                                ->where('id', $tag_id->id)->get();
                                                    ?>
                                                    @foreach ($tag_name as $tag)
                                                    <button type="button" class="btn btn-success btn-sm">{{$tag->nama_tag}}</button>
                                                    @endforeach 
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{url('/pertanyaan/'. $item->id. '/detail')}}" class="btn btn-success mt-3" style="float: right"><i class="fa fa-eye"></i> Detail</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header bg-light">
                    Jawaban dari : 
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>

                    Anda Berhasil Masuk !
                     </br>
        <div class="col-md-2 mb-2">
            <div class="card main">
                <div class="card-body">
                    @include('layouts.partials.rightbar')
                </div>
            </div>
        </div>

</div>

@endsection
