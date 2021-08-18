<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
    protected $table = "users";
    protected $guarded = [];

     protected $appends = ['courses_names','courses_names_admin','courses_ids'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'c_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getImageAttribute($value){
        return $value ? url('/').'/images/'.$value:'';
    }

    //relation Student
    public function courses()
    {
        return $this->belongsToMany(Course::class , 'grades'  , 'user_id', 'course_id')->withTimestamps()->withPivot('grade','type');
    }


    //relation Teacher له عدة كورسات but الكورس الواحد معلم واحد
    public function teachers()
    {
        return $this->hasMany(Course::class);
    }

    public function getCoursesNamesAttribute(){
        $array=[];
        foreach($this->teachers as $teacher) {
            array_push($array ,$teacher->name);
        }
        return $array ;

    }
    public function getCoursesNamesAdminAttribute(){
        $array=[];
        foreach($this->teachers as $teacher) {
            array_push($array ,$teacher->name);
        }
        return collect($array )->implode(', ');

    }
    public function getCoursesIdsAttribute(){
        $array=[];
        foreach($this->courses as $course) {
            array_push($array ,$course->id);
        }
        return collect($array )->implode(', ');

    }



}
