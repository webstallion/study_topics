<?php
	class St_controller extends AIV_Controller {
	  public function __construct(){
	    parent::__construct();
	    $this->load->library('globalvar');
	    $this->load->model('gen_model');
	    $this->load->model('St_model');
	  }

		public function insert_data(){
			if($_POST){
				$arrayName = array(
											'firstname' => $_POST['fistname'], 
											'lastname' => $_POST['lastname'], 
										 );
				if($this->gen_model->add('st_student', $arrayName)){
					echo 1;
				}else{
					echo 0;
				}
			}else{	
				$this->load->view('st_view/insert_data');
			}
		}

		public function load_update_form(){
			if($_POST){
				$id=$_POST['id'];
				$st_data = $this->gen_model->get_single_date('st_student', array('id' => $id));
				if(isset($st_data)){
					$output_data = "<tr>
							<th>First name</th>
							<td><input type='text' value='{$st_data->firstname}' id='edit-fname'></td>
						</tr>
						<tr>
							<th>L name</th>
							<td><input type='text' value='{$st_data->lastname}' id='edit-lname'></td>
						</tr>
						<tr>
							<th></th>
							<td><input type='submit' id='edit-submit' data-editid='{$st_data->id}' value='Save'></td>
						</tr>";
						echo $output_data;
				}else{
					echo "<h2>No Record Found</h2>";
				}
			}
		}

		public function ajax_pagination(){
			$limit_per_page= 5;
			$page="";
			if(isset($_POST['page_no'])){
				$page=$_POST["page_no"];
			}else{
				$page=1;
			}
			$offset = ($page-1)*$limit_per_page;
			$st_data = $this->St_model->get_data_limit_offset('st_student', $limit_per_page, $offset);
			$output="";
			if(count($st_data)>0){
				$st_all_data = $this->St_model->get_data('st_student');
				$a=count($st_all_data)/$limit_per_page;
				$a1=ceil($a);
				$output.='<table id="main" border="1" style="width: 25%;">
					<tbody>
						<tr>
							<td colspan="3" id="header" style="background: #21a343; text-align: center;">
								<h1>Pagination</h1>
							</td>
						</tr>
						<tr style="background: #21a343;">
							<th>S.N</th>
							<th>ID</th>
							<th>Name</th>
						</tr>';
						$i=0;foreach ($st_data as $value) {$i++;
							$output .=	"<tr>
								<td align='center'>{$i}</td>
								<td align='center'>{$value->id}</td>
								<td align='center'>{$value->firstname}&nbsp{$value->lastname}</td>
							</tr>";
						}
					$output .= '</tbody>
				</table>';
				$output .='<div id="pagination" style="margin-top: 10px;">';
				for ($b=1; $b <= $a1 ; $b++) { 
					if($page==$b){
						$class='active';
					}else{
						$class='';
					}
					$output.="<a class='{$class}' style='padding: 5px;background: green;' id='{$b}' href=''>{$b}</a>";
				}
				$output.='</div>';
				echo $output;
			}else{
				echo "<h2>No Record Found</h2>";
			}
		}

		public function update_form(){
			if($_POST){
				$id=$_POST['id'];
				$arrayName = array(
											'firstname' => $_POST['first_name'], 
											'lastname' => $_POST['last_name'], 
										 );
				if($this->gen_model->edit('st_student', $arrayName,array('id'=>$id))){
					echo 1;
				}else{
					echo 0;
				}
			}else{	
				$this->load->view('st_view/insert_data');
			}
		}

		public function ajax_load(){
			$get_data = $this->data['compliances'] = $this->St_model->get_all_date('st_student');
			if(count($get_data)>0){
				$output="<table border='1' width='100%' cellspacing='0' cellpadding='10px'>
									<tr>
										<th>ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>";
									foreach($get_data as $row){
										$output.="<tr>
											<td>{$row->id}</td>
											<td>{$row->firstname}</td>
											<td>{$row->lastname}</td>
											<td><button class='btn edit-btn' data-eid='{$row->id}'>Edit</button></td>
											<td><button class='btn delete-btn' data-id='{$row->id}'>Delete</button></td>
										</tr>";
									}	
				$output .="<table>";
				echo $output;							
			}else{
				echo "<h1>record not found!.</h1>";
			}
		}

		public function live_search(){
			$search=$_POST['search'];
			$get_data = $this->St_model->live_search($search);
			if(count($get_data)>0){
				$output="<table border='1' width='100%' cellspacing='0' cellpadding='10px'>
									<tr>
										<th>ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>";
									$i=0; foreach($get_data as $row){ $i++;
										$output.="<tr>
											<td>{$row->id}</td>
											<td>{$row->firstname}</td>
											<td>{$row->lastname}</td>
											<td><button class='btn edit-btn' data-eid='{$row->id}'>Edit</button></td>
											<td><button class='btn delete-btn' data-id='{$row->id}'>Delete</button></td>
										</tr>";
									}	
				$output .="<table>";
				echo $output;							
			}else{
				echo "<h1>record not found!.</h1>";
			}
		}

		public function pagination(){
			$this->load->view('st_view/pagination');
		}

		public function Load_more_pagination(){
			$this->load->view('st_view/load_more_pagination');
		}

		public function ajax_load_pagination(){
			$limit_per_page= 5;
			$page="";
			if(isset($_POST['page_no'])){
				$page=$_POST["page_no"];
			}else{
				$page=0;
			}
			$i=0;
			$st_data = $this->St_model->get_data_limit_offset('st_student', $limit_per_page, $page);
			$output="";
			if(count($st_data)>0){
			  foreach ($st_data as $value) {$i++;
						$output .=	"<tr>
							<td align='center'>{$i}</td>
							<td align='center'>{$value->id}</td>
							<td align='center'>{$value->firstname}&nbsp{$value->lastname}</td>
						</tr>";
				}
				$output .="<tr id='pagination'><td colspan='3'><a style='padding: 5px;background: green' id='ajaxbtn' data-id='{$value->id}' href=''>Load more..</a></td>
					</tr>";
				echo $output;
			}else{
				echo "<h2>No Record Found</h2>";
			}
		}
		public function delete_data(){
			if($_POST){
				$id=$_POST['id'];
				if($this->gen_model->delete_tower('st_student', $id)){
					echo 1;
				}else{
					echo 0;
				}
			}
		}
		public function json(){
			$this->load->view('st_view/json');
		}
		public function my_json(){
			$data=$this->load->view('st_view/my.json');
		}
		//work these functions
		public function JsonEncode(){
			$get_data = $this->data['get_data'] = $this->St_model->get_all_date('st_student');
			$this->load->view('st_view/jsonencode');
			// echo json_encode($get_data);
		}
		public function JsonEncodeAjax(){
			$id=$_POST['id'];
			$get_data = $this->data['get_data'] = $this->St_model->get_all_date_condition('st_student', array('id'=>$id));
			echo json_encode($get_data);
		}
		//close these functions

		//work these functions
		public function JsonDecode(){
			//$get_data = $this->data['get_data'] = $this->St_model->get_all_date('st_student');
			$this->load->view('st_view/JasonDecode');
		}
		public function my_json_url(){
			$this->load->view('st_view/my.json');
		}
		public function my_json_data(){
			$var=base_url('st_controller/my_json_url');
			$jsondata= file_get_contents($var);
			$arr= json_decode($jsondata,true);
			echo $arr;
		}
		//close these functions

		public function JsonFile(){
			$get_data = $this->data['get_data'] = $this->St_model->get_all_date('st_student');
			$this->load->view('st_view/json_form');
			//$json_data=json_encode($get_data);
		}

		public function save_form(){
			if($_POST['fname'] !='' && $_POST['lname'] !=''){
				$current_data=base_url('st_controller/data_student_url');
				$get_data=file_get_contents($current_data);
				$array_data=json_decode($get_data, true);
				$new_data=array(
										'firstname'=>$_POST['fname'],
										'lastname'=>$_POST['lname'],
									);
				$array_data[]=$new_data;
				$json_data=json_encode($array_data,JSON_PRETTY_PRINT);
				if(file_put_contents($current_data, $json_data)){
					echo "<h3>Successfully saved data in JSON file.</h3>";
				}else{
					echo "<h3>Unsuccessfully saved data in JSON file.</h3>";
				}
			}else{
				echo "<h3>All form fields are required.</h3>";
			}
		}

		public function data_student_url(){
			$this->load->view('st_view/my.json');
		}

		public function javascript(){
			$this->load->view('javascript/index');
		}

		public function javascript2(){
			$this->load->view('javascript/typing_speed');
		}

	}
?>