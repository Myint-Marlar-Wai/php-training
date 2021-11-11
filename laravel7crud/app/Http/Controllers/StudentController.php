<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\FieldRequest;
use App\Student;
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
        $countPerPage = config('constants.paginate_per_page');
        $students = Student::sortable()->paginate($countPerPage);
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
    public function store(FieldRequest $request)
    {   

        $validatedData = $request->validated();
        Student::create($validatedData);
        
        if ($request->hasFile('image')) {
            $profile = $request->file('image');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);   
        }
            $student = new Student();
            $student->full_name = $request->full_name;
            $student->image =  $file_name;    
            $student->phone_no = $request->phone_no;
            $student->address = $request->address;
            $student->save();


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
    
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'image' => 'required|image',
            'phone_no' => 'required|numeric',
            'address' => 'required|max:255',
        ]);
        
        if ($request->hasfile('image')) {
            $profile = $request->file('image');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);   
            $floderpath = $file_name; 
               
        } else {
            $floderpath = require('oldphoto');
        }

            $student = Student::find($id);
            $student->full_name = $request->full_name;
            $student->image =  $floderpath;    
            $student->phone_no = $request->phone_no;
            $student->address = $request->address;
            $student->save();

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
        $file_name = "students_" . date("m.d.y") . "_" . time() . ".xlsx";
        return Excel::download(new StudentsExport, $file_name);
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
