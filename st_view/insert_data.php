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
	<table id="main" border="0" cellspacing="0">
		<tbody>
			<tr>
				<td id="header" style="background: #21a343;">
					<h1 style="float: left;">Add Records</h1>
					<h1 style="float: left;margin-left:50px;">Search: <input type="text" name="search" id="search"></h1>
				</td>
			</tr>
			<tr>
				<td id="table-form">
					<form id="addForm">
						First Name: <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Last Name:  <input type="text" id="lname">
						<input type="submit" id="save-button" value="Save">
					</form>
				</td>
			</tr>
			<tr>
				<td id="table-data" style="border: 1px solid red;">
				</td>
			</tr>
		</tbody>
	</table>
	<div id="error_msg"></div>
	<div id="success_msg"></div>

	<div id="modal">
		<div id="modal-form">
			<h2>Edit Form</h2>
			<table id="main" border="0" cellspacing="0">
				<tbody>
					
				</tbody>
			</table>
			<div id="close-btn">X</div>
		</div>
	</div>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			function loadTable(){
				$.ajax({
					url: "ajax_load",
					type: "POST",
					success : function(data){
						$('#table-data').html(data);
					}
				})
			}
			loadTable();

			$("#save-button").click(function(e){
				e.preventDefault();
				var fname=$('#fname').val();
				var lname=$('#lname').val();
				if(fname=='' || lname==''){
					$('#error_msg').html('All fields are required.').slideDown();
					$('#success_msg').slideUp();
				}else{
					$.ajax({
						url: "<?php echo base_url(); ?>/St_controller/insert_data",
						type: "POST",
						data: {fistname: fname, lastname: lname},
						success: function(data){
							if(data==1){
								loadTable();
								$('#addForm').trigger('reset');
							}else{

							} 
						}
					});
				}
			});

			//delete data
			$(document).on("click",".delete-btn", function(){
				var id=$(this).data('id');
				$.ajax({
						url: "<?php echo base_url(); ?>/St_controller/delete_data",
						type: "POST",
						data: {id: id},
						success: function(data){
							if(data==1){
								loadTable();
							}else{
								loadTable();
							} 
						}
				});
			});

			//edit form
			$(document).on("click",".edit-btn", function(){
				$('#modal').show();
				var studentID=$(this).data('eid');
				$.ajax({
					url:  "<?php echo base_url(); ?>/St_controller/load_update_form",
					type: "POST",
					data: {id:studentID},
					success: function(data){
						$("#modal-form table tbody").html(data);
					}
				})
			});

			//save update form
			$(document).on("click","#edit-submit", function(){
				var fname=$('#edit-fname').val();
				var lname=$('#edit-lname').val();
				var studentID=$(this).data('editid');
				$.ajax({
					url:  "<?php echo base_url(); ?>/St_controller/update_form",
					type: "POST",
					data: {id:studentID, first_name: fname, last_name: lname},
					success: function(data){
						if(data==1){
							$('#modal').hide();
							loadTable();
						}else{
							loadTable();
						} 
					}
				})
			});
			//hide modal box
			$('#close-btn').on("click", function(){
				$('#modal').hide();
			});

			//Live search
			$('#search').on("keyup", function(){
				var search_term=$(this).val();
				$.ajax({
					url:  "<?php echo base_url(); ?>/St_controller/live_search",
					type: "POST",
					data: {search: search_term},
					success: function(data){
						$('#table-data').html(data);
					}
				})
			});
		});
	</script>
</body>
</html>

