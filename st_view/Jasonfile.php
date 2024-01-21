<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		.delete-btn{
			cursor: pointer;
			background-color: red;
			color: #ffff;
		}
		.edit-btn{
			cursor: pointer;
			background-color: green;
			color: #ffff;
		}
	</style>
   <link href="<?php echo base_url('assets/css/st_css.css') ?>" rel="stylesheet">
</head>
<body>

	<div id="header" style="background: lightblue; width: 45%;">
		<h1>PHP with Ajax & Json</h1>
	</div>
	<div id="load-data">
		<table id="load-table" border="1" cellpadding="10px" width="100%">
			<tr>
				<th>Id</th>
				<th>Name</th>
			</tr>
		</table>
	</div>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: '<?php echo base_url();?>St_controller/JsonFile',
				type: 'POST',
				dataType: 'JSON',
				data: {id: 1},
				success: function(data){
					console.log(data);
					// $.each(data,function(key,value){
					// 	$('#load-table').append("<tr style='text-align:center;'><td>"+value.id+'</td><td>'+value.firstname+' '+value.lastname+'</td></tr>');
					// })
				},error: function (data) {
       		console.log(data);
        }

			})
		});
	</script>
</body>
</html>

