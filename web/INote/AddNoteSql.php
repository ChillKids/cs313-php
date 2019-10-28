<?php
$note = htmlspecialchars($_POST['note']);
$user_id = $_POST['user_id'];
require('dbconnection.php');

function addClass($class_name){
    require('dbconnection.php');
    $stmt = $db->prepare("INSERT INTO class (name) VALUES (:name, :password)");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$statement = $db->query('SELECT class_id FROM enrollment WHERE user_id = $user_id');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo 'user: ' . $row['username'] . ' password: ' . $row['password'] . '<br/>';
}
if (empty($row)){
    echo 'Add a class: <input type="text" name="class_name">';
}

$statement = $db->query(" id FROM user_profile WHERE name = '$name'");
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($results)) {
                    echo 'User Already in Exists<br/>';
                    echo 'THe screen will redirect in 3 sec <br/>';
                    header("refresh:3; url=SignUp.php");
                    die();
                } else { 
                    try {
                        $stmt = $db->prepare("INSERT INTO user_profile (name, password) VALUES (:name, :password)");
                        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                        $stmt->execute();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo 'Successfully Registor! It will redirect to the homepage in 5 sec<br/>';
                        header("refresh:3; url=INotedb.php");
                    } catch (PDOException $ex) {
                        echo 'Error!: ' . $ex->getMessage();
                        die();
                    }
                }
