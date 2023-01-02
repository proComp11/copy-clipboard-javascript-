<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>tsetup/css/mcliLiStyles.css" />
<link href="<?php echo base_url();?>tsetup/css/progressbar.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>tsetup/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />

<div class="row" >
    <div class="col-md-6 col-md-offset-3">
        <section class="panel panel-primary">
            <header class="panel-heading">
            	<div class="row">
	                <div class="col-md-12 col-md-offset-5">
	                    BSNL TL
	                </div>
	            </div>
            </header>
            <div id="" class="panel-body">
            	<div class="row">
            		<div class="col-md-8">
            			<textarea class="form-control" id="mssid">91</textarea>		
            		</div>
            	</div><br/>
            	<div class="row">	
            		<div class="col-md-12">
            			<button class="btn btn-success" id="ftchLocation">Submit<i id="loader" style="display: none; margin-top:4px;" class="fa fa-refresh fa-spin fa-x fa-fw pull-right"></i></button>	
            		</div>
            	</div>
            	
            </div>
        </section>
    </div>
</div>
<div class="row" id="info" style="display:none;">
	<div class="col-md-6 col-md-offset-3">
        <section class="panel panel-primary">
            <header class="panel-heading">
            	<div class="row">
	                <div class="col-md-12 col-md-offset-5">
	                   Information
	                </div>
	            </div>
            </header>
            <div id="response" class="panel-body">
            	
            </div>
        </section>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#ftchLocation').on('click', function(){
			// alert('ok');
			let mssid = $('#mssid').val();
			if(mssid.length <= 2){
				$('#err').html('<h6 class="text-center text-danger">Enter Valid Mobile Number</h6>');
			}else{
				$.ajax({
					type:"POST",
					url:"<?php echo base_url('BsnlTlController/fetchDetails')?>",
					data:{
						mssid: mssid
					},
					beforeSend:function(){
						$('#loader').show();
						$('#err').hide();
					},
					success:function(data){
						res = JSON.parse(data.result);
						$('#info').show();
						$('#response').show();
						$('#response').html("");
						$('#response').append('<div class="col-sm-12"><div class="card"><div class="card-body"><p id="copyArea">MSISDN : '+res.msisdn+'<br/>Subscriber State :'+data.city+' <br/>Date & Time : '+res.TimeStamp+'<br/>IMEI : '+res.imei+'<br/>IMSI: '+res.imsi+'<br/>Age of Location : '+res.ageOfLocationEstimate+'<br/>LBS: '+res.url+'<br/>Longitude:'+res.longitude+'<br/>Latitude: '+res.latitude+'<br/>VLR: '+res.vlr+'</p><button class="btn btn-success btn-sm mt-2" onclick="copyBtn()" data-bs-toggle="tooltip" data-bs-placement="top" title="copy"><i class="fa fa-copy"></i></button></div></div></div>');
						// clear the text area value after getting response
						$('#mssid').val('91');
					},
					error:function(error){
						console.log(error);
					},
					complete:function(){
						$('#loader').hide();	
					}
				});
			}
		});
	});

	// copy to clip board function using async function
	const copyBtn = async () => {
		let text = document.getElementById('copyArea').innerHTML;
		text = text.replace(/<br\s*[\/]?>/gi, "\n"); // replace the <br> tag to newline(\n) 
	    try {
	      await navigator.clipboard.writeText(text);
	      console.log('Content copied to clipboard');
	    } catch (err) {
	      console.error('Failed to copy: ', err);
	    }
	}	


</script>








	