<header class="suby" id="hero" style="height: 230px; min-height: 230px;">
    <div class="container">
        <div class="blocky text-center">
            <h2>Small Cost Huge Returns</h2>
        </div>
    </div>
</header>
<section id="services" class="pricing-holder gray">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div id="pricing-left" class="col-sm-8">
                        <h3>One Price Full Premium Access.</h3>
                        <p>Sign up with one low cost and get exclusive access to the world’s only freelancing tools designed specifically for Fiverr sellers.</p>
                        <br>
                        <div class="center">
                            <a class="btn btn-lg btn-action block" href="<?= base_url(); ?>payment/membership/1">$<?= $default_price; ?> Sign Up Now <span>Payment via Paypal</span></a>
                        </div>
                    </div>
                    <div id="pricing-right" class="col-sm-4">
                        <div class="price-tag text-center">
                            <a href="<?= base_url(); ?>payment/membership/1">
                            <span class="sign">$</span>
                            <span class="money"><?= $price_dollar; ?></span>
                            <span class="sub">.<?= $price_cents; ?></span>
                            </a>
                            <a class="active" href="<?= base_url(); ?>payment/membership/2">
                            <span class="period">Go 3 months, Save 25% ($22.39) →</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="signup-tag" href="<?= base_url(); ?>payment/membership/1">
                    <img class="pull-right" alt="Signup" src="<?= base_url(); ?>v1_assets/images/signup-tag.png">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="contact">
    <div class="container text-center">
        <h2 class="section-heading">Joining <strong>Smart Freelancer</strong></h2>
        <h3>is a big step in boosting your freelancing earnings.</h3>
        <div class="center">
            <a href="#" data-toggle="modal" data-link="<?= base_url(); ?>auth/lead" data-target="#get-started" class="btn btn-footer">Get Started Now <span>For Just $<?= $default_price; ?> USD</span></a>
        </div>
    </div>
