<?php
session_start();
include "../Database/env.php";
if(isset($_POST['register'])){

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$enc_password = sha1($password);



$errors = [];
if(empty($first)){

    $errors['first'] = "first name dewa hoini";
}

if(empty($last)){

    $errors['last'] = "last name dewa hoini";
}
if(empty($email)){

    $errors['email'] = "email dewa hoini";
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   
    $errors['email'] = "enter validate Email";
}
if(empty($password)){

    $errors['password'] = "password dewa hoini";
}
if(empty($confirm_password)){
    $errors['confirm_password'] = "confirm_password dewa hoini";

}
elseif($password !== $confirm_password){
    $errors['confirm_password'] = "confirm_password did not match ";


}

if(count($errors) >0 ){
 
    $_SESSION['errors'] = $errors;
    header("location: ../Backend/register.php");

}else {
    $query = "INSERT INTO users( first_name, last_name, email, password) VALUES ('$first','$last','$email','$enc_password')";

$store = mysqli_query($connection,$query);
$_SESSION['Done'] ="WELL DONE YOU HAVE REGISTERED.";
header("location: ../Backend/login.php"); 
}



}





?>