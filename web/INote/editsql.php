<?php
require('dbconnection.php');
session_start();
$user_id = $_SESSION['id'];
$note_id = $_POST['note_id'];
$content = htmlspecialchars($_POST['note']);

try {
    $stmt = $db->prepare("UPDATE note SET content = :content WHERE id = :note_id; ");
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':note_id', $note_id, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Location: AddNote.php');
    die();
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}
