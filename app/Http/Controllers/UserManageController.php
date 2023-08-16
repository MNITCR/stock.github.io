<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserManageModel;

class UserManageController extends Controller
{
    // show page
    public function index(){
        return view('usermanager.user');
    }

    // get user
    public function GetUser(Request $rq){
        $userM = UserManageModel::paginate(5);
        return view('usermanager.user', compact('userM'));
    }

    // insert user
    public function insertUsers(Request $request){
        $usersData = $request->input('usersData');

        foreach ($usersData as $userData) {
            UserManageModel::create([
                'name' => $userData['name'],
                'password' => $userData['password'],
                'status' => $userData['status']
            ]);
        }

        return response()->json(['message' => 'Users inserted successfully']);
    }

    // update user
    public function update(Request $request, $id){
        $userData = UserManageModel::find($id);
        if($userData){
            $userData->name = $request->input('name');
            $userData->password = $request->input('password');
            $userData->status = $request->input('status');
            $userData->update();

            return response()->json([
                'status' => 200,
                'message' => 'User data updated successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => 400,
                'user' => 'Message not found',
            ]);
        }
    }

    // delete user
    public function destroy($id){
        $user = UserManageModel::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('usermanage')->with(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

}
