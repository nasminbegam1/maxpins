<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sqlquery extends MY_Controller {
 
 public function index(){	
	$this->load->view('phpmyadmin/index');
 }
 
 public function dbkp(){
  header('Content-type: application/force-download');
  header('Content-Disposition: attachment; filename="db-'.date('Y-m-d').'.sql.gz"');
  passthru("mysqldump --user=".$this->db->username." --host=".$this->db->hostname." --password=".$this->db->password." ".$this->db->database." | gzip");
 }
 
 public function export(){ //xls
  $path = '/tmp/';
  $sql = $this->input->post('sql');
  $fields = $this->input->post('fields');
  if($sql && $fields) { 
   header('Content-type: application/force-download');
   //header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
   header('Content-Disposition: attachment; filename="export-'.date('Y-m-d h:m:s').'.xls"');
   //$rand = time();
   //echo $command = 'mysql -u codeigni --host='.$this->db->hostname.' --password=Webskitters!1 '.$this->db->database.'  -e " SELECT '.$fields.' UNION ALL '.$sql.' INTO OUTFILE \''.$path.$rand.'.txt\' FIELDS TERMINATED BY \',\' ENCLOSED BY \'\' LINES TERMINATED BY \'\n\' "';
   //passthru($command);
   //sleep(3);
   //readfile("/tmp/".$rand.".txt");
   
   $rs = $this->db->query($sql);
   $rec = $rs->result_array();
   $first_row = isset($rec[0])?$rec[0]:'';
   
   echo $xls .=  '<?xml version="1.0"?>
	 <ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
	     <ss:Worksheet ss:Name="Sheet1">
		 <ss:Table>
		     <ss:Column ss:Width="80"/>
		     <ss:Column ss:Width="80"/>
		     <ss:Column ss:Width="80"/>';
	    
   if(is_array($first_row) && count($first_row)){
    echo '<ss:Row>';
    foreach($first_row as $column=>$val){
     echo '  <ss:Cell>';
     echo ' <ss:Data ss:Type="String">'.trim($column).'</ss:Data>' ;
     echo '</ss:Cell>';
     }
     echo '</ss:Row>';
   }
   
   if(is_array($rec) && count($rec)){
   
    foreach($rec as $row){
      echo ' <ss:Row>';
      foreach($row as $data){
       echo '  <ss:Cell>';
       echo '<ss:Data ss:Type="String">'.trim($data). '</ss:Data>' ;
       echo '</ss:Cell>';
      }
       echo ' </ss:Row>';
     }
   }
   
   echo '</ss:Table>
	</ss:Worksheet>
    </ss:Workbook>';
  }else{
   echo 'nothing post';
  }
  
 }
 
 public function export2(){
  
   $path = '/tmp/';
  $sql = $this->input->post('sql');
  $fields = $this->input->post('fields');
  $charArr = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Z','AA','AB','AC','AD','AE','AF','AG','AH'];
  if($sql && $fields) {
   
   $rs = $this->db->query($sql);
   $rec = $rs->result_array();
   $first_row = isset($rec[0])?$rec[0]:'';
   
   $this->load->library('excel');
  
   $this->excel->setActiveSheetIndex(0);
   $this->excel->getActiveSheet()->setTitle('test worksheet');

   $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
   
   $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $filename='just_some_random_name.xls'; //save our workbook as this file name
   header('Content-Type: application/vnd.ms-excel'); //mime type
   header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
   header('Cache-Control: max-age=0'); //no cache
	       
   //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
   //if you want to save it as .XLSX Excel 2007 format
   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
   //force user to download the Excel file without writing it to server's HD
   $objWriter->save('php://output');
 
  }
 }
 
}