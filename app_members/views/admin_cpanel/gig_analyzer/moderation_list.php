<?php $this->load->view('admin_cpanel/admin_links'); ?>

<div id="main" role="main">

    <div id="ribbon">
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?= base_url(); ?>admin">Admin cPanel</a></li>
            <li><a href="<?= base_url(); ?>admin/gig-analyzer">Gig Analyzer</a></li>
            <li>Gig Moderation List </li>
        </ol>
    </div>

    <div id="content">

        <?= $this->session->flashdata('flush_msg'); ?>

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget" id="acp-ga-list" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-rocket"></i> </span>
                            <h2>Gig Moderation List</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding acp-ga-mod-list">

                                <table id="dt_acp_ga_list" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                &nbsp;
                                            </th>
                                            <th class="hasinput">
                                                <input type="text" class="form-control" placeholder="Filter by Title" />
                                            </th>
                                            <th class="hasinput icon-addon">
                                                <input id="dateselect_filter" type="text" placeholder="Filter by Date" class="form-control datepicker" data-dateformat="mm-dd-yy">
                                                <label for="dateselect_filter" class="glyphicon glyphicon-calendar no-margin padding-top-15" rel="tooltip" title="" data-original-title="Filter Date"></label>
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="Filter by Status" />
                                            </th>
                                            <th class="hasinput" style="width:17%">
                                                &nbsp;
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-class="expand">Gig Image</th>
                                            <th data-hide="phone,tablet">Gig Title</th>
                                            <th data-hide="phone,tablet">Date Submitted</th>
                                            <th data-hide="phone,tablet">Moderation Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $gig_list; ?>
                                    </tbody>
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

          $('li#mod-list').addClass('active'); // make the current nav active

        var responsiveHelper_datatable_fixed_column = undefined;
        var breakpointDefinition = {
            tablet : 1024,
            phone : 480
        };
        var otable = $('#dt_acp_ga_list').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#dt_acp_ga_list'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
            }

        });

        $("#dt_acp_ga_list thead th input[type=text]").on( 'keyup change', function () {
            otable
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
        });
    })
</script>