<!DOCTYPE html>
<html lang="en">
<?php include("../includes/backend/head.php")  ?>
<?php 
include("../includes/backend/header.php");
//if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']!='1'){
//	header('location:news.php');
//	die();
//}
?>
<div class="container-fluid">
<ol class="breadcrumb">
  <li class="breadcrumb-item">
	 <a href="">Sammuray</a>
  </li>
</ol>
<!-- Page Content -->
<h1>Blank Page</h1>
<hr>
<script>
var chart_D=new Array()
chart_D.push(['Date', 'Sales'])
</script>
<?php 
 $query_product = "select SUM(price_to_pay) from request where status ='Paid' AND req_date > current_date - interval 30 day";
 $products = mysqli_query($connection,$query_product);
 $product = mysqli_fetch_assoc($products);

 $sum = $product['SUM(price_to_pay)'];

 $query_request = "select req_date,price_to_pay from request where status ='Paid' AND req_date > current_date - interval 30 day";
 $requests = mysqli_query($connection,$query_request);


 while($request = mysqli_fetch_assoc($requests))
 {
	 $rr_date=$request['req_date'];
	 $rr_price=$request['price_to_pay'];
	 ?>

 <script>
	chart_D.push(['<?php echo $rr_date; ?>',<?php echo $rr_price; ?>])

 </script>
<?php } ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(chart_D);

        var options = {
          title: 'Sales ',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<div class="card revenue" >
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader" style="font-weight: 500;">Total Revenue in last 30 Days:</div>
                      
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2" style="color: green;"><?php  echo $sum ;?> MAD</div>

                    </div>
                  </div>
</div>
				  <div id="curve_chart" class="sales_chart" style="width: 400px; height: 200px"></div>


<?php include('../includes/backend/footer.php')?>