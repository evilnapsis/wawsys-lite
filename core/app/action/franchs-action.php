<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$f = new FranchiseData();
	$f->name = $_POST["name"];
	$f->name_owner = $_POST["name_owner"];
	$f->no = $_POST["no"];
	$f->no_dfa = $_POST["no_dfa"];
	$f->no_dfc = $_POST["no_dfc"];
	$f->k_id = $_POST["k_id"];
	$f->start_at = $_POST["start_at"];
	$f->expire_at = $_POST["expire_at"];

	$f->kind_tariff = $_POST["kind_tariff"];
	$f->tariff = $_POST["tariff"];
	$f->caudal = $_POST["caudal"];

	$f->kind_drna = $_POST["kind_drna"];
	$f->f_address = $_POST["f_address"];
	$f->f_city = $_POST["f_city"];
	$f->f_country_id = $_POST["f_country_id"];
	$f->f_cp = $_POST["f_cp"];

	$f->p_address = $_POST["p_address"];
	$f->p_city = $_POST["p_city"];
	$f->p_country_id = $_POST["p_country_id"];
	$f->p_cp = $_POST["p_cp"];

	$f->da = isset($_POST["da"])?1:0;
	$f->da_kind = $_POST["da_kind"]!=""?$_POST["da_kind"]:"NULL";
	$f->da_year = $_POST["da_year"];
	$f->da_total = $_POST["da_total"];
	$f->da_no = $_POST["da_no"];

	$f->add();

	Core::alert("Agregado exitosamente!");
	Core::redir("./?view=franqs&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$f = FranchiseData::getById($_POST["id"]);
	$f->name = $_POST["name"];
	$f->name_owner = $_POST["name_owner"];
	$f->no = $_POST["no"];
	$f->no_dfa = $_POST["no_dfa"];
	$f->no_dfc = $_POST["no_dfc"];
	$f->k_id = $_POST["k_id"];
	$f->start_at = $_POST["start_at"];
	$f->expire_at = $_POST["expire_at"];

	$f->kind_tariff = $_POST["kind_tariff"];
	$f->tariff = $_POST["tariff"];
	$f->caudal = $_POST["caudal"];

	$f->kind_drna = $_POST["kind_drna"];
	$f->f_address = $_POST["f_address"];
	$f->f_city = $_POST["f_city"];
	$f->f_country_id = $_POST["f_country_id"];
	$f->f_cp = $_POST["f_cp"];

	$f->p_address = $_POST["p_address"];
	$f->p_city = $_POST["p_city"];
	$f->p_country_id = $_POST["p_country_id"];
	$f->p_cp = $_POST["p_cp"];

	$f->da = isset($_POST["da"])?1:0;
	$f->da_kind = $_POST["da_kind"]!=""?$_POST["da_kind"]:"NULL";
	$f->da_year = $_POST["da_year"];
	$f->da_total = $_POST["da_total"];
	$f->da_no = $_POST["da_no"];

	$f->update();

	Core::alert("Actualizado exitosamente!");
	Core::redir("./?view=franqs&opt=all");

}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$f = FranchiseData::getById($_GET["id"]);
	$f->del();
	Core::alert("Eliminado exitosamente!");
	Core::redir("./?view=franqs&opt=all");
}
?>