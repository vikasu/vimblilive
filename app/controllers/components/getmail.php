<?php
class GetmailComponent extends Object
{
    var $components = array('Session','Email');
    
     function getEmails($user='', $password='') {
      
      /* connect to gmail */
      $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
      $username = $user;
      $password = $password;
      
      /* try to connect */
      $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
      
      /* grab emails */
      $emails = imap_search($inbox,'ALL');
    
      /* if emails are returned, cycle through each... */
      if($emails) {
	
	/* begin output var */
	$output = '';
	
	/* put the newest emails on top */
	rsort($emails);
	$i=1;
	
	$allEmails = array(); $cnt=0;
	/* for every email... */
	foreach($emails as $email_number) {
	  
	  /* get information specific to this email */
	  $overview = imap_fetch_overview($inbox,$email_number,0);
	  //echo '<pre>'; print_r($overview); die;
	  
	  $message = imap_fetchbody($inbox,$email_number,1);
	  //echo '<pre>'; print_r($message); die;
	  
	  $allEmails[$cnt]['uid'] = $overview[0]->uid;
	  $allEmails[$cnt]['subject'] = $overview[0]->subject;
	  $allEmails[$cnt]['from'] = $overview[0]->from;
	  $allEmails[$cnt]['seen'] = $overview[0]->seen;
	  $allEmails[$cnt]['on'] = date('Y-m-d H:i:s',strtotime($overview[0]->date));
	  $allEmails[$cnt]['body'] = $message;
	  
	  //var_dump($overview[0]);
	  /* output the email header information 
	  $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
	  $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
	  $output.= '<span class="from">'.$overview[0]->from.'</span>';
	  $output.= '<span class="date">on '.$overview[0]->date.'</span>';
	  $output.= '</div>';
	  
	  /* output the email body 
	  echo $output.= '<div class="body">'.$message.'</div>';
	      if ($i>10)
		      break;
	      $i++;
	  */    
	  $cnt = $cnt+1;
	}
	//pr($allEmails); die; 
	return $allEmails;
	//echo $output;
	
	/* close the connection */
	imap_close($inbox);

      }
      
    }
    
  
}
?>