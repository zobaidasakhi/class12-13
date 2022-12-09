<?php
session_start();
include "../Database/env.php";
if (isset($_POST['submit'])){

$request = $_POST;


$title = $request['title'];
$detail = $request['detail'];
$video = $request['video'];
$banner_img = $_FILES['banner_img'];
$extension = pathinfo($banner_img['name'])['extension'];
$accepted_extension = ['jpg' , 'png','webp','jepg','svg'];


$errors =[];
if(empty($title)){
$errors['title'] = "Banner title din";

}

if(empty($detail)){
    $errors['detail'] = "Banner detail din";
    
    }
    if(empty($video))
    {
        $errors['video'] = "Banner video din";
        
        }
if($banner_img['size'] ==  0)
{
$errors['banner_img'] =  "Insert a Banner Image";

}
else if(in_array($extension , $accepted_extension) == false)
{
$errors['benner_img'] = "Insert a Proper Image Format";


}



    if (count($errors) >0 )
    {
$_SESSION['errors'] = $errors;
header("location: ../Backend/add_banner.php");

    }else {

    $new_image_name = 'Banner-' . uniqid() . '.' . $extension;
   $upload =  move_uploaded_file($banner_img['tmp_name'],"../uploads/banners/$new_image_name");
    
   if($upload){
$query = " INSERT INTO benners( banner_img, title, detail, video ) VALUES ('$new_image_name','$title','$detail','$video')";

$data = mysqli_query($connection,$query);
if($data){

    header("location:../Backend/add_banner.php"); 
}


}

}


        
}      


    





