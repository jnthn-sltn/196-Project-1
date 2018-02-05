<?php
	function connectMongo() {
		$connection = new MongoClient("mongodb://admin:admin@ds217898.mlab.com:17898/ambilampdb");
		$db = $conn->ambilampdb;
		return $db;
	}
?>
<link rel="stylesheet" type="text/css" href="assets/css/header.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
<!--HEADER -->
<header>
	<ul>
		<li><img src="assets/img/lamp.jpg"></li>
		<li><a href="index.php">AmbiLamp</a></li>
		<li><a href="details.php">Details</a></li>
	</ul>
<header>
