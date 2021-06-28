<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <title></title>

</head>

<body>
<?php

if ($_POST["explode"] == "1"){
	$file = file_get_contents($_POST["filename"], FILE_USE_INCLUDE_PATH);
	$file = str_replace("\n"," ", $file);//убираем переход на новую строчку, заменяем на пробел
	echo ($file."<br>");
	if ($file){
		$strings = explode($_POST["simbol"], $file);
		$k = 0;
		for ($i=0;$i<count($strings);$i++){
			if (trim($strings[$i]) != ""){//если строка не пустая, выводим количество цифр
				$k++;
				echo ($k)." = ".$strings[$i].' = '.strlen(preg_replace('/[^\d]/','',$strings[$i]))."<br>";
			}
		}
	}

} else {

	if (($_POST["upload"] == "1") && isset($_FILES)){
		$uploaddir = __DIR__.'/files/';
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    		echo "Файл корректен и был успешно загружен.<br>";
?>
<form name="" action="upload.php" method="post">
	<input name="explode" type="hidden" value="1">
	Разбить файл символом: <input name="simbol" type="text" value="">
	<input name="filename" type="hidden" value="<?php echo $uploadfile; ?>"><input type="submit" value="Send">
</form>
<?php
		} else {
	    	echo "Файл не был загружен!<br>";
		}

	} else {


?>

<form enctype="multipart/form-data" action="upload.php" method="POST">
	<input name="upload" type="hidden" value="1">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
    Отправить этот файл: <input name="userfile" type="file" accept="text/plain">
    <input type="submit" value="Отправить файл">
</form>

<?php
	}

}

?>

</body>

</html>