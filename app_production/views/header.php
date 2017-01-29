<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $site_name; ?> - <?= $page_title; ?></title>
        <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('v1_assets/plugins/formvalidation/css/formValidation.min.css'); ?>"/>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <body>

        <?php if ($this->session->flashdata('response_msg')) { ?>
        <div class="alert alert-<?= $this->session->flashdata('response_msg')['class']; ?> alert-block" role="alert">
            <a class="close" href="#" data-dismiss="alert">×</a>
            <?= $this->session->flashdata('response_msg')['msg']; ?>
        </div>
        <?php } ?>