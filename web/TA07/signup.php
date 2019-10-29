<html>
<head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
</head>
<body>
    <div>
        <a style="float:right" href="signin.php">Sign In</a><br>
    </div>

    <hr><br>

    <div>
        <h1>Sign Up</h1>
        <form action="signupSql.php" method="post">
            Username: <input type="text" name="uid" placeholder="Username"><br>
            Password: <input type="password" name="pwd" placeholder="Password"><br>
            Please re-enter password: <input type="password" name="pwd-repeat" placeholder="Confirm Password"><br>
            <input type="button" name="signup-submit" value=SignUp>
        </form>
    </div>
    
</body>
</html>
