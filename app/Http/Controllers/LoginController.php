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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
 public function logInMasyarakat(Request $request){
        
            $username =$request->username;
            $password=$request->password;

            $data=User::where('username',$username)->first();
            if($data){
                  $role_id=$data->role_id;

                if(Hash::check($password,$data->password)){
                    if ($role_id==3) {
                        $getdata=DB::table('azriel_masyarakats')->join('users', 'azriel_masyarakats.user_id', 'users.id_user')
                                            ->join('role', 'users.role_id', 'role.id_role')
                                            ->select('azriel_masyarakats.*', 'users.role_id', 'users.username', 'role.role')
                                            ->where('users.id_user', '=', $data->id_user)
                                            ->get();
                    }
                   else{ 
                     $getdata=DB::table('azriel_petugass')->join('users', 'azriel_petugass.user_id', 'users.id_user')
                                            ->join('role', 'users.role_id', 'role.id_role')
                                            ->select('azriel_petugass.*', 'users.role_id', 'users.username', 'role.role')
                                            ->where('users.id_user', '=', $data->id_user)
                                            ->get();
                   
                    }
                	// $getdata = User::with(['azriel_masyarakats'])->where('id_user', $data->id_user)->get();
                	foreach ($getdata as $key) {
                
                	}
                    return response()->json([
                        'status' => true,
                        'msg'=>'Login Berhasil',
                        'data'=> $key

                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'msg'=>'Password salah',
                        
             
                    ]);
                }
            }
        else{
            return response()->json([
                'status' => 'daftar',
                'msg'=>'Akun Belum terdaftar',
               
            ]);
        }

    }
     public function logInPetugas(Request $request){
        
            $username =$request->username;
            $password=$request->password;

            $data=User::where('username',$username)->first();
           
            if($data){
                if(Hash::check($password,$data->password)){
                	 $getdata=DB::table('azriel_petugass')->join('users', 'azriel_petugass.user_id', 'users.id_user')
                                            ->join('role', 'users.role_id', 'role.id_role')
                                            ->select('azriel_petugass.*', 'users.role_id', 'role.role')
                                            ->where('users.id_user', '=', $data->id_user)
                                            ->get();
                	// $getdata = User::with(['azriel_masyarakats'])->where('id_user', $data->id_user)->get();
                	foreach ($getdata as $key) {
                
                	}
                    return response()->json([
                        'status' => true,
                        'msg'=>'Login Berhasil',
                        'data'=> $key

                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'msg'=>'Login Gagal',
                        
             
                    ]);
                }
            }
        else{
            return response()->json([
                'status' => true,
                'msg'=>'Akun Belum terdaftar',
               
            ]);
        }

    }
  public function index()
    {
       
        return view('login\loginadmin');
    }
     public function registeradmin()
    {
       
        return view('login\loginadmin');
    }
    public function logInWeb(Request $request){
       $input['username'] = $request->username;
        $input['password'] = $request->password;
        $data=array(
       'username' => 'required',
        'password' => 'required',

    );
    $validator = Validator::make($input,$data);
        if($validator ->fails()) {
          return redirect('loginadmin')
            ->withErrors($validator)
            ->withInput();
      
        }else{
            $data=User::where('username',$input['username'])->first();
            if($data){
                  $role_id=$data->role_id;

                if(Hash::check($input['password'],$data->password)){
                 
                     $getdata=DB::table('azriel_petugass')->join('users', 'azriel_petugass.user_id', 'users.id_user')
                                            ->join('role', 'users.role_id', 'role.id_role')
                                            ->select('azriel_petugass.*', 'users.role_id', 'users.username', 'role.role')
                                            ->where('users.id_user', '=', $data->id_user)
                                            ->get();
                   
                    // $getdata = User::with(['azriel_masyarakats'])->where('id_user', $data->id_user)->get();
            
                    if ($role_id==3) {
                       return redirect('loginadmin')->with('message', "Kamu tidak punya akses untuk masuk!");
                    }
                    else{
                        
                   return redirect('admin/adminhome');
                }
                }else{
                    return redirect('loginadmin')->with('message', "Wrong Password");
                }
            }
        else{
           return redirect('loginadmin')->with('message', "Account has not been Registered");
        }
}
    }
        public function sms($code){
            $six_digit_random_number = mt_rand(100000, 999999);
            $basic  = new \Vonage\Client\Credentials\Basic("ed2d5a25", "dC0W2Bxo2HbNwNdW");
                $client = new \Vonage\Client($basic);
                $response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("6281902014316", BRAND_NAME, 'Code Verification : '.$code)
);

$message = $response->current();

if ($message->getStatus() == 0) {
     return response()->json([
                'status' => true,
                'msg'=>'The message was sent successfully',
               
            ]);
} else {
     return response()->json([
                'status' => false,
                'msg'=>'The message was sent successfully',
               
            ]);
}
        }
    
    public function logout(Request $request) {
  Auth::logout();
  return redirect('/loginadmin');
}

}
