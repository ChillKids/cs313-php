<?php
require ('dbconnection.php');
                $name = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['password']);

                $stmt = $db->prepare("SELECT * FROM user_profile WHERE (name = :name AND password = :password) ");
                $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($row)) {
                    echo 'login successfully!';
                    header("refresh:1; url=AddNote.php?id=" . $row[0]['id']);
                } else {
                    echo 'Username or Password Wrong!';
                    header("refresh:1; url=INotedb.php");
                }