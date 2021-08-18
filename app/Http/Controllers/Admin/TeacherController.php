<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Type;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('type',0)->get();
        return view( 'auth_admin.Teacher.index',compact(['users'])) ;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)

    {
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
        $data['type']= 0 ;


        $user = User::query()->create($data);

        return redirect()->route('index_teacher');
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
//        $user = User::find($id);





//        if($user){
//            return response()->json([
//                'status'=>200,
//                'user'=>$user,
//            ]);
//        }
//        else
//        {
//            return response()->json([
//                'status'=>404,
//                'message'=>'Teacher not found',
//            ]);
//        }


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
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'phone'=>'nullable|unique:users,phone',
            'image' => 'nullable|image',
        ];
        $this->validate($request,$rules);

//        $user =User::find($id);
        $data = $request->except('image');
//        if(empty($request->input('name'))) {
//            $user->name = null;
//        }else{
//            $user->name=$request->input('name');
//        }
//        if(empty($request->input('email'))) {
//            $user->name = null;
//        }else{
//            $user->name=$request->input('email');
//        }
//        if(empty($request->input('phone'))) {
//            $user->name = null;
//        }else{
//            $user->name=$request->input('phone');
//        }
//        if(empty($request->input('image'))) {
//            $user->name = null;
//        }else{
        if($request->image){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] =$imageName;
        }
        $user->update($data);
        return response()->json([$user]);


//        return redirect()->route('index_teacher');
//        $data = $request->except('password','confirm_password','image');
//
//        if ($request->password)
//            $data['password'] =Hash::make($request->password);
//
//        if($request->image) {
//            $imageName = time() . '.' . $request->image->extension();//41568498.png
//            $request->image->move(public_path('images'), $imageName);
//            $user->image = $imageName;
//
//        }

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
}
