<?php 

    use Illuminate\Support\Facades\Auth;
    use \App\Pertanyaan_Tag; 
    use \App\Tag;
    use \App\User;
    use \App\Vote_Pertanyaan;
    use \App\Pertanyaan;
    use \App\Jawaban;
    use Illuminate\Support\Facades\DB;
    $user = Auth::user(); 

?>

@extends('adminlte.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
<h1 class="h3 mb-4 text-gray-800">Halaman Diskusi</h1>
<div class="container">
        <button class="btn btn-outline-primary">
            <span class="card-text"> Point Reputasi: </span>
            <span class="text-center ml-1" style="color: darkslateblue"><b>{{$user->reputasi}}</b></span>
        </button>
    </div>

<div class="container mb-4 mt-4">
    <center>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @foreach ($pertanyaan as $key)
        <!-- Post -->
        </br>
        <div class="card gedf-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-2">
                            <img class="rounded-circle" width="45" src="{{asset('images/user.jpg')}}" alt="">
                        </div>
                        <div class="ml-2 ">
                            <div class="h5 m-0 ">{{$key->user->name}}</div>
                            <div class="h7 text-muted">{{$key->user->email}}</div>
                        </div>
                    </div>
                    @if ($key->user_id == Auth::user()->id)
                    <!-- Dropdown menu -->
                    <div class="dropdown" style="text-align:right;">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <div class="h6 dropdown-header">Aksi</div>
                            <!-- Button modal edit jawaban -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#editjawaban{{$key->id}}" href="#">Edit</a>
                            <form action="/pertanyaan/{{$key->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link dropdown-item" role="button">Hapus</button>
                            </form>
                        </div>
                        <!-- Modal Edit jawaban-->
                        <div class="modal fade" style="text-align:center;" id="editjawaban{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pertanyaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pertanyaan/{{$key->id}}" method='POST'>
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="judul">Judul Pertanyaan</label>
                                                <input type="text" name="judul" class="form-control" value="{{$key->judul}}" placeholder="" id="judul">
                                            </div>
                                            <div class="form-group">
                                                <label for="comment">Pertanyaan</label>
                                                <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                                <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!} {{$key->isi}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="judul"><b>Tag</b></label>
                                                <input type="text" name="tag" class="form-control" placeholder="ex: javascript,laravel,..." size="20" required>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tutup Modal -->
                    </div>
                    <!-- Dropdown end -->
                    @else

                    @endif
                </div>
            </div>
            <div class="card-body" style=" text-align: left!important;">
                <a class="card-link" href="pertanyaan/{{$key->id}}">
                    <h5 class="card-title">{{$key->judul}}</h5>
                </a>
                <p class="card-text">
                    {!!$key->isi!!}
                </p>
            </div>
            <div class="mb-4 ml-3" style="text-align: left!important;">
                <span>
                    <?php
                                                
                    $tag = Pertanyaan_Tag::where('pertanyaan_id', $key->id)
                                            ->get();
                ?>
                @foreach ($tag as $tag_id)
                    <?php
                        $tag_name = DB::table('tag')
                                ->select(DB::raw('nama_tag'))
                                ->where('id', $tag_id->id)->get();
                    ?>
                    <button type="button" class="btn btn-success btn-sm">
                        BUG
                    </button>
                @endforeach
                </span>
            </div>
            <div class="card-footer">
                <a href="{{url('user/vote-tanya/' . $key->id . '/' . Auth::id() . '/up')}}" class="card-link" style="color: green;"><i class="fa fa-arrow-up"></i> UpVote</a>
                <a href="#" class="btn btn-secondary btn-sm">
                    <?php
                        
                        $up_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$key->id, 'up_down'=>true])
                                ->count();
                        $down_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$key->id, 'up_down'=>false])
                                ->count();
                                
                        echo $up_vote - $down_vote;

                    ?>
                </a>
                <a href="{{url('user/vote-tanya/' . $key->id . '/' . Auth::id() . '/down')}}" class="card-link" style="color: red;"><i class="fa fa-arrow-down"></i> DownVote</a>
                <a href="#" class="card-link"><i class="fa fa-lightbulb-o" style="color:#000;"> Beri Jawaban</i> </a>

            </div>
        </div>
        @endforeach
</div>

@endsection

@push('scripts')
<script>
    var editor_config = {
        path_absolute: "/",
        selector: "textarea.my-editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };
    tinymce.init(editor_config);
</script>
@endpush