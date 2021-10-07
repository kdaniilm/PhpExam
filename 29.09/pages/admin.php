<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <?php 
            include_once("functions.php");


        if(isset($_POST["CreateDb"])){
            createDB();
        }

        ?>

        <form action="index.php?page=4" method="post">
            <input class="btn btn-outline-dark btn-primary" type="submit" name="CreateDb" value="Create DB"/>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <?php
            $link=connect();
            $selectCommand="select * from countries";
            $res=mysqli_query($link, $selectCommand);        
        ?>
        <p>
            <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Countries
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <table class="table table-striped">
                <?php
                    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                    {
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td><input type='checkbox' name='cb$row[0]' /></td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <?php mysqli_free_result($res); ?>
        </div>

        <form action="index.php?page=4" method="post" class="input-group" id="formcountry">       
            <input type="text" name="country" placeholder="Country"   style="height: 35px;"/>
            <input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info mr-1 ml-1" />
            <input type="submit" name="delcountry" value="Delete" class="btn btn-sm btn-warning mr-1 ml-1" />
        </form>

        <?php
            if(isset($_POST["addcountry"])){
                $country=trim(htmlspecialchars($_POST['country']));
                if($country=="") exit();
                $inquiry="INSERT INTO countries(country) VALUES ('$country')";

                mysqli_query($link, $inquiry);
                $error=mysqli_errno($link);
                if($error){echo "$error"; exit();}

                echo "<script> window.location = document.URL; </script>";
            }

            if(isset($_POST["delcountry"])){      
                $countryName = trim(htmlspecialchars($_POST['country']));
                $findCommand = "SELECT * FROM countries WHERE country='$countryName'";
                $res = mysqli_query($link, $findCommand);
                $countryId = 0;
                while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                {
                    $countryId = $row[0];
                }
                $delCommand = "DELETE FROM countries WHERE id=$countryId";
                mysqli_query($link, $delCommand);

                echo "<script> window.location = document.URL; </script>";
            }
        ?>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <?php
            $selectCommand="select ci.id, ci.ucity, co.country from countries co, cities ci where ci.countryId=co.id";
            $res=mysqli_query($link, $selectCommand);        
        ?>
        <p>
            <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                Cities
            </button>
        </p> 
        <div class="collapse" id="collapseExample1">
            <table class="table table-striped">
                <?php
                    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                    {
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td><input type='checkbox' name='ci$row[0]' /></td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <?php mysqli_free_result($res); ?>
        </div>        
        
        <form action="index.php?page=4" method="post" class="input-group" id="formcountry">
            <input type="text" name="city" placeholder="City"  />
            <?php GetCountries(); ?>
            <input type="submit" name="addcity" value="Add" class="btn btn-sm btn-info mr-1 ml-1" />
            <input type="submit" name="delcity" value="Delete" class="btn btn-sm btn-warning mr-1 ml-1" />
        </form>

        <?php
            if(isset($_POST["addcity"])){
                $city=trim(htmlspecialchars($_POST['city']));
                if($city=="") exit();
                $countryId=$_POST["countryName"];
                $inquiry="INSERT INTO cities(ucity, countryId) VALUES ('$city', '$countryId')";

                mysqli_query($link, $inquiry);
                $error=mysqli_errno($link);
                if($error){echo "$error"; exit();}

                echo "<script> window.location = document.URL; </script>";
            }

            if(isset($_POST["delcity"])){      
                $cityName = trim(htmlspecialchars($_POST['city']));
                $findCommand = "SELECT * FROM cities WHERE ucity='$cityName'";
                $res = mysqli_query($link, $findCommand);
                $cityId = 0;
                while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                {
                    $cityId = $row[0];
                }
                $delCommand = "DELETE FROM cities WHERE id=$cityId";
                mysqli_query($link, $delCommand);

                echo "<script> window.location = document.URL; </script>";
            }
        ?>

    </div>

    <!-- Add hotels -->
    <div class="col-12 center">
        <?php
            $selectCommand="select ci.id, ci.ucity, co.country from countries co, cities ci where ci.countryId=co.id";
            $res=mysqli_query($link, $selectCommand);        
        ?>
        <p>
            <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                Hotels
            </button>
        </p> 
        <div class="collapse" id="collapseExample1">
            <table class="table table-striped">
                <?php
                    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                    {
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td><input type='checkbox' name='ci$row[0]' /></td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <?php mysqli_free_result($res); ?>
        </div>        
        
        <form action="index.php?page=4" enctype="multipart/form-data" method="post" class="input-group" id="formcountry">
            <div class="col-12 mt-2 mb-3 d-flex justify-content-center">
                <input type="file" name="images[]" multiple="multiple">
            </div>
            <input type="text" name="hotel" placeholder="Hotel"  />
            <?php GetCountries(); 
            GetCities()?>
            <input type="number" name="stars" placeholder="Stars count"/>
            <input type="number" name="cost" placeholder="Price"/>
            <textarea name="info" placeholder="Hotel info" maxlength="200" style="height:2.35rem;"></textarea>
            <input type="submit" name="addhotel" value="Add" class="btn btn-sm btn-info mr-1 ml-1" />
            <input type="submit" name="delhotel" value="Delete" class="btn btn-sm btn-warning mr-1 ml-1" />
        </form>

        <?php
            if(isset($_POST["addhotel"])){
                
                //hotelId
                $hotelIdForImages = 0;

                //Save files start
                if($_FILES){
                    $imgCount = count($_FILES["images"]["name"]);
                    $filePathes = array();


                    $fileDirectoryName = md5($_POST['hotel']); 
                    $saveFilePath = './images/'.$fileDirectoryName."/";
                    mkdir($saveFilePath, 0777, true);

                    for($i = 0; $i < $imgCount; $i++){
                        $file = $_FILES["images"]["name"][$i];
                        $path = pathinfo($file);
                        $filename = $path["filename"];
                        $ext = $path["extension"];
                        $tempName = $_FILES["images"]["tmp_name"][$i];
                        $path_filename_ext = $saveFilePath.$filename.".".$ext;
                        if(move_uploaded_file($tempName,$path_filename_ext)){
                            array_push($filePathes, $path_filename_ext);
                        }
                    }
                }
                //save files end

                //get hotel start
                $hotel=trim(htmlspecialchars($_POST['hotel']));
                if($hotel=="") exit();
                $countryId=$_POST["countryName"];
                $cityId = $_POST["countryName"];
                $stars = $_POST["stars"];
                $cost = $_POST["cost"];
                $info = htmlspecialchars($_POST["info"]);

                $setHotels="INSERT INTO hotels(hotel, countryId, cityId, stars, cost, info) VALUES ('$hotel', '$countryId', '$cityId', '$stars', '$cost', '$info')";


                mysqli_query($link, $setHotels);
                $error=mysqli_errno($link);
                if($error)
                {
                    echo "$error"; exit();
                }
                //set hotel end

                //set image start
                else{
                    $findCommand = "SELECT * FROM hotels WHERE hotel='$hotel'";
                    $res = mysqli_query($link, $findCommand);
                    
                    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                    {
                       $hotelIdForImages = $row[0];
                    }
                }
                for($i = 0; $i < $imgCount; $i++){
                    $inquiry="INSERT INTO images(hotelId, ImagePath) VALUES ($hotelIdForImages, '$filePathes[$i]')";

                    mysqli_query($link, $inquiry);
                    $error=mysqli_errno($link);
                    if($error){echo "$error"; exit();}

                }
                //set image end
                echo "<script> window.location = document.URL; </script>";
            }

            if(isset($_POST["delhotel"])){      
                $hotelName = trim(htmlspecialchars($_POST['hotel']));
                $findCommand = "SELECT * FROM hotels WHERE hotel='$hotelName'";
                $res = mysqli_query($link, $findCommand);
                $hohelId = 0;
                while($row=mysqli_fetch_array($res, MYSQLI_NUM))
                {
                    $hohelId = $row[0];
                }
                $delCommand = "DELETE FROM hotels WHERE id=$hohelId";
                mysqli_query($link, $delCommand);
                
                echo "<script> window.location = document.URL; </script>";
            }
        ?>

    </div>

</div>

