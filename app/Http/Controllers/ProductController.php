<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\categoryModel;
use App\Models\ProductModel;

class ProductController extends Controller
{
    // API get data
    public function index()
    {
        $products = ProductModel::all();
        return response()->json($products, 200);
    }

    public function Product(){
        $res = DB::table('productlist')->paginate(5);
        return view('products.product', ['list' => $res]);
    }

    // get Category list title
    public function getCategories()
    {
        $categories = categoryModel::all();
        return response()->json($categories);
    }

    // add data
    public function AddProduct(Request $request) {
        $products = $request->input('products');

        foreach ($products as $product) {
            // $amount = $product['qty'] * $product['price'];
            ProductModel::create([
                'barcode' => $product['barcode'],
                'title' => $product['title'],
                'qty' => $product['qty'],
                'price' => $product['price'],
                // 'amount' => $amount,
                'categoryid' => $product['categoryid']
            ]);
        }

        return response()->json(['message' => 'Products inserted successfully']);
    }

    // // update
    public function updatePro(Request $request, $proid)
    {
        $product = ProductModel::where('proid', $proid)->first();

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }

        $data = $request->only(['barcode', 'title', 'qty', 'price', 'categoryid']);
        $product->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Product updated successfully',
            'product' => $product
        ], 200);
    }

    // delete
    public function DeletePro($id){
        $user = ProductModel::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('product')->with(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
















    // API store data
    public function store(Request $request)
    {
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'barcode' => 'required|unique:products',
        'title' => 'required|string',
        'qty' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'categoryid' => 'required|exists:categories,id',
    ]);

    // Return a JSON response with the validation errors if validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => 442,
            'errors' => $validator->messages()
        ], 442);
    } else {
        // Create a new product using the validated data
        $product = ProductModel::create([
            'barcode' => $request->barcode,
            'title' => $request->title,
            'qty' => $request->qty,
            'price' => $request->price,
            'categoryid' => $request->categoryid,
        ]);

        // Return a JSON response indicating the success or failure of the product creation
        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Successfully created'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}

public function searchProduct(Request $request)
    {
        // echo 'Searching';
        $barcode = $request->input('barcode');

        $product = ProductModel::where('barcode', $barcode)->first();

        if ($product) {
            $result = $product->proid . ';' . $product->title; // Modify this to include other fields you want to return
            return response()->json($result);
        } else {
            return response()->json('0');
        }

    }
}
