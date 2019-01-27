<?php

$current_directory = "./";
$curr_dir_key = "current_directory_key";
$current_path = "current_path";

$result_correct = 0;
$result_file_esixt = 1;
$result_error = 2;
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
                    <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            if(!empty($_FILES) && !empty($_POST[$current_path])){
                                $current_directory = $_POST[$current_path]; 
                                $result = upload_selected_file($current_directory);

                                echo "
                                <div id='pop_up_msg'>
                                    <span>$result</span>
                                    <button id='res_btn_ok' onclick='btnResOkClick()'>OK</button>
                                </div>";
                            }
                            else if(!empty($_POST[$curr_dir_key]) && !empty($_POST["current_path_js"])){
                                $previous_path = $_POST["current_path_js"];
                                $current_dir = $_POST[$curr_dir_key];
                                if($current_dir == ".."){
                                    $current_directory = dirname($previous_path)."/";
                                }else{
                                    $current_directory = $previous_path.$current_dir."/";
                                }
                            }
                        }
                        echo '<input type="text" id="current_path" name="current_path" value="'.$current_directory.'" style="display: none;"/>';
                    ?>
                    <table id="file_manager_table">
                        <thead>
                            <tr>
                                <th><?php echo $current_directory ?></th>
                                <th>Изменение</th>
                                <th>Размер</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row_file_download">
                                <td colspan="3">
                                    <form method="post" action="files_manager.php" enctype="multipart/form-data">
                                        <?php
                                             echo '<input type="text" name="'.$current_path.'" value="'.htmlspecialchars($current_directory).'" style="display: none;"/>';
                                        ?>
                                        <input type="file" name="file_load_input" onchange="this.form.submit()">
                                        <input type="button" id="btn_path"  onclick="btnLoadClick()" value="Загрузить файл">
                                    </form>
                                </td>
                            </tr>
                            
                            <?php 
                            /* Add back button if this path is not root */
                                    if($current_directory != "./"){
                                        $img_src = "img/folder24.png";
                                        echo '
                                            <tr>
                                                <td colspan="3">
                                                    <div class="filesAndDirs">
                                                        <a href="#">
                                                              <img src="'.$img_src.'" id="file_image"/>
                                                              <span class="table_text">..</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                            
                                        ';
                                    }
                            ?>
                            
                            <?php
                                /*Print all files and dirs*/

                                $files = scandir($current_directory);

                                $dirs_names = null;
                                $files_names = null;

                               foreach($files as $entry){
                                    if($entry != '..' && $entry != '.'){
                                        if(is_dir($current_directory."/".$entry)){
                                            $dirs_names[] = $entry;
                                        }else{
                                            $files_names[] = $entry;
                                        }
                                    }
                                }

                                if($dirs_names != null){
                                    foreach($dirs_names as $dir_name){
                                         write_entry($current_directory."/".$dir_name, $dir_name, false);
                                    } 
                                }

                                if($files_names != null){
                                    foreach($files_names as $file_name){
                                        write_entry($current_directory."/".$file_name, $file_name, true);
                                    }  
                                }

                            ?>
                        </tbody>
                    </table>
                    
                    
                </div>
                <?php
                include("includes/footer.inc.php");
                ?>
        </div>
        
        <script>
            var filesAndDirs = document.getElementsByClassName('filesAndDirs');
            
            for(var i = 0; i < filesAndDirs.length;i++){
                var baseName = filesAndDirs[i].getElementsByTagName("span")[0].textContent;
                
                if(baseName.indexOf('.') == -1 || baseName.indexOf('..') > -1){
                    filesAndDirs[i].onclick = function(){
                        getIntoDirPostQuery.call(this);
                    }
                }
            }
            
            function getIntoDirPostQuery(){
                var baseName = this.getElementsByTagName("span")[0].textContent;
                var currPath = document.getElementById("current_path").value;
                
                
               var form = document.body.innerHTML = 
                    '<form acion="file_manager.php" name="open_dir_form" method="post" style="display:none;">'+
                    '<input type="text" name="current_directory_key" value="'+baseName+'"/>'+
                    '<input type="text" name="current_path_js" value="'+currPath+'"/>'+

                    '</form>';
                
                document.forms['open_dir_form'].submit();
            
            }
        </script>
	</body>
</html>  
            

        <?php function write_entry($path, $entry_name, $is_file){
    
            if($is_file){
                $img_src = "img/file24.png";
                $size = filesize($path);
                $size_optimized = optimize_size_name($size);
            }else{
                $img_src = "img/folder24.png";
                $size = folderSize($path);
                $size_optimized = optimize_size_name($size);
            }
    
            $creation_time = getCreationTime($path);
    
            echo '<tr>
                    <td><div class="filesAndDirs">
                                  <img src="'.$img_src.'" id="file_image"/>
                                  <span class="table_text">'.$entry_name.'</span>
                    </div></td>
                    <td>'.$creation_time.'</td>
                    <td><span class="table_text">'.$size_optimized.'</span></td>
                  </tr>';
        }

        function getCreationTime($path){
            $time = filemtime($path);
            $time = date("d.m.y", $time);
            
            return $time;
        }

        function optimize_size_name($size){
            if($size < 1024){
                return $size.' б';
            }
            elseif($size >=1024 && $size <= 1024*1024){
                return round($size/1024,2).' Кб';
            }
            elseif($size >=1024*1024 && $size <= 1024*1024*1024){
                return round($size/1024/1024,2).' Мб';
            }
            else{
                return round($size/1024/1024/1024,2).' Гб';
            }
        }

        function folderSize($path){
            $size = 0;
            
            if( !is_readable($path) || count(scandir($path)) == 2){
                return 0;
            }
            
            foreach(glob(rtrim($path, '/').'/*') as $entry){
                $size += is_file($entry)?filesize($entry):folderSize($entry);
            }

            return $size;
        }

        function open_nested_dir($dir_name){
            $url = "file_manager.php";
            $$data = array($curr_dir_key => $current_directory."/".$dir_name);
            
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
        }

        function upload_selected_file($path){
            $upload_file = $path.basename($_FILES['file_load_input']['name']);
            
            if(file_exists($upload_file)){
                return "Файл уже существует.";
            }
            else if(move_uploaded_file($_FILES['file_load_input']['tmp_name'], $upload_file)){
                return "Файл успешно загружен!";
            }else{
                return "Ошибка загрузки файл";
            }
        }
         ?>