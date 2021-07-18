<!DOCTYPE html>
<html lang="en">
<?php include("../../includes/backend/head.php")  ?>

<script>
function setDataL(id,prodname,qte,date,status)
{
    document.querySelector("#StatusL > div > div > div.modal-header > h4").innerHTML=prodname +": " +qte+"Kg";
    document.querySelector("#StatusL > div > div > div.modal-body > div > div > div.row.d-flex.justify-content-between.px-3.top > div:nth-child(1) > h5 > span").innerHTML="#"+id;
    document.querySelector("#StatusL > div > div > div.modal-body > div > div > div.row.d-flex.justify-content-between.px-3.top > div.d-flex.flex-column.text-sm-right > p > span").innerHTML=date

    if(status=="Pending")
              {
                //ALIKES
                document.querySelector("#progressbar > li:nth-child(1)").className="step0 active"
                //AGAINST
                document.querySelector("#progressbar > li:nth-child(2)").className="step0"
                document.querySelector("#progressbar > li:nth-child(3)").className="step0"
                document.querySelector("#progressbar > li:nth-child(4)").className="step0"
                document.querySelector("#progressbar > li:nth-child(5)").className="step0"
                
                
              }
              else if(status=="Pending" || status=="Approved" )
              {
                //ALIKES
                document.querySelector("#progressbar > li:nth-child(1)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(2)").className="step0 active"
                //AGAINST
                document.querySelector("#progressbar > li:nth-child(3)").className="step0"
                document.querySelector("#progressbar > li:nth-child(4)").className="step0"
                document.querySelector("#progressbar > li:nth-child(5)").className="step0"
                
              }
              else if(status=="Pending" || status=="Approved" || status=="Processing")
              {
                //ALIKES
                document.querySelector("#progressbar > li:nth-child(1)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(2)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(3)").className="step0 active"
                //AGAINST
                document.querySelector("#progressbar > li:nth-child(4)").className="step0"
                document.querySelector("#progressbar > li:nth-child(5)").className="step0"
                
              }
              else if(status=="Pending" || status=="Approved" || status=="Processing" || status=="Ready" )
              {
                //ALIKES
                document.querySelector("#progressbar > li:nth-child(1)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(2)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(3)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(4)").className="step0 active"
                //AGAINST
                document.querySelector("#progressbar > li:nth-child(5)").className="step0"


              }
              else if(status=="Pending" || status=="Approved" || status=="Processing" || status=="Ready" || status=="Paid")
              {
                document.querySelector("#progressbar > li:nth-child(1)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(2)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(3)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(4)").className="step0 active"
                document.querySelector("#progressbar > li:nth-child(5)").className="step0 active"

              }

}

</script>


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
   $r_prodpic = $product['picture'];

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
         <td><button type="button" class="btn btn-primary" data-toggle="modal" onclick="setDataL(<?php echo $r_id; ?>,'<?php echo $r_prodname; ?>','<?php echo $r_qte; ?>','<?php echo $r_date; ?>','<?php echo $r_status; ?>')" data-target="#StatusL">View Status</button></td>
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
    


        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal fade" id="StatusL">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 style="font-weight: bold;"  class="modal-title">Request Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">


        <div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>Request <span class="text-primary font-weight-bold">Request ID</span></h5>
            </div>
            <div class="d-flex flex-column text-sm-right">
                <p class="mb-0">Expected Picking Date <span style="font-weight: bold;">01/12/19</span></p>
            </div>
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                <ul id="progressbar" class="text-center">
                    <li class="active step0" style="width: 26%;"></li>
                    <li class="active step0" style="width: 12%;"></li>
                    <li class=" step0" style="width: 27%;"></li>
                    <li class=" step0" style="width: 11%;"></li>
                    <li class=" step0" style="width: 23%;"></li>

                </ul>

                </ul>
            </div>
        </div>
        <div class="row justify-content-between top">
            <div class="row d-flex icon-content"> <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="hourglass-start" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-hourglass-start fa-w-12 fa-3x"><g class="fa-group"><path fill="currentColor" d="M296 64c0 77.46-46.2 144-104 144S88 141.48 88 64z" class="fa-secondary"></path><path fill="currentColor" d="M360 64a24 24 0 0 0 24-24V24a24 24 0 0 0-24-24H24A24 24 0 0 0 0 24v16a24 24 0 0 0 24 24c0 91 51 167.73 120.84 192C75 280.27 24 357 24 448a24 24 0 0 0-24 24v16a24 24 0 0 0 24 24h336a24 24 0 0 0 24-24v-16a24 24 0 0 0-24-24c0-91-51-167.73-120.84-192C309 231.73 360 155 360 64zm-64 384H88c0-77.46 46.2-144 104-144s104 66.52 104 144zM192 208c-57.79 0-104-66.52-104-144h208c0 77.46-46.2 144-104 144z" class="fa-primary"></path></g></svg>
                <div class="d-flex flex-column">
                    <p class="font-weight-bold"><br>Pending</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="thumbs-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-thumbs-up fa-w-16 fa-3x"><path fill="currentColor" d="M466.27 286.69C475.04 271.84 480 256 480 236.85c0-44.015-37.218-85.58-85.82-85.58H357.7c4.92-12.81 8.85-28.13 8.85-46.54C366.55 31.936 328.86 0 271.28 0c-61.607 0-58.093 94.933-71.76 108.6-22.747 22.747-49.615 66.447-68.76 83.4H32c-17.673 0-32 14.327-32 32v240c0 17.673 14.327 32 32 32h64c14.893 0 27.408-10.174 30.978-23.95 44.509 1.001 75.06 39.94 177.802 39.94 7.22 0 15.22.01 22.22.01 77.117 0 111.986-39.423 112.94-95.33 13.319-18.425 20.299-43.122 17.34-66.99 9.854-18.452 13.664-40.343 8.99-62.99zm-61.75 53.83c12.56 21.13 1.26 49.41-13.94 57.57 7.7 48.78-17.608 65.9-53.12 65.9h-37.82c-71.639 0-118.029-37.82-171.64-37.82V240h10.92c28.36 0 67.98-70.89 94.54-97.46 28.36-28.36 18.91-75.63 37.82-94.54 47.27 0 47.27 32.98 47.27 56.73 0 39.17-28.36 56.72-28.36 94.54h103.99c21.11 0 37.73 18.91 37.82 37.82.09 18.9-12.82 37.81-22.27 37.81 13.489 14.555 16.371 45.236-5.21 65.62zM88 432c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z" class=""></path></svg>
                <div class="d-flex flex-column">
                    <p class="font-weight-bold"><br>Aproved</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="conveyor-belt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-conveyor-belt fa-w-20 fa-3x"><path fill="currentColor" d="M544 320H96c-53 0-96 43-96 96s43 96 96 96h448c53 0 96-43 96-96s-43-96-96-96zm0 160H96c-35.3 0-64-28.7-64-64s28.7-64 64-64h448c35.3 0 64 28.7 64 64s-28.7 64-64 64zM144 368c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48zm0 64c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zm352-64c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48zm0 64c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zm-176-64c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48zm0 64c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zM144 288h352c8.8 0 16-7.2 16-16V16c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16v256c0 8.8 7.2 16 16 16zM288 32h64v76.2l-32-16-32 16V32zm-128 0h96v128l64-32 64 32V32h96v224H160V32z" class=""></path></svg>
                <div class="d-flex flex-column">
                    <p class="font-weight-bold"><br>Processing</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="box-check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-box-check fa-w-20 fa-3x"><path fill="currentColor" d="M240 0H98.6c-20.7 0-39 13.2-45.5 32.8L2.5 184.6c-.8 2.4-.8 4.9-1.2 7.4H240V0zm235.2 81.7l-16.3-48.8C452.4 13.2 434.1 0 413.4 0H272v157.4C315.9 109.9 378.4 80 448 80c9.2 0 18.3.6 27.2 1.7zM208 320c0-34.1 7.3-66.6 20.2-96H0v240c0 26.5 21.5 48 48 48h256.6C246.1 468.2 208 398.6 208 320zm240-192c-106 0-192 86-192 192s86 192 192 192 192-86 192-192-86-192-192-192zm114.1 147.8l-131 130c-4.3 4.3-11.3 4.3-15.6-.1l-75.7-76.3c-4.3-4.3-4.2-11.3.1-15.6l26-25.8c4.3-4.3 11.3-4.2 15.6.1l42.1 42.5 97.2-96.4c4.3-4.3 11.3-4.2 15.6.1l25.8 26c4.2 4.3 4.2 11.3-.1 15.5z" class=""></path></svg>
                <div class="d-flex flex-column">
                    <p class="font-weight-bold"><br>Ready</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="money-check-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-money-check-alt fa-w-20 fa-3x"><path fill="currentColor" d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z" class=""></path></svg>
                <div class="d-flex flex-column">
                    <p class="font-weight-bold"><br>Paid</p>
                </div>
            </div>
        </div>
    </div>
</div>




</div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

<?php include('../../includes/backend/footer.php')?>