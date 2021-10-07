<h3>Tours</h3>
<?php include_once("functions.php"); ?>

<div class="form-line">
    <?php echo "<select name='countryId' id='countryId' onchange='showCities(this.value)'>";?>
    <option value="0">Select country</option>

    <?php
        GetTourPageCountries();
    ?>

    <select name="cityId" id="cityList" onchange="showHotels(this.value)"></select>

    <div class="row">
        <?php
            GetHotels();
        ?>
    </div>

    <!-- <div id="h"></div> -->

<!-- <script>
    function showCities(countryId){
        var citydiv = document.getElementById("cityList");
        if(countryId == "0")
            citydiv.innerHTML = "";


        if(window.XMLHttpRequest){
            var xml = new XMLHttpRequest();
        }
        else{
            var xml = new ActiveXObject('Microsoft.XMLHTTP')
        }

        xml.onreadystatechange = function(){
            if(xml.readyState==4 && xml.status == 200){
                alert(xml.responseText);
                citydiv.innerHTML += xml.responseText;
            }
        }
        xml.open("Get", "pages/ajax1.php?cid="+countryId, true);
        xml.send(null);
    }

    function showHotels(cityId){
        var h = document.getElementById("h");

        if(cityId == "0"){
            h.innerHTML = "";

            if(window.XMLHttpRequest){
                var xml = new XMLHttpRequest();
            }
            else{
                var xml = new ActiveXObject('Microsoft.xml');
            }
            xml.onreadystatechange = function(){
                if(xml.readyState==4 && xml.status == 200){
                    h.innerHTML = xml.responseText;
                }
            }
            xml.open("POST", "pages/ajax2.php?cid="+ countryId, true);
            xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xml.send("cid="+cityId);
        }
    }
</script> -->