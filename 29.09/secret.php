<!DOCTYPE html>
<html>
 <head>
   <title>!DOCTYPE</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">

 </head>
 <body>
<div class="container"> 
    <div class="row">
        <div class="panel panel-primary">
            <?php

                if(!empty($_GET)){
                    $date=$_GET['d'];
                    $file=$_GET['f'];
                    $path="AllData/$date/$file/";
                    if($dir=opendir($path)){
                        while(($file=readdir($dir))!==false){
                            $fullname=$path.$file;
                            if ($file != "." && $file != "..") {
                                echo "<a href='$fullname' target='_blank'> $file</a></br>";     
                            }          
                        }
                        closedir($dir);
                    }
                }
            ?>


            <form action="index.php" method="post" enctype="multipart/form-data">
                <?php
              echo "<input type='hidden' name='path' value=$path />";
              ?>
                <button type="submit" class="btn btn-outline-dark" name="delete">Remove secret</button>
            </form>

        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
 </body> 
</html>