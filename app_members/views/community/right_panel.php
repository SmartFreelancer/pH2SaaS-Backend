<div class="well padding-10 well-light">
    <h5 class="margin-top-0"><i class="fa fa-comment-o"></i> Latest Questions</h5>
    <hr class="dashed">

    <?php if (empty($latest_posts)) { ?>
        <p class="text-center">No latest questions at the moment.</p>
    <?php } else { ?>
        <ul class="no-padding list-unstyled">
            <?php foreach ($latest_posts as $item) { ?>
                <li class="margin-bottom-10">
                    <a href="<?= base_url(); ?>community/question/<?= $item['question_id']; ?>"><i class="fa fa-arrow-circle-right"></i> <?= $item['title']; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>

<div class="well padding-10 well-light">
    <h5 class="margin-top-0"><i class="fa fa-star-o"></i> Popular Questions</h5>
    <hr class="dashed">

    <?php if (empty($popular_questions)) { ?>
        <p class="text-center">No popular questions at the moment.</p>
    <?php } else { ?>
        <ul class="no-padding list-unstyled">
            <?php foreach ($popular_questions as $item) { ?>
                <li class="margin-bottom-10">
                    <a href="<?= base_url(); ?>community/question/<?= $item['question_id']; ?>"><i class="fa fa-arrow-circle-right"></i> <?= $item['title']; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
