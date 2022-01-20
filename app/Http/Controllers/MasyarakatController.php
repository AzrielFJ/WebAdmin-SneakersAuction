<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
class MasyarakatController extends Controller
{
    public function editProfile(Request $request, $id_masyarakat,$id_user)
    {
            
        Masyarakat::where('id_masyarakat', $id_masyarakat)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'no_telp'=>$request->no_telp
        ]);
          User::where('id_user', $id_user)->update([
            'username' => $request->username,

        ]);
       return response()->json([
                        'status' => true,
                        'message'=> 'Succes'

                    ]);

    }
    public function editPassword(Request $request,$id_user)
    {
        $password = $request->password;
        $password2 = $request->passwordnew;

        $data=User::where('id_user',$id_user)->first();
        if (Hash::check($password,$data->password)) {
             $password2 = bcrypt($password2); 
          User::where('id_user', $id_user)->update([
            'password' => $password2,

        ]);
      return response()->json([
                        'status' => true,
                        'message'=> 'Succes'

                    ]);
        }else{
              return response()->json([
                        'status' => false,
                        'message'=> 'Succes'

                    ]);
        }
       
       

    }
    public function editPassword2(Request $request,$username)
    {
                $password = $request->password;


        
             $password = bcrypt($password); 
             User::where('username', $username)->update([
            'password' => $password,

            ]);
            return response()->json([
                        'status' => true,
                        'message'=> 'Succes'

                    ]);
        
       
       

    }
}
