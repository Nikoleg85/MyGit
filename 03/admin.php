<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title></title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<body>
<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
	$enter = false;
	if (isset($_POST["user"]) && isset($_POST["pas"]) && ($_POST["user"] == "user") && ($_POST["pas"] == "pas")) $enter = true;

	if ($enter === false){
?>
<form action="admin.php" method="POST">
    <input name="user" type="text" value="user">
    <input name="pas" type="password" value="">
    <input type="submit" value="Войди">
</form>
<?php
	} else {
?>

<?php
    $mysqli = new mysqli('localhost', 'demo', 'demo', 'demo');
//график посещений по часам
    $time = array('00:00','01:00','02:00','03:00','04:00','05:00','06:00',
    '07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00',
    '17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00');
    $date = '2021-06-28';
    //echo $date.": <br>";
    $dataPoints = "";
    for ($i=0;$i<(count($time)-1);$i++){
        //echo $time[$i].": ";
        $query = "SELECT * FROM `visit` WHERE (`Date` = '".$date."') AND (`Time` > '".$time[$i]."') AND (`Time` < '".$time[$i+1]."') GROUP BY `ip`";
        $result = $mysqli->query($query);
        //echo $result->num_rows."<br>";
        $dataPoints .= '{ label: "'.$time[$i].'", y: '.($result->num_rows).".0 },";
    }
    $dataPoints = trim($dataPoints, ",");
    
?>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>

<?php
//круговая диаграмма
    $query = "SELECT COUNT(*) as `count`, `y_city` FROM `visit` WHERE (`Date` = '".$date."') GROUP BY `y_city`";
    $result = $mysqli->query($query);
    $dataPoints2 = '';
    while ($row = $result->fetch_array()){
        //echo $row["y_city"]." ".$row["count"]."<br>";
        $dataPoints2 .= '{ y: '.$row["count"].', label: "'.$row["y_city"].'" },';
    }
    $dataPoints2 = trim($dataPoints2,",");

?>

<script>
window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
    exportEnabled: true,    
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "График посещений по часам за <?php echo $date; ?>"
	},
	axisY: {
		title: "Кол-во уникальных посещений (шт в час)",
		suffix: " шт"
	},
	axisX: {
		title: "Часы"
	},
	data: [{
		type: "column",
		yValueFormatString: "#\"шт\"",
		dataPoints: [
			<?php echo $dataPoints; ?>
			
		]
	}]
});
chart.render();



var chart2 = new CanvasJS.Chart("chartContainer2", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "Круговая диаграмма за <?php echo $date; ?>"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b> {y}",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}",
		dataPoints: [
			<?php echo $dataPoints2; ?>
		]
	}]
});
chart2.render();

}
</script>

<div id="chartContainer2" style="height: 300px; width: 100%;"></div>

<?php
	}
?>
</body>

</html>