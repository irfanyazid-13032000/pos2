<?php

  

namespace App\Http\Controllers\Auth;

  

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

  

class LoginController extends Controller

{

  

    use AuthenticatesUsers;

    

    protected $redirectTo = '/';

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }

  

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function login(Request $request)
    { 

        $input = $request->all();

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if(auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))
        {
            // setcookie('language', 'id', time() + (86400 * 365), "/");
            return redirect('/');
        }
        else {
            return redirect()->route('login')->with('error','Username And Password Are Wrong.');
        }
    }
}