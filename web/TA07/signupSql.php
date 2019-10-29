<?php
    $username = $_POST['uid'];
    $password = $_POST['pwd'];
    $password_confirm = $_POST['pwd-repeat'];

    if (empty($username) || empty($password) || empty($passwordconfirm)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&email=".$email);
        exit();
    }
    else if ($password !== $passwordconfirm) {
        header("Location: ../signup.php?error=passwrodcheck&uid=".$username."&email=".$email);
        exit();
    }
    else {
    	 $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try
    		{
        	$dbUrl = getenv('DATABASE_URL');

        	$dbOpts = parse_url($dbUrl);

        	$dbHost = $dbOpts["host"];
        	$dbPort = $dbOpts["port"];
        	$dbUser = $dbOpts["user"];
        	$dbPassword = $dbOpts["pass"];
        	$dbName = ltrim($dbOpts["path"],'/');

        	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            $db->query($sql);
            header("refresh:1; url=signin.php");
    	}
    	catch (PDOException $ex)
    	{
        echo 'Error!: ' . $ex->getMessage();
        die();
    	}
    }
?>