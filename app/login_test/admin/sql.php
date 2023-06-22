<?php
require_once '../function/db.php';
$add_activation_column = 'ALTER TABLE users ADD is_activated BOOLEAN DEFAULT FALSE';
$db->exec($add_activation_column);
?>