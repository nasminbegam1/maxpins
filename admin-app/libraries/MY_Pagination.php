<?php
if (!defined('BASEPATH')) exit('No direct access allowed.');
class MY_Pagination extends CI_Pagination{

  
    function setFrontendPaginationStyle(&$config){
		
		//$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 	= TRUE;
		
		$config['full_tag_open'] 	= '<ul class="pagination >';
		$config['full_tag_close'] 	= '</ul>';
									  
		$config['num_tag_open'] 	= '<li class="btn btn-default btn-sm">';
		$config['num_tag_close'] 	= '</li>';
		
		$config['cur_tag_open'] 	= '<li class="btn btn-default btn-sm  btn-info">';
		$config['cur_tag_close'] 	= '</li>';
		
		$config['first_tag_open'] 	= '<li class="btn btn-default btn-sm first">';
		$config['first_tag_close'] 	= '</li>';
		$config['first_link'] 		= 'First';
		
		$config['prev_tag_open'] 	= '<li class="btn btn-default btn-sm">';
		$config['prev_tag_close'] 	= '</li>';
		$config['prev_link'] 		= 'Previous';
		
		$config['next_tag_open'] 	= '<li class="btn btn-default btn-sm">';
		$config['next_tag_close'] 	= '</li>';
		$config['next_link'] 		= 'Next';
		
		$config['last_tag_open'] 	= '<li class="btn btn-default btn-sm">';
		$config['last_tag_close'] 	= '</li>';
		$config['last_link'] 		= 'Last';	
		
    }
    

    
    
    
    
    
}
?>