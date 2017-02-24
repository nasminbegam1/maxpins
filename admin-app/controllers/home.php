<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->templatelayout->get_header();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_footer();
		$this->elements['middle']	= 'dashboard';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function dashboard()
	{
		$this->data = array();
		$this->load->view('dashboard');
	}
	
	public function  get_dashboard_data(){
		$product_total 		= $this->model_basic->getValue_condition(PRODUCTS, 'COUNT(product_id)', 'total_product','');
		$wholesaler_total 	= $this->model_basic->getValue_condition(WHOLESALER, 'COUNT(wholesaler_id)', 'total_wholesaler','wholesaler_status="Active"');
		$new_order_total 	= $this->model_basic->getValue_condition(ORDER_MASTER, 'COUNT(id)', 'total_new_orders','shipping_status = "New"');
		echo json_encode(
				 array(
					'total_product'		=> $product_total,
					'total_wholesaler'	=> $wholesaler_total,
					'analytics'		=> $this->getanalytics(date('Y-m-d',strtotime('-1 months',strtotime(date('Y-m-d')))),date('Y-m-d')),
					'new_order'		=> $new_order_total,
					'admin_name'		=> $this->nsession->userdata('ADMIN_NAME')
				      )
				 );
		exit;
	}
	
	public function login()
	{
		$this->data = array();
		$this->load->view('login');
	}
	
	public function loginAction()
	{
		extract($_POST);
		
		$data = $this->model_basic->getValues_conditions(ADMINUSER,'','',' email_id="'.$email.'"  and password = md5("'.$password.'") and status="active" ');
		
		$response['code'] = 0;
		$response['text'] = 'Login Failed: username passowrd mismatched';
		
		if(is_array($data))
		{
			$data = $data[0];
			
			$this->nsession->set_userdata('ADMIN_ID',$data['admin_id']);
			$this->nsession->set_userdata('ADMIN_EMAIL',$data['email_id']);
			
			$this->nsession->set_userdata('ADMIN_NAME', stripslashes($data['first_name']). ' '. stripslashes($data['last_name']));
			$_SESSION['data'] = $data;
			$response['code'] 	= 1;
			$response['id']		= $data['admin_id'];
			$response['name']	= $data['first_name'].' '.$data['last_name'];
			$response['text'] 	= 'Login Successfull';	
		}
		
		echo json_encode($response);
	}
	
	public function logout()
	{
		$this->nsession->unset_userdata('ADMIN_ID');
		$this->nsession->unset_userdata('ADMIN_EMAIL');
		$this->nsession->unset_userdata('ADMIN_NAME');
		$this->nsession->unset_userdata('ADMINORDERFLUG');
		
		$response['response_code'] = 1;
		echo json_encode($response);
		exit;
	}
	
	public function profile()
	{
		$this->load->view('profile');
	}
	
	public function get_details()
	{
		$admin_id	= $this->nsession->userdata('ADMIN_ID');
		
		$admin_info	= $this->model_basic->getValues_conditions(ADMINUSER,'','',' admin_id="'.$admin_id.'" and status="active" ');
		
		$response['admin_id']	= $admin_id;
		$response['first_name']	= $admin_info[0]['first_name'];
		$response['last_name']	= $admin_info[0]['last_name'];
		$response['email']	= $admin_info[0]['email_id'];
		
		echo json_encode($response);
		exit;
	}
	
	public function update_profile()
	{
		$admin_id  = $this->nsession->userdata('ADMIN_ID');
		
		$first_name	= $this->input->post(trim(addslashes('first_name')));
		$last_name	= $this->input->post(trim(addslashes('last_name')));
		$password	= $this->input->post(trim(addslashes('password')));
		
		$this->nsession->set_userdata('ADMIN_NAME', $first_name. ' '. $last_name);
		
		if($password != 'undefined')
		{
			$updateArr = array(
				
					'first_name'	=> $first_name,
					'last_name'	=> $last_name,
					'password'	=> md5($password)
				    );
		}
		else
		{
			$updateArr = array(
				
					'first_name'	=> $first_name,
					'last_name'	=> $last_name
				    );
		}
		
		$idArr		= array('admin_id' => $admin_id);
		$response	= $this->model_basic->updateIntoTable(ADMINUSER, $idArr, $updateArr);
		
		echo  $response;
		exit;
		
	}
	
	public function get_session_values()
	{
		//$response['admin_id']	= $this->nsession->userdata('ADMIN_ID');
		$response=$this->nsession->all_userdata();
		$response['admin_id'] = $response['ADMIN_ID'];
		echo json_encode($response);
		exit;
	}
	
	
	
	public function getanalytics($start,$end)
	{
		//echo $start.'<br/>'.$end;die;
		
            $record=array();
            $this->data=array();
            $record['total_sessions']=0;  
            $record['total_users']=0;
            $record['total_newusers']=0;
            $record['total_percent_new_user']=0;
            $record['total_page_views']=0;
            $record['total_page_views_per_session']=0;
            $record['total_avg_session_duration']=0;
            $record['total_bounce_rate']=0;    
               
            if($start!='' and $end!='')
	    //if($start=='' and $end=='')
	    {        
             
                    // PROJECT NAME : 'Api project' IN https://console.developers.google.com
                    
                     $library            =   FILE_ABSOLUTE_PATH.'admin-app/libraries/GoogleAnalyticsAPI.class.php';
                    include($library);
        
                    $ga = new GoogleAnalyticsAPI('service');
                    $ga->auth->setClientId( CLIENT_ID ); // From the APIs console
                    $ga->auth->setEmail( EMAIL ); // From the APIs console
                    $ga->auth->setPrivateKey( P12_FILE_PATH ); // Path to the .p12 file
        
                    $auth = $ga->auth->getAccessToken();
                    
                    if ($auth['http_code'] == 200) {
                        $accessToken = $auth['access_token'];
                        $tokenExpires = $auth['expires_in'];
                        $tokenCreated = time();
                    }
        
                    $ga->setAccessToken($accessToken);
                    $ga->setAccountId( ACCOUNT_ID );
                  
                    $defaults = array(
                        'start-date' => date("Y-m-d",strtotime($start)),
                        'end-date'   => date("Y-m-d",strtotime($end))
                    );
                   
                    $ga->setDefaultQueryParams($defaults);
              
                    
                    $params = array(
                        'metrics'    => 'ga:users,ga:pageviewsPerSession,ga:avgSessionDuration,ga:bounceRate',
                        'dimensions' => 'ga:date',
                    );
                    $visits = $ga->query($params);
              
                    //pr($visits);
                    if(is_array($visits) and array_key_exists("totalsForAllResults",$visits)){
                     
                        $record['total_users']                  =   $visits['totalsForAllResults']['ga:users'];
			
                        $record['total_page_views_per_session'] =   number_format($visits['totalsForAllResults']['ga:pageviewsPerSession'],2);
                        $record['total_avg_session_duration']   =   ceil($visits['totalsForAllResults']['ga:avgSessionDuration']);
                        $record['total_bounce_rate']            =   number_format($visits['totalsForAllResults']['ga:bounceRate'],2);
                        
                    }
            }
            return $record;
           
	}
	
}