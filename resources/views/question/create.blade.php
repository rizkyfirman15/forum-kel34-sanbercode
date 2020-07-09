@extends('adminlte.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section ('content')
<h1 class="h3 mb-4 text-gray-800">Halaman Buat Pertanyaan</h1>
<div class="container pt-4 pl-4 pr-4">
<form action="/question" method='POST'>
@csrf
  <div class="form-group">
    <label for="judul">Judul Pertanyaan</label>
    <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Pertanyaan" id="judul">
  </div>
  <div class="form-group">
  <label for="comment">Pertanyaan</label>
  <!-- <textarea class="form-control" name="isi" placeholder="Tuliskan pertanyaan anda di sini !"rows="5" id="isi"></textarea> -->
  <textarea name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
</div>
<div class="form-group">
    <label for="tag">Tag Pertanyaan</label>
    <input type="text" class="form-control" name="tag" required id="tag">
    <small id="emailHelp" class="form-text text-muted">Gunakan pemisah koma untuk memasukkan tag</small>
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