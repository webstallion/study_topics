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
	<table id="main" border="0" cellspacing="0" align="center">
		<tbody>
			<tr>
				<th id="header" style="background: lightblue; width: 45%;">
					<h1>Read Json Records</h1>
				</th>
			</tr>
			<tr>
				<th style="background: grey; width: 45%;height: 100%;padding: 20px;" id="load-data">
				</th>
			</tr>
		</tbody>
	</table>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				//url: 'https://jsonplaceholder.typicode.com/posts/1',
				url: '<?php echo base_url(); ?>/St_controller/my_json',
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					//console.log(data);
					//$('#load-data').append(data.id +' '+data.title);
					$.each(data, function(key,value){
						$('#load-data').append(value.id+"<br>"+value.title+"<br>");
					});
				}
			})
		});
	</script>
</body>
</html>

