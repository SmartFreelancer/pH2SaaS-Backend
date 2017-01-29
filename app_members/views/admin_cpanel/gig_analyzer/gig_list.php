<?php $this->load->view('admin_cpanel/admin_links'); ?>

<div id="main" role="main">

    <div id="ribbon">
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?= base_url(); ?>admin">Admin cPanel</a></li>
            <li><a href="<?= base_url(); ?>admin/gig-analyzer">Gig Analyzer</a></li>
            <li>Gig List </li>
        </ol>
    </div>

    <div id="content">

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget" id="acp_gig_list" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-rocket"></i> </span>
                            <h2>Gig List</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding acp-ga-mod-list">

                                <table id="dt_gig_list" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Gig Title</th>
                                            <th>Image</th>
                                            <th>Date Submitted</th>
                                            <th>Gig Status</th>
                                            <th>Moderator</th>
                                            <th>Moderation Status</th>
                                            <th>Date Moderated</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </section>

    </div>

</div>


<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

          $('li#gig-list').addClass('active'); // make the current nav active

        function format ( d ) {
            return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">'+
                '<tr>'+
                    '<td style="width:100px"></td>'+
                    '<td><strong><em>Moderation Details</em></strong>'+d.fiverr_link+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Title Message:</td>'+
                    '<td>'+d.title_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Category Message:</td>'+
                    '<td>'+d.category_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Image Message:</td>'+
                    '<td>'+d.img_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Video Message:</td>'+
                    '<td>'+d.vid_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Description Message:</td>'+
                    '<td>'+d.desc_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Keywords Message:</td>'+
                    '<td>'+d.keywords_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Additional Info:</td>'+
                    '<td>'+d.additional_msg+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Gig Keyword:</td>'+
                    '<td>'+d.keyword+'</td>'+
                '</tr>'+
            '</table>';
        }

        // clears the variable if left blank
        var table = $('#dt_gig_list').DataTable( {
            "ajax": "<?= base_url(); ?>admin/gig-analyzer/mod_gigs_json_data",
            "bDestroy": true,
            "iDisplayLength": 15,
            "columns": [
                {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                { "data": "title" },
                { "data": "gig_img" },
                { "data": "date_submitted" },
                { "data": "status" },
                { "data": "mod_user" },
                { "data": "mod_status" },
                { "data": "mod_date" },
            ],
            "order": [[1, 'asc']],
            "fnDrawCallback": function( oSettings ) {
                runAllCharts()
            }
        });

        // Add event listener for opening and closing details
        $('#dt_gig_list tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });

    })
</script>