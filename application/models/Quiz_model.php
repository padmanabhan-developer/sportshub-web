<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quiz_model extends CI_Model {
  public function __construct()
  {
   parent ::__construct();  
  } 
  
  public function QuestionFormAttribute($values=array(),$values_question)
  {
    $values = $values_question;
    if(count($values) == 0)
    {
      $values=array('question'=>'','answer'=>'');
    }
  if(empty($values['question']))$values['question']='';
    $attribute['form']=array('id'=>'question_frm','name'=>'question_frm');

  if(!empty($values['question']))$values['question'] = trim($values['question']);else $values['question'] ='';

    $attribute['question']=array('name'=> 'question','id'=> 'question','value' => trim($values['question']),'class'=>"input name" , 'placeholder'=>"Question",);

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now pull-right','value'=>'Save', 'onclick' => 'return form_validate();');
    return $attribute;
  }
  
  public function SettingsFormAttribute($values=array())
  {
    if(count($values) == 0)
    {
      $values=array('competition'=>'','subtext'=>'', 'text' => '');
    }
  	if(empty($values['competition']))$values['competition']='';
  
    $attribute['form']=array('id'=>'question_frm','name'=>'question_frm');

  	if(!empty($values['competition']))$values['competition'] = trim($values['competition']);else $values['competition'] ='';

    $attribute['text']=array('name'=> 'text','id'=> 'text','value' => trim($values['text']),'class'=>"input name" , 'placeholder'=>"Text",);
	
	$attribute['competition']=array('name'=> 'competition','id'=> 'competition','value' => trim($values['competition']),'class'=>"input name" , 'placeholder'=>"Competition",);
	$attribute['subtext']=array('name'=> 'subtext','id'=> 'subtext','value' => trim($values['subtext']),'class'=>"input name" , 'placeholder'=>"Text",);

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now','value'=>'Save');
    return $attribute;
  }
  
  public function GetQuestionData($id='',$from_date,$to_date,$search_text, $status='', $limit='') {
	  
	  $cond = 'where 1=1';
	  if($id!='') $cond.=" and question_id ='$id'";
	  
	  if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $cond.=" and modified_on >='$from_date'";
      }

      if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
         $cond.=" and modified_on <='$to_date'";
       }
    
       if(!empty($search_text) && $search_text!='Search') $cond.=" and (question like '%$search_text%')";
	   if($status!='') { $cond.=" and status IN ('$status')"; }	
	  
	  $sql = "select * from quiz_questions $cond order by modified_on DESC $limit";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	  
	  if($query->num_rows()>0)
       {
		$sp=array();  $i=0;
		foreach($query->result() as $row)
		{
		  if($row->question_id!='') $sp[$i]['question_id']=$row->question_id;
		  if($row->question!='') $sp[$i]['question']=$row->question;
		  if($row->total_option!='') $sp[$i]['total_option']=$row->total_option;
		  if($row->created_on!='') $sp[$i]['created_on']=$row->created_on;
		  if($row->modified_on!='') $sp[$i]['modified_on']=$row->modified_on;
		  if($row->status!='') $sp[$i]['status']=$row->status;
		  if($id!='') {
			$sql1 = "select * from quiz_answer where question_id='$row->question_id' order by created_on DESC";
			$query1 = $this->db->query($sql1);  
			if($query1->num_rows()>0) {
				$j = 0;
				foreach($query1->result() as $row1) { 
				    if($row1->answer_id != '') $sp[$i]['answer'][$j]['answer_id']=$row1->answer_id;
				    if($row1->answer!= '') $sp[$i]['answer'][$j]['answer']=$row1->answer;
				    if($row1->correct_answer!= '') $sp[$i]['answer'][$j]['correct_answer']=$row1->correct_answer;
					
					$j++;		
				}			
			}
			else {
					$sp[$i]['answer'][0]['answer_id']='';
				    $sp[$i]['answer'][0]['answer']='';
				    $sp[$i]['answer'][0]['correct_answer']='';	
			}
		  }
		  $i++;
		 }
		return $sp;
	   }
	   else {
		   	 $row = array();
		 	return $row; 
	   }
  }
  
  public function GetQuestion($id='') {
	  
	  $cond = '';
	  if($id!='') $cond.="where question_id ='$id'";
	  
	  $sql = "select * from quiz_questions $cond order by modified_on DESC";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	  
	  if($query->num_rows()>0)
       {
		$sp=array();  $i=0;
		foreach($query->result() as $row)
		{
		  if($row->question_id!='') $sp[$i]['question_id']=$row->question_id;
		  if($row->question!='') $sp[$i]['question']=$row->question;
		  if($row->total_option!='') $sp[$i]['total_option']=$row->total_option;
		  if($row->created_on!='') $sp[$i]['created_on']=$row->created_on;
		  if($row->modified_on!='') $sp[$i]['modified_on']=$row->modified_on;
		  if($row->status!='') $sp[$i]['status']=$row->status;
		  if($id!='') {
			$sql1 = "select * from quiz_answer where question_id='$row->question_id' order by created_on DESC";
			$query1 = $this->db->query($sql1);  
			if($query1->num_rows()>0) {
				$j = 0;
				foreach($query1->result() as $row1) { 
				    if($row1->answer_id != '') $sp[$i]['answer'][$j]['answer_id']=$row1->answer_id;
				    if($row1->answer!= '') $sp[$i]['answer'][$j]['answer']=$row1->answer;
				    if($row1->correct_answer!= '') $sp[$i]['answer'][$j]['correct_answer']=$row1->correct_answer;
					
					$j++;		
				}			
			}
			else {
					$sp[$i]['answer'][0]['answer_id']='';
				    $sp[$i]['answer'][0]['answer']='';
				    $sp[$i]['answer'][0]['correct_answer']='';	
			}
		  }
		  $i++;
		 }
		return $sp;
	   }
	   else {
		   	 $row = array();
		 	return $row; 
	   }
  }
  
  public function TotalQuestion($id='',$from_date,$to_date,$search_text,$status='',$limit='') {
	  
	  $cond = 'where 1=1';
	  if($id!='') $cond.="and question_id ='$id'";
	  
	  if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $cond.=" and modified_on >='$from_date'";
      }

      if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
         $cond.=" and modified_on <='$to_date'";
       }
    
       if(!empty($search_text) && $search_text!='Search') $cond.=" and (question like '%$search_text%')";
	   if($status!='') { $cond.=" and status IN ('$status')"; }   	
	  
	  $sql = "select * from quiz_questions $cond order by modified_on DESC $limit";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	 
	  
	  if($query->num_rows()>0)
       {
			$total_question = $query->num_rows();   
	   }
	   else {
		   	$total_question = 0;
	   }
	   return $total_question; 
  }
  
  public function AddQuestionData($arr) {
	  
	$question['question'] = addslashes($arr['question']);
	$total_option = count($arr['answer']);
	$question['total_option'] = $total_option;
	
	$this->db->insert('quiz_questions',$question);
	$question_id = $this->db->insert_id();
	
	if($question_id && $total_option>0) {
		foreach ($arr['answer'] as $key => $value) {
			
			$correct_answer = ($key == $arr['correct_answer'][0])?'1':'0';
			$answer['question_id'] = $question_id;
			$answer['answer'] = addslashes($value);
			$answer['correct_answer'] = $correct_answer;
			$this->db->insert('quiz_answer',$answer);
		}
	}
	
  }
   public function UpdateQuestionData($data, $question_ref) { 
  	
	if(count($data)>0) {
		$question['question'] = $data['question'];
		$total_option = count($data['answer']);
		$question['total_option'] = $total_option;
	
		$this->db->where('question_id',$question_ref);
		$this->db->update('quiz_questions', $question);
		//echo $question_ref; die;
		if($question_ref && $total_option>0) { 
		$sql1 = "select * from quiz_answer where question_id='$question_ref' order by created_on DESC";
		$query1 = $this->db->query($sql1);  
		if($query1->num_rows()>0) { 
			
			$this->db->where('question_id',$question_ref);
			$this->db->delete('quiz_answer');
		}
			foreach ($data['answer'] as $key => $value) {
			
				$correct_answer = ($key == $data['correct_answer'][0])?'1':'0';
				$answer['question_id'] = $question_ref;
				$answer['answer'] = $value;
				$answer['correct_answer'] = $correct_answer;
				$this->db->insert('quiz_answer',$answer);
			}
		}
	}
  }
  public function DeleteQuestion($id)  {
    $sql ="select * from quiz_questions where question_id='$id'";
    $query =$this->db->query($sql);
    //echo $sql;  die;
    if($query->num_rows()>0)
    { 
			
        $this->db->where('question_id',$id);
		$this->db->delete('quiz_answer');
		
		$this->db->where('question_id',$id);
		$this->db->delete('quiz_questions');
		return true;
    }
    else
    {
      return false;
    }
  }
  
  public function BlockQuestion($id,$status)
   {
    $sql ="select * from quiz_questions where question_id = '".$id."' ";
	
    $query = $this->db->query($sql);
    $result = $query->result();
	
    if($query->num_rows()>0)
    { 
	 $question_status = ($status=='block')?'1':'0';
	  
       $sql_rem = "UPDATE quiz_questions SET status='".$question_status."' WHERE question_id = '".$id."'";
       $query_rem = $this->db->query($sql_rem);
	   
       return true;
    }
    else
    {
      return false;
    }
  }
  
  public function GetSettings() {
  	
	$sql ="select * from quiz_settings";
    $query = $this->db->query($sql);
    $result = $query->result();
	$res = array();
    if($query->num_rows()>0)
    { 
		$res['id'] = $result[0]->id;
		$res['text'] = $result[0]->text;
		$res['competition'] = $result[0]->competition;
		$res['subtext'] = $result[0]->subtext;
	}
	return $res;
  }
  
    public function UpdateSettings($data, $id)
   {
    $sql ="select * from quiz_settings where id = '".$id."' ";
	
    $query = $this->db->query($sql);
    $result = $query->result();
	
    if($query->num_rows()>0)
    { 
		//echo "<pre>";
		//print_r($data); die;
      $this->db->where('id',$id);
	  $this->db->update('quiz_settings', $data);
      return true;
    }
    else
    {
      return false;
    }
  }
}

?>