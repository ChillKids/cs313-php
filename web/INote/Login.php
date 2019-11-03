<?php
require ('dbconnection.php');
session_start();
                $name = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['password']);

                $stmt = $db->prepare("SELECT password, id FROM user_profile WHERE (name = :name) ");
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stored_password = $row[0]['password'];
                password_verify($password, $stored_password);
                $id = $row[0]['id'];
                $_SESSION['id'] = $id;


                if (!empty($row) && password_verify($password, $stored_password)) {
                    echo 'login successfully!';
                    header("refresh:1; url=AddNote.php");
                    die();
                } else {
                    echo 'Username or Password Wrong!';
                    header("refresh:1; url=INotedb.php");
                    die();
                }