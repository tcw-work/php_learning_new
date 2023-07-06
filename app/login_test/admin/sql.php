<?php
require_once '../common/db.php';
$add = 'ALTER TABLE users ADD user_level BOOLEAN DEFAULT FALSE';
$db->exec($add);
?>