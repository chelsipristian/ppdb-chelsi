@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h3>Students</h3>
                </div>
                    <div class="col-4 text-right">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route($url, $student->id ?? '') }}" enctype="multipart/form-data">
                        @csrf 
                        @if(isset($student))
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="nisn">Nisn</label>
                            <input type="text" class="form-control @error('nisn') {{'is-invalid'}} @enderror" name="nisn" value="{{old('nisn') ?? $student->nisn ?? '' }}">
                            @error('nisn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') {{'is-invalid'}} @enderror">{{old('description') ?? $student->description ?? ''}}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <div class="custom-file">
                                <input type="file" name="thumbnail" class="custom-file-input">
                                <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">{{$button}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        @if(isset($student))
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus nisn {{$student->nisn}}</p>
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('dashboard.student.delete', $student->id) }}" method="post">
                            @csrf 
                            @method('delete')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>


@endsection