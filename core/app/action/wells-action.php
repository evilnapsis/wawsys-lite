<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$f = new WellData();
	$f->name = $_POST["name"];
	$f->address = $_POST["address"];
	$f->no = $_POST["no"];
	$f->franchise_id = $_POST["franchise_id"];

	$f->lat = $_POST["lat"];
	$f->lng = $_POST["lng"];
	$f->zoom = $_POST["zoom"];


	$f->w_id = $_POST["w_id"];
	$f->capacity_gpm = $_POST["capacity_gpm"];
	$f->diam = $_POST["diam"];
	$f->kt = $_POST["kt"];
	$f->depth = $_POST["depth"];
	$f->r_id = $_POST["r_id"];
	$f->r = $_POST["r"];

	$f->kmt = $_POST["kmt"];
	$f->brand = $_POST["brand"];
	$f->serie = $_POST["serie"];
	$f->digits = $_POST["digits"];
	$f->unit = $_POST["unit"];
	$f->factor = $_POST["factor"];

	$f->add();
	Core::alert("Agregado exitosamente!");
	Core::redir("./?view=wells&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$f = new WellData();
	$f->id=$_POST["well_id"];
	$f->name = $_POST["name"];
	$f->address = $_POST["address"];
	$f->no = $_POST["no"];
	$f->franchise_id = $_POST["franchise_id"];

	$f->lat = $_POST["lat"];
	$f->lng = $_POST["lng"];
	$f->zoom = $_POST["zoom"];


	$f->w_id = $_POST["w_id"];
	$f->capacity_gpm = $_POST["capacity_gpm"];
//	$f->diam = $_POST["diam"];
	$f->kt = $_POST["kt"];
	$f->depth = $_POST["depth"];
	$f->r_id = $_POST["r_id"];
	$f->r = $_POST["r"];

	$f->kmt = $_POST["kmt"];
	$f->brand = $_POST["brand"];
	$f->serie = $_POST["serie"];
	$f->digits = $_POST["digits"];
	$f->unit = $_POST["unit"];
	$f->factor = $_POST["factor"];

	$f->update();
	Core::alert("Actualizado exitosamente!");
	Core::redir("./?view=wells&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$f = WellData::getById($_GET["id"]);
	$f->del();
	Core::alert("Eliminado exitosamente!");
	Core::redir("./?view=wells&opt=all");
}
?>