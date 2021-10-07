<?php 
$users ='db/users.txt';  
$countries = "db/countries.txt";

function createDB(){
    include_once("pages/functions.php");

    $linkDb=connect();
    $ct1="CREATE TABLE Countries (id int AUTO_INCREMENT PRIMARY KEY, country varchar(50));";

    $ct2="CREATE TABLE Cities (id int AUTO_INCREMENT PRIMARY KEY, countryId int, ucity varchar(50), FOREIGN KEY (countryId) REFERENCES Countries(id));";

    $ct3="CREATE TABLE Hotels (id int AUTO_INCREMENT PRIMARY KEY, hotel varchar(50), countryId int, cityId int, stars int, cost float, info varchar(50), FOREIGN KEY (countryId) REFERENCES Countries(id), FOREIGN KEY (cityId) REFERENCES Cities(id));";

    $ct4="CREATE TABLE Images (id int AUTO_INCREMENT PRIMARY KEY, hotelId int, imagePath varchar(300), FOREIGN KEY (hotelId) REFERENCES Hotels(id));";

    $ct5="CREATE TABLE Roles (id int AUTO_INCREMENT PRIMARY KEY, role varchar(50));";

    $ct6="CREATE TABLE Users (id int AUTO_INCREMENT PRIMARY KEY, login varchar(50) not null UNIQUE, pass varchar(50), email varchar(50) not null UNIQUE, roleId int, discount int, avatar varbinary(255), FOREIGN KEY (roleId)REFERENCES Roles(id));";


    mysqli_query($linkDb, $ct1);
    $error=mysqli_errno($linkDb);
    if($error){echo "Error create table 1"; exit();}

    mysqli_query($linkDb, $ct2);
    $error=mysqli_errno($linkDb);
    if($error){echo "Error create table 2"; exit();}

    mysqli_query($linkDb, $ct3);
    $error=mysqli_errno($linkDb);
    if($error){echo "Error create table 3"; exit();}

    mysqli_query($linkDb, $ct4);
    $error=mysqli_errno($linkDb);
    if($error){echo "Error create table 4"; exit();}

    mysqli_query($linkDb, $ct5);
    $error=mysqli_errno($linkDb);
    if($error){echo "Error create table 5"; exit();}

    mysqli_query($linkDb, $ct6);
    $error=mysqli_errno($linkDb);
    if($error){echo "Error create table 6"; exit();}
}

function register($login, $pass, $email)
{
    $name = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));


    if($name == '' || $pass == ''){
        echo "<h3><span style='color:red'> FILL ALL Required Fields </span></h3>";
        return false;
    }

    if(strlen($name)< 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30 ) {
        echo "<h3><span style='color:red'> Value lenght must be between 3 - 30 </span></h3>";
        return false;
    }

    $command="insert users(login, pass, email, roleId) values ('$login', '$pass', '$email', 3)";
    $link=connect();
    mysqli_query($link, $command);
    $error=mysqli_errno($link);
    if($error){
        if($error==1062){
            echo "<h3><span style='color:red'> This login is already exists </span></h3>";
        }
        else "<h3><span style='color:red'> DB error #$error</span></h3>";
        return false;
    }
    return true;
}

function connect($host="localhost", $user="root", $pase="", $dbName="traveldb"){
    $link=mysqli_connect($host, $user, $pase) or die ("Error");
    mysqli_select_db($link, $dbName);
    // mysqli_query($link, "insert into Main(id,Name) values (1,1);");

    return $link;
}

function AddCountry($name){
    $name = trim(htmlspecialchars($name));
    if($name==''){
        echo "<h3><span style='color:red'>Name Country is empty!</span></h3>";
        return false;
    }

    global $countries;

    $file=fopen($countries, 'a+');
    while($line=fgets($file,128))
    {
        if($line==$name."\n"){
            echo "<h3><span style='color:red'>Name Country is alrede exist!</span></h3>";
            return false;
        }
    }
    $line=$name."\n";
    fputs($file, $line);
    fclose($file);
    return true;
}

// function GetCountries(){
//     echo "<select name='ext'>";
//     global $countries;

//     $file=fopen($countries, 'a+');
//     while($line=fgets($file,128))
//     {
//         echo "<option>".$line."</option>";
//     }

//     echo "</select>";    
//     fclose($file);
// }


function GetTourPageCountries(){
    $link = connect();
    $selectCommand = "select * from countries";
    $res= mysqli_query($link, $selectCommand);

    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
    {
        echo "<option value='$row[0]'> $row[1]</option>";
    }
}

function GetCountries(){
    $link=connect();
    $selectCommand="select * from countries";
    $res=mysqli_query($link, $selectCommand);


    echo "<select name='countryName' class='form-control'>";
    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
    {
        echo "<option value='$row[0]'>$row[1]</option>";
    }
    echo "</select>";    
}

function GetCities(){
    $link=connect();
    $selectCommand="select * from cities";
    $res=mysqli_query($link, $selectCommand);


    echo "<select name='cityName' class='form-control'>";
    while($row=mysqli_fetch_array($res, MYSQLI_NUM))
    {
        echo "<option value='$row[0]'>$row[2]</option>";
    }
    echo "</select>";    
}

function GetHotels(){
    $link = connect();
    $selectHotelsCommand = "select * from hotels";
    
    $imagePathes = array();
    $countries = array();
    $cities = array();

    $hotelsRes = mysqli_query($link, $selectHotelsCommand);
    while($row = mysqli_fetch_array($hotelsRes, MYSQLI_NUM)){
        $selectImagesCommand = "select * from images where hotelId = $row[0]";
        $imageRes = mysqli_query($link, $selectImagesCommand);
        while($image = mysqli_fetch_array($imageRes, MYSQLI_NUM)){
            array_push($imagePathes, $image[2]);
        }
        echo("<div class='card mt-2 mr-2' style='width: 16rem;'>");

        $imagePath = "";
        if($imagePathes[0]){
            $imagePath =$imagePathes[0];
        }
        echo("<img src=$imagePath class='card-img-top'>");

        echo("<div class='card-body'>
          <h3 class='card-title'>$row[1]</h3>");
          
          $selectCountriesCommand = "select * from countries where id = $row[2]";
          $countryRes = mysqli_query($link, $selectCountriesCommand);
          while($country = mysqli_fetch_array($countryRes, MYSQLI_NUM)){
              array_push($countries, $country[1]);
          }

          echo("<h4>$countries[0]</h4>");

          $selectCitiesCommand = "select * from cities where id = $row[3]";
          $cityRes = mysqli_query($link, $selectCitiesCommand);
          while($city = mysqli_fetch_array($cityRes, MYSQLI_NUM)){
              array_push($cities, $city[2]);
          }

          echo("<h5>$cities[0]</h5>");

          echo("<p class='card-text'>Stars: $row[6]</p>
          <p class='card-text'>Price: $row[5] $</p>
          <p class='card-text'>$row[6]</p>
          <a href='#' class='btn btn-primary'>Go somewhere</a>
        </div>
      </div>
        ");
    }
}
?> 
