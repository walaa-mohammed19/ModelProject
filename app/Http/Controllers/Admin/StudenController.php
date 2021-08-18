<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Grade;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

class StudenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('type',1)->get();
        $teacher = User::where('type',0)->get();
        $courses = Course::all();
        $grades = Grade::where('type',0)->get();
        return view( 'auth_admin.Student.index',compact(['users','teacher','courses'])) ;
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
            'name' =>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'c_password'=>'required|same:password|min:6',
            'phone'=>'required',
            'image' => 'nullable|image',
        ];
        $this->validate($request,$rules);
        $data = $request->except('password','c_password','image');
        if($request->image) {
            $imageName = time() . '.' . $request->image->extension();//41568498.png
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $data['password'] =Hash::make($request->get('password'));
        $data['type']= 1 ;


        $user = User::query()->create($data);

        return redirect()->route('index_student');
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
        if (request()->ajax())
        {
            $data =Sample::FindOrFail($id);
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
        $user =User::find($id);
        $rules=[
            'name' =>'nullable',
            'email'=>'nullable|email|unique:users,email,'.$user->id,
            'phone'=>'nullable|unique:users,phone',
            'image' => 'nullable|image',
        ];
        $this->validate($request,$rules);


        $data = $request->except('image');
        if($request->image){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] =$imageName;
        }
        $user->update($data);
        return response()->json([$user]);

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
        $user= User::find($id);
        if (isset($user));
        $user->delete();
        return redirect()->back();
    }

    public function storeteacher(Request $request)
    {
//        dd($request->all());

        $rules=[
//            'user_id' =>'required',
            'course_id'=>'required',

        ];
        $this->validate($request,$rules);
        $data = $request->all();
        $course= Course::find($request->course_id) ;

        $data['type']= 0 ;
        $data['user_id']= $course->user_id ;

        $garde = Grade::query()->create($data);
return back();
    }

    public function getTeacher($course_id)
    {
//        teacher_names
      //  $courses= Course::find($course_id)->with(teacher_names);
        $courses= Course::find($course_id) ;
        $user = User::find($courses->user_id);
        $name = $user->name;
        $id = $user->id;
//        return response()->json('name');
        return response()->json(['status'=> true,'name'=>$name]);
    }

    public function getTacherCourse($user_id)
    {


//        $user = User::where('type',0);
        $grades = Grade::where('user_id',$user_id)->where('type',1)->get();
        $array = [];
            foreach ($grades as $grade){
              $course =  Course::query()->find($grade->course_id);
               $course_name =  $course->name;
               $user = User::query()->where('type',0)->find($course->user_id);
                $teacher_name = $user->name;
                $array[] = [
               'course_name' => $course_name,
               'teacher_name' => $teacher_name
                    ];
//                array_push($new_arr,$array);

            }

        return response()->json(['status'=> true,'data'=>$array]);
    }

}
