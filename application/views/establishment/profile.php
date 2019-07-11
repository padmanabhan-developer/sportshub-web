

<html>
<head>
<title>CodeIgniter : Login Facebook via Oauth 2.0</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

<style type="text/css">


#main{
width:960px;
margin:50px auto;
font-family:raleway;
}
h2{
position: relative;
background-color: #26c489;
text-align:center;
border-radius: 10px 10px 0 0;
margin: -10px -40px;
padding: 30px;
color:white;
}
hr{
border:0;
border-bottom:1px solid #ccc;
margin: 10px -40px;
margin-bottom: 30px;
}
#login{
width:462px;
float: left;
border-radius: 10px;
font-family:raleway;
border: 2px solid #ccc;
padding: 10px 40px 34px;
margin-top: 0;
margin-left: -70px;;
background-color: #DBF6ED;
}
img.fb{
height: 50px;
padding-left: 90px;
}
img.fb_profile{
height: 50px;
padding-right: 20px;
margin-left: -410px;
}
p.profile_name{
font-size: 16px;
margin-top: -19px;
margin-left: -148px;
}
a.logout{
position: absolute;
font-size: 18px;
text-decoration: none;
top: 46px;
right: 45px;
}

</style></head>
<body>
<div id="main">
<div id="login">
<h2> <?php echo "<a href=".$user_profile['link']." target='_blank' ><img class='fb_profile' src="."https://graph.facebook.com/".$user_profile['id']."/picture".">"."</a>"."<p class='profile_name'>Welcome ! <em>".$user_profile['name']."</em></p>";
echo "<a class='logout' href='$logout_url'>Logout</a>";
?></h2>
<hr/>
<h3><u>Profile</u></h3>
<?php
echo "<p>First Name : ".$user_profile['first_name']."</p>";
echo "<p>Last Name : ".$user_profile['last_name']."</p>";
echo "<p>Gender : ".$user_profile['gender']."</p>";
echo "<p>Facebook URL : "."<a href=".$user_profile['link']." target='_blank'"."> https://www.facebook.com/".$user_profile['id']."</a></p>";
?>
</div>
</div>
<?php //include('info_links.php')?></body>
</html>

