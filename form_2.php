<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8"/>
		<link type="text/css" rel="stylesheet" href="styles/style.css"/>
		<title>Регистрация</title>
        <script type="text/javascript" src="scripts/main_animation.js"></script>
        <script type="text/javascript" src="scripts/form.js"></script>
	</head>
	<body>
		<div id="wrapper">
            
            <?php 
            $content_title = "Данные";
            include("includes/header.inc.php");?>
            <main>
            <?php
            include("includes/sidebar.inc.php");
            include("includes/content_title.inc.php");
                
            $submited = false;

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $name = $_POST['name'];
                $surname = $_POST['second_name'];
                $patronimic = $_POST['patronimic'];
                $submited = true;
            }

            $result = true;
            ?>	
				
				<div id="content">
				    <form name="main_form" id="main_form" action="form_2.php" method="post">
                        <h4>ФИО</h4>
                        <div class="text_block">
                            <input type="text" name="name" id="name" onkeydown="keyPressed('name', 'error_name')" 
                                   <?php if(!empty($_POST['name'])){
                                            echo ' value="'.$_POST['name'].'"';
                                        } 
                                   ?>
                            >
                            <label for="name">Имя</label>
                        </div>
                        <div class="text_block">
                            <input type="text" name="second_name" id="second_name"                   onkeydown="keyPressed('second_name','error_sec_name')" 
                                   <?php if(!empty($_POST['second_name'])){
                                            echo ' calue="'.$_POST['second_name'].'"';
                                        }
                                   ?>
                            >
                            <label for="second_name">Фамилия</label>
                        </div>
                        <div class="text_block">
                            <input type="text" name="patronimic" id="patronimic" onkeydown="keyPressed('patronimic', 'error_patronimic')"
                            <?php if(!empty($_POST['patronimic'])){
                                            echo ' value="'.$_POST['name'].'"';
                                        }
                            ?>
                            >
                            <label for="patronimic">Отчество</label>
                        </div>
                        
                        <?php
                            if($submited && (strlen($name) == 0 || strlen($surname) == 0 || strlen($patronimic) == 0)){
                                echo "<span class='error_msg_form_php'>Заполните, пожалуйста, все поля!</span>";
                                $result = false;
                            }
                        ?>
                        
                        <h4>Чем вы любите заниматься в свободное время?<br>
                            
                        
                        <?php
                        
                            if($submited&&(!empty($_POST['free_time_preferences']))){
                                  $preferences = $_POST['free_time_preferences'];
                                  $checked_cb = count($preferences);

                                 if($checked_cb > 3){
                                     echo '<span class="error_msg_form_php">Выберете не больше 3-х пунктов</span>';
                                     $result = false;
                                 }
                            }
                            
                        ?>
                            
                            
                        </h4>
                        <div id="checkboxes">
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="book_reading" onclick="checkboxChanged(this)" value="first"
                                    <?php if(IsChecked('free_time_preferences', 'first')){
                                            echo ' checked="checked"';
                                        }
                                    ?>       
                                >
                                <label for="book_reading">Чтение</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="do_sports" onclick="checkboxChanged(this)"
                                       value="second"
                                    <?php if(IsChecked('free_time_preferences', 'second')){
                                                echo ' checked="checked"';
                                            }
                                    ?>       
                                >
                                <label for="do_sports">Спорт</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="go_for_a_walk" onclick="checkboxChanged(this)" value="third"
                                    <?php if(IsChecked('free_time_preferences', 'third')){
                                                echo ' checked="checked"';
                                            }
                                    ?>       
                                >
                                <label for="go_for_a_walk">Прогулка</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="make_creativity" onclick="checkboxChanged(this)" vaalue="fourth"
                                    <?php if(IsChecked('free_time_preferences', 'fourth')){
                                            echo ' checked="checked"';
                                        }
                                    ?>       
                                >
                                <label for="make_creativity">Творчество</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="programming" onclick="checkboxChanged(this)" value="fiveth"
                                    <?php if(IsChecked('free_time_preferences', 'fiveth')){
                                            echo ' checked="checked"';
                                        }
                                    ?>       
                                >
                                <label for="programming">Программирование</label>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="Submit" >

			         </form>
                    <?php
                    if($submited && $result){
                        echo "<span id='msg_success'>
                                $name, данные считаны успешно!
                              </span>";
                    }
                    ?>
				</div>
                <?php
                include("includes/footer.inc.php");
                ?>
            </main>
        </div>
	</body>
</html> 

<?php
    function IsChecked($check_name, $value){
        if(!empty($_POST[$check_name])){
            foreach($_POST[$check_name] as $check_value){
                if($check_value == $value){
                    return true;
                }
            }
        }
        
        return false;
    }
?>