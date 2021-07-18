<!DOCTYPE html>
<html lang="en">
<?php include("../../includes/backend/head.php")  ?>


<?php 
include("../../includes/backend/header.php");
if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']!='1'){
	header('location:news.php');
	die();
}
?>
<div class="container-fluid">
   <!-- DataTables Example -->
<?php
   $query_product = "SELECT name,picture FROM product WHERE id = 7 ";
   $products = mysqli_query($connection,$query_product);
   $product = mysqli_fetch_assoc($products);
   print_r($product);

?>   </div>
<?php include('../../includes/backend/footer.php')?>