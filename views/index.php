<?php 
require_once '../core/init.php';
$db = DB::getInstance();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Teacher's Evaluation with Opinion Mining</title>
	<link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css">
	<link rel="favicon" type="image/png" href="../public/images/Evaluationlogo.png">
</head>
<body>
	<div class="container">
		<?php require_once '../layouts/navigationbar.php'; ?>
	</div>
	<?php ?>
	<script src="../public/js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="../public/js/bootstrap.min.js"></script>
</body>
</html>
