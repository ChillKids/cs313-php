<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
<?php 
	$username = $_SESSION['username'];
  echo 'Welcome' . $username . '!';
?>
</body>
</html>