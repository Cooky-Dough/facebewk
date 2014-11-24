<?php
	$db = new PDO('mysql:host=localhost;dbname=the wall','root',''); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);