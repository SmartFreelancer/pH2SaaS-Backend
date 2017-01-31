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
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig-swap/to-purchase"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">To Purchase</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/swap-queue"><i class="fa fa-lg fa-fw fa-clock-o"></i> <span class="menu-item-parent">Swap Queue</span></a>
         </li>
         <li>
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


<div id="main" role="main">

   <div id="ribbon">
      <ol class="breadcrumb">
         <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
         <li><a href="<?= base_url(); ?>tools">Tools</a></li>
         <li><a href="<?= base_url(); ?>tools/gig-swap">Gig Swap</a></li>
         <li>To Purchase</li>
      </ol>
   </div>

   <div id="content">


      <div class="alert alert-info">
         This section consist of the gigs you need to purchase in order to complete the swap.
      </div>

      <section id="widget-grid" class="">

         <div class="jarviswidget" id="wdg-gs-purchase" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
            <header>
               <span class="widget-icon"> <i class="fa fa-shopping-cart"></i> </span>
               <h2>To Purchase</h2>
            </header>
            <div>
               <div class="widget-body no-padding" id="gs-gig-list">

                  <table id="dt_swap_claim_list" class="table table-striped table-bordered table-hover" width="100%">
                     <thead>
                        <tr>
                           <th data-class="expand">Gig Image</th>
                           <th data-hide="phone,tablet">Gig Title</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?= $swap_claim_list; ?>
                     </tbody>
                  </table>

               </div>
            </div>
         </div>

      </section>

   </div>
</div>

<style type="text/css">
   #gs-gig-list img {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 2px;
      padding: 2px;
      width: 120px;
      border-radius: 50%;
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

      $('#dt_swap_claim_list').dataTable({
         "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
         "t"+
         "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
         "autoWidth" : true,

         "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
               responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_swap_claim_list'), breakpointDefinition);
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