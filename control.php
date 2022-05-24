<?php
include('../include/config.php');
date_default_timezone_set("Africa/Lagos");
$datecreated=(new \DateTime())->format('Y-m-d H:i:s');
extract($_POST);


if($dataname=='createaccount'){
   
    $sql = $con->prepare("SELECT * FROM admissionCreateAccount WHERE email='$email'");
    $sql->execute();
    $theresult = $sql->fetch();
     
     if ($theresult > 0) {
				echo "Email already exists in the database!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);
                $code = rand(100,100000);

                $sql2 = $con->prepare("SELECT * FROM admissionacademicterms");
                $sql2->execute();
                $session = $sql2->fetch();
                $sess = $session['session'];
                $termid = $session['termid'];
                $shortterm = $session['shortterm'];
				// $hashedPassword = password_hash($pword, PASSWORD_BCRYPT);
				
        		$stmt=$con->prepare("INSERT INTO admissionCreateAccount (sname,fname,mname,session,termid,shortterm,email,phone,isEmailConfirmed,isPhoneConfirm,token,phoneCode,dateCreated)
                	VALUES ('$sname', '$fname', '$mname', '$sess', '$termid', '$shortterm', '$email', '$phone',  '0', '0', '$token', '$code', '$datecreated')  ");
                $result = $stmt->execute();                
                $to=$email;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= "From:GES" . "\r\n";
                $headers .= 'Reply-To: GES' . "\r\n";
                $headers .= 'X-Mailer: PHP/' . phpversion();
                $subject = 'Account Verification';
                $details = "
                            Please click on the link below to verify your email:<br><br>
                            
                            <a href='http://ges.sch.ng/geps/admissionReg/confirm.php?email=$email&token=$token'>Click Here</a>
                        ";
                mail($to,$subject,$details,$headers);
        
        // mail($getsinglestudentdetails['PEMAIL'],$subject,$details,$headers);        
    
        if ($result){
            echo "You have been registered! Please verify your email!";
        }else{
            echo "Something wrong happened! Please try again!";
        }
    	
    }
}


function getallusertypes(){
    include('../include/config.php');
    $sql = $con->prepare("SELECT * FROM gepssch_institutionsetup.usertypes  where usertypename='admission' order by usertypeid ASC  LIMIT 1");
    $sql->execute();
    return $sql;
}


function getaddno(){
    include('../include/config.php');
    $currentyear=date('y');
    $theidprefix=getallusertypes()->fetch()['idprefix'];
    $getallusertypes=$theidprefix.$currentyear;
    $stmt2 = $con->prepare("SELECT * FROM gepssch_studentrecord.register_admission  where ADDNO  LIKE '%$getallusertypes%' ORDER BY id DESC LIMIT 1");
    $stmt2->execute();
    $rdcount=$stmt2->rowCount();
    if($rdcount > 0){
        $result=$stmt2->fetch(PDO::FETCH_ASSOC);
        $stnodetails=substr($result['ADDNO'],4,2);
        if($stnodetails==$currentyear){
            $prevstno=substr($result['ADDNO'],-3);
            $autoinclaststno=sprintf("%03d", $prevstno) + 1;
            $newstnum=$theidprefix.$currentyear.sprintf("%03d", $autoinclaststno);
        }
    }else{
        $autoinclaststno=sprintf("%03d", 1);
        $newstnum=$theidprefix.$currentyear.sprintf("%03d", $autoinclaststno);
    }

    return $newstnum;
}


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}


if($dataname=='confirmcode'){
        $addno=getaddno();      
        $sql = $con->prepare("SELECT * FROM admissionCreateAccount WHERE phoneCode='$code'");
        $sql->execute();
        $theresult = $sql->fetch();

        $defaultPword = randomPassword();
        // echo $defaultPword;
        
        $theidprefix=getallusertypes()->fetch()['idprefix'];
        $getallusertypes=$theidprefix.$currentyear;
        $stmt2 = $con->prepare("SELECT * FROM gepssch_studentrecord.register_admission  where ADDNO  LIKE '%$getallusertypes%' ORDER BY id DESC LIMIT 1");
        $stmt2->execute();
        $result=$stmt2->fetch(PDO::FETCH_ASSOC);
        $userid = $result['userid'];
        $usertypeid = $result['usertypeid'];
        $userid = $result['userid'];
        $stmt3=$con->prepare("INSERT INTO gepssch_gepsportal.userlogins (`userid`, `kokoro`, `loginkey`, `userloginstatus`, `checkk`, `usertypeid`, `defaultpassword`)
                        VALUES ('$addno', '', '', 1, 1, '$usertypeid', '$defaultPword')  ");
        $result = $stmt3->execute();
         
        if ($theresult > 0) {
            $sql = $con->prepare("UPDATE admissionCreateAccount SET isPhoneConfirm=1, username='$addno' WHERE phoneCode='$code'");
			$sql->execute();

            $details = '<h3>Your email and phone has been verified!</h3>';
            $details .= '<h3>check your email for your <a href="http://gepsschools.ges.sch.ng/gepsportal/login.php">Log in</a><span style="font-size:100px;margin: 100px;">&#128077;</span></h3>';
                        '</div></div></div></div>';
            echo $details;


            $to=$theresult['email'];
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From:GES" . "\r\n";
            $headers .= 'Reply-To: GES' . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $subject = 'Account Verification Success';
            $details = "
                        Congratulations! Your account has been created successfully.<br><br>
                        Username : $addno <br>
                        Password : $defaultPword <br><br>
                        
                        <a href='http://gepsschools.ges.sch.ng/gepsportal/login.php'>Click Here to log in</a>
                    ";
            mail($to,$subject,$details,$headers);            

        }else{
            echo "Invalid code supplied!";
        }
         
    }

   
?>