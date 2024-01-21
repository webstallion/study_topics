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
		.active{
			color: white;
		}
	</style>
   <link href="<?php echo base_url('assets/css/st_css.css') ?>" rel="stylesheet">
</head>
<body>
	<div id="table-data">

	</div>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			function loadTable(page){
				$.ajax({
					url: "ajax_pagination",
					type: "POST",
					data: {page_no :page},
					success : function(data){
						$('#table-data').html(data);
					}
				})
			}
			loadTable();

			//pagination code
			$(document).on("click", "#pagination a",function(e){
				e.preventDefault();
				var page_id= $(this).attr("id");
				loadTable(page_id);
			});
		});
	</script>
</body>
</html>

