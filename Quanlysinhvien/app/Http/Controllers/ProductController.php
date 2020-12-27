<?php 
namespace App\Http\Controllers;
   
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
   
class ProductController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    if(request()->ajax()) {
        return datatables()->of(Product::select('*'))
        ->addColumn('action', 'DataTables.action')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
    return view('test.list');
}
   
   
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{  
    $productId = $request->product_id;
    $product   =   Product::updateOrCreate(['id' => $productId],
                ['title' => $request->title, 'product_code' => $request->product_code, 'description' => $request->description]);        
    return Response::json($product);
}
   
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Product  $product
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{   
    $where = array('id' => $id);
    $product  = Product::where($where)->first();
   
    return Response::json($product);
}
   
   
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Product  $product
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $product = Product::where('id',$id)->delete();
   
    return Response::json($product);
}
}