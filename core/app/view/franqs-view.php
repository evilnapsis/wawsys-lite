<?php if(isset($_GET["opt"])&&$_GET["opt"]=="all"):
$fs = FranchiseData::getAll();
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Franquicias</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="page-header-icon fa fa-institution"></i>Franquicias</h1>
          <br>
          <a href="./?view=franqs&opt=new" class="btn btn-primary">Nueva Franquicia</a>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

        <!-- New users -->
<?php if(count($fs)>0):?>
        <div class="box box-primary box-body">

          <div class="">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Nombre del peticionario</th>
                  <th>Tipo de actividad</th>
                  <th>Fecha de expedicion</th>
                  <th>Fecha de expiracion</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="valign-middle">
                <?php foreach($fs as $f):?>
                <tr>
                  <td><a href='./?view=franqs&opt=one&id=<?php echo $f->id; ?>'><?php echo $f->no; ?></a></td>
                  <td><?php echo $f->name; ?></td>
                  <td><?php echo $f->name_owner; ?></td>
                  <td><?php echo KData::getById($f->k_id)->name; ?></td>
                  <td><?php echo $f->start_at; ?></td>
                  <td><?php echo $f->expire_at; ?></td>


                  <td>
                    <a href="./?view=franqs&opt=edit&id=<?php echo $f->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                    <a href="./?action=franchs&opt=del&id=<?php echo $f->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                  </td>
                <?php endforeach; ?>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      <?php else:?>
        <p class="alert alert-warning">No hay Franquicias</p>
<?php endif; ?>
        <!-- / New users -->

      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="new"):?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Franquicias</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-institution"></i>Nueva Franquicia</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

<div class="box box-primary">
<div class="box-body">

<form method="post" action="./?action=franchs&opt=add">



<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basico</a></li>
    <li role="presentation"><a href="#postal" aria-controls="postal" role="tab" data-toggle="tab">Direccion Postal</a></li>
    <li role="presentation"><a href="#fisic" aria-controls="fisic" role="tab" data-toggle="tab">Direccion Fisica</a></li>
    <li role="presentation"><a href="#da" aria-controls="da" role="tab" data-toggle="tab">Derecho Adquirido</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="basic">

  <div class="form-group">
    <label for="exampleInputEmail1">Nombre de la franquicia</label>
    <input type="text" name="name" class="form-control"  placeholder="Nombre de la franquicia">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre de el peticionario</label>
    <input type="text" name="name_owner" class="form-control"  placeholder="Nombre de el peticionario">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero de la franquicia</label>
    <input type="text" name="no" class="form-control"  placeholder="Numero de la franquicia">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero del Expediente DFA</label>
    <input type="text" name="no_dfa" class="form-control"  placeholder="Numero del expediente DFA">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero del Expediente DFC</label>
    <input type="text" name="no_dfc" class="form-control"  placeholder="Numero del expediente DFC">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de expedicion</label>
    <input type="date" name="start_at" class="form-control pickadate" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de expiracion</label>
    <input type="date" name="expire_at" class="form-control pickadate" >
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de actividad</label>
    <select class="form-control" name="k_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(KData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de Franquicia</label>
    <select class="form-control" name="kind_drna" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Franquicia de agua salobre o de mar</option>
      <option value="2">Franquicia para uso industrial o comercial</option>
      <option value="3">Toma superficial</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Caudal de agua autorizada a extraer anualmente</label>
    <input type="text" name="caudal" class="form-control" >
  </div>

<h3>Tarifa</h3>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo Tarifa</label>
    <select class="form-control" name="kind_tariff" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Mensual</option>
      <option value="2">Anual</option>
      <option value="3">No Tarifa</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tarifa</label>
    <input type="text" name="tariff" class="form-control" >
  </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="postal">
  <div class="form-group">
    <label for="exampleInputEmail1">Direccion</label>
    <input type="text" name="p_address" class="form-control"  placeholder="Direccion">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Ciudad</label>
    <input type="text" name="p_city" class="form-control"  placeholder="Ciudad">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Pais</label>
    <select class="form-control" name="p_country_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(CountryData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Codigo Postal</label>
    <input type="text" name="p_cp" class="form-control"  placeholder="Codigo Postal">
  </div>      

    </div>
    <div role="tabpanel" class="tab-pane" id="fisic">

  <div class="form-group">
    <label for="exampleInputEmail1">Direccion</label>
    <input type="text" name="f_address" class="form-control"  placeholder="Direccion">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Ciudad</label>
    <input type="text" name="f_city" class="form-control"  placeholder="Ciudad">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Pais</label>
    <select class="form-control" name="f_country_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(CountryData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Codigo Postal</label>
    <input type="text" name="f_cp" class="form-control"  placeholder="Codigo Postal">
  </div>


    </div>
    <div role="tabpanel" class="tab-pane" id="da">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="da"> Tiene Derecho Adquirido
    </label>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Numero de Derecho Adquirido</label>
    <input type="text" name="da_no" class="form-control"  placeholder="Numero de Derecho Adquirido">
  </div>  
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de Derecho Adquirido</label>
    <select class="form-control" name="da_kind" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1">Individual</option>
      <option value="2">Colectivo</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad ANUAL del derecho adquirido(Galones)</label>
    <input type="text" name="da_year" class="form-control"  placeholder="Cantidad ANUAL del derecho adquirido(Galones)">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad TOTAL del derecho adquirido por vigencia (Galones)</label>
    <input type="text" name="da_total" class="form-control"  placeholder="Cantidad TOTAL del derecho adquirido por vigencia (Galones)">
  </div>

    </div>



  </div>

</div>




<!--
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  -->
  <button type="submit" class="btn btn-primary">Crear Franquicia</button>
</form>

</div>
</div>

      </div>
    </div>

<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="edit"):
$franq = FranchiseData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Franquicias</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-institution"></i> Editar Franquicia</h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">

<div class="box box-primary">
<div class="box-body">
<form method="post" action="./?action=franchs&opt=upd">
<input type="hidden" name="id" value="<?php echo $franq->id; ?>">

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basico</a></li>
    <li role="presentation"><a href="#postal" aria-controls="postal" role="tab" data-toggle="tab">Direccion Postal</a></li>
    <li role="presentation"><a href="#fisic" aria-controls="fisic" role="tab" data-toggle="tab">Direccion Fisica</a></li>
    <li role="presentation"><a href="#da" aria-controls="da" role="tab" data-toggle="tab">Derecho Adquirido</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="basic">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre de la franquicia</label>
    <input type="text" name="name" value="<?php echo $franq->name; ?>" class="form-control"  placeholder="Nombre de la franquicia">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre de el peticionario</label>
    <input type="text" name="name_owner" value="<?php echo $franq->name_owner; ?>" class="form-control"  placeholder="Nombre de el peticionario">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero de la franquicia</label>
    <input type="text" name="no" value="<?php echo $franq->no; ?>" class="form-control"  placeholder="Numero de la franquicia">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero del Expediente DFA</label>
    <input type="text" name="no_dfa" value="<?php echo $franq->no_dfa; ?>" class="form-control"  placeholder="Numero del expediente DFA">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Numero del Expediente DFC</label>
    <input type="text" name="no_dfc" value="<?php echo $franq->no_dfc; ?>" class="form-control"  placeholder="Numero del expediente DFC">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de expedicion</label>
    <input type="date" name="start_at" value="<?php echo $franq->start_at; ?>" class="form-control pickadate" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Fecha de expiracion</label>
    <input type="date" name="expire_at" value="<?php echo $franq->expire_at; ?>" class="form-control pickadate" >
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de actividad</label>
    <select class="form-control" name="k_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(KData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($franq->k_id==$k->id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de Franquicia</label>
    <select class="form-control" name="kind_drna" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1" <?php if($franq->kind_drna==1){ echo "selected"; }?>>Franquicia de agua salobre o de mar</option>
      <option value="2" <?php if($franq->kind_drna==2){ echo "selected"; }?>>Franquicia para uso industrial o comercial</option>
      <option value="3" <?php if($franq->kind_drna==3){ echo "selected"; }?>>Toma superficial</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Caudal de agua autorizada a extraer anualmente</label>
    <input type="text" name="caudal" value="<?php echo $franq->caudal; ?>" class="form-control" >
  </div>

<h3>Tarifa</h3>
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo Tarifa</label>
    <select class="form-control" name="kind_tariff" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1" <?php if($franq->kind_tariff==1){ echo "selected"; }?>>Mensual</option>
      <option value="2" <?php if($franq->kind_tariff==2){ echo "selected"; }?>>Anual</option>
      <option value="3" <?php if($franq->kind_tariff==3){ echo "selected"; }?>>No Tarifa</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tarifa</label>
    <input type="text" name="tariff" value="<?php echo $franq->tariff; ?>" class="form-control" >
  </div>
  </div>
    <div role="tabpanel" class="tab-pane" id="fisic">

  <div class="form-group">
    <label for="exampleInputEmail1">Direccion</label>
    <input type="text" name="f_address" value="<?php echo $franq->f_address; ?>" class="form-control"  placeholder="Direccion">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Ciudad</label>
    <input type="text" name="f_city" value="<?php echo $franq->f_city; ?>" class="form-control"  placeholder="Ciudad">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Pais</label>
    <select class="form-control" name="f_country_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(CountryData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($franq->f_country_id==$k->id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Codigo Postal</label>
    <input type="text" name="f_cp" value="<?php echo $franq->f_cp; ?>" class="form-control"  placeholder="Codigo Postal">
  </div>
  </div>
    <div role="tabpanel" class="tab-pane" id="postal">


  <div class="form-group">
    <label for="exampleInputEmail1">Direccion</label>
    <input type="text" name="p_address" value="<?php echo $franq->p_address; ?>" class="form-control"  placeholder="Direccion">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Ciudad</label>
    <input type="text" name="p_city" value="<?php echo $franq->p_city; ?>" class="form-control"  placeholder="Ciudad">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Pais</label>
    <select class="form-control" name="p_country_id" required>
      <option value="">-- SELECCIONE --</option>
      <?php foreach(CountryData::getAll() as $k):?>
      <option value="<?php echo $k->id; ?>" <?php if($franq->p_country_id==$k->id){ echo "selected"; }?>><?php echo $k->name; ?></option>
    <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Codigo Postal</label>
    <input type="text" name="p_cp" value="<?php echo $franq->p_cp; ?>" class="form-control"  placeholder="Codigo Postal">
  </div>
  </div>

    <div role="tabpanel" class="tab-pane" id="da">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="da" <?php if($franq->da){ echo "checked"; }?>> Tiene Derecho Adquirido
    </label>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Numero de Derecho Adquirido</label>
    <input type="text" name="da_no" value="<?php echo $franq->da_no; ?>" class="form-control"  placeholder="Numero de Derecho Adquirido">
  </div>  
  <div class="form-group">
    <label for="exampleInputPassword1">Tipo de Derecho Adquirido</label>
    <select class="form-control" name="da_kind" required>
      <option value="">-- SELECCIONE --</option>
      <option value="1" <?php if($franq->da_kind==1){ echo "selected"; }?>>Individual</option>
      <option value="2" <?php if($franq->da_kind==2){ echo "selected"; }?>>Colectivo</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad ANUAL del derecho adquirido(Galones)</label>
    <input type="text" name="da_year" value="<?php echo $franq->da_year; ?>" class="form-control"  placeholder="Cantidad ANUAL del derecho adquirido(Galones)">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad TOTAL del derecho adquirido por vigencia (Galones)</label>
    <input type="text" name="da_total" value="<?php echo $franq->da_total; ?>" class="form-control"  placeholder="Cantidad TOTAL del derecho adquirido por vigencia (Galones)">
  </div>

    </div>
  </div>
  </div>
<!--
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  -->
  <button type="submit" class="btn btn-success">Actualizar Franquicia</button>
</form>
</div>
</div>

      </div>
    </div>
<?php elseif(isset($_GET["opt"])&&$_GET["opt"]=="one"):
$f = FranchiseData::getById($_GET["id"]);
?>
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="./">Inicio</a></li>
      <li class="active">Franquicias</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-institution"></i><?php echo $f->name; ?></h1>

        </div>


      </div>
    </div>




    <div class="row">
      <div class="col-md-12">
<div class="panel panel-info panel-dark">
<div class="panel-heading">Datos de la franquicia</div>
<table class="table table-bordered">
  <tr>
    <td>Nombre de la franquicia</td>
    <td><?php echo $f->name; ?></td>
  </tr>
  <tr>
    <td>Nombre del peticionario</td>
    <td><?php echo $f->name_owner; ?></td>
  </tr>
  <tr>
    <td>Numero de la franquicia</td>
    <td><?php echo $f->no; ?></td>
  </tr>
  <tr>
    <td>Numero del expediente DFA</td>
    <td><?php echo $f->no_dfa; ?></td>
  </tr>
  <tr>
    <td>Numero del expediente DFC</td>
    <td><?php echo $f->no_dfc; ?></td>
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
    <td>Tipo de Actividad</td>
    <td><?php echo KData::getById($f->k_id)->name; ?></td>
  </tr>
  <tr>
    <td>Tipo Pago DRNA</td>
    <td>
    <?php switch ($f->kind_drna) {
      case '1': echo "Franquicia de Agua salobre o de Mar";break;
      case '2': echo "Franquicia Para uso industrial o comercial";break;
      case '3': echo "Toma superficial";break;
      default:break;
    } ?>
      
    </td>
  </tr>

  <tr>
    <td>Caudal</td>
    <td><?php echo $f->caudal; ?></td>
  </tr>
  <tr>
    <td>Tipo Tarifa</td>
    <td>
    <?php switch ($f->kind_tariff) {
      case '1': echo "Mensual";break;
      case '2': echo "Anual";break;
      default:break;
    } ?>
      
    </td>
  </tr>
  <tr>
    <td>Tarifa</td>
    <td>$ <?php echo $f->tariff; ?></td>
  </tr>

  <tr>
    <td>Direccion Postal</td>
    <td><?php echo $f->f_address; ?></td>
  </tr>
  <tr>
    <td>Ciudad Postal</td>
    <td><?php echo $f->f_city; ?></td>
  </tr>
  <tr>
    <td>Pais</td>
    <td><?php echo CountryData::getById($f->f_country_id)->name; ?></td>
  </tr>
  <tr>
    <td>Codigo Postal</td>
    <td><?php echo $f->f_cp; ?></td>
  </tr>
 <tr>
    <td>Direccion Fisical</td>
    <td><?php echo $f->p_address; ?></td>
  </tr>
  <tr>
    <td>Ciudad Fisica</td>
    <td><?php echo $f->p_city; ?></td>
  </tr>
  <tr>
    <td>Pais (Fisico)</td>
    <td><?php echo CountryData::getById($f->p_country_id)->name; ?></td>
  </tr>
  <tr>
    <td>Codigo Postal (Fisico)</td>
    <td><?php echo $f->f_cp; ?></td>
  </tr>
    <tr>
    <td>Derecho Adquirido</td>
    <td><?php if($f->da){ echo "<i class='fa fa-check'></a>"; } ?></td>
  </tr>
  <tr>
    <td>Tipo de Derecho Adquirido</td>
    <td>
    <?php switch ($f->da_kind) {
      case '1': echo "Individual";break;
      case '2': echo "Colectivo";break;
      default:break;
    } ?>
      
    </td>
  </tr>
  <tr>
    <td>Numero de Derecho Adquirido</td>
    <td><?php echo $f->da_no; ?></td>
  </tr>
  <tr>
    <td>Derecho Adquirido ANUAL</td>
    <td><?php echo $f->da_year; ?></td>
  </tr>
  <tr>
    <td>Derecho Adquirido TOTAL</td>
    <td><?php echo $f->da_total; ?></td>
  </tr>
</table>
</div>
      </div>
    </div>
<?php endif;?>
