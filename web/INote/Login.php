<?php
                $name = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['password']);

                $stmt = $db->prepare("SELECT id FROM user_profile WHERE (name = :name AND password = :password) ");
                $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $id = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo $id . 'login successfully!';
/*
                if (!empty($id)) {
                    echo $id. 'login successfully!';
                    header("refresh:1; url=AddNote.php");
                } else {
                    echo 'Username or Password Wrong!';
                    header("refresh:1; url=INotedb.php");
                }*/