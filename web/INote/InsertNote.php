<?php
$note = htmlspecialchars($_POST['note']);
$class_name = htmlspecialchars($_POST['class_name']);
$module_name = htmlspecialchars($_POST['module_name']);
$user_id = $_POST['user_id'];
require('dbconnection.php');

function addNote($db, $note, $user_id, $module_id, $class_id)
{
    $stmt = $db->prepare("INSERT INTO note (content, class_id, module_id, user_id) VALUES (:content ,:class_id, :module_id, :user_id)");
    $stmt->bindValue(':content', $note, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':module_id', $module_id, PDO::PARAM_INT);
    $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    $note_id = $db->lastInsertId();

    echo 'Note id:' . $note_id . '<br>';
    $stmt = $db->prepare("INSERT INTO module_note (module_id, note_id) VALUES (:module_id, :note_id)");
    $stmt->bindValue(':module_id', $module_id, PDO::PARAM_INT);
    $stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo 'Successfully Saved! It will redirect to note in 3 sec<br/>';

  //  header("refresh:3; url=AddNote.php?id=" . $user_id);
}

function addModule($db, $module_name, $user_id, $class_id, $note)
{
    $stmt = $db->prepare("INSERT INTO module (name) VALUES (:name)");
    $stmt->bindValue(':name', $module_name, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
   $module_id = $db->lastInsertId();

    echo 'modudle id:' . $module_id . '<br>';
    /*$stmt = $db->prepare("INSERT INTO class_module (module_id, class_id) VALUES (:module_id, :class_id)");
    $stmt->bindValue(':module_id', $module_id, PDO::PARAM_INT);
    $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    addNote($db, $note, $user_id, $module_id, $class_id);*/
}

function addClass($db, $user_id, $class_name, $module_name, $note)
{

    $stmt = $db->prepare("INSERT INTO class (name) VALUES (:class_name)");
    $stmt->bindValue(':class_name', $class_name, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    $class_id = $db->lastInsertId();

    $stmt = $db->prepare("INSERT INTO enrollment (class_id, user_id) VALUES (:class_id, :user_id)");
    $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
    $stmt->bindValue(':note_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    addModule($db, $module_name, $user_id, $class_id, $note);
}

try {
    $statement = $db->query("SELECT id FROM class WHERE name = '$class_name'");
    $class_id = $statement->fetchAll(PDO::FETCH_ASSOC);
    //  echo "check class<br>";
    if (!empty($class_id)) {
        // echo "class exist<br>";
        $statement = $db->query("SELECT id FROM module WHERE name = '$module_name'");
        $module_id = $statement->fetchAll(PDO::FETCH_ASSOC);
        //   echo "check module<br>";
        if (!empty($module_id)) {
            //     echo "module exist<br>";
            addNote($db, $note, $user_id, $module_id[0]['id'], $class_id[0]['id']);
        } else {
            //   echo "module does not exist<br>";
            addModule($db, $module_name, $user_id, $class_id[0]['id'], $note);
        }
    } else {
        //     echo "class does not exist<br>";
        // addClass($db, $user_id, $class_name, $module_name, $note);
    }
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}
