<?php
include('../include/config.php');
date_default_timezone_set("Africa/Lagos");
$datecreated=(new \DateTime())->format('Y-m-d H:i:s');

$sql = $con->prepare("SELECT * FROM admissionacademicterms");
$sql->execute();
$session = $sql->fetch();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">-->
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >-->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" >
	<style>
    
    .firstcon{
        
        background: hsl(208deg 69% 56% / 40%);
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 0px );
        -webkit-backdrop-filter: blur( 0px );
        border-radius: 50px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
        width: 650px;
        margin: auto;

    }
    
    img{
        padding: 20px 10px;
    }
    
    .btn{
        width: 250px;
        height: 50px;
        margin: 10px 20px;
        border-radius: 50px;
        cursor: pointer;
        color: #fff;
        margin-bottom: 30px;
        background: rgb(0,172,238);
        background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
    }
    .btn:hover{
       background: #fff;
      box-shadow: rgba(2,126,251,1);;
      color: rgba(2,126,251,1);
    }
    
     input {
          padding: 5px;
          background: transparent;
          border: none;
          border-radius: 20px;
          border-bottom: 1px solid #381818;
          /*width: 350px;*/
          margin: 5px 10px;
          width: 250px;
          text-align: center; 
      }
      .form-control::placeholder {
      color: #000;
      }
      
      fieldset{
          border: none;
      }
      
      
      .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #dae7e7;
      width: 120px;
      height: 120px;
      margin-left: 230px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
      margin: 80px 0px 0px -90px;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .w3-modal-content {
        width: 0px;
    }
    
    .login-box .user-box {
      position: relative;
      width: 250px;
    }
    
    .login-box .user-box input {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      color: #000a48;
      margin-bottom: 30px;
      border: none;
      border-bottom: 1px solid #381818;
      outline: none;
      background: #ffffff80;
    }
    .login-box .user-box label {
        position: absolute;
        top: ;
        left: 30px;
        padding: 10px 0;
        font-size: 16px;
        color: #111d97;
        pointer-events: none;
        transition: .5s;
        bottom: 30px;
    }
    
    .login-box .user-box input:focus ~ label,
    .login-box .user-box input:valid ~ label {
      top:-8px;
      left: 25px;
      color: #111d97;
      font-size: 12px;
    }
    
    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -60px;
      position: relative;
      z-index: 2;
    }
    
    
    #error ul, #error li {
        font-size: small;
    }
    
    #myVideo {
      position: ;
      right: 0;
      bottom: ;
      min-width: 100%; 
      min-height: 100%;
    }

</style>

</head>

<body style="background-color: #fff;">
    
    <video autoplay muted loop id="myVideo" style="height: 700px;">
          <source src="../video/Ink.mp4" type="video/mp4">
          
    </video>
    
	<div class="container firstcon" style="margin-top: -650px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">

				<img src="images/logo-2.png" width='150px'><br><br>

				

				<form id="form1" method="post" action="register.php">
				    <fieldset>
				        <div class="container" style="width: 600px;margin-left: -160px;">
                        <h4 style="color:"><b>Create account for <?php echo $session['session']; ?> Academic Session Admission!</b></h4>
				            <div class="row">
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input type="text" id="sname" name="sname" required="">
                                          <label>Surname</label>
                                        </div>
                                        
                                    </div>
				                </div>
                                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div hidden class="user-box">
                                          <input  type="text" id="sname2" name="sname2" required="">
                                          <label>Surname</label>
                                        </div>
                                        
                                    </div>
				                </div>
				        
				            </div>

                            <div class="row">
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input type="text" id="fname" name="fname" required="">
                                          <label>First Name</label>
                                        </div>
                                        
                                    </div>
				                </div>
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input id="mname"  name="mname" type="text" required="">
                                          <label>Middle Name</label>
                                        </div>
                                        
                                    </div>
				                </div>
				            </div>
				            
				            <div class="row">
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input id="email" class="" name="email" type="email" required="">
                                          <label>Email</label>
                                        </div>
                                        
                                    </div>
				                </div>
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input id="phone" class="" name="phone" required="">
                                          <label>Phone no</label>
                                        </div>
                                        
                                    </div>
				                </div>
				            </div>
				            
				            <!-- <div class="row">
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input id="pword" class="" name="password" type="password" required="" oninput="return validate()">
                                          <label>Password</label><span id="toggle-password" toggle="#pword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        
                                    </div>
				                </div>
				                <div class="col-6">
				                    <div class="login-box">
				        
                				        <div class="user-box">
                                          <input id="cpword"  name="cPassword" type="password" required="" oninput="return confirm()">
                                          <label>Confirm Password</label><span id="toggle-password2" toggle="#cpword" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                                        </div>
                                        
                                    </div>
				                </div>
				                <div style="display:none;" id="error" class="no-bullets text-left" style="list-style-type: none;">
				                    <ul>
                                      <li style="list-style-type: none;margin: 0;padding: 0;margin-left: -400px;margin-top: -20px;" id="upper">Atleast one uppercase</li>
                                      <li style="list-style-type: none;margin: 0;padding: 0;margin-left: -403px;margin-top:;" id="lower">Atleast one lowercase</li>
                                      <li style="list-style-type: none;margin: 0;padding: 0;margin-left: -375px;margin-top:;" id="special_char">Atleast one special symbol</li>
                                      <li style="list-style-type: none;margin: 0;padding: 0;margin-left: -415px;margin-top:;" id="number">Atleast one number</li>
                                      <li style="list-style-type: none;margin: 0;padding: 0;margin-left: -415px;margin-top:;" id="length">Atleast 6 characters</li>
                                    </ul> 
				                </div>
				            </div> -->
				            
				        </div>
				        
    
         <!--               <input id="sname" class="" name="Surname" placeholder="First Name...">-->
    					<!--<input id="oname" class="" name="onames" type="text" placeholder="Middle Name..."><br>-->
    					
    					<!--<input id="email" class="" name="email" type="email" placeholder="Email...">-->
    					<!--<input id="phone" class="" name="phone" placeholder="Phone no"><br>-->
    					
    					<!--<input id="pword" class="" name="password" type="password" placeholder="Password...">-->
    					<!--<input id="cpword" class="" name="cPassword" type="password" placeholder="Confirm Password..."><br>-->
    					
    					<input class="btn btn-outline-primary" type="submit" name="submit" id="submit" value="Create Account">
                        
                    </fieldset>
					
				</form>
				<div style="display:none" id="thepreview" class="ex1">
                        <h4 style="color:">Open your email supplied to continue this process!<span style='font-size:50px;margin: 100px;'>&#9993;</span></h4>
                        <!--<span style='font-size:100px;'>&#128077;</span>-->
                </div>
			

			</div>
		</div>
	</div>
	<div id="id01" class="w3-modal">
                <div class="w3-modal-content">
                  <!--<header class="w3-container w3-teal"> -->
                  <!--  <span onclick="document.getElementById('id01').style.display='none'" -->
                  <!--  class="w3-button w3-display-topright">&times;</span>-->
                  <!--  <h2>Modal Header</h2>-->
                  <!--</header>-->
                  <div class="w3-container">
                    <div style="display:none" class="loader"></div>
                    
                  </div>
                  <!--<footer class="w3-container w3-teal">-->
                  <!--  <p>Modal Footer</p>-->
                  <!--</footer>-->
                </div>
        </div>
	
	
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script type="text/javascript">

    // function validate(){
    //     document.getElementById('error').style.display = 'block';
        
    //     var pass 	= document.getElementById('pword');
	// 	var upper	= document.getElementById('upper');
	// 	var lower 	= document.getElementById('lower');
	// 	var num   = document.getElementById('number');
	// 	var sp_char 	= document.getElementById('special_char');
	// 	var len 	= document.getElementById('length');
		
	// 	if(pass.value.match(/[0-9]/)){
	// 	    num.style.color = 'green'
	// 	}else{
	// 	    num.style.color = 'red'
	// 	}
		
	// 	if(pass.value.match(/[A-Z]/)){
	// 	    upper.style.color = 'green'
	// 	}else{
	// 	    upper.style.color = 'red'
	// 	}
		
	// 	if(pass.value.match(/[a-z]/)){
	// 	    lower.style.color = 'green'
	// 	}else{
	// 	    lower.style.color = 'red'
	// 	}
		
	// 	if(pass.value.match(/[!\@\#\$\%\^\&\*\(\)\_\-\+\=\>\<\?\.\,]/)){
	// 	    sp_char.style.color = 'green'
	// 	}else{
	// 	    sp_char.style.color = 'red'
	// 	}
		
	// 	if(pass.value.length > 6){
	// 	    len.style.color = 'green'
	// 	}else{
	// 	    len.style.color = 'red'
	// 	}
		
	// 	if(num.style.color && upper.style.color && lower.style.color && sp_char.style.color == 'green' && pass.value.length > 6){
	// 	    document.getElementById('toggle-password').style.color = 'green';
	// 	}else{
	// 	    document.getElementById('toggle-password').style.color = 'red';
	// 	}
    // }
    
    
    function confirm(){
        // document.getElementById('toggle-password2').style.color = 'red';
        var pass1 	= document.getElementById('pword');
		var pass2	= document.getElementById('cpword');
		
// 		var pass1color = document.getElementById('toggle-password');
// 		console.log(pass1color)
// 		if(pass1color.style.color == 'green'){
// 		    document.getElementById('toggle-password2').style.color = 'green';
// 		}
		
		if(pass1.value == pass2.value){
		    document.getElementById('upper').style.display = 'none';
    		document.getElementById('lower').style.display = 'none';
    		document.getElementById('number').style.display = 'none';
    		document.getElementById('special_char').style.display = 'none';
    		document.getElementById('length').style.display = 'none';
    		document.getElementById('toggle-password2').style.color = 'green';
		}else{
		    document.getElementById('upper').style.display = 'block';
    		document.getElementById('lower').style.display = 'block';
    		document.getElementById('number').style.display = 'block';
    		document.getElementById('special_char').style.display = 'block';
    		document.getElementById('length').style.display = 'block';
    		document.getElementById('toggle-password2').style.color = 'red';
		}
		
    }
    
    

     $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    
    $(".toggle-password2").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });


	
	$("#submit").click(function () {
        var sname 	= $('#sname').val();
        var fname 	= $('#fname').val();
		var mname	= $('#mname').val();
		var email 	= $('#email').val();
		var phone   = $('#phone').val();
		
		// var cpword 	= $('#cpword').val();
        // alert(pword)
		
		
		
// 		alert(onames+sname+email+phone+pword+cpword)
        
        if(sname == '' || fname == '' || email == ''){
            alert('Fill all inputs');
        
        }else{

            // if(pword == cpword){

                $('#id01').show();
                $('.loader').show();
                
                    $.ajax({
                            url:"control.php",
                            type:'POST',
                            dataType:'text',
                            data:{sname:sname,fname:fname,mname:mname,email:email,phone:phone,dataname:'createaccount'},
                            success:function(response){
                                console.log(response);
                                // debugger;
                                if(response == 'Email already exists in the database!'){
                                    $('#id01').hide();
                                    alert('Email already exists in the database!')
                                    
                                }else{
                                    $('#thepreview').show();
                                    $('#form1').hide();
                                    $('#id01').hide();
                                }
                                
                                
                            }
                    });
            // }else{
            //     alert('Password do not match')
            // }
             
        }
        
        return false;
    });
            
	
</script>
</body>
</html>