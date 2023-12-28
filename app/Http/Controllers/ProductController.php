<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\CartMasterProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    //

    public function monitoring_product() 
    {
        if(request()->ajax())
        {
            $data = MasterProduct::select(
            'id as product_id',
            'product_code',
            'description',
            DB::raw('DATE_FORMAT(created_at,\'%d-%m-%Y\') as date_create'),
            DB::raw('DATE_FORMAT(updated_at,\'%d-%m-%Y\') as date_update'))
            ->get();

            return datatables()->of($data)->make(true);
        }

        return view('produk.monitoring');
    }

    public function upload_product() 
    {
        $cabang = Branch::all();

        return view('produk.upload',compact('cabang'));
    }

    public function upload_preview(Request $request)
    {
        $tipe_upload = 2;

        if($request->filter_branch_import == 1)
        {
            $tipe_upload = 1;
        }

        $cab = Branch::where('code','=',$request->filter_branch_import)->first();

        $kode_cabang = $cab->code;
        $nama_cabang = $cab->name;

        $file = $request->file('csv_file');
        $file_path = $file->getRealPath();

        $name_path = "upload_csv" . time() . "-" . $file->getClientOriginalName();

        $file_save_path = 'log/upload_product/temp'.$name_path;

        Storage::disk('local')->put($file_save_path, $file);

        if (($open =fopen($file, "r")) !== FALSE) { //fopen dilakukan untuk membuka dan  read file csv
        while (($csv_data = fgetcsv($open, 0, ",")) !== FALSE) { //fgetcsv->Melakukan parsing baris dari sebuah file ke dalam bentuk csv
        $data[] = $csv_data;
            }
            fclose($open);
        }
        
        session([
            'data_csv' => $data,
            'file_save_path' => $file_save_path,
        ]);

        return view('produk.preview_upload',compact('tipe_upload','data','kode_cabang','nama_cabang','tipe_upload'));
    }

    public function upload_process(Request $request)
    {
        $tipe = $request->tipe_upload;
        $code = $request->code_cab;

        $branch = Branch::where('code','=',$code)
        ->first();

        $data = session('data_csv');

        DB::beginTransaction();
        
        try 
        {
            if($tipe == 1)
            {
                $branch_id = null;
            }
            else
            {
                $branch_id = $branch->id;
            }

            $insert_data_product = [];
            $info_error = array();

            foreach($data as $dt)
            {
                $product = MasterProduct::where('product_code','=',$dt[0])->first();
                
                if(empty($product))
                {
                    $list_product_code = "[".$dt[0]."]";
                    array_push($info_error, $list_product_code);
                    continue;
                }
                
                $product_id = $product->id;

                $data_product = [
                    'branch_id' => $branch_id,
                    'status_master_product_id' => $dt[1],
                    'master_product_id' => $product_id,
                    'price' => $dt[2],
                    'min_order' => $dt[3],
                    'min_qty' => $dt[4],
                    'max_qty' => $dt[5],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $insert_data_product[] = $data_product;
            }

            if(count($info_error) > 1)
            {
                $data_product_code = implode("\n",$info_error);

                return redirect('/product/edit/')->with('error','Gagal Upload : Product Code '.$data_product_code .' tidak ditemukan! Silahkan cek kembali CSV anda!');
            }

            BranchProduct::insert($insert_data_product);

            DB::commit();

            return redirect('/product/edit/')->with('success','Data produk cabang '. $branch->name .' berhasil di upload!');
        }
        catch(Exception $e)
        {
            DB::rollback();
            
            return redirect('/product/edit/')->with('error','Kesalahan pada server: ' . $e);
        }
    }

    public function edit_product(Request $request)
    {
        $filter_branch = $request->filter_branch;

        $btn_update = 0;

        if(request()->ajax())
        {
            $branch = Branch::where('code','=',$filter_branch)->first();

            if(!empty($filter_branch))
            {
                $data = BranchProduct::join('master_products','master_products.id','=','branch_products.master_product_id')
                ->leftjoin('cart_master_products', function($join) {
                    $join->on('cart_master_products.master_product_id','=','branch_products.master_product_id');
                    $join->on('cart_master_products.branch_id','=','branch_products.branch_id');
                })
                ->select('master_products.product_code',
                'master_products.description',
                'branch_products.id as id',
                'branch_products.price',
                'branch_products.min_order',
                'branch_products.min_qty',
                'branch_products.max_qty',
                'branch_products.status_master_product_id as status',
                'cart_master_products.id as flag')
                ->where('branch_products.branch_id','=',$branch->id)
                ->get();
            }
            else
            {
                $data = BranchProduct::join('master_products','master_products.id','=','branch_products.master_product_id')
                ->leftjoin('cart_master_products', function($join) {
                    $join->on('cart_master_products.master_product_id','=','branch_products.master_product_id');
                    $join->on('cart_master_products.branch_id','=','branch_products.branch_id');
                })
                ->select('master_products.product_code',
                'master_products.description',
                'branch_products.id as id',
                'branch_products.price',
                'branch_products.min_order',
                'branch_products.min_qty',
                'branch_products.max_qty',
                'branch_products.status_master_product_id as status',
                'cart_master_products.id as flag')
                ->where('branch_products.branch_id','=',0)
                ->limit(0)
                ->get();
            }

            return datatables()->of($data)->make(true);
        }

        $cabang = Branch::all();

        return view('produk.edit',compact('cabang','btn_update'));
    }

    public function change_product(Request $request)
    {
        DB::beginTransaction();

        try {
            $branch_code = $request->filter_branch;

            $id = $request->input('master_id');
            $price = $request->input('price');
            $order = $request->input('order');
            $min = $request->input('min');
            $max = $request->input('max');
            $status = $request->input('status');

            $branch = Branch::where('code','=',$branch_code)
            ->first();

            CartMasterProduct::insert([
                'branch_id' => $branch->id,
                'status_master_product_id' => $status,
                'master_product_id' => $master_id,
                'price' => $price,
                'min_order' => $order,
                'min_qty' => $min,
                'max_qty' => $max
            ]);

            DB::commit();

            return response()->json(['status'=>1, 'message'=>'Success']);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response()->json(['status'=>0, 'message'=>'[ERROR]'.$e->getMessage()]);
        }
    }

    public function cancel_change_product(Request $request)
    {
        DB::beginTransaction();

        try {
            $branch_code = $request->filter_branch;

            $id = $request->input('master_id');
            $price = $request->input('price');
            $order = $request->input('order');
            $min = $request->input('min');
            $max = $request->input('max');
            $status = $request->input('status');



            DB::commit();

            return response()->json(['status'=>1, 'message'=>'Success']);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response()->json(['status'=>0, 'message'=>'[ERROR]'.$e->getMessage()]);
        }
    }

    public function submit_change_product(Request $request)
    {

    }
}
