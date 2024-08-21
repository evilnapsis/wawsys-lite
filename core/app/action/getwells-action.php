<?php
$wells = WellData::getAllByF($_GET["f"]);
?> 
<?php if(count($wells)>0):?>
      <option value="">-- SELECCIONE --</option>
      <?php foreach($wells as $k):
      $unit = "";
      if($k->unit==1){ $unit = "Galones"; }
      else if($k->unit==2){ $unit="Metros cubicos";}
      ?>
      <option value="<?php echo $k->id; ?>"><?php echo $k->no." - ".$k->name." [".$unit."]"; ?></option>
    <?php endforeach;?>
<?php else:?>
      <option value="">-- NO HAY EXTRACCIONES --</option>
<?php endif; ?>
