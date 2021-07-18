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

<form action="/config/actions.php"  method="post" >
    <label for="lname">User Name</label><br>
        <input type="text" value="" id="pordname" name="username"><br><br>
   <label for="lname">Password</label><br>
        <input type="text" value="" id="pordname" name="password"><br><br>
<label >Choose a role:</label>

<select name="role" id="role">
    <option value="">--Please choose an option--</option>
    <option value="1">Admin</option>
    <option value="2">Delivery Man</option>
    <option value="3">Stock Manager</option>

</select> <br>
     <!-- submit button -->
    <input style="margin-right: 5%;" class="btn btn-success" type="submit" id="SavEdit" value="Save User" name="<?php if(isset($_GET["new"])){echo "SaveUser";}else{echo "EditUser";} ?>">
	
    <button  class="btn btn-danger"> Delete User</button>
</form>




















   </div>
</div>
<?php include('../../includes/backend/footer.php')?>