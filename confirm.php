<?php
include('../include/config.php');
$STAFFID='ADMISSIONCODE';    

    function redirect() {
        header('Location: register.php');
        exit();
    }


    function insertbulkresponsemsg($status,$message,$smstosend,$phoneno,$message_id, $cost, $gateway_used, $staffid, $dateposted){
        include('../include/config.php');
        $sql2 = "INSERT INTO gepssch_institutionsetup.bulksmsresponse(status,message,body,phoneno,message_id, cost, gateway_used, staffid, dateposted)
                values ('$status','$message','$smstosend','$phoneno','$message_id', '$cost', '$gateway_used', '$staffid', '$dateposted')";
        $stmt2 = $con->prepare($sql2);
        $result2 = $stmt2->execute();
        if ($result2) {
            $remarks = "Succesfully  saved";
        } else {
            $remarks = "Not saved";
        }
        return $remarks;
    }

    function sendbulksms($to,$smstosend,$staffid){
        $dateposted=(new \DateTime())->format('Y-m-d H:i:s');
        $from="GES";
        $body=$smstosend;
        $dnd=2;
        $token="SaPZ7RhkhejJuZ7XNtaU1OuNP85uiCphu3AQtQCSjxE2z0TF7lnPY6oXfY0r";
        $url ="https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=".$token."&from=".$from."&to=".$to."&body=".$body."&dnd=".$dnd;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $resp = curl_exec($ch);
        
        $mydata=json_decode($resp, TRUE);
        $insertbulkresponsemsg=insertbulkresponsemsg($mydata['data']['status'],$mydata['data']['message'],$smstosend,$to,$mydata['data']['message_id'], $mydata['data']['cost'], $mydata['data']['gateway_used'], $staffid, $dateposted);
        // if($insertbulkresponsemsg){
        //     echo "Message succesfully sent";
        // }else{
        //     echo "Message not sent";
        // }
        curl_close($ch);
    }

    

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	} else {
		
		$email = $_GET['email'];
		$token = $_GET['token'];

		$sql = $con->prepare("SELECT id FROM admissionCreateAccount WHERE email='$email' AND token='$token' AND isEmailConfirmed=0");
		$sql->execute();
        $theresult = $sql->fetch();

		if ($theresult > 0) {
            $sql = $con->prepare("UPDATE admissionCreateAccount SET isEmailConfirmed=1, token='' WHERE email='$email'");
            $sql->execute();

            $sql = $con->prepare("SELECT * FROM admissionCreateAccount WHERE email='$email'  AND isPhoneConfirm=0");
            $sql->execute();
            $theresult = $sql->fetch();
            $phoneCode = $theresult['phoneCode'];
            $to = $theresult['phone'];

            sendbulksms($to, $phoneCode, $STAFFID);  
            
            $details="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'><html><head>
                <link rel='stylesheet' href='https://unpkg.com/purecss@2.1.0/build/pure-min.css' integrity='sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH' crossorigin='anonymous'>
                <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
                <style type='text/css'>
                    .firstcon{
                    
                    background: rgba(235, 241, 244, 0.98);
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
                    margin-bottom: 30px;
                    background: rgb(0,172,238);
                    background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
                }
                .btn:hover{
                    background: transparent;
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
                        margin: 30px 20px;
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
                a {
                    color: blueviolet;
                    text-decoration-line: none;
                    cursor:pointer;
                    }
                                </style>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
                <meta property='og:title' content=' '/>
            </head><body>";
            echo $details;
            echo '<div class="container firstcon" style="margin-top: 30px;">';
            echo '<div class="row justify-content-center">';
            echo '<div class="col-md-6 col-md-offset-3" align="center">';
            echo '<img src="images/logo-2.png" width="150px"><br><br>';
        
            echo '<div id="thepreview" class="ex1">';
            echo '<h3 id="text" style="color: red;">Insert bellow with code sent to your phone!</h3>';
            echo '<div class="row"><div class="col-6"><div class="login-box">   
                    <div class="user-box">
                    <form action="#">
                    <input type="text" id="code" name="code" required="">
                    <h3 hidden id="emailcon" style="color: red;">'.$email.'</h3>
                    </form>
                    <div id="userbox"></div>
                    </div>                    
                </div>
                </div><input style="width: 20%; margin: 9px 20px;" class="btn btn-outline-primary" type="submit" name="submit" id="submit" value="Submit">
                </div></div></div></div></div>';

		} else
			redirect();
	}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript">

$("#submit").click(function () {
        var code 	= $('#code').val();
        var email 	= $('#emailcon').val();        
        
        if(code == ''){
            alert('Insert a code');
        
        }else{
                
            $.ajax({
                    url:"control.php",
                    type:'POST',
                    dataType:'text',
                    data:{code:code,email:email,dataname:'confirmcode'},
                    success:function(response){
                        console.log(response);
                        // debugger;
                        if(response == 'Invalid code supplied!'){
                            alert('Invalid code!')
                            
                        } else{
                            $('#code').hide();
                            $('#text').hide();
                            $('#submit').hide();
                            $('#userbox').html(response);
                            // $('#appno2').html(data.applicationno);
                        }                              
                        
                    }
            });            
             
        }        
        return false;
    });

</script>