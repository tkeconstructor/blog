<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
    	'name','desc','code','students'
    ];

    public $timestamps = false;

    public function students(){
    	$role = Role::whereName('student')->first();
    	return $this->belongsToMany(\App\User::class)->where('role_id','=',$role->id)->get();
    }

    public function lecturers(){
    	$role = Role::whereName('lecturer')->first();
    	return $this->belongsToMany(\App\User::class)->where('role_id','=',$role->id)->get();
    }

    public function users(){
    	return $this->belongsToMany(\App\User::class);
    }
}
