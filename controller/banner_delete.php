<?php
$id = $_GET['id'];
include "../Database/env.php";
$query = "SELECT banner_img FROM benners WHERE id = '$id'";
$store = mysqli_query($connection,$query);
$banner = mysqli_fetch_assoc($store);
$path = "../uploads/banners/" . $banner['banner_img'];


if (file_exists($path)){

unlink($path);

}
$Query = "DELETE FROM benners WHERE id ='$id'";
$Store = mysqli_query($connection,$Query);

if($Store){


    header("location: ../Backend/All_banner.php");
}
