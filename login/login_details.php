<?php

  session_start();
  include '../libraries/essentials.php';


function check_passwordu($user_name,$password)
{
    
  $con = getCon();
    
  $user = $con->query("select * from user where user_name='$user_name';");
  $res = $user->fetch_assoc();
  
  echo var_dump($res)."<br>";
  
  $password_hash=$res['password'];
    
  if(password_verify($password,$password_hash)){
    echo "password verified<br>";
    return True;
  }
  else{
    echo "password not verified<br>";
    return False;
  }
}



//checking if user credentials
if(isset($_POST['login_user']))
{
   $user_name = $_POST['user_name'];
  $password = $_POST['password'];

if(rowExists('user','user_name',$user_name)){
    if(check_passwordu($user_name,$password)){
        //echo "Yes";
        
        $_SESSION['user_name']=$user_name;
        header("Location:../index.php");
        die();
    }
    else{
      $wrongpassword=true;
     header("Location:login.php?wrongpassword=".$wrongpassword);
        echo "no2 [password wrong]";
    }
}
else{
    header("Location:../register/register.php");
    die();
}
}
