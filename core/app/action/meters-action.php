<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$f = new MeterData();
	$f->name = $_POST["name"];
	$f->brand = $_POST["brand"];
	$f->serie = $_POST["serie"];
	$f->person = $_POST["person"];
	$f->organization = $_POST["organization"];
	$f->phone = $_POST["phone"];
	$f->email = $_POST["email"];
	$f->expire_at = $_POST["expire_at"];

	$f->no = $_POST["no"];
	$f->start_at = $_POST["start_at"];

	$f->add();

	Core::alert("Agregado exitosamente!");
	Core::redir("./?view=meters&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$f = MeterData::getById($_GET["id"]);
	$f->del();
	Core::alert("Eliminado exitosamente!");
	Core::redir("./?view=meters&opt=all");
}
?>