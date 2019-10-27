<?php
$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);
require('dbconnection.php');
$statement = $db->query("SELECT id FROM user_profile WHERE name = '$name'");
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($results)) {
                    echo 'User Already in Exists<br/>';
                } else if ($name == "" || $password == "") {
                    echo 'Name and Password cannot be blank<br/>';
                } else { 
                    try {
                        $stmt = $db->prepare("INSERT INTO user_profile (name, password) VALUES (:name, :password)");
                        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                        $stmt->execute();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo 'Successfully Registor! It will redirect to the homepage in 5 sec<br/>';
                        header("refresh:5; url=INotedb.php");
                    } catch (PDOException $ex) {
                        echo 'Error!: ' . $ex->getMessage();
                        echo 'You must filled up all the boxes';
                        die();
                    }
                }
