<?php

// $sname = "localhost";

// $unmae = "root";

// $password = "";

// $db_name = "cap-pas";

$sname = "localhost";

$unmae = "root";

$password = "";

$db_name = "u679900105_cap_pas";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {

    echo "Connection failed to database!";

}
?>