<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: text/xml');

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
    </box>

    <!--timed quiz-->
    <custom type="quiz" id="quiz" position="relative" x="0" y="0" class="col-md-10 col-md-offset-1">
		<settings timer="true" timerx="0" timery="0"/>
        
		<!-- question 1 -->
        <question id="q1" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question1" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">How many times did Tom Kristensen win the le mans?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option1_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">7</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option1_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">9</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option1_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">11</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>

		<!-- question 2 -->
        <question id="q2" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question2" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">When is Christiano Ronaldo born? </p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option2_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">1983</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option2_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">1985</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option2_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">1987</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
		<!-- question 3 -->
        <question id="q3" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question3" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who scored 5 goals in 9 minutes in 2015?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option3_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Ronaldo</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option3_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Messi</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option3_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Lewandowski</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
				<!-- question 4 -->
        <question id="q4" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question4" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Which beer brand is main sponsor for the UEFA Champions League?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option4_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Carlsberg</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option4_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Heineken</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option4_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Budweiser</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
				<!-- question 5 -->
        <question id="q5" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question5" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">How many times did Lance Armstrong win Tour de France?</p>]]></text>
			
			<!--option 1 -->
			<option correct="true">
				<text id="option5_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">7</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option5_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">8</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option5_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">9</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 6 -->
        <question id="q6" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question6" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">On which famous street ends tour de france? </p>]]></text>
			
			<!--option 1 -->
			<option correct="true">
				<text id="option6_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Champ Elysee</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option6_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Boulevard Saint-Michel</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option6_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Avenue de l’Opera</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 7 -->
        <question id="q7" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question7" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">What are the measures of a handball field?</p>]]></text>
			
			<!--option 1 -->
			<option correct="true">
				<text id="option7_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">40x20m</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option7_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">50x25m</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option7_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">60x30m</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 8 -->
        <question id="q8" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question8" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who sang the official song of the 2010 FIFA World Cup?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option8_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Beyonce</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option8_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Janet Jackson</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option8_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Shakira</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 9 -->
        <question id="q9" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question9" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">How big is the capacity on Estadio Nou Camp (Barcelona)?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option9_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">59.000</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option9_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">79.000</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option9_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">99.000</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 10 -->
        <question id="q10" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question10" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who won their first UEFA European Championship in 2006?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option10_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Denmark</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option10_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Greece</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option10_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Ireland</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 11 -->
        <question id="q11" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question11" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who won the most Formula1 Championship titles?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option11_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Juan Fangio</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option11_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Sebastian Vettel</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option11_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Michael Schumacher</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 12 -->
        <question id="q5" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question12" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who won UEFA Champions league in 2014/15?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option12_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Juventus</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option12_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Barcelona</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option12_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Real Madrid</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 13 -->
        <question id="q13" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question13" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Where is Christiano Ronaldo born?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option13_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Azores</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option13_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Continental Portugal</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option13_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Madeira</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 14 -->
        <question id="q14" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question14" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">How many Olympic medals did Michael Phelps win?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option14_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">18</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option14_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">22</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option14_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">28</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 15 -->
        <question id="q5" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question15" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who won the FIFA World Cup 2006?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option15_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">France</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option15_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Spain</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option15_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Italy</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 16 -->
        <question id="q5" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question16" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who won the Spanish La Liga 2014/15?</p>]]></text>
			
			<!--option 1 -->
			<option correct="true">
				<text id="option16_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Barcelona</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option16_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Real Madrid</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option16_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Athletico Madrid</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 17 -->
        <question id="q5" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question17" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">Who won the UEFA Champions League 2013/14?</p>]]></text>
			
			<!--option 1 -->
			<option correct="true">
				<text id="option17_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Bayern Munich</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option17_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Barcelona</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option17_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Dortmund</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 18 -->
        <question id="q18" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question18" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">What sportsstar has most followers on twitter?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option18_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Lewis Hamilton</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option18_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Rafael Nadal</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option18_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">C. Ronaldo</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 5 -->
        <question id="q19" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question19" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">What is the Australian rugby team know as?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option19_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">The Aussies</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="true">
				<text id="option19_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">The Wallabies</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="false">
				<text id="option5_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">The Kangaroos</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
		
						<!-- question 20 -->
        <question id="q20" time="20" event="">

    		<box id="col1" position="relative" class="col-md-6" />
    		<box id="col2" position="relative" class="col-md-6" />

    		<text id="question20" position="relative" target="col1" x="0" margin-top="150" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24">What was Muhammad Alis birth name?</p>]]></text>
			
			<!--option 1 -->
			<option correct="false">
				<text id="option20_1" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">Sonny Liston</p>]]></text>
			</option>
			
			<!--option 2 -->	
			<option correct="false">
				<text id="option20_2" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.6" event="optionover,selectandsubmit" class="optionBox"><![CDATA[<p class="p_16 white">George Foreman</p>]]></text>
			</option>
			
			<!--option 3 -->
			<option correct="true">
				<text id="option20_3" position="relative" target="col1" x="match" width="100%" margin-bottom="40" anim="show" animtime="0.5" animdelay="0.7" event="optionover,selectandsubmit" class="optionBox" float="left"><![CDATA[<p class="p_16 white">Cassius Clay</p>]]></text>
			</option>
			<!--/options -->
			
			<!-- feedbacks -->
			<fb id="pass" event="">	
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
		</question>
	
		<!--generic timeout text-->
		<timeout>
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
            	<box id="center" position="relative" height="100%">
	            	<box id="passTextBox" position="relative" height="350" margin-top="0" margin-bottom="20" anim="left" animtime="0.5" class="col-sm-8 col-sm-offset-2 vertical-align">
					
					<image id="winimage" position="relative" x="0" y="0" margin-bottom="30" anim="none" class="img-responsive"><![CDATA[lib/assets/win.png]]></image>
						
						<text id="pass_txt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none">
						<![CDATA[<p class="p_30 white glow">CONGRATULATIONS!</p><p class="p_24 orange glow">You scored [score]%</p>]]></text>
						
						<button id="goBtn" position="relative" x="10" margin-bottom="30" height="40" width="140" anim="none" event="btnover,restart,hidepassbg"><![CDATA[Play again?]]></button>
						
						<button id="FbBtn" position="relative" x="10" margin-bottom="30" height="50" width="200" anim="none" animtime="0.5" event="btnover,fbshare,hidefailbg"><![CDATA[<p class="fbshare">]]></button>
	                </box>
                </box>
            </fb>
            
            <fb id="fail" event="">
  				<box id="center" position="relative" height="100%">
	            	<box id="failTextBox" position="relative" height="350" margin-top="0" margin-bottom="20" anim="left" animtime="0.5" class="col-sm-8 col-sm-offset-2 vertical-align">
					<image id="lostimage" position="relative" x="0" y="0" margin-bottom="30" anim="none" class="img-responsive"><![CDATA[lib/assets/lost.png]]></image>

	                    <text id="fail_txt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none"><![CDATA[<p class="p_32 white glow">Bad luck! You scored [score]%</p><p class="p_24 orange glow">Why not have another go?</p>]]></text>
	                        
						<button id="goBtn" position="relative" x="10" margin-bottom="30" height="40" width="120" anim="none" animtime="0.5" event="btnover,restart,hidefailbg"><![CDATA[Start again]]></button>
						
						<button id="FbBtn" position="relative" x="10" margin-bottom="30" height="50" width="200" anim="none" animtime="0.5" event="btnover,fbshare,hidefailbg"><![CDATA[<p class="fbshare">]]></button>
	                </box> 
                </box> 
            </fb>
        </score>

    </custom>

</data>';

?>

