<?php
$dbconn = pg_connect("host=localhost dbname=DB_PROJ_BODUCH user=kboduch password=bazy123")
    or die('Could not connect: ' . pg_last_error());
?>
