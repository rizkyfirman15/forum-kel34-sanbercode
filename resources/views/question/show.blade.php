@extends('adminlte.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
<h1 class="h3 mb-4 text-gray-800">{{$question->judul}}</h1>

<div class="container mb-4">
    <center>
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
                            <div class="h5 m-0 ">{{$question->user->name}}</div>
                            <div class="h7 text-muted">{{$question->user->email}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style=" text-align: left!important;">
                <p class="card-text">
                    {!!$question->isi_pertanyaan!!}
                </p>
            </div>
            <div class="mb-4 ml-3" style="text-align: left!important;">
                <span class="badge badge-primary">{{$question->tag}}</span>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link" style="color: green;"><i class="fa fa-arrow-up"></i> UpVote</a>
                <a href="#" class="card-link" style="color: red;"><i class="fa fa-arrow-down"></i> DownVote</a>
                <!-- Button Modal -->
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#berijawaban1">
                    <i class="fa fa-lightbulb-o" style="color:#000;"> Beri Jawaban</i>
                </button>
                <!-- Modal Beri Jawaban-->
                <div class="modal fade" id="berijawaban1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat Jawaban</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/question/1" method='POST'>
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Jawaban</label>
                                        <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                        <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
                <!-- Button Modal -->
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#komentarpertanyaan1">
                    <i class="fa fa-commenting"> Beri Komentar</i>
                </button>
                <!-- Modal Beri Komentar Pertanyaan-->
                <div class="modal fade" id="komentarpertanyaan1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat Komentar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/question-comment/" method='POST'>
                                    @csrf
                                    <input type="hidden"name="question_id" value="{{$question->id}}">
                                    <input type="hidden"name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden"name="vote" value="0">
                                    <div class="form-group">
                                        <label for="comment">Komentar</label>
                                        <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                        <textarea name="komentar" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
        </div>
        <!-- end Post -->
        @foreach($comments as $comment)
                <!-- comment -->
                <div class="card w-75 mt-2" style="text-align:left;">
            <div class="card-header mb-0 mt-0 pb-0 pt-0">
                @if ($comment->user_id==Auth::user()->id)
                    <!-- Dropdown -->
                <div class="dropdown" style="text-align:right;">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <div class="h6 dropdown-header">Aksi</div>
                        <!-- Button modal edit komentar pertanyaan -->
                        <a class="dropdown-item" data-toggle="modal" data-target="#editkomentarpertanyaan{{$comment->id}}" href="#">Edit</a>
                        <form action="/question-comment/{{$comment->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link dropdown-item" role="button">Hapus</button>
                            </form>
                    </div>
                    <!-- Modal Edit Komentar pertanyaan-->
                    <div class="modal fade" style="text-align:center;" id="editkomentarpertanyaan{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Komentar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/question-comment/{{$comment->id}}" method='POST'>
                                        @csrf
                                        @method('put')
                                        <input type="hidden"name="question_id" value="{{$comment->question_id}}">
                                        <input type="hidden"name="user_id" value="{{Auth::user()->id}}">
                                        <input type="hidden"name="vote" value="0">
                                        <div class="form-group">
                                            <label for="comment">Komentar</label>
                                            <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                            <textarea name="komentar" class="form-control my-editor">{!! old('isi', $isi ?? '') !!} {!!$comment->komentar!!}</textarea>
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
                <!-- Dropdown -->
                @else
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$comment->user->name}}</h5>
                <p class="card-text">{!!$comment->komentar!!}</p>
                <!--Button modal  -->
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#balaskomentarpertanyaan1">
                    <i class="fa fa-reply"> Balas</i>
                </button>
                <!-- Modal Beri Komentar pertanyaan-->
                <div class="modal fade" id="balaskomentarpertanyaan1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Balas Komentar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/question/1" method='POST'>
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Komentar</label>
                                        <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                        <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
        </div>
        <!--End comment  -->
        @endforeach
        <!-- Jawaban -->
        </br>
        <div class="card gedf-card">
            <div class="card-header" style="background-color: #1c1a1f!important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-2">
                            <img class="rounded-circle" width="45" src="{{asset('images/user.jpg')}}" alt="">
                        </div>
                        <div class="ml-2 ">
                            <div class="h5 m-0 ">{{Auth::user()->name}}</div>
                            <div class="h7 text-muted">{{Auth::user()->email}}</div>
                        </div>
                    </div>
                    <div>
                        <div class="dropdown" style="text-align:right;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                <div class="h6 dropdown-header">Aksi</div>
                                <!-- Button modal edit jawaban -->
                                <a class="dropdown-item" data-toggle="modal" data-target="#editjawaban1" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                            <!-- Modal Edit jawaban-->
                            <div class="modal fade" style="text-align:center;" id="editjawaban1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Jawaban</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/question/1" method='POST'>
                                                @csrf
                                                <div class="form-group">
                                                    <label for="comment">Jawaban</label>
                                                    <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                                    <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
                    </div>
                </div>
            </div>
            <div class="card-body" style=" text-align: left!important;">
                <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos ipsa praesentium esse magnam nemo dolor
                    sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.
                </p>
            </div>
            <div class="mb-4 ml-3" style="text-align: left!important;">
                <span class="badge badge-primary">JavaScript</span>
                <span class="badge badge-primary">Android</span>
                <span class="badge badge-primary">PHP</span>
                <span class="badge badge-primary">Node.js</span>
                <span class="badge badge-primary">Ruby</span>
                <span class="badge badge-primary">Paython</span>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link" style="color:#000;"><i class="fa fa-thumbs-up"></i> Tandai Jawaban terbaik</a>
                <a href="#" class="card-link" style="color: green;"><i class="fa fa-arrow-up"></i> UpVote</a>
                <a href="#" class="card-link" style="color: red;"><i class="fa fa-arrow-down"></i> DownVote</a>
                <!-- Button Modal -->
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#komentarjawaban1">
                    <i class="fa fa-commenting"> Beri Komentar</i>
                </button>
                <!-- Modal Beri Komentar Pertanyaan-->
                <div class="modal fade" id="komentarjawaban1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat Komentar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/question/1" method='POST'>
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Komentar</label>
                                        <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                        <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
        </div>
        <!-- end Jawaban -->


        <!-- comment -->
        <div class="card w-75 mt-2" style="text-align:left;">
            <div class="card-header mb-0 mt-0 pb-0 pt-0">
                <div class="dropdown" style="text-align:right;">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <div class="h6 dropdown-header">Aksi</div>
                        <!-- Button modal edit komentar jawaban -->
                        <a class="dropdown-item" data-toggle="modal" data-target="#editkomentarjawaban1" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                    <!-- Modal Edit Komentar Jawaban-->
                    <div class="modal fade" style="text-align:center;" id="editkomentarjawaban1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Komentar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/question/1" method='POST'>
                                        @csrf
                                        <div class="form-group">
                                            <label for="comment">Komentar</label>
                                            <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                            <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
            </div>
            <div class="card-body">
                <h5 class="card-title">{{Auth::user()->name}}</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <!--Button modal  -->
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#balaskomentarjawaban1">
                    <i class="fa fa-reply"> Balas</i>
                </button>
                <!-- Modal Balas Komentar Jawaban-->
                <div class="modal fade" id="balaskomentarjawaban1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Balas Komentar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/question/1" method='POST'>
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Komentar</label>
                                        <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                                        <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
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
        </div>
        <!--End comment  -->
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