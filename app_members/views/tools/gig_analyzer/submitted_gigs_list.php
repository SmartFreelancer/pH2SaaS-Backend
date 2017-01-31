<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Gig Analyzer
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Overview</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer/submit_gig"><i class="fa fa-lg fa-fw fa-magic"></i> <span class="menu-item-parent">Submit a Gig</span></a>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">My Submitted Gigs</span></a>
         </li>
         <?php $this->load->view('quick_links'); ?>
      </ul>
   </nav>

   <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
   </span>

</aside>


<div id="main" role="main">

    <div id="ribbon">
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?= base_url(); ?>tools">Tools</a></li>
            <li><a href="<?= base_url(); ?>tools/gig_analyzer">Gig Analyzer</a></li>
            <li>My Submitted Gigs</li>
        </ol>
    </div>

    <div id="content" class="ga-gig-list">

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget" id="ga-sgig-list" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-newspaper-o"></i> </span>
                            <h2>Gig Analyzer</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <table id="dt_gig_list" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th data-class="expand">Gig Image</th>
                                            <th data-hide="phone,tablet">Gig Title</th>
                                            <th data-hide="phone,tablet">Date Submited</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $gig_list; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </section>

    </div>

</div>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var responsiveHelper_dt_basic = undefined;
        var breakpointDefinition = {
          tablet : 1024,
          phone : 480
       };

       $('#dt_gig_list').dataTable({
          "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
          "t"+
          "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
          "autoWidth" : true,

          "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
             if (!responsiveHelper_dt_basic) {
                 responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_gig_list'), breakpointDefinition);
             }
          },
          "rowCallback" : function(nRow) {
              responsiveHelper_dt_basic.createExpandIcon(nRow);
          },
          "drawCallback" : function(oSettings) {
              responsiveHelper_dt_basic.respond();
          }
       });

    })
</script>