<?php
	include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> World Population Data </title>
<!--Table Style -->
<style type="text/css">
	table{
		border-collapse: collapse;
		width: 100%;
		color: #588c7e;
		font-family: monospace;
		font-size: 25px;
		text-align: left;
	}
	th{
	background-color: grey;
	color:white;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
<table>
<!--Table Headers-->
        <tr>
				<th>Rank</th>
        <th>Country</th>
        <th>Population</th>
				<th>Year</th>
				<th>Continent</th>
        </tr>
<?php
  $sql = "SELECT * FROM populationstats;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr><td>". $row["rank"]."</td><td>".$row["country"]."</td><td>".$row["population"]."</td><td>".$row["year"]."</td><td>".$row["continent"]."</td></tr>";
		}

	}
?>
</table>
<br></br>
<!-- Bar Graph -->
<?php

$dataPoints = array(
	array("y" => 1339724852, "label" => "China" ),
	array("y" => 1182105564, "label" => "India" ),
	array("y" => 309349689, "label" => "United States" ),
	array("y" => 237641326, "label" => "Indonesia" ),
	array("y" => 193252604, "label" => "Brazil" ),

);

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "World Population in 2010"
	},
	axisY: {
		title: "Amount of People"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## People",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html
