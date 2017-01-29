<?php $this->load->view('community/side_nav'); ?>

<span id="page-bg">
    <div id="main" role="main">
       <div id="ribbon">
          <ol class="breadcrumb">
             <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
             <li><a href="<?= base_url(); ?>community">Community</a></li>
             <li><a href="<?= base_url(); ?>community/category/<?= $asked_question->cat_id; ?>">Category</a></li>
             <li>Question</li>
          </ol>
       </div>

        <div id="content" class="community">

            <div class="row">
                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-6">



                        </div>
                        <div class="col-md-6 text-right">

<a href="#reply-quest" class="btn btn-warning btn-block btn-lg"><i class="fa fa-comments-o"></i> Answer Question</a>


                        </div>
                    </div>
                    <br>

                    <div class="well well-light">
                        <h3 class="margin-top-0"><?=  $asked_question->title; ?>
                        <?php if ($total_answers > 0) { ?>
                            <span class="pull-right label label-primary"><i class="fa fa-check"></i> Answered</span>
                        <?php } else  { ?>
                            <span class="pull-right label label-warning"><i class="fa fa-exclamation-circle"></i> Unanswered</span>
                        <?php } ?>
                        </h3>
                        <p>
                            <?= $asked_question->msg; ?>
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-xs-4">
                                <img class="img-circle avatar-img-sm" alt="avatar" src="<?= base_url(); ?>uploads/avatar/<?= $asked_question->author_avatar; ?>"> <small class="font-xs"><em><strong><?= $asked_question->author; ?></strong></em></small>
                            </div>
                            <div class="col-xs-4 text-center">
                                <small class="font-xs"><i class="fa fa-calendar text-danger"></i> <i>Asked On: <?= $asked_question->date_asked; ?></i></small>
                            </div>
                            <div class="col-xs-4 text-center">

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $total_answers; ?> Answer(s)</h3>
                        </div>
                        <div id="answers_main_list" class="panel-body no-padding">
                        <?php if ($answer_list == false) { ?>

                            <div class="no-answers">
                                <div class="alert alert-block alert-warning">
                                    <a class="close" href="#" data-dismiss="alert">×</a>
                                    <h4 class="alert-heading"><i class="fa fa-comments-o"></i> No answers!</h4>
                                    There is no answer for this question as yet, be the first to give one.
                                </div>
                            </div>

                        <?php } else { ?>

                            <?php foreach ($answer_list as $item) { ?>
                                <div id="<?= $item['ans_id']; ?>" class="row answer-item">
                                    <div class="col-xs-12 col-md-2">

                                        <div class="vote-btn">
                                            <?= $item['vote_option']; ?>
                                        </div>
                                        <br>
                                        <div class="vote-count">
                                            <i class="fa fa-plus font-xs"></i> <?= $item['positive_vote']; ?>
                                            <br>
                                            <i class="fa fa-minus font-xs"></i> <?= $item['negative_vote']; ?>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-md-10">
                                        <p>
                                            <?= $item['ans_msg']; ?>
                                        </p>
                                        <hr class="dashed">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <img class="img-circle avatar-img-sm" alt="avatar" src="<?= base_url(); ?>uploads/avatar/<?= $item['author_avatar']; ?>"> <small class="font-xs"><em><strong><?= $item['author']; ?></strong></em></small>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                            <small class="font-xs"><i class="fa fa-calendar text-danger"></i> <i>Asked On: <?= $asked_question->date_asked; ?></i></small>
                                            </div>
                                            <div class="col-xs-4 text-center">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>

                            <center class="pagin">
                                <?= $pagination; ?>
                            </center>

                        <?php } ?>

                            <div class="padding-10">
                                <h3 class="margin-top-0">Your Answer</h3>

                                <div id="ans-respond" role="alert" style="display:none">
                               <button type="button" class="close"><i class="fa fa-times"></i></button>
                               <strong></strong>
                            </div>

                            <div id="reply-quest">
                             <form>
                                <div id="ans-form-editor"></div>
                                    <button type="button" id="submit-btn" class="btn btn-primary margin-top-10"><i class="fa fa-paper-plane"></i> Post Answer</button>
                                    <span class="process-loader">
                                        <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                                    </span>
                                </form>
                            </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <?php $this->load->view('community/right_panel'); ?>
                </div>
            </div>

        </div>
    </div>
</span>

<script src="<?= base_url(); ?>assets/js/plugin/summernote/summernote.min.js"></script>
<script src="<?= base_url(); ?>assets/js/ajax.js"></script>
<script language='javascript' type="text/javascript">
    $(document).ready(function() {
        //editor
        $('#ans-form-editor').summernote({
            height : 180,
            focus : false,
            tabsize : 2
        });

        // Vote up
        $('.vote-up-btn').click(function() {
            var ans_post_id = this.id;
         swal({
                title: "Was this answer helpful?",
                text: "If this answer was helpful to you in anyway you can vote it up.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#337ab7",
                confirmButtonText: "Yes - Vote Up",
                cancelButtonText: "No - Cancel",
                closeOnConfirm: false
         },
         function(){
            swal({
                    title: "Vote Confirm!",
                    text: "You have successfully place your vote.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
            })

            // send ajax request
                $.ajax({
                url: '<?= base_url(); ?>community/add-vote',
                type: "POST",
                data: {
                    vote_type: 'positive',
                   ans_id: ans_post_id,
                   question_id: <?= $asked_question->question_id; ?>
               },
                success:function() {
                        setTimeout(function(){
                     window.location='<?= base_url(); ?>community/question/<?= $asked_question->question_id; ?>';
                  }, 700);
                }
             });
         });
        });

        // Vote down
        $('.vote-down-btn').click(function() {
            var ans_post_id = this.id;
         swal({
                title: "Are you sure?",
                text: "Do you really want to vote down this answer?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#337ab7",
                confirmButtonText: "Yes - Vote Down",
                cancelButtonText: "No - Cancel",
                closeOnConfirm: false
         },
         function(){
            swal({
                    title: "Vote Confirm!",
                    text: "You have successfully place your vote.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
            })

            // send ajax request
                $.ajax({
                url: '<?= base_url(); ?>community/add-vote',
                type: "POST",
                data: {
                    vote_type: 'negative',
                   ans_id: ans_post_id,
                   question_id: <?= $asked_question->question_id; ?>
               },
                success:function() {
                        setTimeout(function(){
                     window.location='<?= base_url(); ?>community/question/<?= $asked_question->question_id; ?>';
                  }, 700);
                }
             });
         });
        });

      // check if the editor is empty
      $('#submit-btn').click(function() {
            var textareaValue = $("#ans-form-editor").code();
            if (textareaValue !== '' && textareaValue !== '<p><br></p>') {

             clearMessage();
             $.ajax({
                url: '<?= base_url(); ?>community/submit-answer',
                type: "POST",
                data: {
                  ans_msg: textareaValue,
                  question_id: <?= $asked_question->question_id; ?>
               },

                beforeSend: function(){
                   $('.process-loader').show();
                },
                success:function(response) {
                   var oRtn = eval('('+response+')');
                   displayMessage('ans-respond', oRtn.message, oRtn.success);
                        if (oRtn.success == true) {
                      setTimeout(function(){
                         window.location='<?= base_url(); ?>community/question/<?= $asked_question->question_id; ?>';
                      }, 1500);
                   }
                },
                complete: function(){
                   $('.process-loader').hide();
                }
             });

            } else {
             swal({
                title: "Answer Required!",
                text: "The answer text field cannot be empty. Please write your answer then try submitting again.",
                type: "warning",
                confirmButtonColor: "#337ab7"
             })
         }
      });

    })
</script>