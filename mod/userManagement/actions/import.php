<?php
$userMgmt = new UserManagement();

$userMgmt->importUsers($_FILES['users']['tmp_name']);