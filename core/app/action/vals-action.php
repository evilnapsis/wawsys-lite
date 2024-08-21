<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){


$well = WellData::getById($_POST["well_id"]);

$val_prev = ValData::getByDWK($_POST["date_at"],$well->id,$_POST["k"]);
	
	if( ($val_prev==null)|| ( $val_prev!=null && $val_prev->val<=$_POST["val"])){
	$f = new ValData();
	$f->well_id = $_POST["well_id"];
	$f->date_at = $_POST["date_at"];
	$f->val = $_POST["val"];
	$f->k = $_POST["k"];
	$f->user_id = $_SESSION["user_id"];
	$f->kx=1;
	$f->add();
}else if($val_prev->val>$_POST["val"]){

	$f = new ValData();
	$f->well_id = $_POST["well_id"];
	$f->date_at = $_POST["date_at"];
	$f->val = str_repeat("9", $well->digits);
	$f->k = $_POST["k"];
	$f->user_id = $_SESSION["user_id"];
	$f->kx=2;
	$f->add();

	$f = new ValData();
	$f->well_id = $_POST["well_id"];
	$f->date_at = $_POST["date_at"];
	$f->val = 0;
	$f->k = $_POST["k"];
	$f->user_id = $_SESSION["user_id"];
	$f->kx=3;
	$f->add();

	$f = new ValData();
	$f->well_id = $_POST["well_id"];
	$f->date_at = $_POST["date_at"];
	$f->val = $_POST["val"];
	$f->k = $_POST["k"];
	$f->user_id = $_SESSION["user_id"];
	$f->kx=1;
	$f->add();

}
	Core::alert("Agregado exitosamente!");
	Core::redir("./?view=vals&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$f = ValData::getById($_GET["id"]);
	$f->del();
	Core::alert("Eliminado exitosamente!");
	Core::redir("./?view=vals&opt=all");
}
?>