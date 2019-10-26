
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
 
            
echo '<form action=INotedb.php method=POST>';
echo 'Enter your username: (Enter: Jack)<input type=text name=user_name>';
echo '<input type=submit value="Enter">';
echo '</form><br>';

echo '<form action=INotedb.php method=POST>';
echo 'Do not have your account? Click Here to Sign Up';
echo '<input type=submit value="Enter">';
echo '</form>';

$user_name = $_POST['user_name'];

foreach ($db->query('SELECT id, name FROM user_profile WHERE name =' .  '\'' . $user_name . '\'') as $row) {
    echo '<strong>' . 'Your name are ' . $row['name'];
    echo '<br/>';
    $id = $row["id"];

   

    foreach ($db->query('SELECT user_id, class_id FROM enrollment WHERE user_id =' . $id) as $row) {
        foreach ($db->query('SELECT id, name FROM class WHERE id = ' . $row['class_id']) as $row) {
            echo 'Here are the class that you enrolling: <br>';
            echo '<strong>' . $row['name'];
            echo '<br/>';
            $class_id = $row['id'];

            

            foreach ($db->query('SELECT class_id, module_id FROM class_module WHERE class_id =' . $class_id) as $row) {
                foreach ($db->query('SELECT id, name FROM module WHERE id = ' . $row['module_id']) as $row) {
                    echo 'Here are the Modules in ' . $row['name'] .': <br>';
                    echo '<strong>' . $row['name'];
                    echo '<br/>';
                    $module_id =  $row['id'];

                    echo '<br>Here are the notes in that ' . $row['name'] . ': <br>';
                    foreach ($db->query('SELECT module_id, note_id FROM module_note WHERE module_id =' . $module_id) as $row) {
                        foreach ($db->query('SELECT id, content FROM note WHERE id = ' . $row['note_id']) as $row) {
                            echo '<strong>' . $row['content'];
                            echo '<br/>';
                            $note_id = $row['id'];

                            foreach ($db->query('SELECT id, content, class_id, module_id, user_id FROM note WHERE id = ' . $note_id) as $noterow) {
                                echo 'The note is own by: <br>';

                                foreach ($db->query('SELECT id, name FROM user_profile WHERE id = ' . $noterow['user_id']) as $row)
                                    echo '<strong>' . $row['name'] . '</strong><br>';

                                echo 'The note is under: <br>';
                                foreach ($db->query('SELECT id, name FROM class WHERE id = ' . $noterow['class_id']) as $row)
                                    echo '<strong>' . $row['name'] . '</strong>';

                                echo '<br/><br>';
                            }
                        }
                    }
                }
            }
        }
    }
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


