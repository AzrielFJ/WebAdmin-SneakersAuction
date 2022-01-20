<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
Use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Models\User;
use Validator;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{
     public function registerMasyarakat(Request $request){
    
        $input['username'] = $request->username;
        $input['password'] = $request->password;
        $data=array(
       'username' => 'required|unique:users,username',
        'password' => 'required',

    );
        $validator = Validator::make($input,$data);
        if($validator ->fails()) {
            return response()->json([
                'status'=>false,
                'message' => 'Username Telah Terdaftar',

        ]); 
        }

        else {
  		$user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role_id =3;
        $user['password'] = bcrypt($user['password']); 
        $user->save();
        $id = $user->id;
        $input2['no_telp'] = $request->no_telp;
        $input2['alamat'] = $request->alamat;
        $input2['nama_lengkap'] =$request->nama_lengkap;
        $input2['user_id'] = $id;
        $masyarakat = Masyarakat::create($input2);
        $getdata=DB::table('azriel_masyarakats')->join('users', 'azriel_masyarakats.user_id', 'users.id_user')
                                            ->join('role', 'users.role_id', 'role.id_role')
                                            ->select('azriel_masyarakats.*', 'users.role_id', 'users.username', 'role.role')
                                            ->where('users.id_user', '=', $id)
                                            ->get();
        foreach ($getdata as $key) {
                
        }
		return response()->json([
                'status'=>true,
                'message' => 'Register Berhasil',
                'data' => $key,
        ]); 
        }
    
    }
 	// public function registerAdmin(Request $request){
    
  //       $input['username'] = $request->username;
  //       $input['password'] = $request->password;
     
  //       $data=array(
  //       'username' => 'required|unique:users,username',
  //       'password' => 'required',
  

  //   );
  //       $validator = Validator::make($input,$data);
      
  //       if($validator ->fails()) {
  //           return response()->json([
  //               'status'=>false,
  //               'message' => 'Data Anda Telah Terdaftar',
  //       ]); 
  //       }
  //       else {
  // 		$user = new User;
  //       $user->username = $request->username;
  //       $user->password = $request->password;
  //       $user->role_id =1;
  //       $user['password'] = bcrypt($user['password']); 
  //       $user->save();
  //       $id = $user->id;
  //  		$input2['nama_petugas'] =$request->nama_petugas;
  //  		$input2['user_id'] = $id;
  //       $petugas = Petugas::create($input2);
		// return response()->json([
  //               'status'=>true,
  //               'message' => 'Register Berhasil',
  //       ]); 
  //       }
  //   }
    public function registerPetugas(Request $request){
    
         $input['username'] = $request->username;
        $input['password'] = $request->password;
        $data=array(
       'username' => 'required|unique:users,username',
        'password' => 'required',

    );
        $validator = Validator::make($input,$data);
        if($validator ->fails()) {
            return response()->json([
                'status'=>false,
                'message' => 'Username Telah Terdaftar',

        ]); 
        
       
        }
        else{
  		$user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role_id= $request->role_id;
        $user['password'] = bcrypt($user['password']); 
        $user->save();
        $id = $user->id;
  		$input2['nama_petugas'] =$request->nama_petugas;
   		$input2['user_id'] = $id;
        $petugas = Petugas::create($input2);
        
		return response()->json([
                'status'=>true,
                'message' => 'Register Berhasil',
        ]); 
        }
    
    }
     public function registerWeb(Request $request){
    
         $input['username'] = $request->username;
        $input['password'] = $request->password;
        $input['password_confirmation']=$request->password_confirmation;
        $input['name officer']=$request->name_officer;
        $data=array(
       'username' => 'required|min:5|unique:users,username',
        'password' => 'required|min:8',
         "password_confirmation" => "same:password",
         "name officer"=>"required"

    );
        $validator = Validator::make($input,$data);
        if($validator ->fails()) {
          return redirect('registeradmin')
            ->withErrors($validator)
            ->withInput();
      
        }
        else{
      $user = new User;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role_id= 1;
        $user['password'] = bcrypt($user['password']); 
        $user->save();
        $id = $user->id;
      $input2['nama_petugas'] =$request->name_officer;
      $input2['user_id'] = $id;
        $petugas = Petugas::create($input2);
        
      return redirect('/admin/adminhome')->with('message', "Registration is Successful");
    }
    }

}
   