<?php
require_once '../common/db.php';
$add = 'ALTER TABLE favorites ADD goods BOOLEAN DEFAULT FALSE';
$db->exec($add);
?>