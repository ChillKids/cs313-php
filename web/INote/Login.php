<?php
require ('dbconnection.php');
                $name = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['password']);

                $stmt = $db->prepare("SELECT id FROM user_profile WHERE (name = :name AND password = :password) ");
                $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $id = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($id)) {
                    echo 'login successfully!';
                    header("refresh:1; url=AddNote.php?id=$id");
                } else {
                    echo 'Username or Password Wrong!';
                    header("refresh:1; url=INotedb.php");
                }