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
   <div class="card mb-3">
<?php
if(isset($_GET["id"])){
 $query_product = "SELECT * FROM `product` WHERE id =".$_GET['id']."";
 $products = mysqli_query($connection,$query_product);
 $product = mysqli_fetch_assoc($products);
 
 $p_name=$product['name'];
 $p_price=$product['price'];
 $p_des=$product['Description'];
 $p_pic=$product['picture'];
}
?>






<form action="/config/actions.php"  method="post" enctype="multipart/form-data" >
    <input value=" <?php if(isset($_GET["id"])){echo $_GET['id'] ; }?> "type="hidden" name="prodid">
    <label for="lname">Product Name</label><br>
        <input type="text" value="<?php if(isset($_GET["id"])){echo $p_name ; }?>" id="pordname" name="prodname"><br><br>
   <label for="lname">Price (1kg)</label><br>
        <input type="number" value="<?php if(isset($_GET["id"])){ echo $p_price ; }?>" id="pordname" name="prodprice"><br><br>
    <label>Description</label><br>
    <textarea  value="<?php if(isset($_GET["id"])){ echo $p_des ; }?>" id="Description"  name="description" style="margin-top: 0px;margin-bottom: 0px;width: 50%;height: 106px;  "><?php if(isset($_GET["id"])){echo $p_des ;}?></textarea><br><br>
    <input type='file'  name="fileToUpload"  id="fileToUpload">  <br>


     <!-- submit button -->
    <input type="submit" id="SavEdit" value="Save Product" name="<?php if(isset($_GET["new"])){echo "SaveProd";}else{echo "EditProd";} ?>">' <br>
</form>
    <?php if(!isset($_GET["new"])){ ?>
        <button onclick="document.getElementById('id01').style.display='block'">Delete product</button>
    <?php }?>




















   </div>
</div>
<?php include('../../includes/backend/footer.php');?>

<?php if(!isset($_GET["new"])){ 
$get_id = $_GET["id"];


include('del_mod.php');

}?>