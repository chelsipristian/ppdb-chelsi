@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align self-center">
                    <h3>Student</h3>
                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        <!-- Tambahkan konten disini sesuai kebutuhan -->
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route($url, $student->nisn ?? '') }}" enctype="multipart/form-data">
                        @csrf 
                        @if(isset($student))
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="nisn">Nisn</label>
                            <input type="text" class="form-control @error('nisn') {{'is-invalid'}} @enderror " name="nisn" value="{{old('nisn') ?? $student->nisn ?? ''}}">
                            @error('nisn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') {{'is-invalid'}} @enderror " name="nama" value="{{old('nama') ?? $student->nama ?? ''}}">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') {{'is-invalid'}} @enderror " name="alamat" value="{{old('alamat') ?? $student->alamat ?? ''}}">
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control @error('asal_sekolah') {{'is-invalid'}} @enderror " name="asal_sekolah" value="{{old('asal_sekolah') ?? $student->asal_sekolah ?? ''}}">
                            @error('asal_sekolah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tgllahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tgllahir') {{'is-invalid'}} @enderror " name="tgllahir" value="{{old('tgllahir') ?? $student->tgllahir ?? ''}}">
                            @error('tgllahir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control @error('jenis_kelamin') {{'is-invalid'}} @enderror " name="jenis_kelamin" value="{{old('jenis_kelamin') ?? $student->jenis_kelamin ?? ''}}">
                            @error('jenis_kelamin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') {{'is-invalid'}} @enderror " name="email" value="{{old('email') ?? $student->email ?? ''}}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <div class="custom-file">
                                <input type="file" name="thumbnail" class="custom-file-input">
                                  <br>*Wajib menambahkan pas foto!!
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary button-spacing">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">{{$button}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if(isset($student))
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete</h5>
                        
                    </div>

                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus Data {{$student->nisn}}</p>
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('dashboard.student.delete', $student->nisn) }}" method="post">
                            @csrf 
                            @method('delete')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection