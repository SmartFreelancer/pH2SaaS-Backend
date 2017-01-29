<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Monthly Bonus
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <?php $this->load->view('extras/side_nav'); ?>
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
         <li>Monthly Bonus</li>
      </ol>
   </div>

   <div id="content">
      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="jarviswidget" id="wdg-mb" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                     <h2>Monthly Bonus</h2>
                  </header>

                  <div>
                     <div class="widget-body">

                        <div class="page-error">
                           <i class="fa fa-laptop fa-5x text-primary"></i>
                           <br>
                           <h3 class="text-center">The monthly bonus for this month is currently not out as yet!</h3>
                        </div>

                     </div>
                  </div>

               </div>
            </article>
         </div>

      </section>

   </div>
</div>

<script language='javascript' type="text/javascript">
   $('li#monthly-bonus-nav').addClass('active'); // make the current nav active
</script>