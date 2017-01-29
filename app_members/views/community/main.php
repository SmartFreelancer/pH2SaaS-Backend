
<?php $this->load->view('community/side_nav'); ?>

<span id="page-bg">
    <div id="main" role="main">
       <div id="ribbon">
          <ol class="breadcrumb">
             <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
             <li>Community - Explore Ask Discover</li>
          </ol>
       </div>

        <div id="content" class="community">
            <div class="row">

                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-6">


                            <!-- <div class="input-group">
                                <input id="search-user" class="form-control" type="text" placeholder="Community Search...">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-fw fa-search fa-lg"></i>
                                    </button>
                                </div>
                            </div>-->

                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#post_modal" style="padding: 10px 5px;"><i class="fa fa-comments-o"></i> Ask a Question</button>
                        </div>
                    </div>
                    <br>

                    <div class="well well-light no-padding" style="border: 0;">
                        <table class="table table-striped table-forum">
                            <thead>
                                <tr style="border: 1px solid #dfb56c;">
                                    <th colspan="3" style="background: #efe1b3;">Need Help? Ask the Community <br><small class="text-muted">Questions asked and answered by Community members</small> </th>
                                </tr>
                            </thead>
                            <tbody style="border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
                                <?php foreach ($cat_one as $item) { ?>
                                    <tr>
                                        <td class="text-center" style="width: 40px;"><?= $item['icon']; ?></td>
                                        <td>
                                            <h4><a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>">
                                                <?= $item['title']; ?>
                                            </a>
                                                <small><?= $item['description']; ?></small>
                                            </h4>
                                        </td>
                                        <td class="hidden-xs hidden-sm">
                                            <a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>"><?= $item['answers']; ?> New</a>
                                            <br>
                                            <small><i>Posted Questions</i></small>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="well well-light no-padding" style="border: 0;">
                        <table class="table table-striped table-forum">
                            <thead>
                                <tr style="border: 1px solid #dfb56c;">
                                    <th colspan="3" style="background: #efe1b3;">Tips: Learn with the Community<br><small class="text-muted">A growing collection of articles from the Community.</small> </th>
                                </tr>
                            </thead>
                            <tbody style="border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
                                <?php foreach ($cat_two as $item) { ?>
                                    <tr>
                                        <td class="text-center" style="width: 40px;"><?= $item['icon']; ?></td>
                                        <td>
                                            <h4><a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>">
                                                <?= $item['title']; ?>
                                            </a>
                                                <small><?= $item['description']; ?></small>
                                            </h4>
                                        </td>
                                        <td class="hidden-xs hidden-sm">
                                            <a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>"><?= $item['answers']; ?> New</a>
                                            <br>
                                            <small><i>Posted Questions</i></small>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="well well-light no-padding" style="border: 0;">
                        <table class="table table-striped table-forum">
                            <thead>
                                <tr style="border: 1px solid #dfb56c;">
                                    <th colspan="3" style="background: #efe1b3;">Your Voice: Improve the Community <br><small class="text-muted">A place for productive discussion about your opinions.</small> </th>
                                </tr>
                            </thead>
                            <tbody style="border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
                                <?php foreach ($cat_three as $item) { ?>
                                    <tr>
                                        <td class="text-center" style="width: 40px;"><?= $item['icon']; ?></td>
                                        <td>
                                            <h4><a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>">
                                                <?= $item['title']; ?>
                                            </a>
                                                <small><?= $item['description']; ?></small>
                                            </h4>
                                        </td>
                                        <td class="hidden-xs hidden-sm">
                                            <a href="<?= base_url(); ?>community/category/<?= $item['cat_id']; ?>"><?= $item['answers']; ?> New</a>
                                            <br>
                                            <small><i>Posted Questions</i></small>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-3">
                    <?php $this->load->view('community/right_panel'); ?>
                </div>

            </div>
        </div>
    </div>
</span>


<script language='javascript' type="text/javascript">
   $('li#overview').addClass('active'); // make the current nav active
</script>