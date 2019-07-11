<html>
<head>
	<title></title>
	<style type="text/css">
/* LIST #4 */
#list4 { width:320px; font-family:Georgia, Times, serif; font-size:15px; }
#list4 ul { list-style: none; border-bottom:red 2px solid;}
#list4 ul li { }
#list4 ul li a { display:block; text-decoration:none; color:#000000; background-color:#FFFFFF; line-height:30px;
  border-bottom-style:solid; border-bottom-width:1px; border-bottom-color:#CCCCCC; padding-left:10px; cursor:pointer; }
#list4 ul li a:hover { color:red; background-image:url(../images/hover.png); background-repeat:repeat-x; }
#list4 ul li a strong { margin-right:10px; color: green; }
	</style>
</head>
<body>

<p><?php 
foreach($resp as $item)
{
	?>

<div id="list4">
   <ul>
      <li><a href="<?php echo base_url().$item['url'];?>"><strong>Method name: </strong> <?php echo $item['Method_name'];?></a></li>
      <li><a href="<?php echo base_url().$item['url'];?>"><strong>Url: </strong><?php echo $item['url'];?></a></li>
      <li><a href="<?php echo base_url().$item['url'];?>"><strong>Type: </strong><?php echo $item['type'];?></a></li>
      <li><a href="<?php echo base_url().$item['url'];?>"><strong>Parameters: </strong><?php echo $item['parameters'];?></a></li>
        <li><a href="<?php echo base_url().$item['url'];?>"><strong>Response: </strong><?php echo $item['response'];?></a></li>
      
   </ul>
</div>


<?php

}

?>



</p>

</body>
</html>