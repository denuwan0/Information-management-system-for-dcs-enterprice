<script>
//disable right click 
/* document.addEventListener('contextmenu', (e) => e.preventDefault());

function ctrlShiftKey(e, keyCode) {
  return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
}

document.onkeydown = (e) => {
  // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
  if (
    event.keyCode === 123 ||
    ctrlShiftKey(e, 'I') ||
    ctrlShiftKey(e, 'J') ||
    ctrlShiftKey(e, 'C') ||
    (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
  )
    return false;
}; */

/*** add active class and stay opened when selected ***/
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).addClass('active');

// for the treeview
$('ul.nav-treeview a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
$(document).on('click', '#logout', function(e){
    e.preventDefault();
   
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",	
		url: web+"ApiRequest/logout/",
		success: function(data, result){
			//var count = Object.keys(data).length;
			console.log(data);	
			if(data.error == false){
				$(location).prop('href', web+'logout/')				
			}
			else{
				//console.log('error');
			}				
			
			
		},
		
	});
});

$(document).on('click', '#logout', function(){
	
	
})
</script>
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">DCS Enterprices</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Jquery -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/jquery-ui/jquery-ui.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/system/backend/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/chart.js/Chart.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<!--script src="<?php echo base_url() ?>assets/system/backend/plugins/daterangepicker/daterangepicker.js"></script-->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/datepicker/datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/system/backend/plugins/fullcalendar/main.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/system/backend/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="<?php echo base_url() ?>assets/system/backend/dist/js/pages/dashboard2.js"></script-->


</body>
</html>