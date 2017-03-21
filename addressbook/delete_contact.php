<?php include ('core/init.php'); ?>

<?php
//Create DB Object
$db = new Database;

//RUn Query
$db->query("DELETE FROM `contacts` WHERE id = :id");

//Bind Query
$db->bind(':id', $_POST['id']);

if($db->execute()){
	echo "contact was deleted";
} else {
	echo "can not delete contact";
}

?>