<?php
require('dbconnection.php');
session_start();

$note_id = $_GET['note_id'];
$user_id = $_SESSION['id'];

$stmt = $db->prepare("DELETE FROM module_note WHERE note_id = :note_id");
$stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("DELETE FROM note WHERE id = :note_id");
$stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);



echo 'Successfully Deleted<br>';

header("Location:AddNote.php?id=" . $user_id);
