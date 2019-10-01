<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

echo 'Your name is: '. $_POST["name"]. '<br>';
echo 'Your email is: <a href="mailto:' .$_POST["email"]. ' ">'.$_POST["email"].'</a><br>';
echo 'Your major is: '. $_POST["major"]. '<br>';
echo 'Your comment is: '. $_POST["comments"]. '<br>';

$continents = $_POST['continents'];
  if(empty($continents)) 
  {
    echo("You didn't select any continents.");
  } 
  else
  {
    $N = count($continents);

    echo("You selected $N continents: <br>");

foreach($_POST['continents'] as $selected){
  echo "You have selected: ". $selected."</br>";
}
}
?>
</body>
</html>
