<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    // get data from database
    public function Category(){
        $cate = CategoryModel::paginate(5);
        return view('categorys.category', compact('cate'));
    }

    // add category
    public function addCategory(Request $request){
        $Category = $request->input('Category');

        // Loop through the input arrays and insert data into the database
        foreach ($Category as $index) {
            categoryModel::create([
                'title' => $index['title'],
                'titlekh' => $index['titlekh'],
                'desciption' => $index['description'],
            ]);
        }

        return response()->json(['message' => 'Category inserted successfully']);
    }

    // Edit category
    public function Edit(Request $request, $id){
        $CateT = categoryModel::find($id);
        if($CateT){
            $CateT->title = $request->input('title');
            $CateT->titlekh = $request->input('titlekh');
            $CateT->desciption = $request->input('desciption');
            $CateT->update();

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

    // Delete category
    public function destroy($catid){
        $catId = categoryModel::find($catid);
        if ($catId) {
            $catId->delete();
            return redirect()->route('category')->with(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
