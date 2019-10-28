<?php
require('dbconnection.php');

$note_id = $_GET['note_id'];
$user_id = $_GET['user_id'];

$stmt = $db->prepare("DELETE FROM module_note WHERE note_id = :note_id");
$stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("DELETE FROM note WHERE id = :note_id");
$stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);



echo 'Successfully Deleted<br>';

header("refresh:1; url=AddNote.php?id=" . $user_id);
