@extends('adminlte::page')

@section('title', 'Tambah Kategori')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Aspirasi</h1>
@stop

@section('content')
    <form action="{{route('aspirasi.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputName">NIM</label>
                            <input type="text" class="form-control @error('nama Kategori') is-invalid @enderror" id="exampleInputName" placeholder="NIM" name="nim" value="{{old('nim')}}">
                            @error('nim') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select id="kategori" name="kategori" value="{{old('kategori')}}" placeholder="kategori" class="form-select"  required>
                            <option selected="" disabled="">- Pilih Kategori -</option>
                            <option value="akademi" @if (old('kategori') == 'akademi') selected="selected" @endif>akademi
                            </option>
                            <option value="minat bakat" @if (old('kategori') == 'minat bakat') selected="selected" @endif>minat bakat
                            </option>
                            <option value="fasilitas" @if (old('kategori') == 'fasilitas') selected="selected" @endif>fasilitas
                            </option>
                            <option value="ormawa" @if (old('kategori') == 'ormawa') selected="selected" @endif>ormawa
                            </option>
                            <option value="dll" @if (old('kategori') == 'dll') selected="selected" @endif>dll
                            </option>
                            </select>
                        </div>
                                <div class="form-group">
                        <select id="status" name="status" value="{{old('status')}}" placeholder="status" class="form-select" hidden required>
                        <option value="pending" @if (old('status') == 'pending') selected="selected" @endif>pending
                        </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="aspirasi">Aspirasi</label>
                        <textarea class="form-control" id="aspirasi" placeholder="aspirasi" name="aspirasi" value="{{old('aspirasi')}}" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gambar">gambar</label>
                        <input type="file" name="images" class="form-control border-input">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('aspirasi.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
