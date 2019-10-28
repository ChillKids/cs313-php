<?php
require('dbconnection.php');

$note_id = $_POST['note_id'];
$user_id = $_POST['user_id'];

$stmt = $db->prepare("DELETE FROM note WHERE id = :note_id");
$stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("DELETE FROM module_note WHERE note_id = :note_id");
$stmt->bindValue(':note_id', $note_id, PDO::PARAM_INT);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);

header("refresh:3; url=AddNote.php?id=" . $user_id);
