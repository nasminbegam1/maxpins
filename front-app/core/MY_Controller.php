<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public function __construct() {
	    
            parent::__construct();
	    $this->load->model('model_basic');
	}

	/**
	 *  Login Check function
	 */
	public function chk_login()
	{
		$admin_id = $this->nsession->userdata('ADMIN_ID');
		
		if( $admin_id == '' || $admin_id < 0 )
		{
			redirect(base_url());
			return false;
		}
		return true;
	}
	
	
	public function chk_not_login(){
		$user_id = $this->nsession->userdata('user_id');
		if( $user_id && $user_id != '' )
		{
			redirect(base_url()."user/dashboard/");
			return false;
		}
		return true;
	}
	
}