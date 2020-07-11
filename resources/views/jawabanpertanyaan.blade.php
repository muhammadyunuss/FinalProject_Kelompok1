@extends('layouts.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Table</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pertanyaan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="{{asset('/adminlte/dist/img/user1-128x128.jpg')}}" alt="user image">
                          <span class="username">
                            <a href="#">{{$name}}</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Shared publicly - {{ $getPertanyaan['created_at'] }}</span>
                        </div>
                        <!-- /.user-block -->
                        <h5>{{$getPertanyaan['judul']}}</h5>
                        <p>
                          {!! $getPertanyaan['isi'] !!}
                        </p>

                        @foreach($getPertanyaan->tags as $tag)
                        <button class="btn btn-default btn-sm"> {{$tag->tag_name}} </button>
                        @endforeach

                        <p>
                          <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                          <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                          <span class="float-right">
                            <a href="#" class="link-black text-sm">
                              <i class="far fa-comments mr-1"></i> Comments (5)
                            </a>
                          </span>
                        </p>

                        <form action="{{url('jawaban/'.$getPertanyaan['id'])}}" class="form-horizontal" method="POST">@csrf
                            <div class="form-group">
                                <textarea name="isi" class="form-control my-editor" placeholder="Enter ..."></textarea>
                            </div>
                            <div style="float: right" class="input-group-append">
                              <button type="submit" class="btn btn-success">Send</button>&nbsp;&nbsp;
                              <a class="btn btn-danger" href="/pertanyaan">Kembali</a>
                            </div>
                          </form>
                      </div>
                </div>
                <!-- /.card-body -->
              </div>
              @foreach ($getJawaban as $key => $jawaban)
              @if ($key % 2)
                  <?php $color = "danger" ?>
              @else
                  <?php $color = "info" ?>
              @endif
              <div class="callout callout-{{$color}}">
                
                <h5><i class="fas fa-user"></i> {{ $jawaban['user_id'] }}</h5>
                {!! $jawaban['isi']!!}
              </div>

              @endforeach
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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

