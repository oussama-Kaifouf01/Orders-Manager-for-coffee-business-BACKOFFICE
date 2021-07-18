<!DOCTYPE html>
<html lang="en">
<?php include("../../includes/backend/head.php") ;
include("../../includes/backend/header.php");
if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']!='2'){
	header('location:news.php');
	die();
}
?>
<script>
var cof
function select(element , id )
{    
    //if(element[2].classList[1]=="active")
    //{
    //   element[2].className="price"
    //   element[2].id=""
    //}
    //else
    //{  
         if(document.getElementById("active")!=null)
        {
            document.getElementById("active").className="price"
            document.getElementById("active").id=""
        }
       element[2].id="active"
       element[2].className=element[2].className+" active"
       document.querySelector("#prodid").value=id
       console.log(id)
       cof=parseInt(element[2].children[0].innerText)
    //}
}
</script>
<div class="container-fluid">
   <!-- DataTables Example -->
   <div class="card mb-3">
	
   

<form  action="/config/actions.php"  method="post" >
   <label for="lname">Product</label><br>
     
   <div class="row justify-content-between px-4">
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
    
    <div onclick="select(this.children , this.id)" id="<?php echo  $p_id ; ?>" class="block text-center">
        <p class="my-3 prod-name"><?php echo $p_name  ; ?></p> <img class="image" src="/assets/frontend/img/<?php echo  $p_pic ; ?>">
        <div class="price">
            <h6 class="mb-0"><?php echo  $p_price ; ?>DH</h6>
        </div>
    </div>
    <?php } ?>
    </div>

    <input id="prodid" name="prodid" type="prodid" value="undefined" hidden>
      <br>

   <label>Quantity</label>
  
   <span id="rangeValue">10kg</span>
        <Input name="qte" class="range" type="range" value="10" min="10" max="1000" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)"></Input>
    </div>
    <script type="text/javascript">
        function rangeSlide(value) 
        {
            document.getElementById('rangeValue').innerHTML = value +"Kg";
            document.querySelector("#price").value=parseInt(document.querySelector("#content-wrapper > div > div > form > input.range").value)*cof
        }
    </script>


   <label> Price: </label><br>
   <input id="price" name="price" type="text" value="10" readonly><span>DH</span><br><br>

   <label>Date</label>
        <input type="date" value="" id="date" name="date" min="2014-05-11" ><br><br>

    <input class="btn btn-success" type="submit" value="Send Request" name="sendreq" > <br><br>
    
	
</form>

    
   </div>
</div>
<?php include('../../includes/backend/footer.php')?>


<script>
$(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#date').attr('min', maxDate);
});


</script>