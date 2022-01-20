<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\HistoryLelang;
Use Carbon\Carbon;
use PDF;
use App\Models\Masyarakat;
class LelangController extends Controller
{
    public function bukaLelang($id_petugas,$id_barang,Request $request)
    {
       
        $input['petugas_id'] =$id_petugas;
        $input['barang_id'] =$id_barang;
        $input['tanggal_dibuka'] =$request->tanggal_dibuka;
        $input['tanggal_ditutup'] =$request->tanggal_ditutup;
        $input['status'] ="dibuka";
        $data=Lelang::where('barang_id',$id_barang)->first();
       
        if ($data==null) {
           if ($input['tanggal_ditutup'] > $input['tanggal_dibuka']) {
           $lelang = Lelang::create($input);
          return response()->json([
                        'status' => true,
                      

                    ]);
        }else{
          
          return response()->json([
                        'status' => 'date',
                      

                    ]);
        }
        	  
        }else{
        	  return response()->json([
                        'status' => false,
                      	'message'=> 'data telah ada'

                    ]); 
        }
   
    
       return response()->json([
                        'status' => true,

                    ]);
    }
    public function listLelang(Request $request,$status){

  $id_user = $request->id_user;  
  $role_id=$request->id_role;
   
  
    if ($status=='dibuka') {
     $mytime = Carbon::now()->toDateTimeString();
   $mytime2 = Carbon::now()->toTimeString();
    	$getdata=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas')
                                        ->where('azriel_lelangs.status', '=', $status)
                                        ->where('azriel_lelangs.tanggal_ditutup', '>', $mytime)
                            
                                        ->get();
    }if($status=='dibuka2'){
    	 $getdata=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')

                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas')
                                        ->where('azriel_lelangs.status', '=', 'dibuka')
                                        ->get();
    }

    if($status=='ditutup'){
      if ($role_id==2) {
       $getdata=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->join('azriel_masyarakats', 'azriel_lelangs.user_id', 'azriel_masyarakats.user_id')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas','azriel_masyarakats.*')
                                        ->where('azriel_lelangs.status', '=', $status)
                                        ->get();
                                    }
      else{
         $getdata=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->join('azriel_masyarakats', 'azriel_lelangs.user_id', 'azriel_masyarakats.user_id')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas','azriel_masyarakats.*')
                                        ->where('azriel_lelangs.status', '=', $status)
                                        ->where('azriel_lelangs.user_id', '=', $id_user)
                                        ->get();
      }
      }
   
                                  

         if (count($getdata) <= 0) {
         		return response()->json([
                        'status' => false,
                     	'message'=> $getdata

                    ]);
         }else{
	return response()->json([
                        'status' => true,
                     	'data'=> $getdata
                   
                    ]);
         }
    
   }
		public function penawarTertinggi($id_lelang){
				$data=HistoryLelang::orderBy('penawaran_harga', 'desc')->where('lelang_id',$id_lelang)
				->first();
				if ($data==null) {
					return response()->json([
                        'status' => false,
 

                    ]);

				}else{
					return response()->json([
                        'status' => true,
                     	'data'=> $data

                    ]);
				}
		}

   public function bidLelang($id_lelang,$id_barang,$id_user,Request $request){
   		$input = array(
            'lelang_id'=> $id_lelang,
            'barang_id'=> $id_barang,
            'user_id' =>  $id_user,
            'penawaran_harga' => $request->harga
           );
  		$data=DB::table('history_lelangs')
  		->where('user_id',$id_user)
  		->where('lelang_id',$id_lelang)
  		->first();
     
        if($data==null){
        	$bid=HistoryLelang::create($input);
        	return response()->json([
                        'status' => true,
                     	'data'=> $bidLelang

                    ]);
         }	
        
        else{
		$update=DB::table('history_lelangs')
  		->where('user_id',$id_user)
  		->where('lelang_id',$id_lelang)
  		->update([
            'penawaran_harga' => $request->harga
        ]);
        	return response()->json([
                        'status' => true,
                     	'data'=>'succes'


                    ]);
         }
        }
	public function penawar($id_lelang){
				// $data=HistoryLelang::orderBy('penawaran_harga', 'desc')->where('lelang_id',$id_lelang)
				// ->get();

		$data=DB::table('history_lelangs')->join('users', 'history_lelangs.user_id', 'users.id_user')
										 ->join('azriel_masyarakats', 'users.id_user', 'azriel_masyarakats.user_id')
										 ->select('history_lelangs.*', 'users.id_user', 'azriel_masyarakats.*')
										 ->where('history_lelangs.lelang_id', $id_lelang)
										 ->orderBy('history_lelangs.penawaran_harga', 'desc')
										 ->take(3)
										 ->get();
									
				if (count($data) <= 0) {
					return response()->json([
                        'status' => false,
 

                    ]);

				}else{
					return response()->json([
                        'status' => true,
                     	'data'=> $data

                    ]);
				}
		}
		public function tutupLelang($id_lelang){
			$data=HistoryLelang::orderBy('penawaran_harga', 'desc')->where('lelang_id',$id_lelang)

				->first();
				if ($data==null) {
					$lelang=Lelang::where('id_lelang',$id_lelang)->forceDelete();
					return response()->json([
                        'status' => true
                  
                    ]);
				}else{
					$update= Lelang::where('id_lelang', $id_lelang)->update([
            		'status' => 'ditutup',
            		'user_id' => $data->user_id,
            		'harga_akhir'=>$data->penawaran_harga
        			]);
          $update= Barang::where('id_barang', $data->barang_id)->update([
                'status' => 'terjual'
              ]);

          $sms=Barang::where('id_barang',$data->barang_id)->first();
           
            $basic  = new \Vonage\Client\Credentials\Basic("ed2d5a25", "dC0W2Bxo2HbNwNdW");
                $client = new \Vonage\Client($basic);
                $response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("6281902014316", 'SNEAKERS AUCTION', 'Congratulations You Won the Auction '.$sms->nama_barang)
);

    $message = $response->current();

    if ($message->getStatus() == 0) {
            return response()->json([
                        'status' => true
                    ]);
        }
    } 



		}


public function listlelangweb(){

    // $tampung = [];
  
    $data=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->join('azriel_masyarakats', 'azriel_lelangs.user_id', 'azriel_masyarakats.user_id')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas','azriel_masyarakats.*')
                                        ->where('azriel_lelangs.status', '=', 'ditutup')
                                        ->get();
                                  

      
        return view('admin.admin', ['data'=>$data]);
         
    
   }
    
public function cetak_pdf($daterange)
    {
     $date = explode('+', $daterange);
      $date2 = explode('+', $daterange);
      $datenow = Carbon::now()->toDateString();
    $start = Carbon::parse($date[0])->format('y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('y-m-d') . ' 23:59:59';
    $start2 = $date2[0];
    $end2 =$date2[1];
    $data=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->join('azriel_masyarakats', 'azriel_lelangs.user_id', 'azriel_masyarakats.user_id')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas','azriel_masyarakats.*')
                                        ->where('azriel_lelangs.status', '=', 'ditutup')
                                        ->whereBetween('azriel_lelangs.tanggal_ditutup', [$start, $end])
                                        ->get();
    if (count($data)<=0) {
      $sum='0';
    }else {
      $sum=Lelang::where('status', 'ditutup')->sum('harga_akhir');    
    }
    
    $pdf = PDF::loadView('admin.admin_pdf',  ['data'=>$data, 'from'=>$start2, 'date2'=>$end2,'sum'=>$sum, 'datenow'=>$datenow]);
    //GENERATE PDF-NYA
    return $pdf->stream();
  // return view('admin.admin_pdf', );
    }


 public function barang($id_user){

    // $tampung = [];
    
  
      $getdata=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas')
                                        ->where('azriel_lelangs.user_id', '=', $id_user)
                                        ->get();


        if (count($getdata) <= 0) {
          return response()->json([
                        'status' => false,
 

                    ]);

        }else{
          return response()->json([
                        'status' => true,
                      'data'=> $getdata

                    ]);
   }	

}
public function orderReport()
{
    
    $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
$date = explode(' - ' ,request()->date);
    if (request()->date != '') {
    
        $date = explode(' - ' ,request()->date);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
    }

   
        $data=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->join('azriel_masyarakats', 'azriel_lelangs.user_id', 'azriel_masyarakats.user_id')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas','azriel_masyarakats.*')
                                        ->where('azriel_lelangs.status', '=', 'ditutup')
                                        ->whereBetween('azriel_lelangs.tanggal_ditutup', [$start, $end])->get();
   
    return view('admin.admin',['data'=>$data,'date'=>$date]);
}
public function orderReport2(Request $request)
{
   
    $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
    
    $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

  
    if ($request->date != '') {
       
        $date = explode(' - ' ,request()->date);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
    }

   
        $data=DB::table('azriel_lelangs')->join('azriel_barangs', 'azriel_lelangs.barang_id', 'azriel_barangs.id_barang')
                                        ->join('azriel_petugass', 'azriel_lelangs.petugas_id', 'azriel_petugass.id_petugas')
                                        ->join('azriel_masyarakats', 'azriel_lelangs.user_id', 'azriel_masyarakats.user_id')
                                        ->select('azriel_lelangs.id_lelang','azriel_lelangs.tanggal_dibuka','azriel_lelangs.tanggal_ditutup','azriel_lelangs.user_id','azriel_lelangs.harga_akhir', 'azriel_barangs.*', 'azriel_petugass.id_petugas','azriel_petugass.nama_petugas','azriel_masyarakats.*')
                                        ->where('azriel_lelangs.status', '=', 'ditutup')
                                        ->whereBetween('azriel_lelangs.tanggal_ditutup', [$start, $end])->get();
   
    return view('admin.admin', compact('data'));
}
    


}