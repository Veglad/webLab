<?php
    $title = "Завершение регистрации";
    $content_title = "Результат";
    include("includes/header.inc.php");
    include("includes/sidebar.inc.php");
    include("includes/content_title.inc.php");?>

<div id="content">
    <div id="form_result_message">
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $surname = $_POST['second_name'];
            $patronimic = $_POST['patronimic'];
            $result = true;

            if(strlen($name) == 0 || strlen($surname) == 0 || strlen($patronimic) == 0){
                echo "Заполните, пожалуйста, все поля!<br/>";
                $result = false;
            }

            if(!empty($_POST['free_time_preferences'])){
                $preferences = $_POST['free_time_preferences'];
                $checked_cb = count($preferences);

                if($checked_cb > 3){
                    echo "Можно выбрать не более 3-х пунктов.<br/>";
                    $result = false;
                }
            }

            if($result){
                echo "<br/><br/>$name, данные считаны успешно! Спасибо за регистрацию!<br/><br/><a href=\"index.php\">Вернуться на главную.</a>";
            }
            else {
                echo "<br/>Некорректные данные!<br/><a href=\"form_2.php\">Попробовать еще раз.</a>";
            }
        }
        ?>
    </div>
</div>
                <?php
                include("includes/footer.inc.php");
                ?>
            </main>
        </div>
	</body>
</html>