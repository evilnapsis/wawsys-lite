<?php if(isset($_GET["opt"])&&$_GET["opt"]=="all"):
$fs = MeterData::getAll();
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Metros</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="page-header-icon fa fa-cube"></i>Metros</h1>
          <br>
          <a href="./?view=meters&opt=new" class="btn btn-primary">Nuevo Metro</a>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

        <!-- New users -->
<?php if(count($fs)>0):?>
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-cube"></i>Metros</span>
          </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Marca</th>
                  <th>Serie</th>
                  <th>Fecha de expedicion</th>
                  <th>Fecha de expiracion</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="valign-middle">
                <?php foreach($fs as $f):?>
                <tr>
                  <td><a href='./?view=meters&opt=one&id=<?php echo $f->id; ?>'><?php echo $f->id; ?></a></td>
                  <td><?php echo $f->name; ?></td>
                  <td><?php echo $f->brand; ?></td>
                  <td><?php echo $f->serie; ?></td>
                  <td><?php echo $f->start_at; ?></td>
                  <td><?php echo $f->expire_at; ?></td>


                  <td>
                    <a href="./?action=meters&opt=del&id=<?php echo $f->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                  </td>
                <?php endforeach; ?>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      <?php else:?>
        <p class="alert alert-warning">No hay metros</p>
<?php endif; ?>
        <!-- / New users -->

      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="new"):?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Metros</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-cube"></i> Nuevo Metro</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<form method="post" action="./?action=meters&opt=add">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre del Metro</label>
    <input type="text" name="name" class="form-control"  placeholder="Nombre del Metro">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Marca</label>
    <input type="text" name="brand" class="form-control"  placeholder="Marca">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Serie del Metro</label>
    <input type="text" name="serie" class="form-control"  placeholder="Serie">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Persona quien cetifica</label>
    <input type="text" name="person" class="form-control"  placeholder="Persona quien certifica">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Organizacion que certifica (si aplica)</label>
    <input type="text" name="organization" class="form-control"  placeholder="Organizacion que certifica">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero de certificacion</label>
    <input type="text" name="no" class="form-control"  placeholder="Numero de certificacion">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de expedicion</label>
    <input type="date" name="start_at" class="form-control" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de expiracion</label>
    <input type="date" name="expire_at" class="form-control" >
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Telefono de quien certifica</label>
    <input type="text" name="phone" class="form-control"  placeholder="Telefono de quien certifica">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email de quien certifica</label>
    <input type="text" name="email" class="form-control"  placeholder="Email de quien certifica">
  </div>
<!--
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  -->
  <button type="submit" class="btn btn-primary">Crear Metro</button>
</form>
      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="one"):
$f = MeterData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Metros</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-cube"></i><?php echo $f->name; ?></h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<div class="panel panel-info panel-dark">
<div class="panel-heading">Datos del Metro</div>
<table class="table table-bordered">
  <tr>
    <td>Nombre </td>
    <td><?php echo $f->name; ?></td>
  </tr>
  <tr>
    <td>Marca</td>
    <td><?php echo $f->brand; ?></td>
  </tr>
  <tr>
    <td>Serie</td>
    <td><?php echo $f->serie; ?></td>
  </tr>
  <tr>
    <td>Persona</td>
    <td><?php echo $f->person; ?></td>
  </tr>
  <tr>
    <td>Organizacion</td>
    <td><?php echo $f->organization; ?></td>
  </tr>
  <tr>
    <td>Numero de certificacion</td>
    <td><?php echo $f->no; ?></td>
  </tr>
  <tr>
    <td>Fecha de expedicion</td>
    <td><?php echo $f->start_at; ?></td>
  </tr>
  <tr>
    <td>Fecha de vencimiento</td>
    <td><?php echo $f->expire_at; ?></td>
  </tr>
  <tr>
    <td>Telefono</td>
    <td><?php echo $f->phone; ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $f->email; ?></td>
  </tr>
</table>
</div>
      </div>
    </div>
<?php endif;?>
