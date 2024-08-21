<?php
/*
$person = new PersonData();
$person->name="S";
$person->lastname="R";
$person->phone="";
$person->address="";
$person->email="sr@gmail.com";
$person->add();

$persons = PersonData::getAll();

foreach($persons as $p){
	echo $p->id." - ".$p->name." ".$p->lastname." ".$p->created_at."<br>";
}

$p = PersonData::getById(1);
$p->phone = "1234567";
$p->address = "Mexico";
$p->update();
*/

$p = PersonData::getById(2);
$p->del();
?>