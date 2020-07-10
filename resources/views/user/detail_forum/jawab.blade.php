<?php 

    use Illuminate\Support\Facades\Auth;
    use \App\Pertanyaan_Tag; 
    use \App\Tag;
    use \App\Vote_Pertanyaan;
    use Illuminate\Support\Facades\DB;

    use Carbon\Carbon;
    $current_date_time = Carbon::now()->toDateTimeString(); 

?>

<?php

    function tgl_indonesia($tgl){
        $tanggal = substr($tgl, 8,2);
        $nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $bulan = $nama_bulan[(substr($tgl, 5,2)-1)];
        $tahun = substr($tgl, 0,4);

        return ($tanggal." ".$bulan." ".$tahun);
    }

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
                        <div class="card-header"></div>
                        
                        <div class="card-body">
                            {{-- @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif --}}
                            <div class="card mb-2">
                                <div class="card-header bg-primary text-white">
                                    Dari : {{$data_user->name}}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12 text-center">
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="{{url('user/vote-tanya/' . $data_tanya->id . '/' . Auth::id() . '/up')}}" class="btn btn-secondary">
                                                                <i class="fa fa-arrow-up"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <a href="#" class="btn btn-secondary">
                                                                <?php
                                                                    
                                                                    $up_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$data_tanya->id, 'up_down'=>true])
                                                                            ->count();
                                                                    $down_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$data_tanya->id, 'up_down'=>false])
                                                                            ->count();
                                                                            
                                                                    echo $up_vote - $down_vote;

                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <a href="{{url('user/vote-tanya/' . $data_tanya->id . '/' . Auth::id() . '/down')}}" class="btn btn-secondary">
                                                                <i class="fa fa-arrow-down"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <h5 class="card-title" style="font-weight: bold">{{$data_tanya->judul}}</h5>
        
                                            <p p class="card-text">{!!$data_tanya->isi!!}</p>
                                            <div class="tag">
                                                <?php
                                                
                                                    $tag = Pertanyaan_Tag::where('pertanyaan_id', $data_tanya->id)
                                                                            ->get();
                                                ?>
                                                @foreach ($tag as $tag_id)
                                                    <?php
                                                        $tag_name = DB::table('tag')
                                                                ->select(DB::raw('nama_tag'))
                                                                ->where('id', $tag_id->id)->get();
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-sm">{{$tag_name[0]->nama_tag}}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{url('/jawab/'. $data_tanya->id)}}" class="btn btn-primary btn-sm mt-3 mr-2" style="float: right"><i class="fa fa-reply"></i> Jawab</a>
                                    <a href="{{url('/komentar-tanya/'. $data_tanya->id)}}" class="btn btn-primary btn-sm mt-3 mr-2" style="float: right"><i class="fa fa-comment"></i> Komentar</a>
                                </div>
                            </div>
                            
                        </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header bg-light">
                        Jawaban Kamu
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('/jawab')}}">
                            @csrf
                            <input type="hidden" name="created_at" value="{{$current_date_time}}">
                            <input type="hidden" name="updated_at" value="{{$current_date_time}}">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <input type="hidden" name="pertanyaan_id" value="{{$data_tanya->id}}">
                            <div class="form-group">
                                <label for="isi"><b>Isi Jawaban</b></label>
                                <textarea style="height: 200px" name="description" class="form-control my-editor">{!! old('description', $isi ?? '') !!}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-primary">Jawab</button>
                            </div>
                        </form>
                    </div>
                </div>
                    
            </div>

        <div class="col-md-2 mb-2">
            <div class="card main">
                <div class="card-body">
                    @include('layouts.partials.rightbar')
                </div>
            </div>
        </div>

</div>

@endsection

@push('scripts')
    
<script>
    var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime media nonbreaking save table contextmenu directionality",
    "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
    if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
    } else {
        cmsURL = cmsURL + "&type=Files";
    }

    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
    });
    }
};

tinymce.init(editor_config);
</script>

@endpush