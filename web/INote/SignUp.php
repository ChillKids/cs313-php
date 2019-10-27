
<?php
try {
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"], '/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}


echo '
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="HomePage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <title>CS313 HomePage</title>
</head>

<body>
    <header class="header">
        <h1>Table and Salt</h1>
        <p>my CS313 HomePage established at 9/26/2019</p>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#header">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Assignments
                  </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../hello.html">Assignment01:Hello World</a>
                        <a class="dropdown-item" href="../prove02/prove02.html">Assignment02:HomePage</a>
                        <a class="dropdown-item" href="../prove03/ShoppingCart.html">Assignment03:ShoppingCart</a>
                        <a class="dropdown-item" href="../INote/HomePage.html">INote</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#footer">About the author</a>
                        <a class="dropdown-item" href="#footer">About this assignment</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="body">
        <div class="row">
            <div class="col-8 col-s-9 Form">
            <h2>INote Sign Up</h2><br>
            ';
 
            
echo '<form action=SignUp.php method=POST>';
echo 'Create your username:<input type=text name=user_name><br>';
echo '</form><br>';

$user_name = $_POST['user_name'];

$check= "SELECT * FROM user_profile WHERE name = '$user_name'";
$stmt = $this->pdo->prepare($check);

if($stmt[0] > 1) {
    echo "User Already in Exists<br/>";
}

else
{
   /* $newUser="INSERT INTO persons(Email,FirstName,LastName,PassWord) values('$_POST[eMailTxt]','$_POST[NameTxt]','$_POST[LnameTxt]','$_POST[passWordTxt]')";
    if (mysqli_query($con,$newUser))
    {
        echo "You are now registered<br/>";
    }
    else
    {
        echo "Error adding user in database<br/>";
    }*/
}


   echo '         </div>

            <div class="col-3 col-s-12">
                <div class="aside">
                    <h2>How?</h2>
                    <p>1.Fill Up the form.<br> 2.Get your php
                    </p>
                </div>
            </div>
        </div>

        <div class="footer" id="footer">
            <p>About Author and the assignment:<br> Hi, I am Jack Leung. A student in BYU-I studying Computer Science. This is I-note.</p>

        </div>

    </div>

</body>';


