
<?php
echo '<h1><strong>INote</strong></h1>';
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


echo '<form action=INotedb.php method=POST>';
echo 'Enter your username: (Enter: Jack)<input type=text name=user_name>';
echo '<input type=submit value=Your name>';
echo '</form>';

$user_name = $_POST['user_name'];

foreach ($db->query('SELECT id, name FROM user_profile WHERE name =' .  '\'' . $user_name . '\'') as $row) {
    echo '<strong>' . 'Your name are ' . $row['name'];
    echo '<br/>';
    $id = $row["id"];

    echo '<br>Here are the classes that you enrolling: <br>';

    foreach ($db->query('SELECT user_id, class_id FROM enrollment WHERE user_id =' . $id) as $row) {
        foreach ($db->query('SELECT id, name FROM class WHERE id = ' . $row['class_id']) as $row) {
            echo '<strong>' . $row['name'];
            echo '<br/>';
            $class_id = $row['id'];

            echo 'Here are the Modules in ' . $row['name'] .  $class_id.': <br>';

            foreach ($db->query('SELECT class_id, module_id FROM class_module WHERE class_id =' . $class_id) as $row) {
                foreach ($db->query('SELECT id, name FROM module WHERE id = ' . $row['module_id']) as $row) {
                    echo '<strong>' . $row['name'];
                    echo '<br/>';
                    $module_id =  $row['id'];
                    echo 'Here are the notes in that ' . $row['name'] . ': <br>';

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
?>


