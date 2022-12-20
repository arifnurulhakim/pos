@extends('adminlte::page')

@section('title', 'Edit Kategori')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Kategori</h1>
@stop

@section('content')
    <form action="{{route('kategori.update', $kategori)}}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama Kategori') is-invalid @enderror" id="exampleInputName" placeholder="Nama Kategori" name="nama_kategori" value="{{$kategori->nama_kategori ?? old('nama_kategori')}}">
                            @error('nama_kategori') <span class="text-danger">{{$message}}</span> @enderror
                        </div>   
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('kategori.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
