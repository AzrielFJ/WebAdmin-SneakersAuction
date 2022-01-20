<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
            width:55%;
            height:80%;
            background:#BA1414;
            position:absolute;
            margin-left:22.5%;
            margin-top:5%;
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
            margin-top:9%;
            border-radius:100%;
        }
        #username{
            font-family:poppins;
            position:absolute;
            padding-top:23%;
            padding-left:3%;
             color: #BA1414;
            
        }
          #username2{
            font-family:poppins;
            position:absolute;
            padding-top:26%;
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
        #usernameinput{
            margin-top:60%;
            width:85%;
            height:35px;
            margin-left:6%;
            border:none;
            border-radius:5px;
        }
        #password{
            font-family:poppins;
            position:absolute;
            padding-top:40%;
            margin-left:-42.5%;
            color: #BA1414;
        }
         #password2{
            font-family:poppins;
            position:absolute;
            padding-top:43%;
            margin-left:-42.5%;
            color: #BA1414;
        }
        #passwordinput{
            margin-top:23%;
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
                <h1 id="h1">Login First</h1>
                <h6 id="unt">To be Able to Access The Dashboard</h6>
                <form action="/loginadmin" method="post">
                    @csrf
                    <label id="username">Username</label>
                      <span id="username2" class="error"><?php echo $errors->first('username') ?></span>
                    <input type="text" id="usernameinput" name="username" placeholder="Enter Username...">
                    <span  id="password2" class="error"><?php echo $errors->first('password') ?></span> 
                    <label id="password">Password</label>
                    <input type="password" id="passwordinput" name="password" placeholder="Enter Password..."> 

                    <input type="submit" value="Login" id="login">
                   

                </form>
            
                   <a class="btn btn-sm btn-danger" id="register" style="text-align: center;"  href="/registeradmin" >Register</a>
         
        </div>
     
    </div>
</body>
</html>
