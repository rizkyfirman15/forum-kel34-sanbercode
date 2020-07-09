@extends('adminlte.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section ('content')
    <h1 class="h3 mb-4 text-gray-800">Form Menjawab</h1>
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
            </div>
        </div>
        <div class="card-body" style=" text-align: left!important;">
            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
            <a class="card-link" href="#">
                <h5 class="card-title">Menjawab: {{$answer->question->judul}} .</h5>
            </a>
    
            <p class="card-text">
                {{$answer->question->isi_pertanyaan}}
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
    </div>
    <div class="container pt-4 pl-4 pr-4">
        <form action="/answer/{{$answer->id}}" method='POST'>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="comment">Jawaban</label>
                <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
                <textarea name="isi" class="form-control my-editor">{{$answer->isi}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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