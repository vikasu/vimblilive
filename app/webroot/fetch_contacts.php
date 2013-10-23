 <?php
 function getGmailContacts($user='', $password='') {
//========================================== step 1: login ===========================================================
    $user = 'incredible.sndp@gmail.com';
    $password = '9872103632';
    $login_url = "https://www.google.com/accounts/ClientLogin";
    $fields = array(
        'Email' => $user,
        'Passwd' => $password,
        'service' => 'cp', // <== contact list service code
        'source' => 'test-google-contact-grabber',
        'accountType' => 'GOOGLE',
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$login_url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,$fields);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec($curl);
    $returns = array();

    foreach (explode("\n",$result) as $line)
    {
        $line = trim($line);
        if (!$line) continue;
        list($k,$v) = explode("=",$line,2);
    
        $returns[$k] = $v;
    }

    curl_close($curl);

//echo "<pre>"; print_r($returns);exit;

    if(!isset($returns['Error'])) {
    
        //========================== step 2: grab the contact list ===========================================================
        $feed_url = "http://www.google.com/m8/feeds/contacts/$user/full?alt=json&max-results=250";
    
        $header = array(
            'Authorization: GoogleLogin auth=' . $returns['Auth'],
        );
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $feed_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result, true);
        //$data = json_decode(json_encode((array) simplexml_load_string($result)),1);
        echo "<pre>";
        print_r($data);exit;
        $contacts = array();
        $i=0;
        foreach ($data['feed']['entry'] as $entry)
        {
            //echo $i." ";
            $entryElement = $entry;
            if(isset($entryElement['gd$email'])) {
    
                $gdEmailData = $entryElement['gd$email'][0];
    
                //$contact->title = $entryElement['title']['$t'];
                //$contact->email = $gdEmailData['address'];
    
                $contacts[$gdEmailData['address']][] = $entryElement['title']['$t'];
                $contacts[$gdEmailData['address']][] = $entryElement['gd$email'][0]['address'];
                $contacts[$gdEmailData['address']][] = $entryElement['gd$phoneNumber'][0]['$t'];
                $contacts[$gdEmailData['address']][] = $entryElement['gd$postalAddress'][0]['$t']; 
            }
        }
        echo'<pre>';
        print_r($contacts);
        return $contacts;
    }
    else {
    
        if($returns['Error']=='BadAuthentication') {
    
            //echo '<strong>User Name and Password is incorrect.</strong>';
            $errorArr = array("Error"=>"User Name and Password is incorrect.");
            //print_r($errorArr);
            return $errorArr;
        }
    }
 }
getGmailContacts();
?>