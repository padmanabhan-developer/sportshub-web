<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class General_Query_Functions
 {
  public function ExecuteQuery($query)
  {
	   $user = 'aqacreat_sh365';
    $password = 'SH@365';
    $db = 'aqacreat_sh365';
    $host = 'localhost';
    $port = 8888;

    $link = mysqli_init();
    $success = mysqli_real_connect(
       $link,
       $host,
       $user,
       $password,
       $db,
       $port
    );
   return mysqli_query($success, $query);
  }
  public function FetchSingleInformation($table_name,$selection,$where_string)
  {
   if(empty($selection))
   {
    $selection="*";
   }
   else
   {
    $real_selection=$selection;
    $selection=str_replace("~",",",$selection);
   }
   $query="select ".$selection." from ".$table_name;
   if(!empty($where_string))
   {
    $query .= " where ".$where_string;
   }
   $res=$this->ExecuteQuery($query) or die("error in query $query<br>".mysql_error());
   $fields=array();
   if($selection == "*")
   {
    $fields=$this->GetFieldsOfTable($table_name);
   }
   else
   {
    $fields=explode("~",$real_selection);
   }
   $information=array();
   while($row=mysql_fetch_object($res))
   {
    foreach($fields as $field)
    {
     if(preg_match("/\sas\s/",$field))
 	 { 
	  $field=trim(end(explode(" as ",$field)));
	 }
 	 $information["$field"]=stripslashes($row->$field);
    }
   }
   return $information;
  }
  
  public function GetFieldsOfTable($table_name)
  {
   $q="show columns from $table_name";
   $qr=$this->ExecuteQuery($q);
   $fields=array();
   while($row=mysql_fetch_object($qr))
   {
    $fields[]=$row->Field;
   }
   return $fields;
  }
  public function FetchInformation($table_name,$selection,$where_string)
  {
   if(empty($selection))
   {
    $selection="*";
   }
   else
   {
    $real_selection=$selection;
    $selection=str_replace("~",",",$selection);
   }
   $q="select $selection from $table_name";
   if(!empty($where_string))
   {
    $q .= " where $where_string";
   }
   $qr=$this->ExecuteQuery($q) or die("error in query $q<br>".mysql_error());
   $fields=array();
   if($selection == "*")
   {
    $fields=$this->GetFieldsOfTable($table_name);
   }
   else
   {
    $fields=explode("~",$real_selection);
   }
   $information=array();
   $i=0;
   while($row=mysql_fetch_object($qr))
   {
    foreach($fields as $field)
    {
     if(preg_match("/\sas\s/",$field))
  	 {
	  $field=trim(end(explode(" as ",$field)));
	 }
     $information[$i][$field]=stripslashes($row->$field);
    }
    $i++;
   }
   return $information;
  }
  public function InsertInToTable($table_name,$field_values)
  {
   $fields="id,";
   $values="null,'";
   if(count($field_values)> 0)
   {
    foreach($field_values as $field=>$value)
    {
     //$value=str_replace("\r\n","<br>",$value);
     $fields .=$field.",";
     $values .=addslashes(trim($value))."','";
    }
   }  
   $fields=substr($fields,0,-1);
   $values=substr($values,0,-2);
   $q="insert into $table_name ($fields) values($values)";
   $this->ExecuteQuery($q)  or die("error in query $q<br>".mysql_error());
  }
  public function UpdateTable($table_name,$field_values,$where_clause)
  {
   if(count($where_clause) > 0)
   {
    $conditions="";
    foreach($where_clause as $condition=>$value)
    {
     //$value=str_replace("\r\n","<br>",$value);
     $conditions .=$condition."='".addslashes(trim($value))."' and ";
    }
    $conditions = substr($conditions,0,-4);
    $where_condition="where $conditions";
   }
   if(count($field_values)> 0)
   {
    foreach($field_values as $field=>$value)
    {
	 $fields="";
     $value=addslashes($value);
     //$value=str_replace("\r\n","<br>",$value);
     $fields.=$field."='$value',";
    }
    $fields=substr($fields,0,-1);
    $q="update $table_name set $fields $where_condition";
    $this->ExecuteQuery($q);
   } 
  }
  public function DeleteRecord($table_name,$where_clause)
  {
   $q="delete from $table_name where $where_clause";
   $this->ExecuteQuery($q);
  }
  public function TrimValues($values)
  {
   $new_values=array();
   if(count($values) > 0)
   {
	foreach($values as $key=>$value)
	{
	 $new_values[$key]=trim($value);
	}
   }
   return $new_values; 
  }

  public function GetFirstItemId($table,$id)
  {
   $sql = "SELECT ".$id." FROM ".$table." WHERE `status`='1' ORDER BY position ASC LIMIT 1";	
   $result = $this->ExecuteQuery($sql);  
   $row = mysql_fetch_object($result);
   if(mysql_num_rows($result) > 0)
   {
    return $row->$id;
   }
   else
   return 0;
  }

  public function GetItemName($table, $id, $id_value, $field_name)
  {
   $sql = "SELECT ".$field_name." FROM ".$table." WHERE $id='".$id_value."'";	
   $result = $this->ExecuteQuery($sql);  
   $row = mysql_fetch_object($result);
   return $row->$field_name;
  }

  
 }

?>