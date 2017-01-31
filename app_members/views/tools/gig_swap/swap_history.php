<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Gig Swap
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Swap a Gig</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/to-purchase"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">To Purchase</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/swap-queue"><i class="fa fa-lg fa-fw fa-clock-o"></i> <span class="menu-item-parent">Swap Queue</span></a>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig-swap/swap-history"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Swap History</span></a>
         </li>
         <!-- <li>
            <a href="<?= base_url(); ?>tools/gig-swap/tool-training"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">Tool Training</a>
         </li> -->
         <?php $this->load->view('quick_links'); ?>
      </ul>
   </nav>


   <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
   </span>

</aside>


<div id="main" role="main" class="gs-img">

   <div id="ribbon">
      <ol class="breadcrumb">
         <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
         <li><a href="<?= base_url(); ?>tools">Tools</a></li>
         <li><a href="<?= base_url(); ?>tools/gig-swap">Gig Swap</a></li>
         <li>Swap History</li>
      </ol>
   </div>

   <div id="content">


   <div class="text-right">
      <a href="<?= base_url(); ?>tools/gig-swap" class="btn btn-warning" style="font-weight: 800;">Swap a Gig</a>
    </div>
    <br>


      <section id="widget-grid" class="">

         <div class="row">

            <article class="col-md-12">
               <div class="jarviswidget" id="wdg-gs-pending" data-widget-editbutton="false" data-widget-deletebutton="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-clock-o"></i> </span>
                     <h2>Swap History</h2>
                  </header>
                  <div>
                     <div class="widget-body no-padding">

                        <table id="dt_gs_pending_list" class="table table-striped table-bordered table-hover" width="100%">
                           <thead>
                              <tr>
                                 <th data-class="expand">Gig Image</th>
                                 <th data-hide="phone,tablet">Gig Title</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?= $swapped_list; ?>
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

<style type="text/css">
   .gs-img img {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 2px;
      padding: 2px;
      width: 100px;
   }
</style>

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

      $('#dt_gs_pending_list').dataTable({
         "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
         "t"+
         "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
         "autoWidth" : true,

         "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
               responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_gs_pending_list'), breakpointDefinition);
            }
         },
         "rowCallback" : function(nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
         },
         "drawCallback" : function(oSettings) {
            responsiveHelper_dt_basic.respond();
         }
      });

      $('#dt_gs_swapped_list').dataTable({
         "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
         "t"+
         "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
         "autoWidth" : true,

         "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
               responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_gs_swapped_list'), breakpointDefinition);
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