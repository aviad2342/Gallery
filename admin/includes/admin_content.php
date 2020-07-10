<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>

        <div class="row">
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-th fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge-panel"><?php echo Album::countRecords($session->user_id); ?></div>
                              <div>Albums</div>
                          </div>
                      </div>
                  </div>
                  <a href="albums.php">
                      <div class="panel-footer">
                        <span class="pull-left">View Albums</span> 
                     <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span> 
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>

           <div class="col-lg-3 col-md-6">
              <div class="panel panel-red">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-photo fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge-panel"><?php echo Photo::countRecords(); ?></div>
                              <div>Photos</div>
                          </div>
                      </div>
                  </div>
                  <a href="photos.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Photos in Gallery</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>


           <div class="col-lg-3 col-md-6">
              <div class="panel panel-yellow">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-user fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge-panel"><?php echo User::countRecords(); ?></div>
                              <div>Users</div>
                          </div>
                      </div>
                  </div>
                  <a href="users.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Users</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>

            <div class="col-lg-3 col-md-6">
              <div class="panel panel-green">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-fw fa-edit fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge-panel"><?php echo Comment::countRecords(); ?></div>
                              <div>Comments</div>
                          </div>
                      </div>
                  </div>
                  <a href="comments.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Comments</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>


          </div> <!--First Row-->

          <div class="row">
            <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
          </div>

        </div>
    </div> <!-- /.row -->
</div><!-- /.container-fluid -->

<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Albums',       <?php echo Album::countRecords($session->user_id); ?>],
          ['Photos',      <?php echo Photo::countRecords(); ?>],
          ['Users',       <?php echo User::countRecords(); ?>],
          ['Comments',    <?php echo Comment::countRecords(); ?>]
        ]);

        var options = {
          title: 'Activities Chart:',
          backgroundColor: 'transparent',
          pieSliceText: 'value-and-percentage',
          legend: { position: 'left', alignment: 'start', textStyle: {bold: true} },
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>