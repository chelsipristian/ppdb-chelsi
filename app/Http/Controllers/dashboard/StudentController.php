<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Student $students)
    {
        $q = $request->input('q');

        $active = 'Student';

        $students = $students->when($q, function($query) use ($q) {
                        return $query->where('nisn', 'like', '%' .$q. '%')
                                     ->orwhere('description', 'like', '%' .$q. '%');
        })

        ->paginate(10);
        $request = $request->all();
        return view('dashboard/student/list', [
            'students' => $students,
            'request' => $request,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Students';
        return view('dashboard/student/form', [
            'active' => $active,
            'button' =>'Create',
            'url'    =>'dashboard.student.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn'          =>  'required|unique:App\Models\Student,nisn',
            'description'   =>  'required',
            'thumbnail'     =>  'required|image', 
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.student.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $student = new Student(); //  untuk objek student
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/student', $image, $filename);

            $student->nisn = $request->input('nisn');
            $student->description = $request->input('description');
            $student->thumbnail = $filename; // Ganti nama file yg baru diupload
            $student->save();

            return redirect()
                             ->route('dashboard.student')
                             ->with('message', __('Data Berhasil diperbarui!', ['nisn'=>$request->input('nisn')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        $active = 'Student';
        return view('dashboard/student/form', [
            'active'  => $active,
            'student' => $student,
            'button'  =>'Update',
            'url'     =>'dashboard.student.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $validator = Validator::make($request->all(), [
            'nisn'          =>  'required|unique:App\Models\Student,nisn,'.$student->id,
            'description'   =>  'required',
            'thumbnail'     =>  'image'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.student.update', $student->id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // $student = new Student(); // Tambahkan ini untuk objek
                if($request->hasFile('thumbnail')){
                    $image = $request->file('thumbnail');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                        Storage::disk('local')->putFileAs('public/student', $image, $filename);
                    $student->thumbnail = $filename; // Ganti dengan nama file yg baru diupload
                }
            $student->nisn = $request->input('nisn');
            $student->description = $request->input('description');
            $student->save();

            return redirect()
                             ->route('dashboard.student')
                             ->with('message', __('Data Berhasil diperbarui!', ['nisn'=>$request->input('nisn')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $nisn = $student->nisn;

        $student->delete();
        return redirect()
                ->route('dashboard.student')
                ->with('message', __('Data Berhasil diperbarui!', ['nisn' => $nisn]));
    }
}
