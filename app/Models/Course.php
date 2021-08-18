<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    protected $table = "courses";
    protected $guarded = [];
    protected $appends = ['teacher_names'];

//relation Student
    public function users()
    {
        return $this->belongsToMany(User::class
            , 'grades' , 'course_id' , 'user_id'
        )->withTimestamps()->withPivot('grade','type');
    }
    
    public function getTeacherNamesAttribute(){
        $array=[];
        foreach($this->users as $user) {
            array_push($array ,$user->name);
        }
        return collect($array)->implode(', ');

    }

    //relation Teacher له عدة كورسات but الكورس الواحد معلم واحد
    public function user()
    {
         return $this->belongsTo(User::class,'user_id');
         //هنا لازم انتبه انه teacher_id لازم ينكتب لانه اسمه بختنلف
        //لانه لو ماكتبت بفكره user_id
    }
}
