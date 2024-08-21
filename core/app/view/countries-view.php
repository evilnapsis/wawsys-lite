<?php if(isset($_GET["opt"])&&$_GET["opt"]=="all"):
$fs = CountryData::getAll();
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Paises</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="page-header-icon fa fa-circle-o"></i>Paises</h1>
          <br>
          <a href="./?view=countries&opt=new" class="btn btn-primary">Nuevo Pais</a>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

        <!-- New users -->
<?php if(count($fs)>0):?>
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-circle-o"></i>Paises</span>
          </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="valign-middle">
                <?php foreach($fs as $f):?>
                <tr>
                  <td><a href="./?view=countries&opt=one&id=<?php echo $f->id; ?>"><?php echo $f->id; ?></a></td>
                  <td><?php echo $f->name; ?></td>
 

                  <td>
                    <a href="./?view=countries&opt=edit&id=<?php echo $f->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>

                    <a href="./?action=countries&opt=del&id=<?php echo $f->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                  </td>
                <?php endforeach; ?>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      <?php else:?>
        <p class="alert alert-warning">No hay Paises</p>
<?php endif; ?>
        <!-- / New users -->

      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="new"):?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Paises</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-circle-o"></i> Nuevo Pais</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<form method="post" action="./?action=countries&opt=add">

  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" required class="form-control"  placeholder="Nombre">
  </div>
  <button type="submit" class="btn btn-primary">Guardar Pais</button>
</form>
      </div>
    </div>

<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="edit"):
$well = CountryData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Paises</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-circle-o"></i> Modificar Pais</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<form method="post" action="./?action=countries&opt=upd">
<input type="hidden" name="well_id" value="<?php echo $_GET['id'];?>">

  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" value="<?php echo $well->name; ?>" required class="form-control"  placeholder="Nombre">
  </div>
  <button type="submit" class="btn btn-primary">Guardar Pais</button>
</form>
      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="one"):
$f = CountryData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Paises</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-circle-o"></i><?php echo $f->name; ?></h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<div class="panel panel-info panel-dark">
<div class="panel-heading">Datos del pais</div>
<table class="table table-bordered">
  <tr>
    <td>Nombre</td>
    <td><?php echo $f->name; ?></td>
  </tr>

</table>
</div>
      </div>
    </div>
<?php endif;?>
