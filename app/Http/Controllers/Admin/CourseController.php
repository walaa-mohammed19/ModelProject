<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $course =Course::all();
        $users = User::where('type',0)->get();

        return view( 'auth_admin.course.index',compact(['course','users'])) ;

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
            'name' =>'required |unique:courses',
            'user_id' =>'required',
            ];
        $this->validate($request,$rules);
        $data = $request->all();
        $course = Course::query()->create($data);
        return redirect()->route('index_course');


//        $data = $request->except('teacher_name');
//         $data['teacher_name'] = $request->input('teacher_name');



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

        if (request()->ajax())
        {
            $data =Course::FindOrFail($id);
            return response()->json(['reslut'=>$data]);
        }
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
        $course =Course::find($id);
        $rules=[
            'name' =>'nullable',
            'user_id' =>'nullable',
        ];

        $this->validate($request,$rules);
        $data = $request->all();
        $course->update($data);
        return response()->json([$course]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course= Course::find($id);
        if (isset($course));
        $course->delete();
        return redirect()->back();
        //
    }
}
