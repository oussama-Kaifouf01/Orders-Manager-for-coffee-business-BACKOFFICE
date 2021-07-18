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
		 Users
	  </div>
<thead>
<tr>
      <th style="width: 80px;">ID</th>
      <th style="width: 129px;">User Name</th>
      <th style="width: 123px;">Password</th>
      <th style="width: 78px;">Role</th>


   </tr>
</thead>
   <tbody>
   <?php
   $query_user = "SELECT * FROM `admin_user`";
   $users = mysqli_query($connection,$query_user);
   while($user = mysqli_fetch_assoc($users))
   {
   $u_id=$user['id'];
   $u_username=$user['username'];
   $u_password=$user['password'];
   $u_role=$user['role'];
   ?>
      <tr>
         <td><?php echo $u_id ;  ?></td>
         <td><?php echo $u_username ;  ?></td>
         <td><?php echo $u_password ;  ?></td>
         <td><?php echo $u_role ;  ?></td>
      </tr>
<?php } ?>
   </tbody>
</table>



<div>
<a href="/admin/views/add_user.php?new=true">
<button class="btn btn-primary">Add New User</button>
</a>
</div>








    
   </div>
</div>
<?php include('../../includes/backend/footer.php')?>