<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;


class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view( 'student.profile') ;


    }

    public function viewCourse(){

        $user =auth('web')->user();
        return view('student.view_course',compact(['user'])) ;

    }
    public function addCourse(){
        $courses=Course::all();
        return view('student.add_course',compact(['courses'])) ;

    }
    public function viewGrade (){
        $user =auth('web')->user();
        $grades =Grade::where('user_id',$user->id)->where('type',1)->get();
         return view('student.view_grade',compact(['user','grades'])) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules=[
            'course_id'=>'required',
        ];

        $this->validate($request,$rules);
        $data = $request->all();
//        $course= Course::find($request->course_id) ;

        $data['type']= 1;
        $user =auth('web')->user();
        $data['user_id']= $user->id ;

//        $data['user_id']= $course->user_id ;

        $garde = Grade::query()->create($data);
        return redirect()->route('view_course');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTeacher($course_id)
    {

        $courses= Course::find($course_id) ;
        $user = User::find($courses->user_id);
        $name = $user->name;
        return response()->json(['status'=> true,'name'=>$name]);
    }

//    public function storeteacher(Request $request)
//    {
//
//        $rules=[
//            'course_id'=>'required',
//        ];
//
//        $this->validate($request,$rules);
//        $data = $request->all();
//        $course= Course::find($request->course_id) ;
//
//        $data['type']= 0 ;
//        $data['user_id']= $course->user_id ;
//
//        $garde = Grade::query()->create($data);
//        return back();
//    }
}
