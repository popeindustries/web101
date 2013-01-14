<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Web 101 - <?php echo preg_replace("/^\/(lesson)(\d)\/$/", "$1 $2", $_SERVER['REQUEST_URI']); ?></title>

		<link rel="stylesheet" href="/assets/css/lesson.css">
	</head>
	<body>
		<button class="button button-mode" id="btnPresentation">presentation mode</button>
