<?php
$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);
require('dbconnection.php');
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$statement = $db->query("SELECT id FROM user_profile WHERE name = '$name'");
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($results)) {
                    echo 'User Already in Exists<br/>';
                    echo 'THe screen will redirect in 3 sec <br/>';
                    header("refresh:3; url=SignUp.php");
                    die();
                } else { 
                    try {
                        $stmt = $db->prepare("INSERT INTO user_profile (name, password) VALUES (:name, :password)");
                        $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
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
