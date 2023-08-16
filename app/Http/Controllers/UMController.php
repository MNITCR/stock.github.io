<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UMController extends Controller
{
    public function User(){
        //Select * from tablename
        // $result = DB::table('tb_user')->get();
        $result = DB::table('tb_user')->paginate(5);
        return view('admin.index', ['UserData' => $result]);
    }

    // add user
    public function AddUser(Request $rq){
        $user = $rq->username;
        $pass = $rq->password;
        $status = $rq->status;

        // echo $user. $pass . $status;
        DB::table('tb_user')->insert(
            [
                'username' => $user,
                'password' => $pass,
                'status' => $status,
            ]
        );
        echo 1;
    }

    // delete user
    public function Delete(Request $rq){
        $id = $rq->id;
        DB::table('tb_user')->where('userId', $id)->delete();
        echo 1;
    }

    // update user
    public function Update(Request $rq){
        if($rq->upp == ''){
            DB::table('tb_user')
            ->where('userId', $rq->id)
            ->update(
                [
                    'username' => $rq->upn,
                    'status' => $rq->upst,
                ]
             );
                echo 1;
        }else{
            DB::table("tb_user")
            ->where('userId', $rq->id)
            ->update(
                [
                    'username' => $rq->upn,
                    'password' => $rq->upp,
                    'status' => $rq->upst,
                ]
            );
            echo 1;
        }
    }

}
