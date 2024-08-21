<?php if(isset($_GET["opt"])&&$_GET["opt"]=="all"):
$fs=null;
if(Core::$user->kind==1){
$fs = WellData::getAll();
}else if(Core::$user->kind==3){
$fs = WellData::getAllBy('franchise_id',Core::$user->franchise_id);  
}
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Extracciones</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="page-header-icon fa fa-circle-o"></i>Extracciones</h1>
          <br>
          <a href="./?view=wells&opt=new" class="btn btn-primary">Nueva Extraccion</a>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

        <!-- New users -->
<?php if(count($fs)>0):?>
        <div class="box box-primary box-body">

          <div class="datatable">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Franquicia</th>
                  <th>Capacidad (GPM)</th>
                  <th>Profundidad (Pies)</th>
                  <th>Toma de Agua</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="valign-middle">
                <?php foreach($fs as $f):?>
                <tr>
                  <td><a href="./?view=wells&opt=one&id=<?php echo $f->id; ?>"><?php echo $f->no; ?></a></td>
                  <td><?php echo $f->name; ?></td>
                  <td><?php echo $f->address; ?></td>
                  <td><?php echo FranchiseData::getById($f->franchise_id)->name; ?></td>
                  <td><?php echo $f->capacity_gpm; ?></td>
                  <td><?php echo $f->depth; ?></td>
                  <td><?php echo WData::getById($f->w_id)->name; ?></td>


                  <td>
                    <a href="./?view=wells&opt=edit&id=<?php echo $f->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>

                    <a href="./?action=wells&opt=del&id=<?php echo $f->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                  </td>
                <?php endforeach; ?>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      <?php else:?>
        <p class="alert alert-warning">No hay Extracciones</p>
<?php endif; ?>
        <!-- / New users -->

      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="new"):?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Extracciones</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-circle-o"></i> Nueva Extraccion</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

<div class="box box-body box-primary">

<form method="post" action="./?action=wells&opt=add">
  <div class="form-group">
    <label for="exampleInputPassword1">Franquicia</label>
    <select class="form-control" name="franchise_id" required>
<?php if(Core::$user->kind==1):?>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(FranchiseData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
  <?php else:?>
      <option value="<?php echo Core::$user->franchise_id; ?>"><?php echo FranchiseData::getById(Core::$user->franchise_id)->name; ?></option>
  <?php endif; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero de pozo</label>
    <input type="text" name="no" required class="form-control"  placeholder="Numero del Pozo">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre del Pozo</label>
    <input type="text" name="name" required class="form-control"  placeholder="Nombre del Pozo">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Direccion</label>
    <input type="text" name="address" class="form-control"  placeholder="Direccion">
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de cuerpo de agua</label>
    <select class="form-control" name="w_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(WData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Ubicacion</label>
  <div class="gllpLatlonPicker">
    <div class="gllpMap" style="width:auto;height:300px;">Google Maps</div>
      <input type="hidden" class="gllpLatitude" name="lat" value="1"/>
      
      <input type="hidden" class="gllpLongitude" name="lng" value="1"/>
 <input type="hidden" class="gllpZoom" name="zoom" value="1"/>
</div>
</div>
<input type="hidden" name="diam" value="">
  <div class="form-group">
    <label for="exampleInputEmail1">Capacidad de la bomba de extraccion (GPM - Galones por minuto)</label>
    <input type="text" name="capacity_gpm" class="form-control"  placeholder="Capacidad de la bomba de extraccion (GPM - Galones por minuto)">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo Toma de Agua</label>
    <select class="form-control" name="kt" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Permanente</option>
      <option value="2">Portatil</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Profundidad del pozo en pies</label>
    <input type="text" name="depth" class="form-control"  placeholder="Profundidad del pozo en pies">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de Ritmo de extraccion</label>
    <select class="form-control" name="r_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(RData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Valor del Ritmo</label>
    <input type="text" name="r" class="form-control"  placeholder="Valor del Ritmo">
  </div>
  <h3>Datos del Metro (Lector)</h3>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo Toma de Agua</label>
    <select class="form-control" name="kmt" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Superficial</option>
      <option value="2">Pozo Profundo</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Marca</label>
    <input type="text" name="brand" class="form-control"  placeholder="Marca">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Serie</label>
    <input type="text" name="serie" class="form-control"  placeholder="Serie">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad de digitos que se mueven</label>
    <input type="text" name="digits" class="form-control"  placeholder="Cantidad de digitos que se mueven">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Unidad de medida</label>
    <select class="form-control" name="unit" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Galones</option>
      <option value="2">Metros Cubicos</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Factor (Multiplicar por)</label>
    <input type="text" name="factor" class="form-control"  placeholder="Factor (Multiplicar por)">
  </div>
<!--
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  -->
  <button type="submit" class="btn btn-primary">Guardar Extraccion</button>
</form>
</div>
      </div>
    </div>

<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="edit"):
$well = WellData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Extracciones</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-circle-o"></i> Modificar Extraccion</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary box-body">
<form method="post" action="./?action=wells&opt=upd">
<input type="hidden" name="well_id" value="<?php echo $_GET['id'];?>">
  <div class="form-group">
    <label for="exampleInputPassword1">Franquicia</label>
    <select class="form-control" name="franchise_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(FranchiseData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($well->franchise_id==$k->id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero de pozo</label>
    <input type="text" name="no" value="<?php echo $well->no; ?>" required class="form-control"  placeholder="Numero del Pozo">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre del Pozo</label>
    <input type="text" name="name" value="<?php echo $well->name; ?>" required class="form-control"  placeholder="Nombre del Pozo">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Direccion</label>
    <input type="text" name="address" value="<?php echo $well->address; ?>" class="form-control"  placeholder="Direccion">
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de cuerpo de agua</label>
    <select class="form-control" name="w_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(WData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($k->id==$well->w_id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Ubicacion</label>
  <div class="gllpLatlonPicker">
    <div class="gllpMap" style="width:auto;height:300px;">Google Maps</div>
      <input type="hidden" class="gllpLatitude" name="lat" value="<?php echo $well->lat; ?>" />
      
      <input type="hidden" class="gllpLongitude" name="lng" value="<?php echo $well->lng; ?>"/>
 <input type="hidden" class="gllpZoom" name="zoom" value="<?php echo $well->zoom; ?>"/>
</div>
</div>
<input type="hidden" name="diam" value="">
  <div class="form-group">
    <label for="exampleInputEmail1">Capacidad de la bomba de extraccion (GPM - Galones por minuto)</label>
    <input type="text" name="capacity_gpm" value="<?php echo $well->capacity_gpm; ?>" class="form-control"  placeholder="Capacidad de la bomba de extraccion (GPM - Galones por minuto)">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo Toma de Agua</label>
    <select class="form-control" name="kt" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1" <?php if($well->kt==1){ echo "selected"; }?>>Permanente</option>
      <option value="2" <?php if($well->kt==2){ echo "selected"; }?>>Portatil</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Profundidad del pozo en pies</label>
    <input type="text" name="depth" class="form-control" value="<?php echo $well->depth; ?>"  placeholder="Profundidad del pozo en pies">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de Ritmo de extraccion</label>
    <select class="form-control" name="r_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(RData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($well->r_id==$k->id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Valor del Ritmo</label>
    <input type="text" name="r" class="form-control" value="<?php echo $well->r; ?>" placeholder="Valor del Ritmo">
  </div>
  <h3>Datos del Metro (Lector)</h3>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo Toma de Agua</label>
    <select class="form-control" name="kmt" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1" <?php if($well->kmt==1){ echo "selected"; }?>>Superficial</option>
      <option value="2" <?php if($well->kmt==2){ echo "selected"; }?>>Pozo Profundo</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Marca</label>
    <input type="text" name="brand" value="<?php echo $well->brand; ?>" class="form-control"  placeholder="Marca">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Serie</label>
    <input type="text" name="serie" class="form-control" value="<?php echo $well->serie; ?>" placeholder="Serie">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad de digitos que se mueven</label>
    <input type="text" name="digits" value="<?php echo $well->digits; ?>" class="form-control"  placeholder="Cantidad de digitos que se mueven">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Unidad de medida</label>
    <select class="form-control" name="unit" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1" <?php if($well->unit==1){ echo "selected"; }?>>Galones</option>
      <option value="2" <?php if($well->unit==2){ echo "selected"; }?>>Metros Cubicos</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Factor (Multiplicar por)</label>
    <input type="text" name="factor" value="<?php echo $well->factor; ?>" class="form-control"  placeholder="Factor (Multiplicar por)">
  </div>
<!--
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  -->
  <button type="submit" class="btn btn-primary">Guardar Extraccion</button>
</form>
</div>
      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="one"):
$f = WellData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Extracciones</li>
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
<div class="panel-heading">Datos del pozo</div>
<table class="table table-bordered">
  <tr>
    <td>Franquicia</td>
    <td><?php echo FranchiseData::getById($f->franchise_id)->name; ?></td>
  </tr>
  <tr>
    <td>Nombre de la franquicia</td>
    <td><?php echo $f->name; ?></td>
  </tr>
  <tr>
    <td>Numero del pozo</td>
    <td><?php echo $f->no; ?></td>
  </tr>
  <tr>
    <td>Direccion</td>
    <td><?php echo $f->address; ?></td>
  </tr>
  <tr>
    <td>Ubicacion</td>
    <td>
        <div class="gllpLatlonPicker">
    <div class="gllpMap" style="width:auto;height:300px;">Google Maps</div>
      <input type="hidden" class="gllpLatitude" name="lat" value="<?php echo $f->lat; ?>"/>
      
      <input type="hidden" class="gllpLongitude" name="lng" value="<?php echo $f->lng; ?>"/>
 <input type="hidden" class="gllpZoom" name="zoom" value="<?php echo $f->zoom; ?>"/>
</div>
    </td>
  </tr>
  <tr>
    <td>Cuerpo de Agua</td>
    <td><?php echo WData::getById($f->w_id)->name; ?></td>
  </tr>
  <tr>
    <td>Capacidad de la bomba (GPM)</td>
    <td><?php echo $f->capacity_gpm; ?></td>
  </tr>
  <tr>
    <td>Tipo de Toma de Agua</td>
    <td>
    <?php switch ($f->kt) {
      case '1': echo "Permanente";break;
      case '2': echo "Portatil";break;
      case '3': echo "Otro";break;
      default:break;
    } ?>
      
    </td>
  </tr>

  <tr>
    <td>Profundidad del pozo (Pies)</td>
    <td><?php echo $f->depth; ?></td>
  </tr>
  <tr>
    <td>Tipo de Ritmo de Extraccion</td>
    <td><?php echo RData::getById($f->r_id)->name; ?></td>
  </tr>
  <tr>
    <td>Valor del Ritmo de Extraccion</td>
    <td><?php echo $f->r; ?></td>
  </tr>
  <tr>
    <td>Metro: Tipo de Toma de Agua</td>
    <td>
    <?php switch ($f->kmt) {
      case '1': echo "Superficial";break;
      case '2': echo "Pozo profundo";break;
      default:break;
    } ?>
      
    </td>
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
    <td>Digitos que se mueven</td>
    <td><?php echo $f->digits; ?></td>
  </tr>
  <tr>
    <td>Unidad de medida</td>
    <td>
    <?php switch ($f->unit) {
      case '1': echo "Galones";break;
      case '2': echo "Metros cubicos (m3)";break;
      default:break;
    } ?>
      
    </td>
  </tr>
  <tr>
    <td>Factor multiplicador</td>
    <td><?php echo $f->factor; ?></td>
  </tr>


</table>
</div>
      </div>
    </div>
<?php endif;?>
