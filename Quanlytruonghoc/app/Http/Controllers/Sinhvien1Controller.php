<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Sinhvien1;
use Illuminate\Support\Facades\DB;

class Sinhvien1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data1 = DB::table('sinhvien as sv')
            ->leftJoin('khoa as tenkhoa', 'sv.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('sv.id', 'sv.masinhvien', 'sv.hoten', 'sv.email', 'sv.diachi', 'tenkhoa.tenkhoa')->get();
            $data = Sinhvien1::latest()->get();
            return Datatables::of($data1)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        return view('sinhvien1',compact('sinhvien1s'))->with('dskhoa', $dskhoa);;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           Sinhvien1::updateOrCreate(['id' => $request->Item_id],
                ['masinhvien' => $request->masinhvien, 'hoten' => $request->hoten,'email' => $request->email,'tenkhoa' => $request->tenkhoa,'diachi' => $request->diachi]);        
   
        return response()->json(['success'=>'Item saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Sinhvien1::find($id);
        return response()->json($item);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Sinhvien1::find($id)->delete();
     
       return response()->json(['success'=>'Sinh viên deleted successfully.']);
    }
}