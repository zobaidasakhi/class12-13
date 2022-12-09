<?php
session_start();
include '../Database/env.php';


if(isset($_POST['submit'])){
   $email =$_POST['email'];
   $password =$_POST['password'];
$enc_password = sha1($password);
$errors = [];
 
if(empty($email)){
    $errors['email'] = 'Email dewa hoi nai';
}
if(empty($password)){
    $errors['password'] = 'Password dewa hoi nai';
}
if( count($errors) > 0){
$_SESSION['errors'] = $errors;
header("Location: ../Backend/login.php");
} else{

$query = "SELECT * FROM users WHERE email = '$email'";
$store = mysqli_query($connection, $query);

if(mysqli_num_rows($store) > 0){

    $query = "SELECT * FROM users WHERE  email = '$email' AND password ='$enc_password'";
$store = mysqli_query($connection,$query);

   if(mysqli_num_rows($store) > 0) {
   
$user = mysqli_fetch_assoc($store);
$_SESSION['user'] = $user;
header("Location:../Backend/Dashboard.php");
   }else {

    $_SESSION['errors']['password'] = 'Apner password bhulhoyeche';
    header("Location:../Backend/login.php");
    
   }
}
else{
   $_SESSION['errors']['email'] = 'Not found email address!';
header("Location:../Backend/login.php");

}
}

}
