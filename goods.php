<?php
$path_to_xml = 'xml/cars.xml';
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8"/>
		<link type="text/css" rel="stylesheet" href="styles/style.css"/>
		<title>Навигация по файлам</title>
        <script type="text/javascript" src="scripts/main_animation.js"></script>
        <script type="text/javascript" src="scripts/form.js"></script>
	</head>
	<body>
		<div id="wrapper">
            
            <?php
            $content_title = "Навигация";
            include("includes/header.inc.php");
            include("includes/sidebar.inc.php");
            include("includes/content_title.inc.php");
            ?>
				
                <div id="content">
                    <div id="goods_list">
                        <?php
                                if(file_exists($path_to_xml)){
                                
                                    $xmlDoc = new DOMDocument();
                                    $xmlDoc->load($path_to_xml);
                                    $cars = $xmlDoc->getElementsByTagName("car");
                                    
                                    foreach ($cars AS $car) {
                                        $carArray = get_car_as_array_from_xml($car);
                                        print_car_card(
                                            $carArray["id"], $carArray["name"], $carArray["model"],
                                            $carArray["price"], $carArray["image"], $carArray["prod_country"], 
                                            $carArray["prod_year"], $carArray["serial_number"]
                                        );
                                    }
                                }
                                else{
                                    echo "xml файл не существует.";
                                }
                        ?>
                    </div>
                    <!-- Car info block -->
                    <?php include("includes/car_info.php");?>
                </div>
                <?php
                include("includes/footer.inc.php");

                ?>
        </div>
        <script>
            function btnLoadClick(){
                var fileLoadInput = document.querySelector('input[type=file]');
                fileLoadInput.click();
            }
            
            function showMoreButton(cardId){
                document.getElementsByClassName("more_background")[parseInt(cardId)].style.display = "block";
            }
            
            function hideMoreButton(cardId){
                document.getElementsByClassName("more_background")[parseInt(cardId)].style.display = "none";
            }
            
            function moreButtonClick(cardId){
                cardId = parseInt(cardId)
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        showFullCarDescription(this.responseXML, cardId);
                    }
                }
                xhttp.open("GET", "xml/cars.xml", true);
                xhttp.send();
            }
            
            function showFullCarDescription(xml, cardId){
                //Show block
                var carCard = document.getElementById("carInfoDiv");
                carCard.style.display = "flex";
                
                //Fill the table with xml data
                var tableContent = generateTableContent(xml, cardId);
                var table = document.getElementById("attributeTable");
                table.innerHTML = tableContent;
                
                //Fill the card with primary data
                fillCarCardWithPrimaryData(xml, cardId);
            }
            
            function generateTableContent(xml, cardId) {
                var tableContent = "";
                var carParams = xml.getElementsByTagName("parameter_list")[cardId];
                var params = carParams.getElementsByTagName("parameter");
                
                for(var i = 0; i < params.length; i++) {
                    tableContent += "<tr><td>" +
                    params[i].getElementsByTagName("parameter_name")[0].textContent +
                    ":</td><td>" +
                    params[i].getElementsByTagName("parameter_value")[0].textContent +
                    "</td></tr>"
                }
                
                return tableContent
            }
            
            function fillCarCardWithPrimaryData(xml, cardId) {
                //Get data from xml
                var car = xml.getElementsByTagName("car")[cardId];
                var name = car.getElementsByTagName("name")[0].textContent;
                var model = car.getElementsByTagName("model")[0].textContent;
                var prodCountry = car.getElementsByTagName("prod_country")[0].textContent;
                var prodYear = car.getElementsByTagName("prod_year")[0].textContent;
                var serialNumber = car.getElementsByTagName("serial_number")[0].textContent;
                var imageUrl = car.getElementsByTagName("image")[0].textContent;
                var price = car.getAttribute("price");
                
                //Fill car card with data
                var carInfoLeftBlock = document.getElementById("carInfoLeftBlock");
                var carInfoScrollBlock = document.getElementById("carInfoScrollBlock");
                
                carInfoLeftBlock.getElementsByClassName("car_name")[0].innerHTML = name;
                carInfoLeftBlock.getElementsByClassName("car_model")[0].innerHTML = model;
                document.getElementById("carThumbnailMoreInfo").src = imageUrl;
                document.getElementById("moreInfoPrice").innerHTML = price + " $";
                
                carInfoScrollBlock.getElementsByClassName("car_country")[0].innerHTML = prodCountry;
                carInfoScrollBlock.getElementsByClassName("car_year")[0].innerHTML = prodYear;
                carInfoScrollBlock.getElementsByClassName("car_serial_number")[0].innerHTML = serialNumber;
            }
            
            document.getElementById("closeBtnCarInfo").onclick = function(){
                var carCard = document.getElementById("carInfoDiv");
                carCard.style.display = "none";
                
            }
        </script>
	</body>
</html>

<?php
function print_car_card($id, $name, $model, $price, $thumbnail, $country, $year, $serial_number){
    echo '
        <div id="'.$id.'" class="car_card" onmouseover="showMoreButton('.$id.');" onmouseleave="hideMoreButton('.$id.');">
            <div class="more_background">
                <button class="more_btn" onclick="moreButtonClick('.$id.');">More</button>
            </div>
            <div class="car_img_block">
                <img class="thumbnail" alt="car image" src="'.$thumbnail.'"/>
                <div class="car_price">
                    <span>'.$price.'$</span>
                </div>
            </div>
            <div class="car_info">
                <span class="car_name car_full_name">'.$name.'</span>
                <span class="car_model car_full_name">'.$model.'</span>
                <hr>
                <table>
                    <tr>
                        <td>Country:</td>
                        <td class="car_country">'.$country.'</td>
                    </tr>
                    <tr>
                        <td>Year:</td>
                        <td class="car_year">'.$year.'</td>
                    </tr>
                    <tr>
                        <td>Serial number:</td>
                        <td class="car_serial_number">'.$serial_number.'</td>
                    </tr>
                </table>
            </div>
        </div>
    ';
}

function get_car_as_array_from_xml($carNode){
    $array = false; 

    if ($carNode->hasAttributes()) 
    { 
        foreach ($carNode->attributes as $attr) 
        { 
            $array[$attr->nodeName] = $attr->nodeValue; 
        } 
    } 

    if ($carNode->hasChildNodes()) 
    { 
        foreach ($carNode->childNodes as $childNode) 
            { 
                if ($childNode->nodeType != XML_TEXT_NODE) 
                { 
                    $array[$childNode->nodeName] = $childNode->nodeValue; 
                } 
            } 
    } 

    return $array;
}
?>