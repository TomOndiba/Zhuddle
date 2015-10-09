<?php
include("loggedincheck.php");

// PREVENT DOUBLE POSTS /////////////////////////////////////////////////////////////////////////////
if($_POST)
{
$checkuserid="";
$checkuserid=$_POST['senderid'];
$prevent_dp = mysql_query("SELECT id FROM private_messages WHERE id_from='".mysql_real_escape_string($checkuserid)."'AND time_sent between subtime(now(),'0:0:20') and now()");
$nr = mysql_num_rows($prevent_dp);
if ($nr > 0){
	echo 'Please wait for 20 seconds.';
	exit();
}
///////////////////////////////////////////////////////////////////////////////////////
// PREVENT MORE THAN 30 IN ONE DAY FROM THIS MEMBER  /////////////////////////////////////////////////////////////////////////////
$sql = mysql_query("SELECT id FROM private_messages WHERE id_from='$checkuserid' AND DATE(time_sent) = DATE(NOW()) LIMIT 40");
$numRows = mysql_num_rows($sql);
if ($numRows > 30) {
	echo 'You can only send 30 Private Messages per day.';
    exit();
}

// Process the message once it has been sent 
if (isset($_POST['message'])) { 
  // Escape and prepare our variables for insertion into the database 
  $to   = $_POST['recID']; 
  $from = $_POST['senderid'];
  $pageid = $_POST['pageID']; 
	if($pageid==1)
	{
  		$messageid = $_POST['messID']; 
	}
	else if($pageid==2)
	{
		$messageid=0;
	}
  //$toName   = ($_POST['rcpntName']); 
  //$fromName = ($_POST['senderName']); 
  $sub = htmlspecialchars($_POST['subject']); // Convert html tags and such to html entities which are safer to store and display
  $msg = htmlspecialchars($_POST['message']); // Convert html tags and such to html entities which are safer to store and display
  $sub  = mysql_real_escape_string($sub); // Just in case anything malicious is not converted, we escape those characters here
  $msg  = mysql_real_escape_string($msg); // Just in case anything malicious is not converted, we escape those characters here
  // Handle all pm form specific error checking here 
  if (empty($to) || empty($from) || empty($sub) || empty($msg)) { 
    echo 'Missing Data to continue';
	exit();
  } else { 
		// Delete the message residing at the tail end of their list so they cannot archive more than 100 PMs ------------------
        $sqldeleteTail = mysql_query("SELECT * FROM private_messages WHERE id_to='$to' ORDER BY time_sent DESC LIMIT 0,100"); 
        $dci = 1;
        while($row = mysql_fetch_array($sqldeleteTail)){ 
                $pm_id = $row["id"];
				if ($dci > 99) {
					$deleteTail = mysql_query("DELETE FROM private_msg WHERE id='$pm_id'"); 
				}
				$dci++;
        }
        // End delete any comments past 100 off of the tail end -------------  
		
    // INSERT the data into your table now
	if($pageid==1)
	{
		$sql = "INSERT INTO private_messages (id,id_to,id_from, time_sent, subject, message, Sstatus, Rstatus) VALUES ('$messageid','$to', '$from', now(), '$sub', '$msg', 'Seen', 'Unseen')"; 
		if (!mysql_query($sql)) { 
			echo 'Could not send message! An insertion query error has occured.';
			exit();
		
		} else { 
		   
			echo 'Message sent successfully';
			exit();
		} // close else after the sql DB INSERT check
	}
	else if($pageid==2)
	{
		$sql = "INSERT INTO private_messages (id,id_to,id_from, time_sent, subject, message, Sstatus, Rstatus) VALUES ('$messageid','$to', '$from', now(), '$sub', '$msg', 'Seen', 'Unseen')"; 
		if (!mysql_query($sql)) { 
			echo 'Could not send message! An insertion query error has occured.';
			exit();
		
		} else { 
		   
			echo 'Message sent successfully';
			exit();
		} // close else after the sql DB INSERT check
	}
	else
	{
	$selmaxid=mysql_query("SELECT id from private_messages ORDER BY id DESC LIMIT 1");
		$numros=mysql_num_rows($selmaxid);
		 if($numros=0)
		  {
			  
			  $maxidadd=1;
		  }
		  else
		  {
		while($insertmess=mysql_fetch_array($selmaxid))
		{
		$maxidadd=$insertmess['id'];
		$maxidadd=$maxidadd+1;
		}
		  }
		$sql1 = "INSERT INTO private_messages (id,id_to,id_from, time_sent, subject, message, Sstatus, Rstatus) VALUES ('$maxidadd','$to', '$from', now(), '$sub', '$msg', 'Seen', 'Unseen')"; 
		if (!mysql_query($sql1)) { 
			echo 'Could not send message! An insertion query error has occured.';
			exit();
		
		} else { 
		   
			echo 'Message sent successfully';
			exit();
		} // close else after the sql DB INSERT check
  } 
  }// Close if (empty($sub) || empty($msg)) { 
}
}
else
{
	echo'error occurred';
}
// Close if (isset($_POST['message'])) { 
?>