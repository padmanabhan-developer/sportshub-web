<?php
 include_once("database.php");
 
 mysql_select_db($db['default']['database'],mysql_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']));

$route['about']="generalpages/about";
$route['history']="generalpages/history";
$route['trade-ins']="generalpages/trade_ins";
$route['finance']="generalpages/finance";
$route['servicing']="generalpages/servicing";
$route['testimonials']="generalpages/testimonials";
$route['how-to-buy']="generalpages/how_to_buy";

$route['careers/apply/(:any)']="careers/apply/$1";
$route['careers/(:any)']="careers/career_details/$1";
$route['careers-thanks']="thanks/careers_thanks";
$route['servicing-thanks']="thanks/servicing_thanks";
$route['thanks-product-enquiry']="thanks/thanks_product_enquiry";

// News router
$route['news/(:num)/(:any)']="news";
$route['news/(:num)']="news";
$route['news/DisplayNews']="news/DisplayNews";
$route['news/DisplayImageGallery']="news/DisplayImageGallery";
$route['news/Downloads/(:any)']="news/Downloads/$1";
$route['news/PopUpImageGallery/(:num)/(:num)']="news/PopUpImageGallery/$1/$2";
$route['news/(:any)']="news/news_details/$1";

//blog
$route['blog']="blog/blog_list";
$months=array("january","february","march","april","may","june","july","august","september","october","november","december");
foreach($months as $month)
{
 $route["blog/$month-(:num)"]="blog/BlogArchive/$month/$1";
 $route["blog/$month-(:num)/page/(:num)"]="blog/BlogArchive/$month/$1/$2";
}
$route['blog/(:any)/page/(:num)']="blog/BlogCategory/$1/$2";
$route['blog/page/(:num)']="blog/blog_list/$1";
$route['blog/(:any)/(:any)']="blog/BlogDetails/$1/$2";
$route['blog/(:any)']="blog/BlogCategory/$1";


$route['specials']="products/SpecialProductsList";
//$route['specials-temp']="products/TempSpecialProductsList";


// Main Category Router
$sql="select url from categories where parent_id=0 and status='1'";
$res=mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
 while($row=mysql_fetch_object($res))
 {
  $route[$row->url]="products/categories/".$row->url;
 }
}
$route['other-categories']="products/MainCategories";
// Categories Router
$sql="SELECT cat.url as cat_url FROM  categories cat INNER JOIN  category_to_products  ctp ON cat.id = ctp.cat_id where cat.status='1' and ctp.status='1' GROUP BY cat.url order by cat.position";
$res=mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
 while($row=mysql_fetch_object($res))
 {
  $route[$row->cat_url]="products/ProductsList/".$row->cat_url;
  
  // Products Router
  $prod_sql="SELECT cat.url as cat_url,c2p.url as product_url FROM  category_to_products c2p INNER JOIN categories cat ON c2p.cat_id = cat.id INNER JOIN products prod ON c2p.product_id = prod.id WHERE cat.url =  '".$row->cat_url."' AND cat.status =  '1' AND c2p.status =  '1' ORDER BY c2p.position";
  $prod_res=mysql_query($prod_sql);
  if(mysql_num_rows($prod_res) > 0)
  {
   while($prod_row=mysql_fetch_object($prod_res))
   {
    $route[$prod_row->cat_url."/".$prod_row->product_url]="products/ProductDetails/".$prod_row->product_url."/".$prod_row->cat_url;
   }
  }  
 }
}

$route['hot-deals']="products/hot_deals";

$sql="select * from stockist";
$res=mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
 while($row=mysql_fetch_object($res))
 {
    $route[$row->url]="locations/LocationDetails/".$row->id."/".$row->url;
 }
}


?>