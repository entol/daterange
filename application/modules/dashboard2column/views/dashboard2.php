                      <button  type="button" class="btn btn-default "  id="daterange-btn">
                        <i class="fa fa-calendar"></i> Choose Date
                        <i class="fa fa-caret-down"></i>
                      </button>
                      <a href="<?php echo base_url();?>dashboard2column" type="button" class="btn btn-default" > 
                      
                       <i class="fa fa-refresh text-green"></i> Refresh
                      </a>
                    
					  <!--button onclick="Xcrud.reload()">Reload button</button-->
   				    <div id="history">
                      
						<div class="col-md-6">
						<span><b>Today</b></span>
						<?php echo $today;?>
						</div><!-- /.col -->
                    
						<div class="col-md-6" >
						<span><b>Tomorrow</b></span>
						<?php echo $content;?>
						</div><!-- /.col -->       
                    </div><!-- /.col -->
               
                   
              
              
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>setInterval(function(){ Xcrud.reload() },15000); </script>
<script type="text/javascript">
      $(function () {
      
       
       
       	var daterangepicker_start = jQuery("#daterangepicker_start").val();	
		var	daterangepicker_end = jQuery("#daterangepicker_end").val();	
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                   'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
        
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          //jQuery("#daterangepicker_start").val()alert(jQuery("#daterangepicker_start").val());
           $body = jQuery("body");
           $body.addClass("loading");
	//document.getElementById("p1").innerHTML = " ";
		jQuery('#history').html("<br></br><br></br><br><div class='progress'> <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width:100%'>Please Wait...</div></div></br><br></br><br></br><br></br>");
		
		jQuery.ajax({
			type: "POST",
			dataType: "text",	
			data: {'<?= $this->security->get_csrf_token_name() ?>' : '<?= $this->security->get_csrf_hash() ?>' },
			url: "<?php echo base_url();?>dashboard2column/by_date?par1="+jQuery("#daterangepicker_start").val()+"&par2="+jQuery("#daterangepicker_end").val(),
			//alert("url");
			success: function(response) {
				jQuery('#history').html(response)
				//setInterval(function(){ Xcrud.reload() },15000); -->duplicate script
			},
			error: function(response){
				alert("error");
			 },
			complete: function(response){
				// alert("complete");
			}
		});	
		return false;
	
        }
        
        );
         

      });
  
     function removeHistory(){
        // alert();
		$body.removeClass("loading");
	}
    </script>
