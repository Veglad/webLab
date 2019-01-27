<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8"/>
		<link type="text/css" rel="stylesheet" href="styles/style.css"/>
		<title>Серверные переменные</title>
        <script type="text/javascript" src="scripts/main_animation.js"></script>
        <script type="text/javascript" src="scripts/form.js"></script>
	</head>
	<body>
		<div id="wrapper">
            
            <?php 
            $content_title = "Значения";
            include("includes/header.inc.php");?>
            <main>
            <?php
            include("includes/sidebar.inc.php");
            include("includes/content_title.inc.php");
            ?>	
				
				<div id="content">
                    <div id="server_vars">
                        <table>
                            <tr>
                                <td><strong>$_GET</strong></td>
                                <td></td>
                            </tr>
                            
                            <?php
                            foreach($_GET as $key => $value){
                                
                                echo "<tr><td>$key</td>";
                                echo "<td>$value</td></tr>";
                                
                            }?>
                            <tr>
                                <td><strong>$_POST</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                            <?php
                            foreach($_POST as $key => $value){
                                echo "<tr><td>$key</td>";
                                echo "<td>$value</td></tr>";
                                
                            }?>
                            </tr>
                            <tr>
                                <td><strong>$_SERVER</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                            <?php
                            foreach($_SERVER as $key => $value){
                                echo "<tr><td>$key</td>";
                                echo "<td>$value</td></tr>";
                                
                            }?>
                            </tr>
                        </table>
                    </div>
				</div>
                <?php
                include("includes/footer.inc.php");
                ?>
            </main>
        </div>
	</body>
</html> 