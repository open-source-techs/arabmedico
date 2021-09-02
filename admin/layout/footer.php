        <footer class="main-footer">
            <!-- <div class="pull-right hidden-xs"> <b>Version</b> 1.0</div> -->
            <strong>Copyright &copy; <?= date('Y');?> <a href="#">Open Source Techs</a>.</strong> All rights reserved.
        </footer>
    </div>
    <script src="<?= admin_base_url();?>assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/dist/js/custom1.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/toastr/toastr.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/datamaps/d3.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/datamaps/topojson.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/datamaps/datamaps.all.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/counterup/waypoints.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/emojionearea/emojionearea.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/monthly/monthly.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/datamaps/d3.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/datamaps/topojson.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/datamaps/datamaps.all.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/dist/js/custom.js" type="text/javascript"></script>
    <?php
    get_msg('msg');
    ?>
    <script>
	function checkFileSize(id)
	{
		var fi = document.getElementById(id); 
        if (fi.files.length > 0)
        { 
            for (var i = 0; i <= fi.files.length - 1; i++)
            {
                var fsize = fi.files.item(i).size; 
                var file = Math.round((fsize / 1024));
                if (file >= 10240)
                {
                    $("."+id).html("File size can not be greater than 10MB");
                    $("."+id).css('text-transform','uppercase');
                    $("."+id).css('font-weight','bold');
                    $("."+id).css('color','red');
                    $("#"+id).val('');
                }
                else
                {
                	$("."+id).html("");
                }
            } 
        } 
	}
    </script>
    </body>
</html>