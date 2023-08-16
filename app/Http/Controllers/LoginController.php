<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

// class LoginController extends Controller
// {
//     public function LoginForm()
//     {
//         return view('admin.login');
//     }

//     public function LoginPage(Request $rq)
//     {
//         $data = $rq->all();
//         $email = $rq->input('email');
//         $pass = $rq->input('pass');

//         $result = DB::table('tb_user')
//             ->where('email', $email)
//             ->where('password', $pass)->first();
//          // Validate the request

//         if (isset($result)) {
//             $userId = $result->userId;
//             $username = $result->username;

//             session(['userId' => $userId, 'username' => $username]);
//             return redirect('/dashboard')->with('login success');
//         } else {
//             return redirect()->route('login')->with('Invalid email or password');
//         }
//     }
//         public function logout(Request $rq){
//         $rq->session()->flush();
//         return redirect('/');
//     }
// }






namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function LoginForm()
    {
        return view('admin.login');
    }

    public function LoginPage(Request $rq)
    {
        $data = $rq->all();
        $email = $rq->input('email');
        $pass = $rq->input('pass');

        $result = DB::table('tb_user')
            ->where('email', $email)
            ->where('password', $pass)->first();
         // Validate the request

        if (isset($result)) {
            $userId = $result->userId;
            $username = $result->username;

            if(isset($data['remember']) && !empty($data['remember'])) {
                setcookie("email", $data["email"], time() + 3600);
                setcookie("pass", $data["pass"], time() + 3600);
            }else{
                setcookie("email","");
                setcookie("pass","");
            }
            return redirect('/dashboard')->with('login success');
        } else {
            return redirect()->route('login')->with('Invalid email or password');
        }
    }
        public function logout(Request $rq){
        $rq->session()->flush();
        return redirect('/');
    }
}


