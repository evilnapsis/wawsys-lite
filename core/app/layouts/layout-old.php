<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <title>Wawsys - Dashboard</title>

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- DEMO ONLY: Function for the proper stylesheet loading according to the demo settings -->
  <script>function _pxDemo_loadStylesheet(a,b,c){var c=c||decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"clean"),d="rtl"===document.getElementsByTagName("html")[0].getAttribute("dir");document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/,'<link href="$1'+(c.indexOf("dark")!==-1&&a.indexOf("/css/")!==-1&&a.indexOf("/themes/")===-1?"-dark":"")+(!d||0!==a.indexOf("assets/css")&&0!==a.indexOf("assets/demo")?"":".rtl")+'$2" rel="stylesheet" type="text/css"'+(b?'class="'+b+'"':"")+">"))}</script>

  <!-- DEMO ONLY: Load PixelAdmin core stylesheets -->
  <script>
    _pxDemo_loadStylesheet('assets/css/bootstrap.min.css', 'px-demo-stylesheet-bs');
    _pxDemo_loadStylesheet('assets/css/pixeladmin.min.css', 'px-demo-stylesheet-core');
    _pxDemo_loadStylesheet('assets/css/widgets.min.css', 'px-demo-stylesheet-widgets');
  </script>

  <!-- DEMO ONLY: Load theme -->
  <script>
    function _pxDemo_loadTheme(a){var b=decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"clean");_pxDemo_loadStylesheet(a+b+".min.css","px-demo-stylesheet-theme",b)}
    _pxDemo_loadTheme('assets/css/themes/');
  </script>

  <!-- holder.js -->
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>

  <!-- Pace.js -->
  <script src="res/js/jquery.min.js"></script>
  <script src="assets/pace/pace.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyB32J3yOLlwVphYyWsD5LnS53LrKlbUJ3w"></script>
  <script src="assets/demo/demo.js"></script>

  <script src="res/if_gmap.js"></script>

  <!-- Custom styling -->
  <style>
    .page-header-form .input-group-addon,
    .page-header-form .form-control {
      background: rgba(0,0,0,.05);
    }

  </style>
  <!-- / Custom styling -->
</head>
<body>
<?php if(isset($_SESSION["user_id"])):?>
  <nav class="px-nav px-nav-left">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
      <span class="px-nav-toggle-arrow"></span>
      <span class="navbar-toggle-icon"></span>
      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content">
<!--
      <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="assets/demo/avatars/1.jpg" alt="" class="pull-xs-left m-r-2 border-round" style="width: 54px; height: 54px;">
        <div class="font-size-16"><span class="font-weight-light">Welcome, </span><strong>John</strong></div>
        <div class="btn-group" style="margin-top: 4px;">
          <a href="#" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-envelope"></i></a>
          <a href="#" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-user"></i></a>
          <a href="#" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-cog"></i></a>
          <a href="#" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-power-off"></i></a>
        </div>
      </li>
-->
      <li class="px-nav-item">
        <a href="./"><i class="px-nav-icon fa fa-home"></i><span class="px-nav-label">Inicio</span></a>
      </li>
      <li class="px-nav-item">
        <a href="./?view=vals&opt=all"><i class="px-nav-icon fa fa-dashboard"></i><span class="px-nav-label">Lecturas</span></a>
      </li>
      <li class="px-nav-item">
        <a href="./?view=wells&opt=all"><i class="px-nav-icon fa fa-circle-o"></i><span class="px-nav-label">Extracciones</span></a>
      </li>
      <li class="px-nav-item">
        <a href="./?view=franqs&opt=all"><i class="px-nav-icon fa fa-institution"></i><span class="px-nav-label">Franquicias</span></a>
      </li>
      <li class="px-nav-item">
        <a href="./?view=meters&opt=all"><i class="px-nav-icon fa fa-cube"></i><span class="px-nav-label">Certificacion Metros</span></a>
      </li>

      <li class="px-nav-item">
        <a href="./?view=users&o=all"><i class="px-nav-icon fa fa-users"></i><span class="px-nav-label">Usuarios</span></a>
      </li>
      <!--
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-ios-pulse-strong"></i><span class="px-nav-label">Dashboards<span class="label label-danger">5</span></span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item"><a href="index.html"><span class="px-nav-label">Default</span></a></li>
          <li class="px-nav-item"><a href="dashboards-analytics.html"><span class="px-nav-label">Analytics</span></a></li>
          <li class="px-nav-item"><a href="dashboards-videos.html"><span class="px-nav-label">Videos</span></a></li>
          <li class="px-nav-item"><a href="dashboards-financial.html"><span class="px-nav-label">Financial</span></a></li>
          <li class="px-nav-item"><a href="dashboards-blog.html"><span class="px-nav-label">Blog</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-erlenmeyer-flask"></i><span class="px-nav-label">Widgets</span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item"><a href="widgets-lists.html"><span class="px-nav-label">Lists</span></a></li>
          <li class="px-nav-item"><a href="widgets-pricing.html"><span class="px-nav-label">Pricing</span></a></li>
          <li class="px-nav-item"><a href="widgets-timeline.html"><span class="px-nav-label">Timeline</span></a></li>
          <li class="px-nav-item"><a href="widgets-misc.html"><span class="px-nav-label">Misc</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item">
        <a href="utilities.html"><i class="px-nav-icon ion-cube"></i><span class="px-nav-label">Utilities</span></a>
      </li>
      <li class="px-nav-item px-nav-dropdown">
        <a href="#"><i class="px-nav-icon ion-monitor"></i><span class="px-nav-label">UI elements</span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item"><a href="ui-buttons.html"><span class="px-nav-label">Buttons</span></a></li>
          <li class="px-nav-item"><a href="ui-tabs.html"><span class="px-nav-label">Tabs & Accordions</span></a></li>
          <li class="px-nav-item"><a href="ui-modals.html"><span class="px-nav-label">Modals</span></a></li>
          <li class="px-nav-item"><a href="ui-alerts.html"><span class="px-nav-label">Alerts & Tooltips</span></a></li>
          <li class="px-nav-item"><a href="ui-panels.html"><span class="px-nav-label">Panels</span></a></li>
          <li class="px-nav-item"><a href="ui-sortable.html"><span class="px-nav-label">Sortable</span></a></li>
          <li class="px-nav-item"><a href="ui-carousel.html"><span class="px-nav-label">Carousel</span></a></li>
          <li class="px-nav-item"><a href="ui-misc.html"><span class="px-nav-label">Misc</span></a></li>
        </ul>
      </li>

      <li class="px-nav-item">
        <a href="../color_generator/index.html"><i class="px-nav-icon ion-aperture"></i><span class="px-nav-label">Color Generator</span></a>
      </li>
  -->
    </ul>
  </nav>

  <nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
      <a class="navbar-brand px-demo-brand" href="index.html"><span class="px-demo-logo bg-primary"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span>Wawsys</a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav">
        <!--
        <li class="dropdown">
          <a href class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
          <div class="dropdown-multi-column">
            <ul class="dropdown-menu dropdown-column col-md-4">
              <li class="dropdown-header">Business</li>
              <li><a href="#">Design &amp; Urban Ecologies</a></li>
            </ul>
            <ul class="dropdown-menu dropdown-column col-md-4">
              <li class="dropdown-header">Liberal Arts</li>
              <li><a href="#">Anthropology</a></li>
            </ul>
            <ul class="dropdown-menu dropdown-column col-md-4">
              <li class="dropdown-header">Social Sciences</li>
              <li><a href="#">Food Studies</a></li>
            </ul>
          </div>
        </li>

        <li class="dropdown">
          <a href class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bookmark m-r-1"></i>Links</a>
          <ul class="dropdown-menu">
            <li class="dropdown-toggle">
              <a href>Products</a>
              <ul class="dropdown-menu">
                <li><a href="#">All</a></li>
              </ul>
            </li>
            <li class="dropdown-toggle">
              <a href>Users</a>
              <ul class="dropdown-menu">
                <li><a href="#">All</a></li>
              </ul>
            </li>
            <li class="dropdown-toggle">
              <a href>Blog</a>
              <ul class="dropdown-menu">
                <li><a href="#">All</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-edit m-r-1"></i>New blog post</a></li>
              </ul>
            </li>
            <li class="divider"></li>
            <li><a href="#">Overview</a></li>
          </ul>
        </li>
        -->
      </ul>

      <ul class="nav navbar-nav navbar-right">
      <!--
        <li class="dropdown">
          <a href="https://stackoverflow.com" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="px-navbar-icon fa fa-bullhorn font-size-14"></i>
            <span class="px-navbar-icon-label">Notifications</span>
            <span class="px-navbar-label label label-success">5</span>
          </a>
          <div class="dropdown-menu p-a-0" style="width: 300px">
            <div id="navbar-notifications" style="height: 280px; position: relative;">
              <div class="widget-notifications-item">
                <div class="widget-notifications-title text-danger">SYSTEM</div>
                <div class="widget-notifications-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
                <div class="widget-notifications-date">12h ago</div>
                <div class="widget-notifications-icon fa fa-hdd-o bg-danger"></div>
              </div>

            </div>

            <a href="#" class="widget-more-link">MORE NOTIFICATIONS</a>
          </div>
        </li>

        <li class="dropdown">
          <a href="https://google.com" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="px-navbar-icon fa fa-envelope font-size-14"></i>
            <span class="px-navbar-icon-label">Income messages</span>
            <span class="px-navbar-label label label-danger">8</span>
          </a>
          <div class="dropdown-menu p-a-0" style="width: 300px;">
            <div id="navbar-messages" style="height: 280px; position: relative;">
              <div class="widget-messages-alt-item">
                <img src="assets/demo/avatars/2.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                <div class="widget-messages-alt-description">from <a href="#">Robert Jang</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

            </div>

            <a href="#" class="widget-more-link">MORE MESSAGES</a>
          </div> 
        </li>

     <li>
          <form class="navbar-form" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search" style="width: 140px;">
            </div>
          </form>
        </li>
-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<!--            <img src="assets/demo/avatars/1.jpg" alt="" class="px-navbar-image"> -->
            <span class="hidden-md"><?php echo Core::$user->name." ".Core::$user->lastname; ?></span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
<!--
            <li><a href="pages-profile-v2.html"><span class="label label-warning pull-xs-right"><i class="fa fa-asterisk"></i></span>Profile</a></li>
            <li><a href="pages-account.html">Account</a></li>
            <li><a href="pages-messages-list.html"><i class="dropdown-icon fa fa-envelope"></i>&nbsp;&nbsp;Messages</a></li>
            <li class="divider"></li>
            -->
            <li><a href="./?action=access&o=logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesion</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>

  <div class="px-content">
  <?php View::load("index");?>
  </div>

  <footer class="px-footer px-footer-bottom p-t-0">


<br>
    <span class="text-muted">Copyright © 2017 Evilnapsis.</span>
  </footer>
<?php else:?>

<div class="row">
<div class="col-md-4 col-md-offset-4 ">
<center>
  <h1>Wawsys</h1>
</center>
              <form method="post" action="./?action=access&o=login" class="p-a-4" id="page-signin-form">
                <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Acceder</h4>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <input type="text" name="username" required class="page-signin-form-control form-control" placeholder="Nombre de usuario">
                </fieldset>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <input type="password" name="password" required class="page-signin-form-control form-control" placeholder="Password">
                </fieldset>


                <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Acceder</button>
              </form>
              </div>
              </div>
<?php endif; ?>
  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- jQuery
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
-->
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/pixeladmin.min.js"></script>

  <script>
    // -------------------------------------------------------------------------
    // Initialize DEMO sidebar

    $(function() {
      pxDemo.initializeDemoSidebar();

      $('#px-demo-sidebar').pxSidebar();
      pxDemo.initializeDemo();
    });
  </script>

  <script type="text/javascript">
    // -------------------------------------------------------------------------
    // Initialize DEMO

    $(function() {
      var file = String(document.location).split('/').pop();

      // Remove unnecessary file parts
      file = file.replace(/(\.html).*/i, '$1');

      if (!/.html$/i.test(file)) {
        file = 'index.html';
      }

      // Activate current nav item
      $('body > .px-nav')
        .find('.px-nav-item > a[href="' + file + '"]')
        .parent()
        .addClass('active');

      $('body > .px-nav').pxNav();
      $('body > .px-footer').pxFooter();

      $('#navbar-notifications').perfectScrollbar();
      $('#navbar-messages').perfectScrollbar();
    });
  </script>

  <script>
    // -------------------------------------------------------------------------
    // Initialize uploads chart

    $(function() {
      var data = [
        { day: '2014-03-10', v: pxDemo.getRandomData(20, 5) },
        { day: '2014-03-11', v: pxDemo.getRandomData(20, 5) },
        { day: '2014-03-12', v: pxDemo.getRandomData(20, 5) },
        { day: '2014-03-13', v: pxDemo.getRandomData(20, 5) },
        { day: '2014-03-14', v: pxDemo.getRandomData(20, 5) },
        { day: '2014-03-15', v: pxDemo.getRandomData(20, 5) },
        { day: '2014-03-16', v: pxDemo.getRandomData(20, 5) }
      ];

      new Morris.Line({
        element: 'hero-graph',
        data: data,
        xkey: 'day',
        ykeys: ['v'],
        labels: ['Value'],
        lineColors: ['#fff'],
        lineWidth: 2,
        pointSize: 4,
        gridLineColor: 'rgba(255,255,255,.5)',
        resize: true,
        gridTextColor: '#fff',
        xLabels: "day",
        xLabelFormat: function(d) {
          return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
        },
      });
    });

    // -------------------------------------------------------------------------
    // Initialize easy pie charts

    $(function() {
      var colors = pxDemo.getRandomColors();

      var config = {
        animate: 2000,
        scaleColor: false,
        lineWidth: 4,
        lineCap: 'square',
        size: 90,
        trackColor: 'rgba(0, 0, 0, .09)',
        onStep: function(_from, _to, currentValue) {
          var value = $(this.el).attr('data-max-value') * currentValue / 100;

          $(this.el)
            .find('> span')
            .text(Math.round(value) + $(this.el).attr('data-suffix'));
        },
      }

      var data = [
        pxDemo.getRandomData(1000, 1),
        pxDemo.getRandomData(100, 1),
        pxDemo.getRandomData(64, 1),
      ];

      $('#easy-pie-chart-1')
        .attr('data-percent', (data[0] / 1000) * 100)
        .attr('data-max-value', 1000)
        .easyPieChart($.extend({}, config, { barColor: colors[0] }));

      $('#easy-pie-chart-2')
        .attr('data-percent', (data[1] / 100) * 100)
        .attr('data-max-value', 100)
        .easyPieChart($.extend({}, config, { barColor: colors[1] }));

      $('#easy-pie-chart-3')
        .attr('data-percent', (data[2] / 64) * 100)
        .attr('data-max-value', 64)
        .easyPieChart($.extend({}, config, { barColor: colors[2] }));
    });

    // -------------------------------------------------------------------------
    // Initialize retweets graph

    $(function() {
      var data = [
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
      ];

      $("#sparkline-1").pxSparkline(data, {
        type: 'line',
        width: '100%',
        height: '42px',
        fillColor: '',
        lineColor: '#fff',
        lineWidth: 2,
        spotColor: '#ffffff',
        minSpotColor: '#ffffff',
        maxSpotColor: '#ffffff',
        highlightSpotColor: '#ffffff',
        highlightLineColor: '#ffffff',
        spotRadius: 4,
      });
    });

    // -------------------------------------------------------------------------
    // Initialize Monthly visitor statistics graph

    $(function() {
      var data = [
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
        pxDemo.getRandomData(300, 100),
      ];

      $("#sparkline-2").pxSparkline(data, {
        type: 'bar',
        height: '42px',
        width: '100%',
        barSpacing: 2,
        zeroAxis: false,
        barColor: '#ffffff',
      });
    });

    // -------------------------------------------------------------------------
    // Initialize scrollbars

    $(function() {
      $('#support-tickets').perfectScrollbar();
      $('#comments').perfectScrollbar();
      $('#threads').perfectScrollbar();
    });
  </script>
</body>
</html>
