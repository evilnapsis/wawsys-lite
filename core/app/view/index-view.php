    <section class="content-header">
      <h1>
        Water Well System
      </h1>
    </section>
<section class="content">
<?php if(Core::$user->kind==1):?>  
        <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-circle-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pozos</span>
              <span class="info-box-number"><?php echo count(WellData::getAll());?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-institution"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Franquicias</span>
              <span class="info-box-number"><?php echo count(FranchiseData::getAll());?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

     <!--   <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
          </div>
        </div>-->
        <!-- /.col -->
       <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
          </div>
</div>-->
</div>
<?php else:?>
<?php endif; ?>
</section>
