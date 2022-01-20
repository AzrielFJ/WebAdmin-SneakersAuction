<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;	
use App\Models\Foto;  
class BarangController extends Controller
{
     public function addBarang(Request $request)
    {
       
        $input['nama_barang'] =$request->nama_barang;
        $input['tanggal'] =$request->tanggal;
        $input['harga_awal'] =$request->harga_awal;
        $input['deskripsi_barang'] =$request->deskripsi;
        $input['foto'] = $request->foto;
        $input['status'] ="tersedia";
        $petugas = Barang::create($input);      
    
       return response()->json([
                        'status' => true,
                        'data'=>$petugas
                    ]);
    }

    public function listBarang($status){
    	$barang=Barang::where('status',$status)->get();
    	 return response()->json([
                        'status' => true,
                        'data'=> $barang

                    ]);
    }
      public function deleteBarang($id_barang)
    {
        $petugas = Barang::where('id_barang',$id_barang)->forceDelete();
        return response()->json(['status' => true]);
    }


      public function addFotoBarang(Request $request)
    {
         $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
    
        $imageName = $request->image->getClientOriginalName();  
     
        $request->image->move(public_path('images'), $imageName);
        // $input['foto'] = $imageName;
        // $input['barang_id'] =$id_barang;
        // Foto::create($input);
    
         return response()->json([
                        'status' => true,
                    
                    ]);


     }
       public function addFotoBarang2(Request $request,$id_barang)
    {
         $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
    
        $imageName = $request->image->getClientOriginalName();  
     
        $request->image->move(public_path('images'), $imageName);
        $input['foto'] = $imageName;
        $input['barang_id'] =$id_barang;
        Foto::create($input);
    
         return response()->json([
                        'status' => true,
                    
                    ]);


     }
       public function editBarang(Request $request, $id_barang)
    {
            
        Barang::where('id_barang', $id_barang)->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'harga_awal'=>$request->harga_awal
        ]);
      
       return response()->json([
                        'status' => true,
                        'message'=> 'Succes'

                    ]);

    }
    public function getFoto($id_barang){
    $foto=Foto::where('barang_id',$id_barang)->get();
      return response()->json([
                        'status' => true,
                        'data'=> $foto

                    ]);
     
 }


}

