@extends('layouts.master')
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
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable with default features</h3>
                  <a style="float: right;" class="btn btn-success" href="/pertanyaan/create">Masukan Pertanyaan</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pertanyaan as $key => $row)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{$row->judul}}</td>
                          <td>
                            <a class="btn btn-sm btn-info" title="Add/Edit Attributes" href="{{ url('jawaban/'.$row->id) }}">Lihat</a>
                            &nbsp;
                            &nbsp;
                            <a class="btn btn-sm btn-default" title="Add/Edit Attributes" href="{{ url('pertanyaan/'.$row->id.'/edit') }}">Edit</a>
                            &nbsp;
                            &nbsp;
                            <a title="Delete Pertanyaan dan Jawaban" class="confirmDelete" recordid="{{ $row->id }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                            <form id="formdelete" action="/pertanyaan/{{$row['id']}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <?php //<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"><a title="Delete Pertanyaan dan Jawaban" class="confirmDelete" recordid="{{ $row->id }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a></i></button> ?>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Aksi</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
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
<script src="{{asset('/adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<!-- Sweet Alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(".confirmDelete").click(function () {
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: 'Apa anda yakin menghapus file?',
            text: "Anda tidak akan dapat mengembalikan file ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus File!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Berhasil Dihapus!',
                    'File Sudah Terhapus.',
                    'success'
                )
                document.getElementById("formdelete").submit();
            }
        });
    });
    </script>
@endpush
