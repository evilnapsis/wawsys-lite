<?php

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$p =  new PersonData();
	$p->name = $_POST["name"];
	$p->lastname = $_POST["lastname"];
	$p->address = $_POST["address"];
	$p->email = $_POST["email"];
	$p->phone = $_POST["phone"];
	$p->add();
	header("Location: ./?view=crud&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$p =  new PersonData();
	$p->id = $_POST["id"];
	$p->name = $_POST["name"];
	$p->lastname = $_POST["lastname"];
	$p->address = $_POST["address"];
	$p->email = $_POST["email"];
	$p->phone = $_POST["phone"];
	$p->update();
	header("Location: ./?view=crud&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$person = PersonData::getById($_GET["id"]);
	$person->del();
	header("Location: ./?view=crud&opt=all");
}

?>