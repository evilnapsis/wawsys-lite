<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$f = new CountryData();
	$f->name = $_POST["name"];

	$f->add();
	Core::alert("Agregado exitosamente!");
	Core::redir("./?view=countries&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$f = new CountryData();
	$f->name = $_POST["name"];

	$f->update();
	Core::alert("Actualizado exitosamente!");
	Core::redir("./?view=countries&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$f = CountryData::getById($_GET["id"]);
	$f->del();
	Core::alert("Eliminado exitosamente!");
	Core::redir("./?view=countries&opt=all");
}
?>