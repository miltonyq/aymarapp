<?php

class UserController extends BaseController {

	
	public function login_usuario()
	{
		return View::make('users.loginusuario');
	}

	public function login_usuario_post()
	{
		$input = Input::all();
		$bcrypt = new Bcrypt(15);

		$rules = array(
			'username' => 'required|exists:users,username',
			'password' => 'required',
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$username = Input::get('username');
			$password = Input::get('password');

			if($user = User::where('username', '=', $username)->first())
			{
				if($bcrypt->verify($password, $user->password))
				{
					Session::put('user_id', $user->id);
					Session::put('user_username', $user->username);
					Session::put('user_type', $user->type);
					return Redirect::to('/administrador');
				}
				else
				{
					return Redirect::to('/loginusuario');
				}
			}
			else
			{
				return Redirect::to('/loginusuario');
			}

		}
	}

	public function usuario_logout()
	{
		Session::flush();
		return Redirect::to('/loginusuario');
	}

}
