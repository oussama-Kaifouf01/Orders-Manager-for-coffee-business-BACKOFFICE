<?php
session_start();
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

if(!isset($_SESSION['IS_LOGIN'])){
	header('location:login.php');
	die();
}
?>

   <body id="page-top">
      <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
         <a class="navbar-brand mr-1" href="index.php">Castor</a>
         <div class="d-none d-md-inline-block ml-auto"></div>
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-user-circle fa-fw"></i>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="/admin/logout.php">Logout</a>
               </div>
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="sidebar navbar-nav">
            <?php if($_SESSION['ROLE']==1){?>
			   <li class="nav-item">
               <a class="nav-link" href="/admin/index.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/admin/views/products.php">
               <i class="fa fa-fw fa-archive "></i>
               <span>Add Products</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/admin/views/track_req.php">
               <i class="fas fa-exchange-alt"></i>
               <span>Track Requests</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/admin/views/users.php">
               <i class="fa fa-fw fa-users"></i>
               <span>Add Users</span></a>
            </li>
			<?php } ?>
         <?php if($_SESSION['ROLE']==2){?>
            <li class="nav-item">
               <a class="nav-link" href="/admin/index.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/admin/views/sent_req.php">
               <i class="fas fa-exchange-alt"></i>
               <span>My Requests</span></a>
            </li>
         <?php }?>
         <?php if($_SESSION['ROLE']==3){?>
            <li class="nav-item">
               <a class="nav-link" href="/admin/views/requests.php">
               <i class="fas fa-exchange-alt"></i>
               <span>Current Requests</span></a>
            </li>
         <?php }?>
         </ul>
         <div id="content-wrapper">