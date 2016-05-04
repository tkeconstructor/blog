<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Helpers\Config;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';

    protected $redirectTo = '/admin';

	protected $guard = 'admins';

    protected $redirectAfterLogout = 'admin/login';

	 public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }


	public function getLogin(){
		return view('admin.auth.login');
	}

	public function getRegister(){
		return view('admin.auth.register');	
	}

	protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
