<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            background:#ffffff;
            font-family:poppins;
            
        }
        .kotak{
            background:#BA1414;
            width:50%;
            height:100vh;
            position:absolute;
            border:none;
        }
        .kotak-login{
            width:80%;
            height:100%;
            background:#BA1414;
            position:absolute;
            margin-left:10%;
       
            border-radius:20px;
        }
        .kotak-login-kiri{
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            width:50%;
            height:100%;
            background:#E8EBEE;
        }
        #gambar{
            position:absolute;
            width:70px;
            height:70px;

            margin-left:21%;
            margin-top:2%;
            border-radius:100%;
        }
        #username{
            font-family:poppins;
            position:absolute;
            padding-top:12%;
            padding-left:3%;
             color: #BA1414;
            
        }
          #username2{
            font-family:poppins;
            position:absolute;
            padding-top:15%;
            padding-left:3%;
             color: #BA1414;
            
        }
        #usernameinput::-webkit-input-placeholder{
            font-size:9pt;
            padding-left:2%;
        }
        #passwordinput::-webkit-input-placeholder{
            font-size:9pt;
            padding-left:2%;
        }
         #passwordinputv::-webkit-input-placeholder{
            font-size:9pt;
            padding-left:2%;
        }
         #nama_petugasinput::-webkit-input-placeholder{
            font-size:9pt;
            padding-left:2%;
        }
        #usernameinput{
            margin-top:36%;
            width:85%;
            height:35px;
            margin-left:6%;
            border:none;
            border-radius:5px;
        }
        #password{
            font-family:poppins;
            position:absolute;
            padding-top:22%;
            margin-left:-42.5%;
            color: #BA1414;
        }
         #passwordv{
            font-family:poppins;
            position:absolute;
            padding-top:10%;
            margin-left:-42.5%;
            color: #BA1414;
        }
          #passwordv2{
            font-family:poppins;
            position:absolute;
            padding-top:5%;
            margin-top: 7%;
            margin-left:-42.5%;
            color: #BA1414;
        }
        #password2{
            font-family:poppins;
            position:absolute;
            padding-top:25%;
            margin-left:-42.5%;
            color: #BA1414;
        }
        #passwordinput{
            margin-top:12%;
            width:85%;
            height:35px;
            margin-left:6%;
            border:none;
            border-radius:5px;
        }
         #passwordinputv{
            margin-top:11%;
            width:85%;
            height:35px;
            margin-left:6%;
            border:none;
            border-radius:5px;
        }
        #nama_petugas{
            font-family:poppins;
            position:absolute;
            padding-top:9%;
            margin-left:-42.5%;
            color: #BA1414;
        }
        #nama_petugas2{
            font-family:poppins;
            position:absolute;
            padding-top:11%;
            margin-left:-42.5%;
            color: #BA1414;
        }
        #nama_petugasinput{
            margin-top:10%;
            width:85%;
            height:35px;
            margin-left:6%;
            border:none;
            border-radius:5px;
        }
        #login{
            margin-top:5%;
            width:85%;
            height:28px;
            margin-left:6%;
            border:none;
            background:#BA1414;
            color:white;
        }
        #register{
  
            margin-top:5%;
            width:85%;
            height:28px;
            margin-left:6%;
            border:none;
            background:#BA1414;
            color:white;

        }
        #h1{
            font-family:poppins;
            color:white;
            position:absolute;
            margin-left:55%;
            margin-top:23%;
        }
        #dah{
            font-family:poppins;
            color:white;
            position:absolute;
            margin-left:55%;
            margin-top:30%;
        }
        #unt{
            font-family:poppins;
            color:white;
            position:absolute;
            margin-left:55%;
            margin-top:40%;
        }
    </style>
</head>
<body>
    <div class="kotak"></div>
    
        
    @if(session('message'))
        <div class="alert alert-danger" style="color: #ffffff ; background-color: #888888; border-color:#888888" >            
            {{session('message')}}
        </div>
        @endIf
    <div class="kotak-login">
        <div class="kotak-login-kiri">
                <img id="gambar" src="{{ ('img/logo.jpg') }}" >
                <h1 id="h1">Register as Admin</h1>
                <h6 id="unt">To be Able to Access The Dashboard</h6>
                <form action="/registeradmin" method="post">
                    @csrf
                    <label id="username"> Username</label>
                     <span id="username2" class="error"><?php echo $errors->first('username') ?></span>
                    <input type="text" id="usernameinput" name="username" placeholder="Enter Username...">
                       
                    <label id="password">Password</label>
                    <span  id="password2" class="error"><?php echo $errors->first('password') ?></span> 
                    <input type="password" id="passwordinput" name="password" placeholder="Enter Password..."> 
                     <label id="passwordv">Confrim Password</label>
                    <span id="passwordv2" class="error"><?php echo $errors->first('password_confirmation') ?></span>
                   
                     <input type="password" id="passwordinputv" name="password_confirmation" placeholder="Enter Confrim Password..."> 
                    <label id="nama_petugas">Officer Name</label>
                    <span id="nama_petugas2" class="error"><?php echo $errors->first('name officer') ?></span>
                    <input type="text" id="nama_petugasinput" name="name_officer" placeholder="Enter Officer Name..."> 
           

                    <input type="submit" value="Register" id="register">
                   

                </form>
            
                   <a class="btn btn-sm btn-danger" id="login" style="text-align: center;"  href="/loginadmin" >Login</a>
         
        </div>
     
    </div>
</body>
</html>
