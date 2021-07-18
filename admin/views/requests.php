<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/backend/head.php")  ?>


<?php 
include($_SERVER['DOCUMENT_ROOT']."/includes/backend/header.php");
if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']!='3'){
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
		 Requests
	  </div>
<thead>
<tr>
      <th style="width: 76px;">ID</th>
      <th style="width: 223px;">UserName</th>
      <th style="width: 352px;">Product</th>
      <th style="width: 352px;">Product Picture</th>
      <th style="width: 123px;">Quantity</th>
      <th style="width: 170px;">Date</th>
      <th style="width: 126px;">Price to pay</th>
      <th style="width: 213px;">Status</th>
   
   </tr>
</thead>
   <tbody>
   <?php
   $query_request = "SELECT * FROM `request`";
   
   $requests = mysqli_query($connection,$query_request);
   while($request = mysqli_fetch_assoc($requests))
   {
   $r_id=$request['id'];
   $r_id_username=$request['id_username'];
   $r_id_prod=$request['id_prod'];
   $r_qte=$request['qte'];
   $r_price_to_pay=$request['price_to_pay'];
   $r_date=$request['date'];
   $r_status=$request['status'];
   
   $query_username = "SELECT * FROM admin_user WHERE id = $r_id_username ";
   $usernames = mysqli_query($connection,$query_username);
   $username = mysqli_fetch_assoc($usernames);
   $r_username= $username['username'];


   $query_product = "SELECT name,picture FROM product WHERE id = $r_id_prod ";
   $products = mysqli_query($connection,$query_product);
   $product = mysqli_fetch_assoc($products);
   $r_prodname= $product['name'];
   $r_prodpic= $product['picture'];

  //  if($r_status!="Paid") { echo "class="req-paid"}
  //{
   ?>
      <tr <?php  if($r_status=="Paid") { echo "class='req-paid'"; } ?> >
         <td><?php echo $r_id; ?></td>
         <td><?php echo $r_username; ?></td>
         <td><?php echo $r_prodname; ?></td>
         <td><img style="width:50%;" src="/assets/frontend/img/<?php echo $r_prodpic; ?>"> </td>
         <td><?php echo $r_qte; ?></td>
         <td><?php echo $r_date; ?></td>
         <td><?php echo $r_price_to_pay; ?>  DH</td>
         
         <td>
         <button type="button" class="btn btn-primary" data-toggle="modal" onclick="setData(<?php echo $r_id; ?>,'<?php echo $r_username; ?>','<?php echo $r_status; ?>')" data-target="#Status">Update Status</button></td>
      </tr>
<?php }
//}?>
   </tbody>
</table>
<script>
function setData(id,username,status)
            {
              document.querySelector("#Status > div > div > div.modal-header > h4").innerHTML=username+" Req #"+id
              document.querySelector("#reqid").value=id
              if(status=="Pending")
              {
                //ALIKES
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(1)").className="progtrckr-done"
                //AGAINST
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(2)").className="progtrckr-todo"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(3)").className="progtrckr-todo"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(4)").className="progtrckr-todo"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(5)").className="progtrckr-todo"
                
                
              }
              else if(status=="Pending" || status=="Approved" )
              {
                //ALIKES
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(1)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(2)").className="progtrckr-done"
                //AGAINST
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(3)").className="progtrckr-todo"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(4)").className="progtrckr-todo"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(5)").className="progtrckr-todo"
                
              }
              else if(status=="Pending" || status=="Approved" || status=="Processing")
              {
                //ALIKES
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(1)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(2)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(3)").className="progtrckr-done"
                //AGAINST
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(4)").className="progtrckr-todo"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(5)").className="progtrckr-todo"
                
              }
              else if(status=="Pending" || status=="Approved" || status=="Processing" || status=="Ready" )
              {
                //ALIKES
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(1)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(2)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(3)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(4)").className="progtrckr-done"
                //AGAINST
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(5)").className="progtrckr-todo"


              }
              else if(status=="Pending" || status=="Approved" || status=="Processing" || status=="Ready" || status=="Paid")
              {
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(1)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(2)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(3)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(4)").className="progtrckr-done"
                document.querySelector("#Status > div > div > div.modal-body > ol > li:nth-child(5)").className="progtrckr-done"

              }
            }

</script>


<div>
</div>



    
   </div>
</div>
  <!-- The Modal -->
  <div class="modal fade" id="Status">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

        <ol class="progtrckr" data-progtrckr-steps="5">
             <li class="progtrckr-done">Pending</li>
             <li class="progtrckr-todo">Approved</li>
             <li class="progtrckr-todo">Processing</li>
             <li class="progtrckr-todo">Ready</li>
             <li class="progtrckr-todo">Paid</li>
         </ol>
         <br><br><br>
         <form action="/config/actions.php" method="post">
         <label>Mark as:</label>

         <input type="hidden" id="reqid" name="reqid" >
         <select name="reqstatus" id="reqstatus"><br><br>
         <option value="Pending">Pending</option>
         <option value="Approved">Approved</option>
         <option value="Processing">Processing</option>
         <option value="Ready">Ready</option>
         <option value="Paid">Paid</option>

         <input type="submit" name="setss" value="Submit" class="btn btn-success">
         
         </select>
         
         </form>


        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

<?php include('../../includes/backend/footer.php')?>