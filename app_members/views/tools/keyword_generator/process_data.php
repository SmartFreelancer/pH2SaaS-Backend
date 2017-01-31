<?php
if (empty($keywords_result)) { ?>

<div class="page-error">
   <i class="fa fa-meh-o fa-5x"></i>
   <br>
   Unable to generate any keywords for the term you have entered.
</div>

<?php } else { ?>
   <div class="well" style="padding: 10px 60px 30px;">
   <h3 class="no-margin">Suggested Keywords</h3>
   <div class="well well-sm well-light" style="margin-top: 10px; overflow-x: hidden; overflow-y: scroll; height: 300px;">
      <ul class='list-unstyled'>
         <?php foreach($keywords_result as $word) {
            echo "<li><i class='fa fa-arrow-circle-right text-primary'></i> ".$word."</li>";
         } ?>
      </ul>
      </div>
   </div>
<?php } ?>
