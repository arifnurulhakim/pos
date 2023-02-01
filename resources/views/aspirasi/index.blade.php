@extends('adminlte::page')

@section('title', 'List Aspirasi')

@section('content_header')
    <h1 class="m-0 text-dark">List Aspirasi</h1>
@stop


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aspirasi.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Kategori</th>
                            <th>Aspirasi</th>
                            <th>gambar</th>
                            <th>status</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aspirasi as $key => $aspirasi)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$aspirasi->nim}}</td>
                                <td>{{$aspirasi->kategori}}</td>
                                <td>{{$aspirasi->aspirasi}}</td>
                                <td><img height="60px" width="60px" rel="tooltip" src="{{'/storage/gambar/'.$aspirasi->gambar}}"/></td>
                                <td>{{$aspirasi->status}} 
                                    
</td>
                                <td>
                                    <a href="{{route('aspirasi.destroy', $aspirasi)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
