


      <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
      <script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url(); ?>assets/js/plugin/pace/pace.min.js"></script>

      <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script>
         if (!window.jQuery) {
            document.write('<script src="<?= base_url(); ?>assets/js/libs/jquery-2.1.1.min.js"><\/script>');
         }
      </script>

      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
      <script>
         if (!window.jQuery.ui) {
            document.write('<script src="<?= base_url(); ?>assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
         }
      </script>

      <!-- IMPORTANT: APP CONFIG -->
      <script src="<?= base_url(); ?>assets/js/app.config.js"></script>

      <!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
      <script src="<?= base_url(); ?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

      <!-- BOOTSTRAP JS -->
      <script src="<?= base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
      <!-- browser msie issue fix -->
      <script src="<?= base_url(); ?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

      <!-- FastClick: For mobile devices -->
      <script src="<?= base_url(); ?>assets/js/plugin/fastclick/fastclick.min.js"></script>

      <!--[if IE 8]>
         <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
      <![endif]-->

      <!-- MAIN APP JS FILE -->
      <script src="<?= base_url(); ?>assets/js/app.min.js"></script>



      <!-- PAGE RELATED PLUGIN(S)
      <script src="..."></script>-->

      <script type="text/javascript">

         $(document).ready(function() {

            /* DO NOT REMOVE : GLOBAL FUNCTIONS!
             *
             * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
             *
             * // activate tooltips
             * $("[rel=tooltip]").tooltip();
             *
             * // activate popovers
             * $("[rel=popover]").popover();
             *
             * // activate popovers with hover states
             * $("[rel=popover-hover]").popover({ trigger: "hover" });
             *
             * // activate inline charts
             * runAllCharts();
             *
             * // setup widgets
             * setup_widgets_desktop();
             *
             * // run form elements
             * runAllForms();
             *
             ********************************
             *
             * pageSetUp() is needed whenever you load a page.
             * It initializes and checks for all basic elements of the page
             * and makes rendering easier.
             *
             */

             pageSetUp();

            /*
             * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
             * eg alert("my home function");
             *
             * var pagefunction = function() {
             *   ...
             * }
             * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
             *
             * TO LOAD A SCRIPT:
             * var pagefunction = function (){
             *  loadScript(".../plugin.js", run_after_loaded);
             * }
             *
             * OR
             *
             * loadScript(".../plugin.js", run_after_loaded);
             */

         })

      </script>

   </body>

</html>