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
                    echo 'login successfully! id:';
                    echo $row[0];
                    echo $row['id'];
                    echo $row["id"];
                    echo $row['0'];
                    echo $row(0);
                    header("refresh:1; url=AddNote.php?id=" . $row['id']);
                } else {
                    echo 'Username or Password Wrong!';
                    header("refresh:1; url=INotedb.php");
                }