<?php if(isset($_GET["opt"])&&$_GET["opt"]=="all"):
$fs = ValData::getAll();
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Lecturas</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="page-header-icon fa fa-dashboard"></i>Lecturas</h1>
          <br>
          <a href="./?view=vals&opt=new" class="btn btn-primary">Nueva Lectura</a>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

        <!-- New users -->
<?php if(count($fs)>0):?>
        <div class="box box-primary box-body">

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Lectura</th>
                  <th>Unidad</th>
                  <th>Extraccion</th>
                  <th>Franquicia</th>
                  <th>Fecha</th>
                  <th>Frecuencia de lectura</th>
                  <th>Tipo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="valign-middle">
                <?php foreach($fs as $f):
                $well=WellData::getById($f->well_id);
                ?>
                <tr>
                  <td><a href="./?view=vals&opt=one&id=<?php echo $f->id; ?>"><?php echo $f->id; ?></a></td>
                  <td><?php echo $f->val; ?></td>
                  <td><?php if($well->unit==1){ echo "Galones"; }else if($well->unit==2){ echo "Metros cubicos"; }  ?></td>
                  <td><?php  echo $well->name; ?></td>
                  <td><?php echo FranchiseData::getById($well->franchise_id)->name; ?></td>
                  <td><?php echo $f->date_at; ?></td>
                  <td><?php  if($f->k==1){ echo "Mensual"; }elseif($f->k==2){ echo "Diaria"; }  ?></td>
                  <td>
                    <?php if($f->kx==1):?>
                      <span class="label label-primary">Normal</span>
                    <?php elseif($f->kx==2):?>
                      <span class="label label-success">Ajuste</span>
                    <?php elseif($f->kx==3):?>
                      <span class="label label-warning">Reinicio</span>
                    <?php endif; ?>
                  </td>


                  <td>
                    <a href="./?view=vals&opt=topay&id=<?php echo $f->id; ?>" class="btn btn-default btn-xs">Formato de Pago</a>
                    <a href="./?action=vals&opt=del&id=<?php echo $f->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                  </td>
                <?php endforeach; ?>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      <?php else:?>
        <p class="alert alert-warning">No hay Lecturas</p>
<?php endif; ?>
        <!-- / New users -->

      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="new"):?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Lecturas</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-dashboard"></i> Nueva Lectura</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<form method="post" action="./?action=vals&opt=add">
<div class="box box-primary box-body">
  <div class="form-group">
    <label for="exampleInputPassword1">Franquicia</label>
    <select class="form-control" name="franchise_id" id="franchise_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(FranchiseData::getAll() as $k):
      ?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->no." - ".$k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Extraccion</label>
    <select class="form-control" name="well_id" id="well_id" required>

    </select>
  </div>

<script type="text/javascript">
  $("#franchise_id").change(function(){
    $.get("./?action=getwells&f="+$("#franchise_id").val(),function(data){
      $("#well_id").html(data);
      console.log(data);
    });
  });
</script>

  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de la Lectura</label>
    <input type="date" name="date_at" required class="form-control" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Lectura</label>
    <input type="text" name="val" required class="form-control"  placeholder="Valor">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Frecuencia de la Lectura</label>
    <select class="form-control" name="k" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Mensual</option>
      <option value="2">Diaria</option>
    </select>
  </div>
<!--
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  -->
  <button type="submit" class="btn btn-primary">Crear Lectura</button>
  </div>
</form>
      </div>
    </div>

<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="one"):
$f = ValData::getById($_GET["id"]);
$well = WellData::getById($f->well_id);

?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Lecturas</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-dashboard"></i> <?php echo $f->val; ?></h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<div class="box box-primary box-body">
<table class="table table-bordered">
  <tr>
    <td>Franquicia</td>
    <td><?php echo FranchiseData::getById($well->franchise_id)->name; ?></td>
  </tr>
  <tr>
    <td>Extraccion</td>
    <td><?php echo $well->no." - ".$well->name; ?></td>
  </tr>
  <tr>
    <td>Fecha del Lectura</td>
    <td><?php echo $f->date_at; ?></td>
  </tr>
  <tr>
    <td>Valor de la lectura</td>
    <td><?php echo $f->val; ?></td>
  </tr>
  <tr>
    <td>Unidad</td>
    <td><?php if($well->unit==1){ echo "Galones"; }else if($well->unit==2){ echo "Metros cubicos"; }  ?></td>
  </tr>
  <tr>
    <td>Frecuencia de la lectura</td>
    <td><?php  if($f->k==1){ echo "Mensual"; }elseif($f->k==2){ echo "Diaria"; }  ?></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><?php $u= UserData::getById($f->user_id); echo $u->name." ".$u->lastname; ?></td>
  </tr>


</table>
</div>
      </div>
    </div>

<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="topay"):
$f = ValData::getById($_GET["id"]);
$well = WellData::getById($f->well_id);
$val_prev = ValData::getByDWK($f->date_at,$well->id,$f->k);
$fra = FranchiseData::getById($well->franchise_id);
//print_r($vals);

?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Lecturas</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-dashboard"></i> <?php echo $f->val; ?></h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
  <?php if($val_prev==null):?>
    <p class="alert alert-warning">No hay una lectura anterior</p>
<?php endif; ?>

<div class="box box-primary box-body">
<table class="table table-bordered">
  <tr>
    <td>Franquicia</td>
    <td><?php echo FranchiseData::getById($well->franchise_id)->name; ?></td>
  </tr>
  <tr>
    <td>Extraccion</td>
    <td><?php echo $well->no." - ".$well->name; ?></td>
  </tr>
  <tr>
    <td>Fecha del Lectura</td>
    <td><?php echo $f->date_at; ?></td>
  </tr>
  <?php if($val_prev!=null):?>
  <tr>
    <td>Valor de la lectura anterior</td>
    <td><?php echo $val_prev->val; ?></td>
  </tr>
<?php endif; ?>
  <tr>
    <td>Valor de la lectura</td>
    <td><?php echo $f->val; ?></td>
  </tr>
  <?php if($val_prev!=null):?>
  <tr>
    <td>Diferencia</td>
    <td><?php echo $f->val-$val_prev->val; ?></td>
  </tr>
  <tr>
    <td>Por pagar</td>
    <td>$ <?php 
    $diff=$f->val-$val_prev->val;
    if($fra->kind_drna==1){
      $dx=$diff/1000000;
      echo $dx*150;
    } 
    else if($fra->kind_drna==2){
      //$dx=$diff/1000000;
      echo $diff*0.002;
    } 
    else if($fra->kind_drna==3){
      $dx=$diff/1000000;
      echo $dx*500;
    } 
    ?></td>
  </tr>
<?php endif; ?>
  <tr>
    <td>Unidad</td>
    <td><?php if($well->unit==1){ echo "Galones"; }else if($well->unit==2){ echo "Metros cubicos"; }  ?></td>
  </tr>
  <tr>
    <td>Frecuencia de la lectura</td>
    <td><?php  if($f->k==1){ echo "Mensual"; }elseif($f->k==2){ echo "Diaria"; }  ?></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><?php $u= UserData::getById($f->user_id); echo $u->name." ".$u->lastname; ?></td>
  </tr>


</table>
</div>
      </div>
    </div>
<?php endif;?>
