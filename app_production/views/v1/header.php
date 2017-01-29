<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $site_name; ?> - <?= $page_title; ?></title>

        <meta property="og:type"        content="op-hashtags:fiverrtools">
        <meta property="og:image" content="http://fiverrtools.com/v1_assets/images/share-thumbnail.jpg" />
        <meta property="og:url"         content="http://fiverrtools.com">
        <meta property="og:title"       content="Fiverr Tools - Tools For Fiverr Sellers">
        <meta property="og:description" content="Fiverr Tools - Be more visible to clients on Fiverr. Improve your search rankings. Earn more from your gigs. It’s all possible with our groundbreaking freelancing tools for Fiverr sellers. #fiverrtools">

        <meta name="description" content="Fiverr Tools - Be more visible to clients on Fiverr. Improve your search rankings. Earn more from your gigs. It’s all possible with our groundbreaking freelancing tools for Fiverr sellers.">
        <meta name="keywords" content="fiverr,tools,gigs,sellers, fiverr tools,">

        <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('v1_assets/plugins/formvalidation/css/formValidation.min.css'); ?>"/>
        <link type="text/css" media="screen" href="<?= base_url('v1_assets/css/style.css'); ?>" rel="stylesheet">
        <link rel="shortcut icon" href="<?= base_url('v1_assets/images/favicon.ico'); ?>" type="image/x-icon"/>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <script>(function() {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '//connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
        })();
        window._fbq = window._fbq || [];
        window._fbq.push(['track', '6028705332006', {'value':'0.01','currency':'USD'}]);
        </script>
        <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6028705332006&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:64526,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>

    </head>
    <body id="page-top" class="index">
        <?php if ($this->session->flashdata('response_msg')) { ?>
        <div class="alert alert-<?= $this->session->flashdata('response_msg')['class']; ?> alert-block" role="alert">
            <a class="close" href="#" data-dismiss="alert">×</a>
            <?= $this->session->flashdata('response_msg')['msg']; ?>
        </div>
        <?php } ?>
        <!-- Navigation -->
        <nav class="navbar navbar-default">
            <div class="container" style="max-width: 1050px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url(); ?>">Fiverr Tools</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="margin-left: 70px;">
                        <li>
                            <a href="<?= base_url(); ?>features">Features</a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>pricing">Pricing</a>
                        </li>
                        <li>
                            <a href="http://members.fiverrtools.com">Community</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="btn btn-outline" href="http://members.fiverrtools.com">Login</a>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-link="<?= base_url(); ?>auth/lead" data-target="#get-started">Get Started</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>