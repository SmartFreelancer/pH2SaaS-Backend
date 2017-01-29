<h2 class="text-center">Join <?= $site_name; ?></h2>
<p class="text-center">It only takes a few seconds to create your account, follow these easy steps.</p>
<br><br>
<form id="process-form">
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_name" id="user_name" placeholder="What is your name?">
    </div>
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="email" id="email" placeholder="Enter your email address">
    </div>
    <center>
    <button type="submit" class="btn btn-lg btn-action btn-block" >CONTINUE</button>
    <span id="process-loader" style="display:none">
       <img src="<?= base_url('assets/images/ajax-loader.gif'); ?>">
    </span>
    </center>
</form>
<br><br>


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
            email: {
                validators: {
                    notEmpty: {
                        message: 'Your email address is required.'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'The email you entered is not a valid email address.'
                    }
                }
            },
            user_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your full name.'
                    }
                }
            }
        }
    })
    // on validation success submit via Ajax
    .on('success.form.fv', function(e) {
        e.preventDefault();
        var formData = $("#process-form").serialize();
        $.ajax({
            url: '<?= base_url(); ?>auth/lead-ajax',
            type: "POST",
            data: formData,
            beforeSend: function() {
                $('#process-loader').show();
            },
            success: function(response) {
                window.location = "<?= $lead_url; ?>";
            },
            complete: function() {
                $('#process-loader').hide();
            }
        });
    });
});
</script>