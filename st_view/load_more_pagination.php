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
	<div>
		<table  border="1" style="width: 25%;">
			<thead>
				<tr>
					<td colspan="3" id="header" style="background: #21a343; text-align: center;">
						<h1>Pagination</h1>
					</td>
				</tr>
				<tr style="background: #21a343;">
					<th>S.N</th>
					<th>ID</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody id="table-data">
				
			</tbody>
		</table>
	</div>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			function loadTable(page){
				$.ajax({
					url: "ajax_load_pagination",
					type: "POST",
					data: {page_no :page},
					success : function(data){
						if(data){
							$('#pagination').remove();
							$('#table-data').append(data);
						}else{
							$('#ajaxbtn').prop('disabled',true);
						}
					}
				})
			}
			loadTable();

			//pagination code
			$(document).on("click", "#pagination a",function(e){
				e.preventDefault();
				var page_id= $(this).data("id");
				loadTable(page_id);
			});
		});
	</script>
</body>
</html>

