<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8"/>
		<link type="text/css" rel="stylesheet" href="styles/style.css"/>
		<title>Данные</title>
        <script src="scripts/jquery-3.3.1.js"></script>
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
            ?>	
				<div id="content">
				    <form onsubmit="return onFormSubmit();" name="main_form" id="main_form">
                        <h4>ФИО</h4>
                        <div class="text_block">
                            <input type="text" name="name" id="name" onkeydown="keyPressed('name', 'error_name')">
                            <label for="name">Имя</label>
                            <span class="error_message" id="error_name">Введите имя!</span>
                        </div>
                        <div class="text_block">
                            <input type="text" name="second_name" id="second_name" onkeydown="keyPressed('second_name','error_sec_name')">
                            <label for="second_name">Фамилия</label>
                            <span class="error_message" id="error_sec_name">Введите фамилию!</span>
                        </div>
                        <div class="text_block">
                            <input type="text" name="patronimic" id="patronimic" onkeydown="keyPressed('patronimic', 'error_patronimic')">
                            <label for="patronimic">Отчество</label>
                            <span class="error_message" id="error_patronimic">Введите отчество!</span>
                        </div>

                        <h4>Чем вы любите заниматься в свободное время?<br>
                            <span class="error_message" id="error_checkboxes">Выберете не больше 3-х пунктов</span>
                        </h4>
                        <div id="checkboxes">
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="book_reading" onclick="checkboxChanged(this)">
                                <label for="book_reading">Чтение </label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="do_sports" onclick="checkboxChanged(this)">
                                <label for="do_sports">Спорт</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="go_for_a_walk" onclick="checkboxChanged(this)">
                                <label for="go_for_a_walk">Прогулка</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="make_creativity" onclick="checkboxChanged(this)">
                                <label for="make_creativity">Творчество</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="programming" onclick="checkboxChanged(this)">
                                <label for="programming">Программирование</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="cb_music" onclick="checkboxChanged(this)">
                                <label for="cb_music">Музыка</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="cb_hobby" onclick="checkboxChanged(this)">
                                <label for="cb_hobby">Хобби</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="cb_computer_games" onclick="checkboxChanged(this)">
                                <label for="cb_computer_games">Компьютерные игры</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="cb_shopping" onclick="checkboxChanged(this)">
                                <label for="cb_shopping">Шопинг</label>
                            </div>
                            <div class="checkbox_block">
                                <input type="checkbox" name="free_time_preferences[]" id="cb_museum" onclick="checkboxChanged(this)">
                                <label for="cb_museum">Музеи</label>
                            </div>
                        </div>
                        <input type="button" class="formButton" name="checkAllButton" value="CHECK ALL" >
                        <input type="button" class="formButton" name="uncheckAllButton" value="UNCHECK ALL">
                        <input type="button" class="formButton" name="InvertAll" value="INVERT" >
                        <input type="submit" class="formButton" name="submit" value="SUBMIT" >
			         </form>
				</div>
                <?php
                include("includes/footer.inc.php");
                ?>
            </main>
        </div>
	</body>
</html> 	