@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href ="{{route('dashboard.student.create')}}" class="btn btn-primary">+ Student</a>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success">
        <strong>{{session()->get('message')}}</strong>
       
    </div>
    @endif

    <div class="card">
        <div class="card-header">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Student</h3>
                </div>
                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.student') }}">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($students->total())
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <!--<th>No</th>
                            <th>Nisn</th>
                            <th>Thumbnail</th>
                            <th>&nbsp;</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <!--<td>{{ ($students->currentPage() -1 ) * $students->perPage() + $loop->iteration }}</td>-->
                            <td class="col-thumbnail">
                                <img src="{{asset('storage/student/'.$student->thumbnail)}}" class="img-fluid">
                               
                            <td>
                               <h4><strong>{{ $student->nisn }}</strong></h4>--------------------------------------------
                               <table>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td>{{ $student->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>:</td>
                                    <td>{{ $student->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Asal Sekolah</strong></td>
                                    <td>:</td>
                                    <td>{{ $student->asal_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Lahir</strong></td>
                                    <td>:</td>
                                    <td>{{ $student->tgllahir }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>:</td>
                                    <td>{{ $student->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>:</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                            </table>

                            </td>
                            <td><a href="{{ route('dashboard.student.edit', $student->nisn) }}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a></td>
                           
                        @endforeach
                    </tbody>
                </table>
                {{ $students->links() }}
            @else
                <h5 class="text-center p-3">Belum ada data Student</h5>
            @endif
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        </div>
    </div>
@endsection