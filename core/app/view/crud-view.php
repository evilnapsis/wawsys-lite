<?php if(isset($_GET["opt"]) && $_GET["opt"]=="all"):
$persons = PersonData::getAll();
?>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<h1>Personas</h1>
	<a href="./?view=crud&opt=new" class="btn btn-default">Nuevo</a>
	<br><br>
	<?php if(count($persons)>0):?>
		<table class="table table-bordered">
			<thead>
				<th>Nombre Completo</th>
				<th>Domicilio</th>
				<th>Telefono</th>
				<th>Email</th>
				<th></th>
			</thead>
			<?php foreach($persons as $p):?>
			<tr>
				<td><?=$p->name." ".$p->lastname;?></td>
				<td><?=$p->address;?></td>
				<td><?=$p->phone;?></td>
				<td><?php echo $p->email;?></td>
				<td>
					<a href="./?view=crud&opt=edit&id=<?=$p->id;?>" class="btn btn-warning btn-xs">Editar</a>
					<a href="./?action=crud&opt=del&id=<?=$p->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				</td>
			</tr>

			<?php endforeach;?>
		</table>

	<?php else:?>
		<p class="alert alert-warning">No hay elementos!</p>
	<?php endif; ?>

	</div>
	</div>
	</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<h1>Nueva Persona</h1>

<form method="post" action="./?action=crud&opt=add">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellido</label>
    <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Apellido" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Domicilio</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Domicilio">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Telefono</label>
    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Telefono">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <button type="submit" class="btn btn-primary">Agregar</button>
</form>



	</div>
	</div>
	</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$person = PersonData::getById($_GET["id"]);
?>
		<div class="container">
	<div class="row">
	<div class="col-md-12">
	<h1>Editar Persona</h1>

<form method="post" action="./?action=crud&opt=upd">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" value="<?=$person->name;?>" class="form-control" id="exampleInputEmail1" placeholder="Nombre" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellido</label>
    <input type="text" name="lastname" value="<?=$person->lastname;?>" class="form-control" id="exampleInputEmail1" placeholder="Apellido" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Domicilio</label>
    <input type="text" name="address" class="form-control" value="<?=$person->address;?>" id="exampleInputEmail1" placeholder="Domicilio">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Telefono</label>
    <input type="text" name="phone" class="form-control" value="<?=$person->phone;?>" id="exampleInputEmail1" placeholder="Telefono">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" value="<?=$person->email;?>" id="exampleInputEmail1" placeholder="Email">
  </div>
  <input type="hidden" name="id" value="<?=$person->id;?>">
  <button type="submit" class="btn btn-success">Actualizar</button>
</form>



	</div>
	</div>
	</div>
<?php endif;?>