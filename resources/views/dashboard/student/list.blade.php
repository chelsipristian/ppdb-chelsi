@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{route('dashboard.student.create')}}" class="btn btn-primary">+ Student</a>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success">
        <strong>{{session()->get('message')}}</strong>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Students</h3>
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
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <!--<th>Thumbnail</th>
                            <th>Nisn</th>
                            <th>Edited</th>
                            <th>&nbsp;</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <!--<th>{{ ($students->currentPage() -1 ) * $students->perPage() + $loop->iteration }}</th-->
                            <td class="col-thumbnail">
                                <img src="{{asset('storage/student/'.$student->thumbnail)}}" class="img-fluid">
                            </td>
                            <td>
                                <h4><strong>{{ $student->nisn }}</strong></h4>
                                {{ $student->description}}
                            </td>
                            <td><a href="{{ route('dashboard.student.edit', $student->id) }}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $students->links() }}
            @else
                <h5 class="text-center p-3">Belum ada data Student</h5>
            @endif
        </div>
    </div>
@endsection