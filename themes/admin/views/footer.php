


        <!-- footer content -->
                <footer>
                    <div class="no-print">
                        <p class="pull-right">
                            <b>
                                Copyright &copy; 2016 KPI by <a>Miqdad Izzudin</a>
                            </b> | Page rendered in <strong>{elapsed_time}</strong> seconds. 
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
                    
                </div>
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        

        <!-- datepicker -->
        <script src="<?= base_url('assets/js/datepicker/lib/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/datepicker/lib/zebra_datepicker.js') ?>"></script>
        <link rel="stylesheet" href="<?= base_url('assets/js/datepicker/lib/css/default.css') ?>" />
        <script>
            $(document).ready(function(){
                $('#tanggal').Zebra_DatePicker({
                    format: 'Y-m-d'
                });
            });
        </script>            

        <!-- bootstrap js -->
        <script src="<?= base_url('assets/js/progressbar/bootstrap-progressbar.min.js') ?>">></script>
        <script src="<?= base_url('assets/js/nicescroll/jquery.nicescroll.min.js') ?>">></script>
       
        <!-- icheck -->
        <script src="<?= base_url('assets/js/icheck/icheck.min.js') ?>">></script>
        <script src="<?= base_url('assets/js/custom.js') ?>">></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="<?= base_url('assets/js/moment.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/datepicker/daterangepicker.js') ?>"></script>
        <!-- input mask -->
        <script src="<?= base_url('assets/js/input_mask/jquery.inputmask.js') ?>"></script>
        <!-- knob -->
        <script src="<?= base_url('assets/js/knob/jquery.knob.min.js') ?>"></script>
        <!-- range slider -->
        <script src="<?= base_url('assets/js/ion_range/ion.rangeSlider.min.js') ?>"></script>
        <!-- color picker -->
        <script src="<?= base_url('assets/js/colorpicker/bootstrap-colorpicker.js') ?>"></script>
        <script src="<?= base_url('assets/js/colorpicker/docs.js') ?>"></script>

        <!-- image cropping -->
        <script src="<?= base_url('assets/js/cropping/cropper.min.js') ?>"></script>
        <script src="<?//= base_url('assets/js/cropping/main.js') ?>"></script>

        <!-- moris js -->
        <script src="<?= base_url('assets/js/moris/raphael-min.js') ?>"></script>
        <script src="<?= base_url('assets/js/moris/morris.js') ?>"></script>

        <!-- input_mask -->
        <script>
            $(document).ready(function () {
                $(":input").inputmask();
            });
        </script>
        <!-- /input mask -->

        <!-- Datatables -->
        <script src="<?= base_url('assets/js/datatables/js/jquery.dataTables.js') ?>">></script>
        <script src="<?= base_url('assets/js/datatables/tools/js/dataTables.tableTools.js') ?>">></script>
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('.example2').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
                    ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": '<"clear">lfrtip' ,
                    "tableTools": {
                        "sSwfPath": "<?= base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>" //Untuk tombol excel , pdf
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>

        <!--Untuk Datatable -->
        <script src="<?= base_url('assets/css/datatables/DT_bootstrap.js') ?>">></script>
        <script>
            $(document).ready(function() {
                $('.example').dataTable( {
                    "sDom": "<'row'<'span8'l><'span8'f>r>t<'row'<'span8'i><'span8'p>>"
                } );
            } );

        </script>

            <!-- Start Calendar js -->
            <script src="<?= base_url('assets/js/calendar/fullcalendar.min.js') ?>"></script>
            <script>
                // $(document).ready(function() {
                $(window).load(function () {

                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    var started;
                    var categoryClass;

                    var calendar = $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end, allDay) {
                            $('#fc_create').click();

                            started = start;
                            ended = end

                            $(".antosubmit").on("click", function () {
                                var title = $("#title").val();
                                if (end) {
                                    ended = end
                                }
                                categoryClass = $("#event_type").val();

                                if (title) {
                                    calendar.fullCalendar('renderEvent', {
                                            title: title,
                                            start: started,
                                            end: end,
                                            allDay: allDay
                                        },
                                        true // make the event "stick"
                                    );
                                }
                                $('#title').val('');
                                calendar.fullCalendar('unselect');

                                $('.antoclose').click();

                                return false;
                            });
                        },
                        eventClick: function (calEvent, jsEvent, view) {
                            //alert(calEvent.title, jsEvent, view);

                            $('#fc_edit').click();
                            $('#title2').val(calEvent.title);
                            categoryClass = $("#event_type").val();

                            $(".antosubmit2").on("click", function () {
                                calEvent.title = $("#title2").val();

                                calendar.fullCalendar('updateEvent', calEvent);
                                $('.antoclose2').click();
                            });
                            calendar.fullCalendar('unselect');
                        },
                        editable: true,
                        events: [
                            {
                                title: 'All Day Event',
                                start: new Date(y, m, 1)
                        },
                            {
                                title: 'Long Event',
                                start: new Date(y, m, d - 5),
                                end: new Date(y, m, d - 2)
                        },
                            {
                                title: 'Meeting',
                                start: new Date(y, m, d, 10, 30),
                                allDay: false
                        },
                            {
                                title: 'Lunch',
                                start: new Date(y, m, d + 14, 12, 0),
                                end: new Date(y, m, d, 14, 0),
                                allDay: false
                        },
                            {
                                title: 'Birthday Party',
                                start: new Date(y, m, d + 1, 19, 0),
                                end: new Date(y, m, d + 1, 22, 30),
                                allDay: false
                        },
                            {
                                title: 'Click for Google',
                                start: new Date(y, m, 28),
                                end: new Date(y, m, 29),
                                url: 'http://google.com/'
                        }
                    ]
                    });
                });
            </script>
            <!-- End Calendar js -->

            <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>