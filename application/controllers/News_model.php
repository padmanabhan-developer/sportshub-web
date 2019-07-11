<?php
class News_model extends CI_Model
{
	

	public function GetStaticNews()
	{
		$news_data=array();
		$news_data[]=array(

			'id'=>'1',
			'title'=>'title here',
			'detail'=>'details here',
			'country' => 'India',
			'datetime' => date('Y-m-d H:i:s')
			);

return $news_data;
	}

	public function get_latest_news(){
		
			return $this->GetStaticNews();
	}

	public function GetNewsFeedUrl()
	{
	return	$this->db_query->FetchInformation('news_feed_link','id~feed_link','deleted_on is null');
	}
	public function InsertNewsFeed($records)
	{
		$this->db->truncate('news_feed');
		die;
		$ids=$this->CheckNewsFeed($records['title'],$records['link']);
		//echo count($ids); die;
		
		// checking if news title and link are already exist in table then we will update only.
		if(count($ids)==0)
		{
			$this->db->insert('news_feed',$records);
			$resp= "inserted successfully";

		}
		else
		{ 
			$this->db->where('link',$records['link']);
			$this->db->update('news_feed',$records);
		    $resp = "updated successfully";

		}
		return $resp;


	}
	public function CheckNewsFeed($title,$link)
	{
		$this->db->select('id');
		$query = $this->db->get_where('news_feed', array('link' => $link,'title'=>$title));
		//echo "<pre>";
		//print_r($query->result());
		//die;
		return $query->result();
		
	}
}

?>