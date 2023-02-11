<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Hobbie;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students=Student::where(function($query)use($request)
        {
            if($request->name)
                $query->where('name','LIKE','%'.$request->name.'%');
            if($request->email)
                $query->where('email',$request->email);
            if($request->active)
                $query->where('status',$request->active);
            if($request->age)
                if($request->age ==1)
                {
                    $query->where('age','>',10);
                }
                elseif($request->age ==2)
                {
                    $query->where('age','<',20);
                }
                elseif($request->age ==3)
                {
                    $query->where('age','=',15);
                }
        })->with('hobbies')->latest()->paginate(5);
        return view('index',compact('students'))->with('success','created successfully');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hobbies=Hobbie::all();
        return view('create',compact('hobbies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|min:2|max:10',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i',
            'gender'=>'required',
            'age'=>'required|numeric',
            'status'=>'required',
            'date_of_birth'=>'required',
            'image_file'=>'required',
            'place'=>'required',
            'pincode'=>'required|numeric',
        ]);
        // dd($request->all());
        $img=time().'.'.$request->image_file->extension();
        $request['image']=$img;
        $request->image_file->storeAs('public/images',$img);
        $student=Student::create($request->except(['image_file','place','pincode','subject','mark','hobbie']));
        $student->address()->create($request->only(['place','pincode']));
        foreach($request->subject as $key=>$value)
        {
            $student->marks()->create(['subject'=>$request->subject[$key],'mark'=>$request->mark[$key]]);
        }
        $student->hobbies()->attach($request->hobbie);
        return redirect()->route('students.index');
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
        $hobbies=Hobbie::all();
        return view('edit',compact(['student','hobbies']));
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
        $request->validate([
            'name'=>'required|min:2|max:10',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i',
            'age'=>'required|numeric',
            'date_of_birth'=>'required',
            'place'=>'required',
            'pincode'=>'required|numeric',
        ]);
        if($request->hasFile('image_file'))
        {
            $img=time().'.'.$request->image_file->extension();
         $request['image']=$img;
         $request->image_file->storeAs('public/images',$img);
        }
        
        $student->marks()->delete();
        $student->update($request->except(['image_file','place','pincode','subject','mark','hobbie']));
        $student->address()->update($request->only(['place','pincode']));
        foreach($request->subject as $key=>$value)
        {
            $student->marks()->create(['subject'=>$request->subject[$key],'mark'=>$request->mark[$key]]);
        }
        $student->hobbies()->sync($request->hobbie);
        return redirect()->route('students.index')->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','deleted successfully');
    }
}
