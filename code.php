<?php

//Import PHPMailer classes into the global namespace

//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;



require 'PHPMailer/src/Exception.php';

require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';



defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->lib->session_check();

		$this->load->library('email');

	}





	public function dashboard()

	{





		$data['title'] = 'Dashboard';



		$data['css'] = '';



		$data['script'] = '';



		$data['page'] = 'admin/include/main_content';

		$todaysrecords  = $this->db->get('tbl_register');

		$data['total_records'] = $todaysrecords->num_rows();



		$this->db->where('is_agreement', '2');

		$todaysrecords1  = $this->db->get('tbl_register');

		$data['total_activate'] = $todaysrecords1->num_rows();

		$this->load->view('admin/dashboard', $data);

	}



	public function franchise_list()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '7';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);



		$data['title'] = 'Franchise List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/franchise/list';

		$data['rec'] = $this->model->hdm_get('tbl_franchise');

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}







	public function franchise_add()

	{

		$data['title'] = 'franchise add';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/franchise/add';

		$data['rec'] = $this->model->hdm_get('tbl_franchise');

		$data['action'] = 'franchise-store';



		$this->load->view('admin/dashboard', $data);

	}

	public function franchise_store()

	{

		$insert['franchise_name'] = $this->input->post('franchise_name');

		$insert['create_at'] = date('Y-m-d H:i:s');

		$res = $this->model->hdm_insert('tbl_franchise', $insert);

		redirect(base_url('franchise-add'));

	}



	public function caller_add()

	{

		$data['title'] = 'Caller add';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/caller/add';

		$data['rec'] = $this->model->hdm_get('tbl_caller');

		$data['franchise_rec'] = $this->model->hdm_get('tbl_franchise');



		$data['action'] = 'caller-store';

		$this->load->view('admin/dashboard', $data);

	}





	public function caller_list()

	{

		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '5';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);









		$data['title'] = 'Caller List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/caller/caller_list';

		$data['rec'] = $this->model->hdm_get('tbl_caller');

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}

	public function caller_store()

	{

		$insert['caller_name'] = $this->input->post('caller_name');

		$insert['franchise_id'] = $this->input->post('franchise_id');

		$insert['create_at'] = date('Y-m-d H:i:s');



		$res = $this->model->hdm_insert('tbl_caller', $insert);

		redirect(base_url('caller-add'));

	}

	public function plan_add()

	{

		$data['title'] = 'plan add';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/plan/add';

		$data['action'] = 'plan-store';

		//	die('here');

		$this->load->view('admin/dashboard', $data);

	}

	public function plan_store()

	{

		$insert['plan_no'] = $this->input->post('plan_no');

		$insert['plan_name'] = $this->input->post('plan_name');

		$insert['days'] = $this->input->post('days');

		$insert['forms'] = $this->input->post('forms');



		$insert['per_form'] = $this->input->post('per_form');

		$insert['cutoff'] = $this->input->post('cutoff');

		$insert['fees'] = $this->input->post('fees');

		$insert['cancel_charge'] = $this->input->post('cancel_charge');

		$insert['first_part'] = $this->input->post('first_part');

		$insert['mul_login_chrg'] = $this->input->post('mul_login_chrg');

		$insert['not_submit_chrg'] = $this->input->post('not_submit_chrg');

		$insert['create_at'] = date('Y-m-d H:i:s');

		$res = $this->model->hdm_insert('tbl_plan', $insert);

		redirect(base_url('plan-list'));

	}



	public function plan_list()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '6';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);









		$data['title'] = 'Plan List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';



		$data['rec'] = $this->model->hdm_get('tbl_plan');

		$data['action'] = '';

		$data['page'] = 'admin/plan/list';

		$this->load->view('admin/dashboard', $data);

	}



	public function register_add()

	{





		$data['title'] = 'User add';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/register/add';

		$data['action'] = 'register-store';

		$data['plan_rec'] = $this->model->hdm_get('tbl_plan');





		$data['franchise_rec'] = $this->model->hdm_get('tbl_franchise');

		$data['agreement_rec'] = $this->model->hdm_get('tbl_agreement');



		$this->load->view('admin/dashboard', $data);

	}





	public function register_list()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '3';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Register List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';





		$today = date('Y-m-d');



		$this->db->select('*');

		$this->db->join('tbl_plan', 'tbl_plan.id = tbl_register.plan_id', 'LEFT');

		$this->db->join('tbl_franchise', 'tbl_franchise.id = tbl_register.franchise_id', 'LEFT');

		$this->db->join('tbl_caller', 'tbl_caller.id = tbl_register.caller_id', 'LEFT');

		$this->db->limit(100, 1);

		$this->db->where('end_date >=', $today);

		$query = $this->db->get('tbl_register');

		$res = $query->result(); // as object

		//$res = $query->result_array(); // as array

		//return $res;



		$data['rec'] = $res; //$this->model->hdm_get('tbl_register');

		$data['action'] = '';

		$data['page'] = 'admin/register/add';

		$this->load->view('admin/dashboard', $data);

	}



	public function get_callers()

	{

		$franchise_id = $this->input->post('franchise_id');

		$where = array('franchise_id' => $franchise_id);

		$rec = $this->model->hdm_get_where('tbl_caller', $where);

		//print_r($rec);

		$option = "";

		foreach ($rec as $r) {

			$option  .= '<option value="' . $r->id . '">' . $r->caller_name . '</option>';

		}

		$response = array('status' => 1, 'data' => $option);

		echo  json_encode($response);

	}



public function register_store()
	{
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$where = array('mobile' => $mobile);
		$where1 = array('email' => $mobile);
		$is_exitmobile = $this->model->hdm_get_where_count('tbl_register', $where);
		$is_exitemail = $this->model->hdm_get_where_count('tbl_register', $where1);
		if ($is_exitmobile > 0) {
			$this->session->set_flashdata('Failded', 'Customer with mobile  already exits');
			return 	redirect(base_url('register-list'));
		}

		if ($is_exitemail > 0) {
			$this->session->set_flashdata('Failded', 'Customer with Email  already exits');
			return 	redirect(base_url('register-list'));
		}

		$insert['name'] = $this->input->post('name');
		$insert['mobile'] = $mobile;
		$insert['email'] = $email;
		$insert['address'] = $this->input->post('address');
		$insert['plan_id'] = $this->input->post('plan_id');
		$insert['franchise_id'] = $this->input->post('franchise_id');
		$insert['caller_id'] = $this->input->post('caller_id');
		$insert['agreement_id'] = $this->input->post('agreement_id');
		$insert['is_agreement'] = '0';
		$insert['create_at'] = date('Y-m-d H:i:s');

		$insert['reg_date'] = date('Y-m-d');

		// aadhar card 

		if (isset($_FILES['aadharcard']['name']) && $_FILES['aadharcard']['name'] != '') {
			$insert['aadharcard'] = $this->lib->pic_upload('aadharcard');
		}

		if (isset($_FILES['pancard']['name']) && $_FILES['pancard']['name'] != '') {
			$insert['pancard'] = $this->lib->pic_upload('pancard');
		}



		$password = rand(12345, 99999);

		$insert['decpassword'] = $password;


		$pdf = $this->generate_pdf($insert);

		$insert['agreement_url'] = $pdf;
		$insert['password'] = $this->encryption->encrypt($password);
		$insert_id = $this->model->hdm_live_id('tbl_register', $insert);

		//	$random = substr(str_shuffle(MD5(microtime())), 0, 8);

		$customer_id = $insert_id . date("dmY");
		$set = array('customer_id' => $customer_id);
		$where = array('id' => $insert_id);
		$this->model->hdm_update_where('tbl_register', $set, $where);

		$send_mail = $this->send_mail2($customer_id, $password, $pdf, $email);

		if ($send_mail == true) {
			$this->session->set_flashdata('success', 'Registered Successfully ID is ' . $customer_id . ' And passowrd is ' . $password . ' /Register Email send successfully  ');
		} else {
			$this->session->set_flashdata('success', 'Registered Successfully ID is ' . $customer_id . ' And passowrd is ' . $password . ' /Register Email send successfully..');
		}
		redirect(base_url('register-list'));
	}

	function send_mail2($customer_id, $password, $pdf, $email)
	{

		$this->load->library('email');
		// $fromemail="theultimate@sparesengineer.com";
		$fromemail = "support@gkinfoteck.com";
		$toemail = $email;
		$subject = "Terms And Condition";
		$data = array('ID' => $customer_id, 'password' => $password);
		$mesg = $this->load->view('email/register_email', $data, true);
		$config = array(
			'charset' => 'utf-8',
			'wordwrap' => TRUE,
			'mailtype' => 'html'
		);

		$this->email->initialize($config);
		$this->email->to($toemail);
		$this->email->from($fromemail, "globalservicesjob");
		$this->email->subject($subject);
		$attactfile = base_url() . 'admin_assets/pdf/' . $pdf;

		$audio_file = base_url() . 'admin_assets/audio_demo.mp3';

		$this->email->attach($attactfile);
		$this->email->attach($audio_file);
		$this->email->message($mesg);
		$mail = $this->email->send();
	}



	public function send_mail($customer_id, $password, $pdf, $email)
	{
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host   ='mail.globalservicesjob.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'support@globalservicesjob.com';                     //SMTP username
			$mail->Password   = 'QkkSlwxHkwiH';
			//$mail->SMTPAutoTLS = false;                              //SMTP password
			 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;
			//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('support@globalservicesjob.com', 'globalservicesjob');
			$mail->addAddress($email);     //Add a recipient
			$audio_file = '/home/ltx8i4fswi8y/globalservicesjob.com/admin_assets/audio_demo.mp3';
			$attactfile = '/home/ltx8i4fswi8y/globalservicesjob.com/admin_assets/pdf/' . $pdf;
			$mail->addAttachment($audio_file);         //Add attachments
			$mail->addAttachment($attactfile);    //Optional name
			$data = array();
			$data = array('ID' => $customer_id, 'password' => $password);
			$mesg = $this->load->view('email/register_email', $data, true);
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = "Terms And Condition";
			$mail->Body    = $mesg;

			$mail->send();
			return true;
		} catch (Exception $e) {
			// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
	}
	function activate_listing()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '11';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);









		$data['title'] = 'Activate List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';





		$this->db->select('*');

		$this->db->join('tbl_plan', 'tbl_plan.id = tbl_register.plan_id', 'LEFT');

		$this->db->join('tbl_franchise', 'tbl_franchise.id = tbl_register.franchise_id', 'LEFT');

		$this->db->join('tbl_caller', 'tbl_caller.id = tbl_register.caller_id', 'LEFT');

		$this->db->where('is_agreement', '1');

		$query = $this->db->get('tbl_register');

		$data['rec']  = $query->result(); // as object 

		// $where = array('is_agreement'=>'1');

		// $data['rec'] =  $this->model->hdm_get_where('tbl_register',$where);

		$data['action'] = '';

		$data['page'] = 'admin/activate/list';

		$this->load->view('admin/dashboard', $data);

	}





	function new_resume()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '2';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'add_per' => '1');

		$data_records = $this->check_permission($where);



		$data['title'] = 'New Resume';

		$data['css'] = '';

		$data['script'] = '';

		$data['action'] = 'store_resume';

		$data['page'] = 'admin/resume/add_resume';

		$this->load->view('admin/dashboard', $data);

	}



	function store_resume()

	{

		$this->db->select_max('id');

		$res1 = $this->db->get('tbl_resumes');

		if ($res1->num_rows() > 0) {

			$res2 = $res1->result_array();



			$resume_id = $res2[0]['id'];

		}

		$path = './uploads/resumes';

		$files = $_FILES['images'];

		$config = array(

			'upload_path'   => $path,

			'allowed_types' => 'pdf',

			'overwrite'     => 1,

			'max_size'		=> '1024'

		);



		$this->load->library('upload', $config);

		$images = array();

		foreach ($files['name'] as $key => $image) {



			echo "<br>" . 'me';



			$resume_id++;

			$_FILES['images[]']['name'] = $files['name'][$key];

			$_FILES['images[]']['type'] = $files['type'][$key];

			$_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];

			$_FILES['images[]']['error'] = $files['error'][$key];

			$_FILES['images[]']['size'] = $files['size'][$key];



			//  $fileName = $resume_id.$image;

			// $images[] = $resume_id;

			$config['file_name'] = $resume_id;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('images[]')) {

				$this->upload->data();

				$insert['resume_id'] = $resume_id;

				$insert['doc'] = $resume_id . '.pdf';

				$res = $this->model->hdm_insert('tbl_resumes', $insert);

			} else {

				$errs = $this->upload->display_errors();

				print_r($errs);

			}

		}

		print_r($images);

		//redirect(base_url('resume-list'));

	}

	function resume_list()

	{





		$data['title'] = 'Resume List';

		$data['css']   = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

					  <link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

					   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';



		$data['rec'] = $this->model->hdm_get('tbl_resumes');

		$data['action'] = '';

		$data['page'] = 'admin/resume/resume_list';

		$this->load->view('admin/dashboard', $data);

	}

	function search()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '26';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$customer_id = $this->input->post('customer_id');

		$data['title'] = 'Search';

		$data['css']   = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

					  <link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

					   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';



		//$where = array('customer_id'=>$customer_id);



		$this->db->select('*,tbl_register.id as reg_id');

		$this->db->join('tbl_plan', 'tbl_plan.id = tbl_register.plan_id', 'LEFT');

		$this->db->join('tbl_franchise', 'tbl_franchise.id = tbl_register.franchise_id', 'LEFT');

		$this->db->join('tbl_caller', 'tbl_caller.id = tbl_register.caller_id', 'LEFT');

		$this->db->where('tbl_register.customer_id', $customer_id);

		$query = $this->db->get('tbl_register');

		$res = $query->result(); // as object



		$data['rec'] = $res;

		$data['action'] = 'search';

		$data['page'] = 'admin/activate/search';

		$this->load->view('admin/dashboard', $data);

	}



	public function activate_list()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '13';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);









		$data['title'] = 'Activate Users';

		$data['css']   = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

					  <link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

					   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';



		// $where = array('customer_id'=>$customer_id);



		$today = date('Y-m-d');

		$this->db->select('*,tbl_register.id as reg_id');

		$this->db->join('tbl_plan', 'tbl_plan.id = tbl_register.plan_id', 'LEFT');

		$this->db->join('tbl_franchise', 'tbl_franchise.id = tbl_register.franchise_id', 'LEFT');

		$this->db->join('tbl_caller', 'tbl_caller.id = tbl_register.caller_id', 'LEFT');

		$this->db->where('tbl_register.is_active', '1');

		$this->db->where('reg_date BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW()');

		$this->db->limit(100, 1);



		$this->db->where('end_date >=', $today);

		$query = $this->db->get('tbl_register');

		$res = $query->result(); // as object



		$data['rec'] = $res;

		$data['action'] = '';

		$data['page'] = 'admin/activate/activate_list';

		$this->load->view('admin/dashboard', $data);

	}



	function help_request()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '14';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Search';

		$data['css']   = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

					  <link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

					   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';





		$data['rec'] = $this->model->get_qry_details();

		$data['action'] = '';

		$data['page'] = 'admin/help_request/customer_req';

		$this->load->view('admin/dashboard', $data);

	}



	function open_customer_request($id)

	{













		$data['title'] = 'Reuqest';

		$data['css'] = '';

		$data['script'] = '';

		$data['action'] = 'update_field_req';

		$data['page'] = 'admin/help_request/edit_customer_req';

		$data['rec'] = $this->model->get_qry_detailsform($id);

		$this->load->view('admin/dashboard', $data);

	}



	function update_field_req()

	{



		$qryfldid = $this->input->post('qryfldid');

		$where = array('id' => $qryfldid);

		$set['status'] = '1';

		$set['value'] = $this->input->post('qry_field');

		$this->model->hdm_update_where('tbl_qry_field', $set, $where);

		return redirect('help-request');

	}





	function activate_agreement()

	{



		$id = $this->input->post('id');

		$where = array('customer_id' => $id);

		$register_data =  $this->model->hdm_get_where('tbl_register', $where);



		$customer_id = $register_data[0]->customer_id;

		$plan_id     =  $register_data[0]->plan_id;



		$email =  $register_data[0]->email;



		$where = array('id' => $plan_id);

		$plan_data =  $this->model->hdm_get_where('tbl_plan', $where);

		$forms = $plan_data[0]->forms;

		$days = $plan_data[0]->days;





		$this->db->select_max('id');

		$res1 = $this->db->get('tbl_resumedata');

		if ($res1->num_rows() > 0) {

			$res2 = $res1->result_array();

			$maxidOfresume = $res2[0]['id'];

		}



		for ($i = 0; $i < $forms; $i++) {

			//$insert['resume_id'] = rand(1, $maxidOfresume);
			$insert['resume_id'] = rand(1, 500);

			$insert['customer_id'] = $customer_id;



			$res = $this->model->hdm_insert('tbl_form', $insert);

		}



		$today = date('Y-m-d h:i:s');

		$end_date = date('Y-m-d h:i:s', strtotime($today . ' +' . $days . ' day'));

		$set = array('is_agreement' => '2', 'activate_date' => $today, 'end_date' => $end_date);

		$where = array('customer_id' => $customer_id);

		$this->model->hdm_update_where('tbl_register', $set, $where);





		$subject = 'WORKLOAD';

		$attactfile = "";



		$data['ID'] = $register_data[0]->customer_id;

		$data['password'] = $register_data[0]->decpassword;



		$mesg = $this->load->view('email/workload_email', $data, true);



		$fromemail = 'support@globalservicesjob.com';

		$this->sendmail($email, $mesg, $subject, $attactfile, $fromemail);







		$response = array('status' => '1', 'msg' => 'User account activate successfully');

		echo  json_encode($response);

	}



	function generate_pdf($data)

	{

		$this->load->library('pdf');

		$html_content = $this->load->view('pdf/sign', $data, true);

		$this->pdf->loadHtml($html_content);

		$this->pdf->render();

		$output = $this->pdf->output();

		$date = date('Ymdhis');

		file_put_contents('admin_assets/pdf/' . $date . '.pdf', $output);

		$response = $date . '.pdf';



		// chmod($_SERVER['DOCUMENT_ROOT'] .'admin_assets/pdf/'.$response,0777);



		return  $response;

	}





	function date_extent()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '15';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Date extent';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/date/add';

		$data['action'] = 'update-date-search';

		$this->load->view('admin/dashboard', $data);

	}



	function coming_soon()

	{



		$data['title'] = 'coming soon';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/coming_soon';

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}



	function get_last_date()

	{



		$customerID = $this->input->post('customerID');

		$expiredate = $this->model->get_last_date($customerID);

		$response = array('status' => '1', 'expdate' => $expiredate);

		echo  json_encode($response);

	}

	function update_date_extent()

	{



		$customerID = $this->input->post('customerID');

		$end_date = $this->input->post('end_date');

		$set = array('end_date' => $end_date);

		$where = array('customer_id' => $customerID);

		$this->model->hdm_update_where('tbl_register', $set, $where);

		//print_r($this->db->last_query());

		return redirect('date-extent');

	}



	function check_dataexit()

	{



		$response = array('status' => '0', 'msg' => '');

		$checktype = $this->input->post('checktype');

		$value = $this->input->post('value');

		if ($checktype == '1') { // check  mobile 

			$where = array('mobile' => $value);

		} else { //check email

			$where = array('email' => $value);

		}

		$records  = $this->model->hdm_get_where('tbl_register', $where);



		if (!empty($records)) {

			$response = array('status' => '1', 'msg' => 'already exit');

		}

		echo  json_encode($response);

	}



	function delete_records()

	{







		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = $this->input->post('pid');

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'remove_per' => '1');

		echo $data_records = $this->check_permission_delete($where);







		if ($data_records == false) {



			$response = array('status' => '2');

		} else {





			$id = $this->input->post('id');

			$table = $this->input->post('table_name');

			$this->db->where('id', $id);

			$this->db->delete($table);

			$errors = $this->db->error();



			if ($table == 'tbl_franchise') {

				$this->db->where('franchise_id', $id);

				$this->db->delete('tbl_caller');

			}

			//	print_r($errors);

			if ($errors['code'] == 1451) {

				$response = array('status' => '0');

			} else {

				$response = array('status' => '1');

			}

		}



		echo json_encode($response);

	}



	function edit_franchaise($id)

	{

		$data['title'] = 'Edit Franchise';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/franchise/edit';

		$data['rec'] = $this->model->hdm_get_where('tbl_franchise', array('id' => $id));

		$data['action'] = 'update_franchise';

		$this->load->view('admin/dashboard', $data);

	}





	function update_franchise()

	{

		$where = array('id' => $_POST['id']);

		$set = $_POST;

		$this->model->hdm_update_where('tbl_franchise', $set, $where);

		return redirect('franchise-add');

	}



	function edit_caller($id)

	{



		$data['title'] = 'Edit Caller';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/caller/edit';

		$data['rec'] = $this->model->hdm_get_where('tbl_caller', array('id' => $id));

		$data['franchise_rec'] = $this->model->hdm_get('tbl_franchise');

		// $option ="";

		// foreach($franchaise as $r){

		// 	$option  .='<option value="'.$r->id.'">'.$r->franchise_name.'</option>';

		// }

		$data['action'] = 'update_caller';

		$this->load->view('admin/dashboard', $data);

	}



	function update_caller()

	{

		$where = array('id' => $_POST['id']);

		$set = $_POST;

		$this->model->hdm_update_where('tbl_caller', $set, $where);

		return redirect('caller-add');

	}



	function edit_plan($id)

	{



		$data['title'] = 'plan Edit';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/plan/planedit';

		$data['action'] = 'update_plan';

		$data['rec'] = $this->model->hdm_get_where('tbl_plan', array('id' => $id));

		$this->load->view('admin/dashboard', $data);

	}

	function update_plan()

	{

		$where = array('id' => $_POST['id']);

		$set = $_POST;

		$this->model->hdm_update_where('tbl_plan', $set, $where);

		return redirect('plan-list');

	}



	public function customeractionlist()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '22';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Register List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';







		$this->db->select('*,tbl_register.id as reg_id');

		$this->db->join('tbl_plan', 'tbl_plan.id = tbl_register.plan_id', 'LEFT');

		$this->db->join('tbl_franchise', 'tbl_franchise.id = tbl_register.franchise_id', 'LEFT');

		$this->db->join('tbl_caller', 'tbl_caller.id = tbl_register.caller_id', 'LEFT');

		$query = $this->db->get('tbl_register');

		$res = $query->result(); // as object

		//$res = $query->result_array(); // as array

		//return $res;



		$data['rec'] = $res; //$this->model->hdm_get('tbl_register');

		$data['action'] = '';

		$data['page'] = 'admin/register/customer_actionlist';

		$this->load->view('admin/dashboard', $data);

	}



	function delete_customers()

	{



		$id = $this->input->post('id');

		$where1 = array('id' => $id);

		$row = 'customer_id';

		$customer_id = $this->model->hdm_get_where_row('tbl_register', $where1, $row);

		$where = array('customer_id' => $customer_id);

		$this->model->hdm_delete('tbl_query', $where);

		$this->model->hdm_delete('tbl_qry_field', $where);

		$this->model->hdm_delete('tbl_form', $where);

		$this->model->hdm_delete('tbl_register', $where);

		$this->model->hdm_delete('tbl_approve', $where);

		$this->model->hdm_delete('tbl_approve_result', $where);

		$this->model->hdm_delete('tbl_customer_log', $where);



		$response = array('status' => '1', 'msg' => 'Customer Delete successfully');

		echo json_encode($response);

		// print_r($this->db->last_query());

		// $errors = $this->db->error();

		// print_r($errors);

	}



	public function deactivate_customers()

	{

		$id = $this->input->post('id');

		$where = array('id' => $id);

		$set['is_active'] = '0';

		$update = $this->model->hdm_update_where('tbl_register', $set, $where);

		$response = array('status' => '1', 'msg' => 'Customer Deactivate successfully');

		echo json_encode($response);

		//return true;



	}



	function sendmail($email, $mesg, $subject, $attactfile, $fromemail)

	{

		$this->load->library('email');

		// $fromemail="theultimate@sparesengineer.com";

		// $fromemail="support@globalservicesjob.com	";

		$toemail = $email;

		$subject = $subject;

		$data = array('email' => $email);

		//$mesg = $this->load->view('email/register_email',$data,true);

		$config = array(

			'charset' => 'utf-8',

			'wordwrap' => TRUE,

			'mailtype' => 'html'

		);



		$this->email->initialize($config);

		$this->email->to($toemail);

		$this->email->from($fromemail, "globalservicesjob");

		$this->email->subject($subject);



		if ($attactfile != "") {

			$this->email->attach($attactfile);

		}





		$this->email->message($mesg);

		$mail = $this->email->send();

	}

	function reminder_mail()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '17';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);



		$data['title'] = 'Reminder Mail';

		$data['css'] = '';

		$data['script'] = '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/reminder_mail';

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}

	function remider_mail_send()

	{

		$ids = $this->input->post('ids');

		$subject = "Reminder Mail";

		$data = array();

		$mesg = $this->load->view('email/reminder_email', $data, true);

		$sendfrom = 'legal@globalservicesjob.com';

		$attactfile = ""; //temp

		foreach ($ids as $cid) {

			$email = $this->model->get_emailbycustid($cid);

			$this->send_mail_withmailer($email, $sendfrom, $mesg, $subject);

		}

		$response = array('status' => '1');

		echo json_encode($response);

	}





	function resend_mail_send()

	{

		$response = array('status' => '0', 'msg' => 'Something went wrong');

		$ids = $this->input->post('ids');



		foreach ($ids as $cid) {

			$where = array('customer_id' => $cid);

			$customer_records = $this->model->hdm_get_where('tbl_register', $where);

			$password = $customer_records[0]->decpassword;

			$pdf = $customer_records[0]->agreement_url;

			$email = $customer_records[0]->email;

			$response = $this->send_mail($cid, $password, $pdf, $email);

			if ($response == 'true') {

				$response = array('status' => '1', 'msg' => 'Mail send successfully');

			} else {

				$response = array('status' => '0', 'msg' => 'Something went wrong');

			}

		}



		echo json_encode($response);

	}



	function warning_mail_send()

	{



		$ids = $this->input->post('ids');

		$mobile_no = $this->input->post('phone');

		//	print_r($ids);

		$subject = "LEGAL NOTICE FOR BREACH OF CONTRACT";

		$data = array();

		$mobile_no = $this->input->post('phone');



		foreach ($ids as $cid) {



			$where = array('customer_id' => $cid);

			$customer_records = $this->model->hdm_get_where('tbl_register', $where);



			$data['email'] = $customer_records[0]->email;

			$data['address'] = $customer_records[0]->address;

			$data['cid'] = $customer_records[0]->customer_id;

			$data['customer_endate'] = $customer_records[0]->end_date;

			$data['name'] = $customer_records[0]->name;

			$data['mobile_no'] = $mobile_no;

			$mesg = $this->load->view('email/warning_email', $data, true);

			$email = $this->model->get_emailbycustid($cid);



			$sendfrom = 'legal@globalservicesjob.com';

			// $this->sendmail($email,$mesg,$subject,$attactfile,$fromemail);

			$this->send_mail_withmailer($email, $sendfrom, $mesg, $subject);

		}

		$response = array('status' => '1');

		echo json_encode($response);

	}









	/*	public function send_mail_withmailer($email, $sendfrom, $mesg, $subject)
	{
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'mail.globalservicesjob.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication

			$mail->Username   = 'legal@globalservicesjob.com';                     //SMTP username
			$mail->Password   = 'Es@nEFoR6Y[Y';
			// $mail->Username   = $emailusername;                     //SMTP username
			// $mail->Password   = $emailpassword; 
			//$mail->SMTPAutoTLS = false;                              //SMTP password
			 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;

			$mail->setFrom($sendfrom, 'globalservicesjob');
			$mail->addAddress($email);     //Add a recipient
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $mesg;
			$mail->send();
			return true;
		} catch (Exception $e) {
			 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
	}*/
	
		public function send_mail_withmailer($email, $sendfrom, $mesg, $subject)
	   {
            $this->load->library('email');
            $fromemail = "legal@gkinfoteck.com";
            //$fromemail = "legal@globalservicesjob.com";
        	$config = array(
			'charset' => 'utf-8',
			'wordwrap' => TRUE,
			'mailtype' => 'html'
		);
            $this->email->initialize($config);
		    $this->email->to($email);
    		$this->email->from($fromemail, "globalservicesjob");
    		$this->email->subject($subject);
    		$this->email->message($mesg);
            
            if ($this->email->send()) {
                echo "Message sent successfully";
                return true;
            } else {
                echo "Message could not be sent.";
                return false;
           }

	    }
	    
	function noc_mail()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '18';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'NOC Mail';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/noc';

		$data['action'] = 'send_noc';

		$this->load->view('admin/dashboard', $data);

	}



	function send_noc()

	{



		$customer_id = $this->input->post('customer_id');

		$amount = $this->input->post('amount');

		$subject = "NOC";



		$where = array('customer_id' => $customer_id);



		 $check_approve = $this->model->hdm_get_where_count('tbl_register', $where);

				if ($check_approve <= 0) {

					 	$this->session->set_flashdata('error','Customer ID Not found');

					    return redirect('noc_mail');

				}



			

		$customer_records = $this->model->hdm_get_where('tbl_register', $where);

		$email = $customer_records[0]->email; //$this->model->get_emailbycustid($customer_id);

		$name = $customer_records[0]->name;

		$reg_date = $customer_records[0]->reg_date;

		$data = array('id' => $customer_id, 'amount' => $amount, 'name' => $name, 'reg_date' => $reg_date);

		$attactfile = $this->create_noc($data);

		$this->load->library('email');



		$fromemail = "support@globalservicesjob.com";



		$config = array(

			'charset' => 'utf-8',

			'wordwrap' => TRUE,

			'mailtype' => 'html'

		);

		$html_content = $this->load->view('email/noc_email', $data, true);

		$this->email->initialize($config);

		$this->email->to($email);

		$this->email->from($fromemail, "NOC");

		$this->email->subject($subject);

		$attactfile = base_url() . 'admin_assets/nocpdf/' . $attactfile;

		$this->email->attach($attactfile);

		$this->email->message($html_content);

		$mail = $this->email->send();



		//$this->sendmail($email,$html_content,$subject,$attactfile);

		$insertData['customer_id'] = $customer_id;

		$insertData['noc'] = $attactfile;

		$insertData['amount'] = $amount;

		$insertData['create_at'] = date('Y-m-d h:i:s');

		$this->db->insert('tbl_noc',$insertData);



		$this->session->set_flashdata('success','NOC sent successfully');



		return redirect('noc_mail');

	}



	function create_noc($data)

	{



		$this->load->library('pdf');

		$html_content = $this->load->view('pdf/noc', $data, true);

		$this->pdf->loadHtml($html_content);

		$this->pdf->render();

		$output = $this->pdf->output();

		$date = date('Ymdhis');

		file_put_contents('admin_assets/nocpdf/' . $date . '.pdf', $output);

		$response = $date . '.pdf';

		return  $response;

	}



	function submission_fail()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '20';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);





		$data['title'] = 'Submission Failded';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

		<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

							<script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>';

		$data['page'] = 'admin/submission/fail_submission';

		$data['action'] = '';



		$where = array('submission_status' => '1');

		$data['rec'] = $this->model->get_registerDetails($where);



		$this->load->view('admin/dashboard', $data);

	}

	function submission_notsubmit()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '19';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$today = date('y-m-d');

		$data['title'] = 'Not Submitted';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

		<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

							<script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>';

		$data['page'] = 'admin/submission/not_submission';

		$data['action'] = '';

		$today = date('y-m-d');

		$where = array('submission_status' => '2');



		$today = date('Y-m-d');

		//    $this->db->where('end_date >=',$today);



		$this->db->order_by('end_date', 'DESC');



		$data['rec'] = $this->model->get_registerDetails($where);

		$this->load->view('admin/dashboard', $data);

	}

	public function submission_pass()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '21';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Submission pass';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

							<script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

							<script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>';

		$data['page'] = 'admin/submission/submission_pass';

		$data['action'] = '';

		$today = date('y-m-d');

		$where = array('submission_status' => '3');

		$this->db->order_by('end_date', 'DESC');

		$data['rec'] = $this->model->get_registerDetails($where);

		$this->load->view('admin/dashboard', $data);

	}

	public function work_space()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '23';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Work space';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/work_space';

		$data['action'] = '';

		$data['rec'] = '';



		$customer_id = $this->input->post('customer_id');

		$name = $this->input->post('name');

		$email = $this->input->post('email');



		$where = array();



		if ($customer_id != "") {

			$where = array('customer_id' => $customer_id);

			$data['rec'] = $this->model->hdm_get_where('tbl_register', $where);

		}

		if ($name != "") {

			$where = array('name' => $name);

			$data['rec'] = $this->model->hdm_get_where('tbl_register', $where);

		}

		if ($email != "") {

			$where = array('email' => $email);

			$data['rec'] = $this->model->hdm_get_where('tbl_register', $where);

		}





		$this->load->view('admin/dashboard', $data);

	}





	function caller_report()

	{







		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '9';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);









		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '6';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);





		$data['title'] = 'Caller Report';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/css/custom.css">';

		$data['script'] = '';

		$data['page'] = 'admin/caller/caller_report';

		$data['rec'] = $this->model->hdm_get('tbl_franchise');



		// $data['rec1'] = $this->model->hdm_get('tbl_caller');



		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}



	function caller_month_report()

	{







		$data['title'] = 'Caller Month  Report';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/css/custom.css">';

		$data['script'] = '';

		$data['page'] = 'admin/caller/caller_month_report';

		$data['rec'] = $this->model->hdm_get('tbl_franchise');



		// $data['rec1'] = $this->model->hdm_get('tbl_caller');



		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}



	function customer_qc()

	{





		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '16';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'QC Report';

		$data['css'] = '';

		$data['script'] = ' <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

							<script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>

							<script src="' . base_url() . 'admin_assets/js/admin_validation.js"></script>';

		// $data['page'] = 'admin/qc/add_qc';

		$data['page'] = 'admin/qc/autoqc';

		$this->db->select('customer_id,id');

		$this->db->where('submission_status', '4');

		$query = $this->db->get('tbl_register');

		$res = $query->result(); // as object



		//$res = $query->result_array(); // as array



		$attributes = array('class' => 'email', 'id' => 'form_approveid');



		$data['cust_rec'] = $res;

		$data['action'] = 'autoformapproved';

		$this->load->view('admin/dashboard', $data);

	}



	public function autoformapproved()

	{

		$customer_id = $this->input->post('customer_id');

		$this->db->where('customer_id',$customer_id);

		$query = $this->db->get('tbl_form');

		$records = $query->result(); // as object

		$fid =0;

		foreach($records as $rows){



			$recorddata = array();

			$resume_id = $rows->resume_id;

			$where1 = array('id'=>$resume_id);

			$recorddata = $this->model->hdm_get_where('tbl_resumedata', $where1); //get resume orignal data



			$form_id = $rows->id;

			$customer_id =  $rows->customer_id;



			if(trim($rows->mis) == $recorddata[0]->mis){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

			//echo $fid_status .'<br>';

		//	echo $rows->mis.'<br>';
            if($fid_status== '0'){
			$fid = 1;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

            }

			if(trim($rows->first_name) == $recorddata[0]->first_name){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 2;
			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

            }

			if(trim($rows->last_name) == $recorddata[0]->last_name){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}
            if($fid_status== '0'){
			$fid = 3;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

            }

			if(trim($rows->contact_no) == $recorddata[0]->contact_no){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 4;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

        }

			if(trim($rows->alternate_no) == $recorddata[0]->alternate_no){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}


        if($fid_status== '0'){
			$fid = 5;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->email) == $recorddata[0]->email){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}


        if($fid_status== '0'){
			$fid = 6;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->company_name) == $recorddata[0]->company_name){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}


        if($fid_status== '0'){
			$fid = 7;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->website_url) == $recorddata[0]->website_url){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 8;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

        }

			if(trim($rows->address) == $recorddata[0]->address){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 9;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->city) == $recorddata[0]->city){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 10;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->state) == $recorddata[0]->state){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 11;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->zip) == $recorddata[0]->zip){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 12;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->sic_desc) == $recorddata[0]->sic_desc){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 13;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->sic_code) == $recorddata[0]->sic_code){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}
        
        if($fid_status== '0'){
			$fid = 14;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

        }

			if(trim($rows->entity_type) == $recorddata[0]->entity_type){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 15;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

        }

			if(trim($rows->company_sale) == $recorddata[0]->company_sale){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 16;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);

        }

			if(trim($rows->revenue) == $recorddata[0]->revenue){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 17;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->country) == $recorddata[0]->country){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 18;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


			if(trim($rows->medical_ins) == $recorddata[0]->medical_ins){

				$fid_status = '1';

			} else {

				$fid_status = '0';

			}

        if($fid_status== '0'){
			$fid = 19;

			$this->approvedata($form_id,$customer_id,$fid,$fid_status);
        }


		}
		$set['submission_status'] = '1';

		$where = array('customer_id' => $customer_id);

		$this->model->hdm_update_where('tbl_register', $set, $where);

		$this->session->set_flashdata('success', 'Auto QC  successfully');

		return redirect('customer_qc');



	}



	function approvedata($form_id,$customer_id,$fid,$fid_status){



		$insertapproveArr = array();

		$insertapproveArr['form_id'] = $form_id;

		$insertapproveArr['customer_id'] = $customer_id;

		$insertapproveArr['fid'] = $fid;

		$insertapproveArr['fid_status'] = $fid_status;



		$where = array(

			'customer_id' => $customer_id,

			'form_id' => $form_id,

			'fid' => $fid,

		);



		$check_approve = $this->model->hdm_get_where_count('tbl_approve', $where);

		if ($check_approve > 0) {

			$this->model->hdm_update_where('tbl_approve', $insertapproveArr, $where);

		} else {

			$this->model->hdm_insert('tbl_approve', $insertapproveArr);

		}





		// return true;

	}

	function customer_form()

	{

		$id = $this->input->post('id');

		$where = array('customer_id' => $id);

		$rec = $this->model->hdm_get_where('tbl_form', $where);

		$option = '<option value="">Select</option>';

		$i = 1;

		foreach ($rec as $r) {

			$option  .= '<option value="' . $r->id . '">' . $i . '</option>';

			$i++;

		}

		$response = array('status' => 1, 'data' => $option);

		echo  json_encode($response);

	}

	function customer_formdata()

	{



		$form_id = $this->input->post('form_id');

		$cust_id = $this->input->post('cust_id');

		$where = array('customer_id' => $cust_id, 'id' => $form_id);

		$rec = $this->model->hdm_get_where('tbl_form', $where);

		$response = array('status' => 1, 'data' => $rec[0]);

		echo  json_encode($response);

	}



	function form_approve()

	{



		$customer_id = $this->input->post('customer_id');

		$form_id = $this->input->post('customer_form');

		$insert['customer_id'] = $customer_id;

		$insert['form_id'] = $form_id;

		$i = 1;

		$check_disapprove = 2;

		for ($i = 1; $i <= 40; $i++) {

			if (isset($_POST['field_id' . $i])) {

				$insert['fid_status'] = $_POST['field_id' . $i];

				$insert['fid'] = $i;



				//check already approve 



				$where = array(

					'customer_id' => $customer_id,

					'form_id' => $form_id,

					'fid' => $i,



				);

				$check_approve = $this->model->hdm_get_where_count('tbl_approve', $where);

				if ($check_approve > 0) {

					$set['fid_status'] = $_POST['field_id' . $i];

					$this->model->hdm_update_where('tbl_approve', $set, $where);

				} else {



					$this->model->hdm_insert('tbl_approve', $insert);

				}





				if ($_POST['field_id' . $i] == '0') { //

					$check_disapprove = 0;

				} else {

				}

			}

		}



		if ($check_disapprove == '2') { // everthing is approve 



			$app_insert['customer_id'] = $customer_id;

			$app_insert['form_id'] = $form_id;

			$app_insert['status'] = '1';

			$this->model->hdm_insert('tbl_approve_result', $app_insert);

		}



		//	return redirect('customer_qc');

		$msg = 'form submit succesfully';

		$response = array('status' => 1, 'msg' => $msg, 'next_form' => $insert['form_id'] + 1);

		echo  json_encode($response);

	}



	public function qc_pass_faild()

	{



		$customer_id = $this->input->post('cust_id');





		$wherecust1 = array('customer_id' => $customer_id);

		$register_data =  $this->model->hdm_get_where('tbl_register', $wherecust1);

		$plan_id     =  $register_data[0]->plan_id;



		$plan_data =  $this->model->hdm_get_where('tbl_plan', array('id' => $plan_id));

		$total_form = $plan_data[0]->forms;



		$where = array('customer_id' => $customer_id);

		$total_pass = $this->model->hdm_get_where_count('tbl_approve_result', $where);

		$where = array('customer_id' => $customer_id, 'fid_status' => '0');

		$total_fail = $this->model->hdm_get_where_count('tbl_approve', $where);



		if ($total_pass >= 0.9*($total_form)) {

			$submission_pass = 1;

		} else {

			$submission_pass = 0;

		}

		$response = array('status' => 1, 'total_pass' => $total_pass, 'total_fail' => $total_fail, 'submission_pass' => $submission_pass);

		echo  json_encode($response);

	}





	public function master_setting()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '24';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'Master Setting';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/master_setting';

		$data['action'] = 'master-edit';

		$data['rec'] = $this->model->hdm_get('tbl_master');

		$this->load->view('admin/dashboard', $data);

	}



	public function update_master_setting()

	{





		$where = array('id' => $_POST['id']);









		if (isset($_FILES['seal']['name']) && $_FILES['seal']['name'] != '') {

			$set['seal'] = $this->lib->pic_upload('seal');

		} else {

			$set['seal'] = $this->input->post('seal_old');

		}



		if (isset($_FILES['logo']['name']) && $_FILES['logo']['name'] != '') {

			$set['logo'] = $this->lib->pic_upload('logo');

		} else {

			$set['logo'] = $this->input->post('logo_old');

		}





		if (isset($_FILES['company_sign']['name']) && $_FILES['company_sign']['name'] != '') {

			$set['company_sign'] = $this->lib->pic_upload('company_sign');

		} else {

			$set['company_sign'] = $this->input->post('oldcompany_sign');

		}



		if (isset($_FILES['agreement_img']['name']) && $_FILES['agreement_img']['name'] != '') {

			$set['agreement_img'] = $this->lib->pic_upload('agreement_img');

		} else {

			$set['agreement_img'] = $this->input->post('oldagreement_img');

		}





		$set['name'] = $this->input->post('name');

		$set['address'] = $this->input->post('address');

		$set['state'] = $this->input->post('state');

		$set['care_no'] = $this->input->post('care_no');

		$set['care_no2'] = $this->input->post('care_no2');

		$set['care_eml'] = $this->input->post('care_eml');

		$this->model->hdm_update_where('tbl_master', $set, $where);

		$this->session->set_flashdata('Failded', 'Data Update successfully');

		return redirect('master_setting');

	}





	function change_password()

	{



		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '25';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);







		$data['title'] = 'change password';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/change_password';

		$data['rec'] = $this->model->hdm_get_where('Admin', array('id' => '1'));

		$data['action'] = 'update_change_password';

		$this->load->view('admin/dashboard', $data);

	}



	function update_change_password()

	{



		$where = array('id' => $_POST['id']);

		$set['email'] = $this->input->post('email');

		if ($this->input->post('password') != "") {

			$set['password'] = $this->encryption->encrypt($this->input->post('password'));

		}

		$this->model->hdm_update_where('Admin', $set, $where);

		$this->session->set_flashdata('success', 'Data Update successfully');

		return redirect('change_password');

	}





	function get_approve_data()

	{



		$customer_id = $this->input->post('cust_id');

		$form_id = $this->input->post('form_id');

		$data = $this->model->hdm_get_where('tbl_approve', array('customer_id' => $customer_id, 'form_id' => $form_id));



		if (sizeof($data) > 0) {

			$response = array('status' => '1', 'data' => $data);

		} else {

			$response = array('status' => '0', 'data' => '');

		}



		echo json_encode($response);

	}







	function customer_qcsubmit($cust_id)

	{

		$data['title'] = 'Reuqest';

		$data['css'] = '';

		$data['script'] = '';

		$data['action'] = 'update_qc_submission';

		$data['page'] = 'admin/qc/qc_submit';

		$data['rec'] = ''; //$this->model->get_qry_detailsform($id);

		$this->load->view('admin/dashboard', $data);

	}



	public function update_qc_submission()

	{

		$customer_id = $this->input->post('customer_id');

		$set['submission_status'] = '4';

		$where = array('customer_id' => $customer_id);

		$this->model->hdm_update_where('tbl_register', $set, $where);
        $this->session->set_flashdata('success', 'Data Update successfully');
		return redirect('customer_qc');

	}



	function add_role()

	{



		$data['title'] = 'Role Add';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/role/add_role';

		$data['action'] = 'store_role';

		$this->load->view('admin/dashboard', $data);

	}

	function store_role()

	{

		$insert['username'] = $this->input->post('name');

		$insert['password'] = $this->encryption->encrypt($this->input->post('password'));

		$insert['email'] =  $this->input->post('email');

		$res = $this->model->hdm_insert('Admin', $insert);

		$this->session->set_flashdata('success', 'Added Successfully');

		redirect(base_url('add-role'));

	}



	public function role_manage()

	{

		$data['title'] = 'Role Manage';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/role/role_manage';

		$data['roles'] = $this->model->hdm_get('Admin');

		$data['permissions'] = $this->model->hdm_get('permissions');

		$data['action'] = 'update_permission';

		$this->load->view('admin/dashboard', $data);

	}



	function update_permission()

	{

		$role_id = $this->input->post('role_id');



		for ($i = 1; $i <= 27; $i++) {



			$role_id = $this->input->post('role_id');

			$insert['role_id'] = $role_id;

			$insert['permission_id']  = $i;

			$insert['add_per']  = isset($_POST['add_' . $i]) ? $_POST['add_' . $i] : 0;

			$insert['edit_per']  = isset($_POST['edit_' . $i]) ? $_POST['edit_' . $i] : 0; //$_POST['edit_'.$i];

			$insert['remove_per']  = isset($_POST['remove_' . $i]) ? $_POST['remove_' . $i] : 0; //$_POST['remove_'.$i];

			$insert['view_per']  = isset($_POST['view_' . $i]) ? $_POST['view_' . $i] : 0; //$_POST['view_'.$i];



			$where = array(

				'role_id' => $role_id,

				'permission_id' => $i,

			);

			$check_approve = $this->model->hdm_get_where_count('permission_role', $where);

			if ($check_approve > 0) {



				$this->model->hdm_update_where('permission_role', $insert, $where);

			} else {

				$this->model->hdm_insert('permission_role', $insert);

			}

		}

		$this->session->set_flashdata('success', 'Added Successfully');

		redirect(base_url('role_manage'));

	}





	public function check_permission($where)

	{

		$check_approve = $this->model->hdm_get_where_count('permission_role', $where);

		if ($check_approve > 0) {

			return true;

		} else {

			$this->session->set_flashdata('error', 'You do not have permission');

			return redirect('admin-dashboard');

		}

	}





	function check_permission_delete($where)

	{





		$check_approve = $this->model->hdm_get_where_count('permission_role', $where);

		if ($check_approve > 0) {



			return true;

		} else {

			$this->session->set_flashdata('error', 'You do not have permission');

			return false;

		}

	}





	public function check_permission_records()

	{

		$role_id = $this->input->post('role_id');

		$data = $this->model->hdm_get_where('permission_role', array('role_id' => $role_id));



		if (sizeof($data) > 0) {

			$response = array('status' => '1', 'data' => $data);

		} else {

			$response = array('status' => '0', 'data' => '');

		}



		echo json_encode($response);

	}





	function  resumes_store()

	{

		$n = '3290';



		for ($i = 1; $i <= $n; $i++) {



			$insert['resume_id'] = $i;

			$insert['doc'] = $i . '.pdf';

			$res = $this->model->hdm_insert('tbl_resumes', $insert);

		}

		echo 'done';

	}





	public function role_list()

	{



		// $rid = $this->session->userdata('admin_sess')['role_id'];

		// $pid = '7';

		// $where = array('role_id'=>$rid,'permission_id'=>$pid,'view_per'=>'1');

		// $data_records = $this->check_permission($where);



		$data['title'] = 'Role List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/role/role_list';

		$data['rec'] = $this->model->hdm_get('Admin');

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}





	public function resend_sign()

	{

		$customer_id = $this->input->post('id');

		$set = array('is_agreement' => '0');

		$where = array('customer_id' => $customer_id);

		$this->model->hdm_update_where('tbl_register', $set, $where);

		$response = array('status' => '1', 'msg' => 'User resign successfully');

		echo  json_encode($response);

	}







	public function walletbalance()

	{





		$today = date('Y-m-d');

		$where = array('submit_at!=' => '', 'plan_id' => '4');

		// $this->model->hdm_update_where('tbl_register',$set,$where);

		$this->db->where('end_date >=', '2022-03-14');

		$this->db->where('end_date <=', '2022-03-15');





		$rec = $this->model->hdm_get('tbl_register');





		foreach ($rec as $r) {



			echo $total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $r->customer_id, 'submit_at!=' => ''));



			echo 'wallet:' . $r->wallet . '<br>';

			// echo $r->id.'<br>';

			// echo $r->end_date.'<br>';



			$set['wallet'] = $total_customer_form * 30;

			$where = array('id' => $r->id);

			$this->model->hdm_update_where('tbl_register', $set, $where);

		}

	}



	

	public function customerlogbyid()

	{

		$customerId = $this->input->post('customerId');

		$data['title'] = $customerId.'-log';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

		   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

		   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>';

		$data['action'] = 'customer-log';

		$data['page'] = 'admin/register/customerlog';

		$this->db->where('customer_id', $customerId);

		$query = $this->db->get('tbl_customer_log');

		$data['rec'] =   $query->result(); // as object

		$this->load->view('admin/dashboard', $data);



	}



  

	public function noclist()

	{

		$data['title'] = 'NOC List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

					<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

					   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

					   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>';

		$data['page'] = 'admin/noclist';

		$query = $this->db->get('tbl_noc');

		$res = $query->result(); // as object

		$data['rec'] = $res;

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}



	function resume_create()

	{

		// $rid = $this->session->userdata('admin_sess')['role_id'];

		// $pid = '2';

		// $where = array('role_id' => $rid, 'permission_id' => $pid, 'add_per' => '1');

		// $data_records = $this->check_permission($where);

		$data['title'] = 'Add Resume';

		$data['css'] = '';

		$data['script'] = '';

		$data['action'] = 'exceltopdf';

		$data['page'] = 'admin/resume/resume_create';

		$this->load->view('admin/dashboard', $data);

	}



	public function exceltopdf()

	{



		$this->load->library('pdf');

		require_once APPPATH . "/third_party/PHPExcel.php";

		$this->db->select_max('id');

		$res1 = $this->db->get('tbl_resumes');

		if($res1->num_rows() > 0) {

			$res2 = $res1->result_array();

			$resume_id = $res2[0]['id'];

		}

		$path = 'uploads/pictures/';

			if (isset($_FILES['images']['name']) && $_FILES['images']['name'] != '') {

						$import_xls_file = $this->lib->excel_upload('images');

		}

		$inputFileName = $path . $import_xls_file;

		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

		$objReader = PHPExcel_IOFactory::createReader($inputFileType);

		$objPHPExcel = $objReader->load($inputFileName);

		$allDataInSheet = $objPHPExcel->getActiveSheet(1)->toArray(null, true, true, true);

		

		$i = 0;

		$html_content="<!DOCTYPE html><html lang='en'><head>";

		$html_content .="	<style>*{margin: 0;padding: 0;box-sizing: border-box;}p{margin: 0;padding: 0;	font-weight: 600;}table{border-spacing: 0;}	</style></head><body>";

		// print_r($allDataInSheet);

		foreach ($allDataInSheet as $value) {

		

			if( $value['A'] != "" &&  $i != 0){

				$inserdata =array();

				$inserdata['mis'] = $this->removewhitespace($value['A']);

				$inserdata['first_name'] = $this->removewhitespace($value['B']);

				$inserdata['last_name'] = $this->removewhitespace($value['C']);

				$inserdata['contact_no'] = $this->removewhitespace($value['D']);

				$inserdata['alternate_no'] =$this->removewhitespace($value['E']);

				$inserdata['email'] = $this->removewhitespace($value['F']);

				$inserdata['company_name'] = $this->removewhitespace($value['G']);

				$inserdata['website_url'] = $this->removewhitespace($value['H']);

				$inserdata['address'] = $this->removewhitespace($value['I']);

				$inserdata['city'] = $this->removewhitespace($value['J']);

				$inserdata['state'] =$this->removewhitespace ($value['K']);

				$inserdata['zip'] = $this->removewhitespace($value['L']);

				$inserdata['sic_desc'] = $this->removewhitespace($value['M']);

				$inserdata['sic_code'] = $this->removewhitespace($value['N']);

				$inserdata['entity_type'] = $this->removewhitespace($value['O']);

				$inserdata['company_sale'] = $this->removewhitespace($value['P']);

				$inserdata['revenue'] = $this->removewhitespace($value['Q']);

				$inserdata['country'] = $this->removewhitespace($value['R']);

				$inserdata['medical_ins'] = $this->removewhitespace($value['S']);

				$this->session->set_userdata($inserdata);

				$html_content .= $this->load->view('pdf/docresume', $inserdata, true);

				$this->session->unset_userdata($inserdata);



				$res = $this->model->hdm_insert('tbl_resumedata', $inserdata);







			}   else {

			//	die('file not found');

			}

			$i++;

		}





	

		// echo $html_content;

		// die();

		$this->pdf->loadHtml($html_content);

		$this->pdf->render();

		$output = $this->pdf->output();

		$num= rand(1,9999);

		file_put_contents('admin_assets/pdf/'.date('D-M-y').$num.'.pdf', $output);



		$datarec['name'] = date('D-M-y').$num.'.pdf';

		$res = $this->model->hdm_insert('tbl_resumelist', $datarec);

   	redirect(base_url('resume_create'));

	}





	function removewhitespace($value){

			

		$lstr = ltrim($value);

		$str = rtrim($lstr);

		return  $str;



	}



	public function createresume_list()

	{

		$rid = $this->session->userdata('admin_sess')['role_id'];

		$pid = '5';

		$where = array('role_id' => $rid, 'permission_id' => $pid, 'view_per' => '1');

		$data_records = $this->check_permission($where);

		$data['title'] = 'Excel Resume List';

		$data['css'] = '<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.css">

						<link rel="stylesheet" href="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';

		$data['script'] = '<script src="' . base_url() . 'admin_assets/bundles/datatables/datatables.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>

						   <script src="' . base_url() . 'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>

						   <script src="' . base_url() . 'admin_assets/js/page/datatables.js"></script>

						   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

		$data['page'] = 'admin/resume/createresume_list';

		$data['rec'] = $this->model->hdm_get('tbl_resumelist');

		$data['action'] = '';

		$this->load->view('admin/dashboard', $data);

	}

}
