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
        <script>
            function btnLoadClick(){
                var fileLoadInput = document.querySelector('input[type=file]');
                fileLoadInput.click();
            }
            
            function btnResOkClick(){
                var resultBlock = document.getElementById("pop_up_msg");
                resultBlock.style.display = "none";
            }
            
            function showMoreButton(cardId){
                document.getElementsByClassName("more_background")[parseInt(cardId)].style.display = "block";
            }
            
            function hideMoreButton(cardId){
                document.getElementsByClassName("more_background")[parseInt(cardId)].style.display = "none";
            }
            
            function moreBtnClick(cardId){
                alert(cardId);
            }
        </script>
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
                </div>
                <?php
                include("includes/footer.inc.php");

                ?>
        </div>
	</body>
</html>

<?php
function print_car_card($id, $name, $model, $price, $thumbnail, $country, $year, $serial_number){
    echo '
        <div id="'.$id.'" class="car_card" onmouseover="showMoreButton('.$id.');" onmouseleave="hideMoreButton('.$id.');">
            <div class="more_background">
                <button class="more_btn" onclick="moreBtnClick('.$id.');">More</button>
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