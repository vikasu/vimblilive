<?php
               // Replace with real server API key from Google APIs  
                $apiKey = "AIzaSyAlV0HyBypMdDzL8y7Y-i-QZ17YGp-ZSgg";    
				
				//notifications: AIzaSyAlV0HyBypMdDzL8y7Y-i-QZ17YGp-ZSgg
				//ddynamic.rahul: AIzaSyB96gvpqfUc0haOGgzA4D18M3Zucr39LMI				
				//androidtester05: AIzaSyABUO0Q-ftwufU5mM3iRoMegHztgTXpVHg
				//testing.sdei: AIzaSyAB40PddfjBC0VM9vgQ3nOX5bSkFD3rIAY

                  // Replace with real client registration IDs
               $registrationIDs = array( "APA91bFEFPEuqBvolcGDNLTR4SFfe-1spt002Zad3KZINQ16bP-T4tOwaC1XM14ys-Lic9dtKMDt9xN8xD-O-x7SxclWMAd5UDmhIqLoUuIgPlGr5urGzwPBvIHTEu2Cb7bwtHzBOXUB74Jig20B0w0CBsGLxL1jtg");
			   
//"APA91bGB5wMuK5LUPtFxKFPWGeS8AqF2NlcWH8OjloIib1UXsKDvkAKxc60mrRfuB_UgjTRJwpzAYSoFhfwuURLteV93ljM-Pbo-ntRs7sQUq0m91TWikGlk_aCzclEYk0HberP8kENu","APA91bGKckzLaaI2sn2hp7gv9_g8C7ofjlmlWGD0C6YsbLHObJTi95SB0y2Osk8zZ6AwIozZuRIRIoPh_I523Crvui5vae6RQkrqUtDpQsdKowvbH8t7cRbEEIXXqL4y1cllAh6RvQMPbaLN9Ha8VH8RYP9x9IUM0g",			   

              // Message to be sent
             $message = "hi!! Testing GCM";

             // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';

           $fields = array(
           'registration_ids' => $registrationIDs,
             'data' => array( "message" => $message ),
            );
         $headers = array(
          'Authorization: key=' . $apiKey,
         'Content-Type: application/json'
          );

         // Open connection
              $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         //     curl_setopt($ch, CURLOPT_POST, true);
           //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields ));

                // Execute post
             $result = curl_exec($ch);

            // Close connection
               curl_close($ch);
             echo $result;
              //print_r($result);
               //var_dump($result);
           ?>

