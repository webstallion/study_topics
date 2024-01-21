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
					<h1 style="float: left;">Form</h1>
				</td>
			</tr>
			<tr>
				<td id="table-form">
					<form id="addForm" method="post" action="<?= base_url('st_controller/save-form') ?>">
						First Name: <input type="text" name="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Last Name:  <input type="text" name="lname">
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


	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>
</body>
</html>

