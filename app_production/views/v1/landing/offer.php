<header class="suby" id="hero" style="height: 260px; min-height: 260px;">
    <div class="container">
        <div class="blocky text-center" style="margin-top: 130px;">
            <h3>Get Free Premium Membership access to fiverr tools...</h3>
            <h2>By Becoming a contributor</h2>
        </div>
    </div>
</header>
<section class="block-offer">
    <p class="text-center" style="font-size: 18px;">We are looking for motivated fiverr sellers to do video testimonials using our platform and in return you will have full premium membership access.</p>
    <br>
    <hr style="width:500px;">
    <h3 class="text-center">Submit your request!</h3>
    <br>
    <div id="process-msg" role="alert" style="display:none">
        <button type="button" class="close"><i class="fa fa-times"></i></button>
        <strong></strong>
    </div>
    <form id="process-form">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username (used to create your account)">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
                </div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" id="msg" name="msg" placeholder="Tell us about what you would like to contribute." rows="2"></textarea>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <button type="submit" class="btn btn-action btn-lg btn-block">Submit</button>
                <br>
                <div class="center">
                    <span id="process-loader" style="display:none"><img src="<?= base_url('v1_assets/images/ajax-loader.gif'); ?>" alt="Loading"></span>
                </div>
            </div>
        </div>
    </section>
</form>
<script src="<?= base_url('v1_assets/js/ajax.js'); ?>"></script>
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
            username: {
                validators: {
                    notEmpty: {
                        message: 'Your username is required.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_-]+$/,
                        message: 'Only alphanumeric characters and hyphen or underscores are allowed (no spaces).'
                    },
                    stringLength: {
                        message: 'Your username must between 3 to 25 characters in length.',
                        max: 25,
                        min: 3,
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Your email address is required.'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Please enter a valid email address.'
                    }
                }
            },
            msg: {
                validators: {
                    notEmpty: {
                        message: 'This field is required.'
                    }
                }
            }
        }
    })
    // on validation success submit via Ajax
    .on('success.form.fv', function(e) {
        e.preventDefault();
        clearMessage(); // Clear response msg if any
        var formData = $("#process-form").serialize();
        $.ajax({
            url: '<?= base_url(); ?>auth/contributor-request',
            type: "POST",
            data: formData,
            beforeSend: function() {
            $('#process-loader').show();
            },
            success: function(response) {
            var oRtn = eval('(' + response + ')');
            displayMessage('process-msg', oRtn.message, oRtn.success);
            },
            complete: function() {
            $('#process-loader').hide();
            },
            error: function (request, status, error) {
            alert(request.responseText);
            }
        });
    });
});
</script>
