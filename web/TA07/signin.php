
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign-In</title>
</head>

<body>
    <div>
        <form action="signin.php" method="post">
            Username: <input type="text" name="username" placeholder="Username"><br>
            Password: <input type="password" name="password" placeholder="Password"><br>
            <button type="submit" name="login-submit">Sign In</button><br>
            Don't have an account yet? Click <a href="signup.php">here</a> to sign up
        </form>
    </div>
</body>
</html>

<?php

session_start();

try {
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts['host'];
    $dbPort = $dbOpts['port'];
    $dbUser = $dbOpts['user'];
    $dbPassword = $dbOpts['pass'];
    $dbName = ltrim($dbOpts['path'], '/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}

$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['username'] = $username;

try {
    $stmt = $db->prepare("SELECT password FROM users WHERE username = :name");
                $stmt->bindValue(':name', $username, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stored_password = $row[0]['password'];

    if (password_verify($password, $stored_password)) {
        echo "Success!!!!!!!!!!!!!!!!!!!!!!!";
        header("refresh:1; url=welcome.php");
        die();
    } else {
        echo "hashed pw:".$password;
        echo 'Incorrect password! Please, try again.';
        die();
    }
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}
?>

