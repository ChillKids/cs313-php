
<?php
echo '<h1><strong>INote</strong></h1>';
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
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

foreach ($db->query('SELECT id, name FROM user_profile WHERE id = 1') as $row)
{
  echo '<strong>' . 'Your name are ' . $row['name'];
  echo '<br/>';
}

 echo 'Here are the classes that you enrolling: <br>';
 foreach ($db->query('SELECT user_id, class_id FROM enrollment WHERE user_id = 1') as $row)
 {
    foreach ($db->query('SELECT id, name FROM class WHERE id = '.$row['class_id']) as $row)
   echo '<strong>' . $row['name'];
   echo '<br/>';
 }

 echo 'Here are the module in that class: <br>';
 foreach ($db->query('SELECT class_id, module_id FROM class_module WHERE class_id = 1') as $row)
 {
    foreach ($db->query('SELECT id, name FROM module WHERE id = '.$row['module_id']) as $row)
   echo '<strong>' . $row['name'];
   echo '<br/>';
 }

 echo 'Here are the notes in that module: <br>';
 foreach ($db->query('SELECT module_id, note_id FROM module_note WHERE module_id = 1') as $row)
 {
    foreach ($db->query('SELECT id, content FROM note WHERE id = '.$row['note_id']) as $row)
   echo '<strong>' . $row['content'];
   echo '<br/>';
 }

?>


