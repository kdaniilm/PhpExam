<?php 
  include_once("pages/menu.php"); 
  include_once("pages/functions.php");
  connect();
?>
<!DOCTYPE html>
<html>
 <head>
   <title>!DOCTYPE</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link href="css/bootstrap.min.css" rel="stylesheet"/>
 </head>
 <body>


<div class="container"> 

<div class="row">
<header class="col-sm-12 col-md-12 col-lg-12"> 

</header>
</div>

<div class="row">
<nav class="col-sm-12 col-md-12 col-lg-12"> 

</header>
</div>

<div class="row mt-2">
  <section class="col-sm-12 col-md-12 col-lg-12"> 
    <?php 
    if(isset($_GET["page"])){
        $page = $_GET["page"];
            if($page == 1) include_once("pages/tours.php"); 
            if($page == 2) include_once("pages/comments.php"); 
            if($page == 3) include_once("pages/registration.php"); 
            if($page == 4) include_once("pages/admin.php"); 
    }

    ?>
  </section>
</div>



</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
 </body> 
</html>