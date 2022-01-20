<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Petugas;

use App\Models\User;
class PetugasController extends Controller
{
    public function getPetugas($id_petugas){
    	  $getdata=DB::table('users')->join('azriel_petugass', 'users.id_user', 'azriel_petugass.user_id')
    	  							->join('role', 'users.role_id', 'role.id_role')
                                            ->select('azriel_petugass.*', 'users.role_id',  'role.role')
                                            ->where('users.role_id', '!=', '3' )
                                            ->whereNotIn('azriel_petugass.id_petugas',[$id_petugas])
                                            ->get();

           			return response()->json([
                        'status' => true,
                        'data'=> $getdata

                    ]);
    }
     public function deletePetugas($id_petugas)
    {
        $petugas = User::where('id_user',$id_petugas)->forceDelete();
        return response()->json(['status' => true]);
    }

    
}
