<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_my_tv_schedule extends MY_Controller {
	
	function __construct()
	{
		parent ::__construct(); 
		$this->load->model('Establishment_tv_model');
		
		$this->data['sport_id']=$this->session->userdata('sport_id');
		$this->data['date_from']=$this->session->userdata('date_from'); 
		$this->data['date_end']=$this->session->userdata('date_end');
		$this->data['search_text']=$this->session->userdata('search_text');
	
		$this->data['cp']=$this->session->userdata('cp');
		$this->data['ppr']=$this->session->userdata('ppr');
		
		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_tv_model->GetUserId($e);

        $est_ref_id=$user_id[0]->id;
        $this->data['est_ref_id']= $est_ref_id;
	}
	
      
	public function goto_my_tv_schedule()
	{

		if($this->session->userdata('channel_id')!=null) 
		$this->session->unset_userdata('channel_id');
		if($this->session->userdata('sport_id')!=null) 
		$this->session->unset_userdata('sport_id');
		if($this->session->userdata('date_from')!=null) 
		$this->session->unset_userdata('date_from');
		if($this->session->userdata('date_end')!=null) 
		$this->session->unset_userdata('date_end');
		if($this->session->userdata('search_text')!=null) 
		$this->session->unset_userdata('search_text');
		if($this->session->userdata('channel_search_text')!=null) 
		$this->session->unset_userdata('channel_search_text');
		if($this->session->userdata('cp')!=null) 
		$this->session->unset_userdata('cp');
		redirect('establishment/my_tv_schedule');
	} 
	public function my_tv_schedule()
	{
		if ($this->session->userdata('email')) 
		{
		$ar= $this->session->all_userdata();
		$this->load->helper('form');
	//	print_r($ar);
		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id = $est_info['id'];
		 
		$this->data['active_schedule']='on';
		$this->data['sport_list']=$this->Establishment_tv_model->AllSport();
		$this->data['fixture_list_count']=$this->Establishment_tv_model->TotalFixtureCount($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$values=array(); 
		//$this->data['channel_search_text']="Search";
	
		$this->data['attribute_search']=$this->Establishment_tv_model->SearchFormAttribute($values);
		
		
		$this->data['total_records']= $this->data['fixture_list_count'];
		$this->data['ppr']=20;
		$cp=1;
    	if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);

		//print_r($this->data['fixture_list']);

		$this->load->view('establishment/my-tv-schedule',$this->data);
		}
		else
			redirect('establishment/login');

	} 
 

 public function display_search_my_tv_fixture()
	{
		if ($this->session->userdata('email')) {
		$this->data['active_schedule']='on';
		
		$spt_id=$this->input->get('sport_id');
		if($spt_id !=null)
		$this->session->set_userdata('sport_id',$spt_id);
		//$sport_id=$this->session->flashdata('sport_id');
		$this->data['sport_id']=$this->input->get('sport_id');
		
		$this->data['date_from']=trim($this->input->get('date_from'));
		//if($this->input->get('date_from') !=null)
		//$this->session->set_userdata('date_from',$this->data['date_from']);
		$this->data['date_end']=trim($this->input->get('date_end'));
		//if($this->input->get('date_end') !=null)
		//$this->session->set_userdata('date_end',$this->data['date_end']);
		$this->data['search_text']=trim($this->input->get('search_text'));
		//if($this->input->get('search_text') !=null)
		//$this->session->set_userdata('search_text',$this->data['search_text']);
		 $est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		 $est_info_id=$est_info['id'];

		$this->data['fixture_list_count']=$this->Establishment_tv_model->TotalFixtureCount($est_info_id,$this->data['sport_id'],
			$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);

		//for pegination
		$this->data['total_records'] = $this->data['fixture_list_count'];
		$this->data['ppr']=20;
		if($this->data['ppr'] !=null)
		$this->session->set_userdata('ppr',$this->data['ppr']);
		$cp=trim($this->input->get('cp'));
    	if(!empty($cp)){
    		$this->data['cp']=$cp;
 		if($this->data['cp'] !=null)
   		$this->session->set_userdata('cp',$cp);
    	}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		

		$this->load->view('establishment/display-my-tv-schedule',$this->data);
	}
		else
		redirect('establishment/login');

	}
	


	


	public function make_fixture_schedule()
	{
		if ($this->session->userdata('email')) {
			 
		$this->data['active_schedule']='on';

		$this->data['sport_id']=$this->input->get('sport_id');
		$this->data['fixture_id']=$this->input->get('fixture_id');
	

		$this->data['date_from']=trim($this->input->get('date_from'));
			
		$this->data['date_end']=trim($this->input->get('date_end'));
		
		$this->data['search_text']=trim($this->input->get('search_text'));

		//print_r($this->data['fixture_list']);
		$est_info=$this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
       // echo $est_ref_id;print_r($est_info);
		$est_info_id=$est_info['id'];
		$this->Establishment_tv_model->MakeFixtureSchedule($this->data['fixture_id'],$est_info_id);
		 $est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		 $est_info_id=$est_info['id'];

		$this->data['fixture_list_count']=$this->Establishment_tv_model->TotalFixtureCount($est_info_id,
			$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		//for pegination
		$this->data['total_records']=$this->data['fixture_list_count'];
		$this->data['ppr']=20;
		$cp=trim($this->input->get('cp'));
		$this->session->set_userdata('cp',$cp);
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}

    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,
			$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",". $this->data['pagination']['end_limit']
);

		$this->load->view('establishment/display-my-tv-schedule',$this->data);
		//redirect('establishment/schedule');
	}
		else
		redirect('establishment/login');

	}


	 public function Pagenation($cp,$ppr,$total_records)
    {
	   $total_page=(int)($total_records/$ppr);
	   $rem=($total_records % $ppr);
	   if($rem > 0)
	    $total_page=$total_page + 1;
	   if(empty($cp)) $cp=1;
	   $start_limit=($cp-1)*$ppr;
	   if(($total_page == $cp) and $rem > 0)
	    $end_limit=$rem;
	   else
	    $end_limit=$ppr;
	   if($total_page > $cp)
	    $next_page=$cp + 1;
	   else $next_page=0; 
	   if($cp > 1)
	    $previous_page=$cp-1;  
	   else $previous_page=0;   
	   $info['start_limit']=$start_limit;
	   $info['end_limit']=$end_limit;
	   $info['next_page']=$next_page;
	   $info['previous_page']=$previous_page;
	   $info['cp']=$cp;
	   $info['total_page']=$total_page;
	   return $info;
  	}
	
	public function downloadpdf()
	{ 
		if ($this->session->userdata('email')) 
		{
			$ar= $this->session->all_userdata();
			$this->load->helper('form');
		//	print_r($ar);
			$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
			
			$this->data['email']= $this->session->userdata('email');
			$this->data['est_name']= $est_info['title'];
			
			$est_info_id = $est_info['id'];
			 
			$this->data['active_schedule']='on';

			$this->data['sport_id']=$this->input->get('sport_id');
			$this->data['fixture_id']=$this->input->get('fixture_id');
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->data['search_text']=trim($this->input->get('search_text'));

			$this->data['sport_list']=$this->Establishment_tv_model->AllSport();
			$this->data['fixture_list_count']=$this->Establishment_tv_model->TotalFixtureCount($est_info_id,'','','','');
			
			$caller=$this->input->post('caller'); 
			$this->data['caller']= $caller;
			$values=array(); 
		
			$this->data['attribute_search']=$this->Establishment_tv_model->SearchFormAttribute($values);
			
			
			$this->data['total_records']=$this->data['fixture_list_count'];
			$this->data['ppr']=20;
			$cp=1;
			if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			//$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
			$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,'','','','','');
			
			
			
			$this->data['isPDF'] = true;
			$html = $this->load->view('establishment/download_schedule', $this->data, true);
			
			//this the the PDF filename that user will get to download
			
			$pdfFilePath = "my_tv_schedule.pdf";
			
			//$pdfFilePath = base_url()."/pdf/$filename";
			 
			//load mPDF library
			$this->load->library('m_pdf');
			//actually, you can pass mPDF parameter on this load() function
			$pdf = $this->m_pdf->load();
	
			$stylesheet1 = file_get_contents('css/bootstrap.min.css'); // external css
			$stylesheet2 = file_get_contents('css/bootstrap-theme.min.css'); // external css
			$stylesheet3 = file_get_contents('css/establishment/style.css'); // external css
	
			$pdf->WriteHTML($stylesheet1,1);
			$pdf->WriteHTML($stylesheet2,1);
			$pdf->WriteHTML($stylesheet3,1);
			//generate the PDF!
			$pdf->WriteHTML($html,2);
			//offer it to user via browser download! (The PDF won't be saved on your server HDD)
			//echo APPPATH."pdf/".$pdfFilePath; die;
			
			$pdf->Output($pdfFilePath, "D");
		}
		else
			redirect('establishment/login');
	}
	
	public function emailpdf()
	{ 
		if ($this->session->userdata('email')) 
		{
			$ar= $this->session->all_userdata();
			$this->load->helper('form');
		//	print_r($ar);
			$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
			
			$this->data['email']= $this->session->userdata('email');
			$this->data['est_name']= $est_info['title'];
			
			$est_info_id = $est_info['id'];
			 
			$this->data['active_schedule']='on';

			$this->data['sport_id']=$this->input->get('sport_id');
			$this->data['fixture_id']=$this->input->get('fixture_id');
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->data['search_text']=trim($this->input->get('search_text'));

			$this->data['sport_list']=$this->Establishment_tv_model->AllSport();
			$this->data['fixture_list_count']=$this->Establishment_tv_model->TotalFixtureCount($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
			
			$caller=$this->input->post('caller'); 
			$this->data['caller']= $caller;
			$values=array(); 
		
			$this->data['attribute_search']=$this->Establishment_tv_model->SearchFormAttribute($values);
			
			
			$this->data['total_records']=$this->data['fixture_list_count'];
			$this->data['ppr']=20;
			$cp=1;
			if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
			
			
			$this->data['isPDF'] = true;
			$html = $this->load->view('establishment/download_schedule', $this->data, true);
			
			//this the the PDF filename that user will get to download
			
			$pdfFilePath = "my_tv_schedule.pdf";
			
			//$pdfFilePath = base_url()."/pdf/$filename";
			 
			//load mPDF library
			$this->load->library('m_pdf');
			//actually, you can pass mPDF parameter on this load() function
			$pdf = $this->m_pdf->load();
	
			$stylesheet1 = file_get_contents('css/bootstrap.min.css'); // external css
			$stylesheet2 = file_get_contents('css/bootstrap-theme.min.css'); // external css
			$stylesheet3 = file_get_contents('css/establishment/style.css'); // external css
	
			$pdf->WriteHTML($stylesheet1,1);
			$pdf->WriteHTML($stylesheet2,1);
			$pdf->WriteHTML($stylesheet3,1);
			//generate the PDF!
			$pdf->WriteHTML($html,2);
			//offer it to user via browser download! (The PDF won't be saved on your server HDD)
			//echo APPPATH."pdf/".$pdfFilePath; die;
			
			$pdf->Output(APPPATH."pdf/".$pdfFilePath, "F");
				
				$path = APPPATH."pdf";
				$filename = $pdfFilePath;
				
				echo $file = $path . "/" . $filename;
				$file_size = filesize($file);
				$handle = fopen($file, "r");
				$attach = fread($handle, $file_size);
				fclose($handle);
				$attach = chunk_split(base64_encode($attach));
				
				$separator = md5(time());
				$eol = PHP_EOL;
				
				$content = '';
				$content .= '<!DOCTYPE html>';
				$content .= '<html lang="en">';
				$content .= '<head>';
				$content .= '<meta charset="utf-8">';
				$content .= '</head>';
				$content .= '<body style="background:#f0f0f0; margin:0; padding:0;">';
				$content .= '<div style="float:left; width:100%;">';
				$content .= '<div style="width:650px; margin:auto">';
				$content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
				$content .= '<div style="background:#fff; width:100%;  box-sizing:border-box; padding:0 10px; float:left;">';
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Welcome to <a href="http://sportshub365.com" style="text-decoration:none; color:#dab503;" target="_blank">Sportshub365.com</a>. <br/>Please find the attached file of your My Tv schedule.</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				
				$to = $this->data['email'];
				$subject = "My Tv Schedule - Sportshub365.com";
			
				/*$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				// main header (multipart mandatory)
				$headers = 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-Type: multipart/mixed; boundary=" '.$separator.' " ' . "\r\n";
				$headers .= 'Content-Transfer-Encoding: 7bit' . "\r\n";
				$headers .= 'This is a MIME encoded message.' . "\r\n";


				$headers .= '--' . $separator. "\r\n";
				$headers .= 'Content-Type: text/html; charset="iso-8859-1"' . "\r\n";
				$headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
				$headers .= $content . "\r\n";
	
				//attachement
				$headers .= '--' . $separator . "\r\n";
				$headers .= 'Content-Type: application/octet-stream; name="' . $filename . '"' . "\r\n";
				$headers .= 'Content-Transfer-Encoding: base64' . "\r\n";
				$headers .= 'Content-Disposition: attachment' . "\r\n";
				$headers .= $attach . "\r\n";
				$headers .= '--' . $separator . '--';
				if(mail($to,$subject,'',$headers)) {
					echo true;
				}
				else {
					echo false;
				}
				*/
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from('info@sportshub365.com', 'Sportshub365.com');
				$this->email->set_mailtype("html");
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($content);
				$this->email->attach($file);
				
				$result =$this->email->send();
				if($result) {
					echo true;
				}
				else {
					echo false;
				}

				
		}
		else
			redirect('establishment/login');
	}
}