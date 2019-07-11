<?php 
//header('Access-Control-Allow-Origin: *');
//header('content=UTF-8');
//header('Content-Type: text/html; charset=utf-8');

$con=mysqli_connect("localhost","sportsh_dbu","Ftwo46*2","sportsh_db");
//$con=mysqli_connect("localhost","root","","sh365live_db");

$comp = "SELECT * FROM quiz_settings";
$comp_q = mysqli_query($con, $comp);
$comp_row = mysqli_fetch_array($comp_q);
$heading = $comp_row['text'];
$competition = $comp_row['competition'];
$text = $comp_row['subtext'];


$q = "SELECT * FROM quiz_questions where status='0' order by RAND() limit 15 ";
$res = mysqli_query($con, $q);
$question  = '';
$i = 1;

while($row=mysqli_fetch_array($res)) {
$q1 = "SELECT * FROM quiz_answer where question_id='".$row["question_id"]."'";
$res1 = mysqli_query($con, $q1);
$ans_count = mysqli_num_rows($res1);

if($ans_count>=2) { 
$question.= '<question id="q'.$i.'" time="20" event="">
				<box id="col1" position="relative" class="col-md-7" />
				<box id="col2" position="relative" class="col-md-5 pull-right" />
				<box id="center" class="col-md-7" position="relative" anim="none" animtime="0.5">
					<text id="quiz_add_inner" position="relative" x="0" y="0" animtime="0.5"><![CDATA[]]></text>
			    </box>
				<text id="question'.$i.'" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">'.utf8_encode($row["question"]).'</p>]]></text>';
				
/*$row1 = mysqli_fetch_array($res1);				
echo "<pre>";
print_r($row1); die;*/
$j = 1;
while($row1=mysqli_fetch_array($res1)) { 
$correct = ($row1["correct_answer"]==1)?'true':'false';

$question.=  '<option correct="'.$correct.'">
					<text id="option'.$i.'_'.$j.'" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">'.utf8_encode($row1["answer"]).'</p>]]></text>
				</option>';
	$j++;			
}
				//feedbacks
$question.=  '<fb id="pass" event="">	
					<box id="fb" position="relative" target="col2" x="0" margin-top="150" clear="both" anim="show" animtime="0.5">
						<image id="passimage" position="relative" x="0" y="0" margin-bottom="30" anim="none" class="img-responsive"><![CDATA[lib/assets/correct.png]]></image>
	
						<text id="txt1" position="relative" anim="none" margin-bottom="30"><![CDATA[<p class="p_24">Correct!</p><p>You´re awesome.</p>]]></text>
				
						<button id="nextQBtn" position="relative" margin-bottom="10" width="150" anim="none" event="btnover,loadNextQuestion"><![CDATA[Try the next one]]></button>
	
						<text id="bottompad" position="relative" anim="none"><![CDATA[<p>&nbsp;</p>]]></text>
					</box>
				</fb>
				
				<fb id="fail" event="">	
					<box id="fb" position="relative" target="col2" x="0" margin-top="150" clear="both" anim="show" animtime="0.5">
						<image id="failimage" position="relative" x="0" y="0" margin-bottom="30" anim="none" class="img-responsive"><![CDATA[lib/assets/incorrect.png]]></image>
	
						<text id="txt1" position="relative" anim="none" margin-bottom="30"><![CDATA[<p class="p_24">Incorrect!</p><p>Better luck on the next question.</p>]]></text>
				
						<button id="nextQBtn" position="relative" margin-bottom="10" width="150" anim="none" event="btnover,loadNextQuestion"><![CDATA[Try the next one]]></button>
	
						<text id="bottompad" position="relative" anim="none"><![CDATA[<p>&nbsp;</p>]]></text>
					</box>
				</fb>
			</question>';
  }
}

echo '<?xml version="1.0" encoding="utf-8" ?>
<data>

    <events>
		<event id="btnover">
			<rollover>
				<css name="btnOverCss">this</css>
			</rollover>
			
			<rollout>
				<css name="btnOutCss">this</css>
			</rollout>
		</event>

		<event id="optionover">
			<rollover>
				<css name="optionOverCss">this</css>
			</rollover>
			
			<rollout>
				<css name="optionOutCss">this</css>
			</rollout>
		</event>
		
		<event id="selectandsubmit">
			<click>
				<css name="optionOverCss">this</css>
				<function name="select">this</function>
				<function name="submit">this</function>
			</click>
		</event>

		<event id="select">
			<click>
				<css name="optionOverCss">this</css>
				<function name="select">this</function>
			</click>
		</event>

		<event id="submit">
			<click>
				<function name="submit">this</function>
			</click>
		</event>

		<event id="reset">
			<click>
				<function name="reset">this</function>
			</click>
		</event>
		
        <event id="begin">
            <click>
                <anim type="remove" animtime="0" oncomplete="0">openingText</anim>
                <function name="begin">this</function>
            </click>
        </event>

        <event id="loadNextQuestion">
            <click>
                <function name="loadNextQuestion">this</function>
            </click>
        </event>
		
		<event id="restart">
            <click>
                <function name="restart">this</function>
            </click>
        </event>
		
		<event id="fbshare">
            <click>
                <function name="fbshare">this</function>
            </click>
        </event>
		
		<event id="fblike">
            <click>
                <function name="fblike">this</function>
            </click>
        </event>
		
		<event id="ios">
            <click>
                <function name="ios">this</function>
            </click>
        </event>
		
		<event id="android">
            <click>
                <function name="android">this</function>
            </click>
        </event>
		
        <event id="showq1bg">
            <click>
                <anim type="show" animtime="2" oncomplete="0">q1bg</anim>
            </click>
        </event>

         <event id="hidepassbg">
            <click>
            	<anim type="hide" animtime="2" oncomplete="0">passbg</anim>
            </click>
        </event>

        <event id="showpassbg">
            <click>
                <anim type="show" animtime="5" oncomplete="0">passbg</anim>
            </click>
        </event>

        <event id="hidefailbg">
            <click>
            	<anim type="hide" animtime="2" oncomplete="0">failbg</anim>
            </click>
        </event>

        <event id="showfailbg">
            <click>
                <anim type="show" animtime="2" oncomplete="0">failbg</anim>
            </click>
        </event>
    </events>    

    <box id="failbg" position="absolute" x="0" y="0" width="100%" height="100%" anim="hide" class="failbg" />
    <box id="orangebg" position="absolute" x="0" y="0" width="100%" height="100%" anim="hide" class="orangebg" />


    <!--responsive timer-->
    <!--2 column layout, timer on the right, moves to top center on phones-->
    <box id="timerRow" position="absolute" x="0" y="0" anim="none" animtime="0.5" animdelay="1" class="col-md-10 col-md-offset-1">
    	<box id="timerCol1" position="relative" class="col-md-6" />
    	<box id="timerContainer" position="relative" class="col-md-6" />
    </box>

    <!--opening text-->
    <box id="openingText" position="relative" anim="left" animtime="0.5" animdelay="1" class="col-md-10 col-md-offset-1 vertical-align" z-index="3">
<image id="introimage" position="relative" x="0" y="0" margin-bottom="0" anim="none" class="img-responsive"><![CDATA[lib/assets/intro.png]]></image>
    	<text id="title" position="relative" margin-top="20" anim="none"><![CDATA[<p class="p_16_black">Welcome to the sportsquiz.</p><p class="p_16_black">For each question, select the answer before your time runs out!</p>]]></text>

    	<button id="goBtn" position="relative" height="40" width="100" margin-top="40" margin-bottom="20" anim="none" event="btnover,begin" target="title"><![CDATA[Let\'s go!]]></button>
		
		<text id="quiz_add" position="relative" x="0" y="0" animtime="0.5"><![CDATA[]]></text>
    </box>

    <!--timed quiz-->
    <custom type="quiz" id="quiz" position="relative" x="0" y="0" class="col-md-10 col-md-offset-1">
		<settings timer="true" timerx="0" timery="0"/>'
        	.$question.
		'<timeout>
			<box id="center" position="relative" height="100%"> 
	            <box id="timeOut" position="relative" height="350" margin-top="0" margin-bottom="20" anim="left" animtime="1" ease="Bounce.easeOut" class="col-sm-8 col-sm-offset-2 vertical-align">
				
				<image id="timeimage" position="relative" x="0" y="0" margin-bottom="30" anim="none" class="img-responsive"><![CDATA[lib/assets/timeup.png]]></image>

					<text id="timeoutTxt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none"><![CDATA[<p class="p_42 grey">Times up!</p>]]></text>
			
					<button id="startAgainBtn" position="relative" x="10" margin-bottom="30" height="40" width="100" anim="none" event="btnover,restart"><![CDATA[Start again]]></button>
				</box>
			</box>
        </timeout>


        <!--score screen-->
        <score masteryscore="80">
           <fb id="pass" event="">
            	<box id="center" class="quiz" position="relative">
				  <box id="center" class="quiz_page" position="relative" anim="none" >
				  	<box id="center" class="container2" position="relative" anim="none"> 
				  		<box id="center" class="quiz_left" position="relative" anim="none">
						<text id="pass_txt" position="relative" anim="none">
						<![CDATA[<h1 class="">EnteR our monthly competition to win sport tickets</h1><h2 class="">Press the button and Like us on facebook to join the competetion. <br/> The winner will be announced on facebook.</h2>]]></text>
						
						<button id="FbLike" class="facebook_button3" position="relative" height="67" width="274" anim="none" event="btnover,fblike,hidefailbg"><![CDATA[<p class="fblike">Like Us On Facebook</p>]]></button>
						
						<text id="comp" class="quiz_box" position="relative" margin-top="30" margin-bottom="20" anim="none">
						<![CDATA[<h3 class="">'.$heading.'</h3><h4 class="">'.$competition.'</h4><h5 class="">'.$text.'</h5>]]></text>
						
						<box id="center" class="box_center" x="125" position="relative" anim="none" animtime="0.5">
							<box id="center" class="span1" position="relative" anim="none" animtime="0.5">
								<image id="ios" position="relative" x="0" y="0" anim="none" class="img-responsive" event="ios"><![CDATA[lib/assets/apple.png]]></image>
							</box>
							<box id="center" class="span1" position="relative" anim="none" animtime="0.5">
								<image id="android" position="relative" x="0" y="0" anim="none" class="img-responsive" event="android"><![CDATA[lib/assets/google_play.png]]></image>
							</box>
						</box>
						
						<text id="quiz_add_final" position="relative" x="0" y="0" animtime="0.5"><![CDATA[]]></text>
					</box>
					
						<box id="passTextBox" position="relative" height="292" margin-top="0" margin-bottom="20" anim="none" animtime="0.5" class="quiz_right">
							<text id="pass_txt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none">
							<![CDATA[<p class="p_30 white glow">CONGRATULATIONS!</p><p class="p_24 orange glow">You scored [score]%</p>]]></text>
							
							<button id="goBtn" position="relative" x="10" margin-bottom="30" height="40" width="140" anim="none" event="btnover,restart,hidepassbg"><![CDATA[Play again?]]></button>
							
							<button id="FbBtn" position="relative" x="10" margin-bottom="30" height="50" width="200" anim="none" animtime="0.5" event="btnover,fbshare,hidefailbg"><![CDATA[<p class="fbshare">]]></button>
						</box>
					  </box>
					</box>
                </box>
            </fb>
            
			<fb id="fail" event="">
            	<box id="center" class="quiz" position="relative">
				  <box id="center" class="quiz_page" position="relative" anim="none" >
				  	<box id="center" class="container2" position="relative" anim="none"> 
				  		<box id="center" class="quiz_left col-sm-6" position="relative" anim="none">
						<text id="pass_txt" position="relative" anim="none">
						<![CDATA[<h1 class="">EnteR our monthly competition to win sport tickets</h1><h2 class="">Press the button and Like us on facebook to join the competetion. <br/> The winner will be announced on facebook.</h2>]]></text>
						
						<button id="FbLike" class="facebook_button3" position="relative" height="67" width="274" anim="none" event="btnover,fblike,hidefailbg"><![CDATA[<p class="fblike">Like Us On Facebook</p>]]></button>
						
						<text id="comp" class="quiz_box" position="relative" margin-top="30" margin-bottom="20" anim="none">
						<![CDATA[<h3 class="">'.$heading.'</h3><h4 class="">'.$competition.'</h4><h5 class="">'.$text.'</h5>]]></text>
						
						<box id="center" class="box_center" x="125" position="relative" anim="none" animtime="0.5">
							<box id="center" class="span1" position="relative" anim="none" animtime="0.5">
								<image id="ios" position="relative" x="0" y="0" anim="none" class="img-responsive" event="ios"><![CDATA[lib/assets/apple.png]]></image>
							</box>
							<box id="center" class="span1" position="relative" anim="none" animtime="0.5">
								<image id="android" position="relative" x="0" y="0" anim="none" class="img-responsive" event="android"><![CDATA[lib/assets/google_play.png]]></image>
							</box>
						</box>
						
						<text id="quiz_add_final" position="relative" x="0" y="0" animtime="0.5"><![CDATA[]]></text>
					</box>
					
						<box id="passTextBox" position="relative" height="292" margin-top="0" margin-bottom="20" anim="none" animtime="0.5" class="quiz_right col-sm-6">
							<text id="fail_txt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none"><![CDATA[<p class="p_32 white glow">Bad luck! You scored [score]%</p><p class="p_24 orange glow">Why not have another go?</p>]]></text>
	                        
						<button id="goBtn" position="relative" x="10" margin-bottom="30" height="40" width="120" anim="none" animtime="0.5" event="btnover,restart,hidefailbg"><![CDATA[Start again]]></button>
							
							<button id="FbBtn" position="relative" x="10" margin-bottom="30" height="50" width="200" anim="none" animtime="0.5" event="btnover,fbshare,hidefailbg"><![CDATA[<p class="fbshare">]]></button>
						</box>
					  </box>
					</box>
                </box>
            </fb>
        </score>

    </custom>

</data>';

?>

