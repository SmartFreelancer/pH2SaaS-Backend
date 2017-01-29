<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Community
         </span>
      </span>
   </div>

   <nav>
      <center>
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Filter by category
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
  <?php foreach ($category_list as $item) { ?>
                           <li>
                              <a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>"><?= $item['title']; ?> </a>
                           </li>
                        <?php } ?>
  </ul>
</div>

      </center>
      <br>
      <ul>
         <li id="overview">
            <a href="<?= base_url(); ?>community"><i class="fa fa-lg fa-fw fa fa-comment"></i> <span class="menu-item-parent">Community Overview</a>
         </li>
         <li id="user-quest">
            <a href="<?= base_url(); ?>community/user-question"><i class="fa fa-lg fa-fw fa-user-plus "></i> <span class="menu-item-parent">My Questions</span></a>
         </li>
         <li id="unanswered">
            <a href="<?= base_url(); ?>community/unanswered"><i class="fa fa-lg fa-fw fa fa-question-circle"><em class="bg-color-pink flash animated"><?= $total_unanswered; ?></em></i> <span class="menu-item-parent">Unanswered</a>
         </li>
      </ul>
   </nav>

   <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
   </span>

</aside>

<!-- Modal -->
<div class="modal fade" id="post_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
               &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">Ask New Question</h4>
         </div>
         <div class="modal-body">

            <div id="process-msg" role="alert" style="display:none">
               <button type="button" class="close"><i class="fa fa-times"></i></button>
               <strong></strong>
            </div>

            <form id="process-form">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Question Title">
                     </div>
                     <div class="form-group">
                        <textarea class="form-control" name="msg" id="msg" placeholder="What would you like to know or need help with?" rows="5"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category">
                           <option value="">Please Select</option>
                           <?php foreach ($category_list as $item) { ?>
                              <option value="<?= $item['cat_id']; ?>"><?= $item['title']; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
               </div>


         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
               Cancel
            </button>
            <button type="submit" class="btn btn-primary">
               <i class="fa fa-paper-plane"></i> Post Question
            </button>
            <span id="process-loader">
               <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
            </span>
            </form>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="<?= base_url(); ?>assets/js/ajax.js"></script>
<script language='javascript' type="text/javascript">
   $(document).ready(function() {
      // validate form input
      $('#process-form').formValidation({
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
            title: {
               validators: {
                  notEmpty: {
                     message: 'The title is required.'
                  },
                  regexp: {
                     regexp: /^[a-zA-Z0-9?!-\s]+$/,
                     message: 'The title field can only consist of alpha numeric characters.'
                  },
                  stringLength: {
                     max: 80,
                     message: 'The title field must be less than 80 characters.'
                  }
               }
            },
            category: {
               validators: {
                  notEmpty: {
                     message: 'Please select a category.'
                  }
               }
            },
            msg: {
               validators: {
                  notEmpty: {
                     message: 'The message content field is required'
                  }
               }
            }
         }
      })

      // on validation success submit via Ajax
      .on('success.form.fv', function(e) {
         e.preventDefault();

         clearMessage();
         var dataString = $("#process-form").serialize();
         var get_cat_data = document.getElementById("category");
         var submit_cat_id = get_cat_data.options[get_cat_data.selectedIndex].value;

         $.ajax({
            url : '<?= base_url(); ?>community/submit-question',
            type: "POST",
            data : dataString,

            beforeSend: function(){
               $('#process-loader').show();
            },
            success:function(response) {
               var oRtn = eval('('+response+')');
               displayMessage('process-msg', oRtn.message, oRtn.success);
              if (oRtn.success == true) {
                  setTimeout(function(){
                     window.location='<?= base_url(); ?>community/category/'+submit_cat_id+'';
                  }, 1500);
               }
            },
            complete: function(){
               $('#process-loader').hide();
            }
         });

      });
   });
</script>