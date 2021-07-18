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
	







   <table class="table table-bordered table-hover">
   <div class="card-header">
		 <i class="fa fa-fw fa-user"></i>
		 Products
	  </div>
<thead>
   <tr>
      <th style="width: 247px;">Name</th>
      <th style="width: 138px;">Price(1kg)</th>
      <th style="width: 100px;">Picture</th>
      <th style="width: 100px;">Change</th>
      <th style="width: 100px;">View</th>
   </tr>
</thead>
   <tbody>
      <?php 
   $query_product = "SELECT * FROM `product`";
   
    $products = mysqli_query($connection,$query_product);
    while($product = mysqli_fetch_assoc($products))
    {

    
    $p_id=$product['id'];
    $p_name=$product['name'];
    $p_price=$product['price'];
    $p_pic=$product['picture'];

?>
      <tr>
         <td><?php  echo $p_name   ;?></td>
         <td><?php  echo $p_price  ;?></td>
         <td> <img src="/assets/frontend/img/<?php  echo $p_pic  ;?>" style="width:75%;" ></td>
         <td>
            <a href="/admin/views/add_prod.php?id=<?php  echo $p_id  ;?>">
            <button class="btn btn-primary">Edit Product</button>
         </a>          
      </td>
      <td>
            <a href="https://castorcoffee.cf/?page_id=814">
            <button class="btn btn-primary">View Product</button>
         </a>          
      </td>
      </tr>
<?php }?>
   </tbody>
</table>



<div>
<a href="/admin/views/add_prod.php?new=true">
<button class="btn btn-primary">Add New Product</button>
</a>
</div>











    
   </div>
</div>
<?php include('../../includes/backend/footer.php')?>