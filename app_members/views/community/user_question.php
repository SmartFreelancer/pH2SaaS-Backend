<?php $this->load->view('community/side_nav'); ?>

<span id="page-bg">
    <div id="main" role="main">
       <div id="ribbon">
          <ol class="breadcrumb">
             <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
             <li><a href="<?= base_url(); ?>/community">Community</a></li>
             <li>Category</li>
          </ol>
       </div>

        <div id="content" class="community">
            <div class="row">

                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="input-group">
                                <input id="search-user" class="form-control" type="text" placeholder="Community Search...">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-fw fa-search fa-lg"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 text-right">

                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Filter by category
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <?php foreach ($category_list as $item) { ?>
                                    <li>
                                        <a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>"><?= $item['title']; ?> </a>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>
                    </div>
                    <br>
                    <?php if (empty($question_list)) { ?>
                        <div class="well well-light">
                            <div class="page-error">
                                <i class="fa fa-laptop fa-5x text-primary"></i>
                                <h3>You have not post any question/topic in the community.</h3>
                                <button type="button" data-toggle="modal" data-target="#post_modal" class="btn btn-danger">Post a Question/Topic</button>
                            </div>
                        </div>
                    <?php } else { ?>
                    <?php foreach ($question_list as $item) { ?>
                        <div class="question-list">

                            <div class="author-block">
                                <small class="font-xs"><em>Asked By: <strong><?= $item['author']; ?></strong></em></small>
                                <img class="img-circle question-img" alt="avatar" src="<?= base_url(); ?>uploads/avatar/<?= $item['author_avatar']; ?>">
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="<?= base_url(); ?>community/question/<?= $item['question_id']; ?>">
                                        <h3 class="margin-top-0"><i class="fa fa-comment fa-lg text-muted"></i> <?= $item['title']; ?></h3>
                                        <p>
                                            <?= word_limiter($item['msg'], 30); ?>
                                        </p>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <small class="font-xs"><i class="fa fa-calendar text-danger"></i> <i>Asked On: <?= $item['date_asked']; ?></i></small>
                                        </div>
                                        <div class="col-xs-2 text-center">
                                            <i class="fa fa-eye"></i> <?= $item['views']; ?>
                                        </div>
                                        <div class="col-xs-2 text-center">
                                        <i class="fa fa-comments-o"></i> <?= $item['answers']; ?>
                                        </div>
                                        <div class="col-xs-2 text-center">
                                            <i class="fa fa-chevron-circle-up"></i> <?= $item['vote_count']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>

                    <center>
                        <?= $pagination; ?>
                    </center>

                </div>
                <div class="col-md-3">
                    <?php $this->load->view('community/right_panel'); ?>
                </div>

            </div>
        </div>
    </div>
</span>


<script language='javascript' type="text/javascript">
   $('li#user-quest').addClass('active'); // make the current nav active
</script>