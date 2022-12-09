<?php
$id =$_GET['id'];
include "../Database/env.php";
$query = "SELECT status FROM benners WHERE id ='$id'";
$store = mysqli_query($connection,$query);
$banner = mysqli_fetch_assoc($store);



if($banner['status'] == 0){

$query = "UPDATE benners SET status='1' WHERE id = '$id'";

}else{

    $query = "UPDATE benners SET status='0' WHERE id ='$id'";
 
}
mysqli_query($connection,$query);

header("location: ../Backend/All_banner.php");