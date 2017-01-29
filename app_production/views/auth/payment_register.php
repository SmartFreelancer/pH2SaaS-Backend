<body style="background: #f8f8f8">
<div class="container">

<h1 style="font-weight: 900; text-align: center; text-decoration: underline; margin-bottom: 0;">Fiverr Tools</h1>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <br><br>
            <div class="alert alert-info" role="alert">
                <h4>Your payment was successful!</h4>
                <p>Thank you for your payment. Your transaction has been completed, please complete setting up your account.</p>
            </div>
            <br>
            <div id="process-msg" role="alert" style="display:none">
                <button type="button" class="close"><i class="fa fa-times"></i></button>
                <strong></strong>
            </div>
            <form id="process-form" style="border: 1px solid #ddd; background: #fff; padding: 20px; border-radius: 3px;">
                <?php if ($require_username) { ?>
                    <div class="form-group">
                        <label for="username">Username</label> <br>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="email">E-mail Address</label> <br>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>" placeholder="Enter your email address">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?php if ($require_username == FALSE) { ?>
                            <div class="form-group">
                                <label for="first_name">First Name</label> <br>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your first name">
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="password">Password</label> <br>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php if ($require_username == FALSE) { ?>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label> <br>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your last name">
                                </div>
                            <?php } ?>
                            <label for="password_confirm">Confirm Password </label> <br>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm your password">
                        </div>
                    </div>
                </div>
                <center>
                <button type="submit" class="btn btn-primary" style="border-radius: 2px; font-size: 18px; font-weight: 800; padding: 8px 15px;">Create Account</button>
                <span id="process-loader" style="display:none">
                    <img src="<?= base_url('v1_assets/images/ajax-loader.gif'); ?>">
                </span>
                </center>
            </form>
        </div>
    </div>
</div>

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
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'Your first name is required.'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'Your last name is required.'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your password.'
                    }
                }
            },
            password_confirm: {
                validators: {
                    notEmpty: {
                        message: 'Please confirm your password.'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same.'
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
            url: '<?= base_url(); ?>auth/payment-register-ajax',
            type: "POST",
            data: formData,
            beforeSend: function() {
                $('#process-loader').show();
            },
            success: function(response) {
                var oRtn = eval('(' + response + ')');
                displayMessage('process-msg', oRtn.message, oRtn.success);
                if (oRtn.success == true) {
                    setTimeout(function() {
                        window.location = "<?= base_url('auth/auto-login'); ?>";
                    }, 1500);
                }
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

</body>