<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Excel;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::sortable()->paginate(6);
        //dd($students);
        return view('index', compact('students'),['name'=> 'Students List']);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create',['name'=> 'Add Student Data']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'image' => 'required',
            'phone_no' => 'required|numeric',
            'address' => 'required|max:255',
        ]);
        
        if ($request->hasFile('image')) {
            $file_name = date('YmdHis') . "." . $request->file('image')->Extension();
            $request->file('image')->storeAs('imgupload',$file_name, 'public');    
            $student = new Student();
            $student->image =  $file_name;      
        }
        // Save In Database

        $show = Student::create($validatedData);

        return redirect()->route('student.index')->with('success', 'Student has been added');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('edit', ['name'=> 'Edit Student Data'])->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->update([
           'full_name' => $request->full_name,
           'phone_no' => $request->phone_no,
           'address' => $request->address,
           'created_at' => now(),
        ]);
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $update['image'] = "$profileImage";
            }
        return redirect()->route('student.index')->with('success', 'Student has been Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student has been Deleted');
    }

    public function exportIntoExcel()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function exportIntoCsv()
    {
        return Excel::download(new StudentsExport, 'students.csv');
    }

    public function import(Request $request) 
    {
        Excel::import(new StudentsImport,request()->file('file'));
           
        return redirect('/students-list');
    }

    public function importForm()
    {
       return view('import-form');
    }

    public function search()
    {
        $search_text = $_GET['query'];
        $students = Student::where("full_name","LIKE","%{$search_text}%")->orwhere("address","LIKE","%{$search_text}%")->paginate(5);

        return view('/search',compact('students'));
    }

}
