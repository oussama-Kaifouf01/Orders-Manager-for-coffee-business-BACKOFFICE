<?php
session_start();
include "./db.php";

//add products


if(isset($_POST['SaveProd']))
{
    $p_name = $_POST['prodname'];                                         
    $p_price = $_POST['prodprice']; 
    $p_des = $_POST['description'];
    //$p_pic = "https://www.cafesdubois.ma/wp-content/uploads/2018/05/Grains_Bresil.png";




    $target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/frontend/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    

    $p_pic = basename($_FILES["fileToUpload"]["name"]); //pic to set
    $query_add_prod = "INSERT INTO product (id, name, Description, price,picture) VALUES (NULL,'$p_name' ,  '$p_des','$p_price','$p_pic')";
    $insert_add_prod = mysqli_query($connection,$query_add_prod);
    $location="/admin/views/products.php";
    echo $query_add_prod;
    header('Location:'.$location);
    exit();
}
//

if(isset($_POST['EditProd']))
{
    $p_id = $_POST['prodid'];                                         
    $p_name = $_POST['prodname'];                                         
    $p_price = $_POST['prodprice']; 
    $p_des = $_POST['description'];
   
    



    $target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/frontend/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    

    $p_pic = basename($_FILES["fileToUpload"]["name"]); //pic to set





    $query_edit_prod = "UPDATE `product` SET `name` = '$p_name', `Description` = '$p_des', `price` = '$p_price', `picture` = '$p_pic' WHERE `product`.`id` =$p_id ;";
    $insert_edit_prod = mysqli_query($connection,$query_edit_prod);
    echo $query_edit_prod;
    $location="/admin/views/products.php";
    header('Location:'.$location);
    exit();
}




if(isset($_POST['deleteProd']))
{
    $r_userid = $_POST['id'];                                         
    $query_add_req = "DELETE FROM `product` WHERE `product`.`id` =$r_userid";
    $insert_add_req = mysqli_query($connection,$query_add_req);
    $location="/admin/views/products.php";
    echo $query_add_req;
    header('Location:'.$location);
    exit();
}

//send requests


if(isset($_POST['sendreq']))
{
    $r_userid = $_SESSION['id'];                                         
    $r_prodid = $_POST['prodid'];                                         
    $r_qte = $_POST['qte']; 
    $r_price = $_POST['price'];
    $r_date = $_POST['date'];
    $query_add_req = "INSERT INTO `request` (`id`, `id_username`, `id_prod`, `qte`, `price_to_pay`, `date` , `req_date`) VALUES (NULL, '$r_userid', '$r_prodid', '$r_qte','$r_price', '$r_date','".date("Y-m-d")."');";
    $insert_add_req = mysqli_query($connection,$query_add_req);
    $location="/admin/views/sent_req.php";
    echo $query_add_req;
    header('Location:'.$location);
    exit();
}    



if(isset($_POST['setss']))
{


    $r_id = $_POST['reqid'];                                         
    $r_status = $_POST['reqstatus']; 
    $query_up_req = "UPDATE `request` SET `status` = '$r_status' WHERE `request`.`id` = $r_id;";
    $insert_up_req = mysqli_query($connection,$query_up_req);
    $location="/admin/views/requests.php";
    header('Location:'.$location);
    exit();
}


if(isset($_POST['SaveUser']))
{
    $u_username = $_POST['username'];                                         
    $u_password = $_POST['password'];
    $u_role = $_POST['role']; 
    //$p_pic = $_POST['Description']; //pic to set
    $query_add_user = "INSERT INTO admin_user (id, username, password, role) VALUES (NULL,'$u_username' ,  '$u_password','$u_role')";
    $insert_add_user = mysqli_query($connection,$query_add_user);
    $location="/admin/views/add_user.php";
    echo $query_add_user;
    header('Location:'.$location);
    exit();
}

?>