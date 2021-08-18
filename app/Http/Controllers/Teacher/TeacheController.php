<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;

class TeacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.profile');
    }

    public function coursesTeacher(){

        $teacher =auth('web')->user();
        $users =User::where('type',1)->get();
        $courses =Course::all();
        return view('teacher.courses_teacher',compact(['courses','teacher','users'])) ;

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
        //
        $rules=[
            'user_id' => 'required|array',
            'course_id' => 'required'
        ];

        $this->validate($request,$rules);
//        $data = $request->except('user_id','course_id');
//        $data['type']=1;

        foreach ($request->user_id as $dep_id){
            $data = [
                'user_id'=> $dep_id,
                'course_id'=>$request->course_id,
                'type'=>1
            ];
//            $data['type']=1;
//            $grade = Grade::query()->create($data);
            $grade = Grade::updateOrCreate(
                $data,
                $data
            );
        }
        return back();
    }
    public function getStudent($course_id)
    {
//        dd(auth('web'))


//        $user = User::where('type',0);
        $grades = Grade::where('course_id', $course_id)->where('type',1)->get();
//        dd($grades);
        $array1 = $array2=[];
        foreach ($grades as $grade) {
            $user = User::query()->find($grade->user_id);
            $student_name = $user->name;
            $student_id = $user->id;
            $student_grade = $grade->grade;
            $array2 = [
                'course_id' => $course_id,
                'student_name' => $student_name,
                'student_grade'=> $student_grade,
                'student_id'=> $student_id
            ];

    array_push($array1, $array2);
//

        }
//        dd($array1);
        return response()->json(['status'=> true,'data'=>$array1]);
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
//        dd($request->all());
        $grade =Grade::where('user_id',$id)->get();
        $rules=[
            'grade' =>'nullable'

            ];
        $this->validate($request,$rules);
        $grade->update($request);
        return response()->json();
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


}
