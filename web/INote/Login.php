<?php
require ('dbconnection.php');
                $name = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['password']);

                $stmt = $db->prepare("SELECT password FROM user_profile WHERE (name = :name AND password = :password) ");
                $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stored_password = $row[0]['password'];
                password_verify($password, $stored_password);

                if (!empty($row) && password_verify($password, $stored_password)) {
                    echo 'login successfully!';
                    header("refresh:1; url=AddNote.php?id=" . $row[0]['id']);
                    die();
                } else {
                    echo 'Username or Password Wrong! ' .$stored_password;
                    header("refresh:1; url=INotedb.php");
                    die();
                }