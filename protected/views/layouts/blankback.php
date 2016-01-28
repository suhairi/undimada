<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<style>
body {
	margin: 0;
	padding: 0;
	color: #555;
	font: normal 10pt Arial,Helvetica,sans-serif;
}
h1 {
	text-align: center;
	font-size: 18pt;
}

h2 {
	font-size: 12pt;
}

table.resultlist {
 	border: 1px solid black;
	border-collapse: collapse;
}

table.resultlist td, table.resultlist th {
	border: 1px solid black;
}

</style>
</head>

<body style="background-color: #ffffff;">

	<?php echo $content; ?>

</body>
</html>
