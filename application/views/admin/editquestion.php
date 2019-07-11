<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="images/favicon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
    <!--<link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">-->
    <!--<link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">-->
	<link href="<?php echo base_url();?>css/admin/AdminLTE.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/establishment/jquery.timepicker.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/establishment/form_validation.js"></script>
    <script src="<?php echo base_url();?>js/admin/ajax.js"></script>
   
    <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url();?>js/establishment/jquery.timepicker.js"></script>
    <script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
 </head>
  <body>
  <div class="wrapper">
    <header id="header">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        
      <div class="container">
           <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo.png"></a></div>
        </div><!-- close container -->
    </header><!-- close header -->
    
    
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <?php $this->load->view('admin/left');?>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div id="content">
       <div class="container">
       		<a class="back-button" href="<?php echo base_url();?>admin/quiz">BACK TO  Question</a>
       		<!--<div class="row2"><h5><small>Establishment: </small>Test venki</h5></div>-->
        	<div class="row">
             <div class="box">
            <h2 class="title2">Edit Question</h2>
        		<div class="col-lg-12 col-md-6 col-sm-6 box-form">
               
                <!--<div class="box">-->
                <?php 
					 $question_ref = $this->uri->segment(3);
                 	 echo form_open(base_url()."admin/edit_question/$question_ref", $attribute_question['form']);
                     echo form_hidden('caller','Question');
      			?>
                <br>
                  <span class="form-row"><span class="title5">Question</span></span>
                  
				  <span class="form-row"><?php echo form_input($attribute_question['question']);?>
                        <label for="question" style="display:none; color:#F00;" >Please enter question</label>
                  </span>
                  <span class="form-row">
                  <span class="title5">Answer - Option</span>  </span>
                  <div class="form-row" id="answer_option">
                  <?php 
				  //echo "<pre>";
				  //print_r($values_question['answer']); die; 
				  if(count($values_question['answer'])>0) {
					 $i = 0; 
					foreach($values_question['answer'] as $key => $value) { ?>
						<span class="form-row">
                            <div class="col-lg-1 col-md-1 col-sm-1">
                                <input type="radio" value=<?php echo $i; ?> id="answer_label<?php echo $i; ?>" <?php if($value['correct_answer']==1) { ?> checked <?php } ?> data-id="<?php echo $i; ?>" name="correct_answer"><label for="answer_label<?php echo $i; ?>" class=""></label>
                            </div>
                            <div class="col-lg-4">
                            <input type="txt" placeholder="Answer" class="input" id="answer<?php echo $i; ?>" value="<?php echo $value['answer'] ?>" name="answer[]">
                            <label id="answer<?php echo $i; ?>" style="display:none; color:#F00;" >Please enter answer</label>
                            </div>
                            <div class="col-lg-1">
                            <?php if($i == 0) { ?>
                            <a href="javascript:void(0);" class="add_button" title="Add field"><img src="<?php echo base_url();?>images/add-icon.png" width="35" height="35"/></a>
                            <?php } else { ?>
                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo base_url();?>images/remove-icon.png" width="35" height="35"/></a>
                            <?php } ?>
                            </div>
                       </span>	
                 <?php 
				 		$i++;
					} 	
				  }
				  ?>
                  </div>
                 <span class="form-row">
                 	<label id="correct_answer" style="display:none; color:#F00;" >Please select correct answer</label> 
                 </span>
                  <span class="form-row"><div class="col-lg-5 col-md-6 col-sm-6"><?php echo form_input($attribute_question['submit']);?></div></span>
                </div>
                
                <?php echo form_close();?>  
                </div>                              
        	</div>
       </div>
    </div>
  </div>
 <script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script> 
 <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
 <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
  </script>
  
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('#answer_option'); //Input field wrapper
	
	$(addButton).click(function(){ //Once add button is clicked
	//alert($('#answer_option span:last-child input[name="correct_answer"]').val())
		var x = parseInt($('#answer_option span:last-child input[name="correct_answer"]').attr('data-id'))+1; //Initial field counter is 1
		//alert(x)
		if(x < maxField){ //Check maximum number of input fields
			var fieldHTML = '<span class="form-row"><div class="col-lg-1 col-md-1 col-sm-1"><input type="radio" value="'+ x +'" data-id="'+ x +'" id="answer_label'+ x +'"name="correct_answer"><label for="answer_label'+ x +'" class=""></label></div><div class="col-lg-4"><input type="text" id="answer'+ x +'" placeholder="Answer" name="answer[]" class="input" /><label id="answer'+ x +'" style="display:none; color:#F00;" >Please enter answer</label></div><div class="col-lg-1"><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo base_url();?>images/remove-icon.png" width="35" height="35"/></a></div></span>'; //New input field html 
			
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
			$('input').customInput();
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		var x = parseInt($('#answer_option span:last-child input[name="correct_answer"]').attr('data-id'))+1; //Initial field counter is 1
		e.preventDefault();
		$(this).parent().closest('span').remove(); //Remove field html
		x--; //Decrement field counter
		$('input[name="correct_answer"]').each(function(index, element) {
            $(this).val(index);
			//alert('#answer_label'+index)
        });
	});
});
</script>
  
  
<script>
function form_validate() {
	var questionerror, answererr, coanswererr;
	if($('#question').val() == '')
	{
		$('label[for="question"]').show();
		questionerr = 1;
		//return false
	}
	else{
		$('label[for="question"]').hide();
		questionerr = 0;
	}
	var i = 1
	$('.input').each(function(index, element) {
    	if($('#answer'+index).val() == '' ) {
			$('label[id="answer'+index+'"]').show();
			answererr = 1;
		}
		else {
			$('label[id="answer'+index+'"]').hide();
			answererr = 0;
			//return true;
		}    
		i++;
    });
	
	if($('input[name="correct_answer"]').is(":checked") == false) {
		$('label[id="correct_answer"]').show();
		coanswererr = 1;
	}
	else {
		$('label[id="correct_answer"]').hide();
		coanswererr = 0;
	}
	
	if(questionerr == 1 || answererr == 1 || coanswererr == 1) {
		return false;
	}
}

</script>    

</body>
</html>      