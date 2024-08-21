<?php 

if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}

if(isset($_GET["o"]) && $_GET["o"]=="all"):?>
<section class="">
<div class="row">
	<div class="col-md-12">
		<h1>Usuarios</h1>

<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Nuevo <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="index.php?view=users&o=new&kind=1">Administrador General</a></li>
    <li><a href="index.php?view=users&o=new&kind=3">Administrador de Franquicia</a></li>
  </ul>
</div>

<br><br>

		<?php
		$users = UserData::getAll();
		if(count($users)>0){
			?>
			<div class="box box-primary box-body">
			<table class="table table-bordered datatable table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Nombre de usuario</th>
      <th>Tipo</th>
      <th>Franquicia</th>
      <th>Fecha de expiracion</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->username; ?></td>
        <td><?php if($user->kind==1) { echo "<span class='label label-primary'>Administrador General</span>"; } else if($user->kind==3){ echo "<span class='label label-success'>Administrador de Franquicia</span>"; } ?></td>
        <td><?php if($user->franchise_id!=null){echo FranchiseData::getById($user->franchise_id)->name;} ?></td>
        <td><?php echo $user->expire_at; ?></td>
				<td style="width:120px;">
				<a href="index.php?view=users&o=edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?action=users&o=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				</td>
				</tr>
				<?php

			}
 echo "</table></div>";

		}else{
			?>
			<p class="alert alert-warning">No hay usuarios.</p>
			<?php
		}

		?>

	</div>
</div>
</section>
<?php elseif(isset($_GET["o"]) && $_GET["o"]=="new"):?>
<section class="container">
<div class="row">
	<div class="col-md-12">
	<h1>Agregar Usuario</h1>
	<br>
<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=users&o=add" role="form">
<input type="hidden" name="kind" value="<?php echo $_GET["kind"];?>">
<?php if($_GET["kind"]==3):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Franquicia*</label>
    <div class="col-md-6">
    <select class="form-control" name="franchise_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(FranchiseData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
    </div>
  </div>
<?php else:?>
  <input type="hidden" name="franchise_id" value="">
<?php endif; ?>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de usuario*</label>
    <div class="col-md-6">
      <input type="text" name="username" class="form-control" required id="username" placeholder="Nombre de usuario">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
    </div>
  </div>

<?php if($_GET["kind"]==3):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Expiracion*</label>
    <div class="col-md-6">
      <input type="text" name="expire_at" required class="form-control pickadate" id="name" placeholder="Fecha de expiracion">
    </div>
  </div>
<?php else:?>
  <input type="hidden" name="expire_at" value="0000-00-00">
<?php endif; ?>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Usuario</button>
    </div>
  </div>
</form>
	</div>
</div>
</section>

<?php elseif(isset($_GET["o"]) && $_GET["o"]=="edit"):?>
<div class="container">
<?php $user = UserData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Usuario</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=users&o=upd" role="form">

<?php if($user->kind==3):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Franquicia*</label>
    <div class="col-md-6">
    <select class="form-control" name="franchise_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(FranchiseData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($user->franchise_id==$k->id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
    </div>
  </div>
<?php else:?>
  <input type="hidden" name="franchise_id" value="">
<?php endif; ?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de usuario*</label>
    <div class="col-md-6">
      <input type="text" name="username" value="<?php echo $user->username;?>" class="form-control" required id="username" placeholder="Nombre de usuario">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
<p class="help-block">La contrase&ntilde;a solo se modificara si escribes algo, en caso contrario no se modifica.</p>
    </div>
  </div>
<?php if($user->kind==3):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Expiracion*</label>
    <div class="col-md-6">
      <input type="text" name="expire_at" value="<?php echo $user->expire_at; ?>" required class="form-control pickadate" id="name" placeholder="Fecha de expiracion">
    </div>
  </div>
<?php else:?>
  <input type="hidden" name="expire_at" value="0000-00-00">
<?php endif; ?>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </div>
  </div>
</form>
	</div>
</div>
</div>
<?php endif; ?>