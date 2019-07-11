<?php
class News_rss extends My_Controller
{
public function index()
	{
			
		$this->load->model('News_model');
		$all_url=$this->News_model->GetNewsFeedUrl();
		//print_r($all_url);
		//die;
		$this->News_model->tabletruncate(); // table truncate
		
		 foreach($all_url as $url)
		 {
		  $content=@file_get_contents($url);
		  if($content === FALSE){ echo "<div style='background-color:red;'><br>URL=".$url." has problem in open<br></div>"; continue;}
		  else 
		  {
		   echo "<br>URL=".print_r($url);
		   $this->getFeed($url);
		  }
		}

	}
	public function getFeed($feed_url)
	{  
     // echo $feed_url['feed_link'];
  //  $content = file_get_contents($feed_url);  

	  $content=@file_get_contents($feed_url['feed_link']);
	  $content= str_replace("&", '&amp;', $content);
	 
	  echo "<br>".print_r($content);

	   if($content === FALSE)
	   {
	    echo "<ul><li><div style='background-color:red;'><br>URL=".$feed_url." has problem in open</li></ul>";    //continue;
	   }
	  else 
	  {

	    $x = new SimpleXmlElement($content);  
	    $records=array();

		$current_date = strtotime("-2 days");
	    
		foreach($x->channel->item as $entry)
	      {  
			$pub_date = strtotime($entry->pubDate);
			
			//echo $current_date.' | '.$pub_date.' | '. $entry->pubDate.' | '.$entry->title;
			//echo "<br>";
			
			if($pub_date >= $current_date) { 
						
				$records['title'] = $entry->title;
				$records['description'] = $entry->description;
				$records['pub_date'] = date("Y-m-d h:i:s",strtotime($entry->pubDate));
				$records['link'] = $entry->link;
				$records['provider_ref']  = $feed_url['id'];	
				$this->News_model->InsertNewsFeed($records);  
			}
	     }
	    //$this->News_model->InsertNewsFeed($records); 
	  }
} 

}?>