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
/*
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

try {
    $stored_password = db->query('SELECT password FROM users WHERE username=\'$username\'');
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if (password_verify($hashed_password, $stored_password)) {
        $newURL = 'success.php';
        header('Location: ' . $newURL);
        die();
    } else {
        echo 'Incorrect password! Please, try again.';
        die();
    }
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}*/
?>

