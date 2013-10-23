<?php 
    $confirmed = 'http://schemas.google.com/g/2005#event.confirmed';

    $three_months_in_seconds = 60 * 60 * 24 * 28 * 3;
    $three_months_ago = date("Y-m-d\Th:i:sP", time() - $three_months_in_seconds);
    $three_months_from_today = date("Y-m-d\Th:i:sP", time() + $three_months_in_seconds);

    $feed = "http://www.google.com/calendar/feeds/foss.sanjuan%40gmail.com/" . 
        "public/full?orderby=starttime&singleevents=true&" . 
        "start-min=" . $three_months_ago . "&" .
        "start-max=" . $three_months_from_today;

    $doc = new DOMDocument(); 
    $doc->load( $feed );

    $entries = $doc->getElementsByTagName( "entry" ); 

    foreach ( $entries as $entry ) { 
    
        $status = $entry->getElementsByTagName( "eventStatus" ); 
        $eventStatus = $status->item(0)->getAttributeNode("value")->value;

        if ($eventStatus == $confirmed) {
            $titles = $entry->getElementsByTagName( "title" ); 
            $title = $titles->item(0)->nodeValue;

            $times = $entry->getElementsByTagName( "when" ); 
            $startTime = $times->item(0)->getAttributeNode("startTime")->value;
	    $when = date( "l jS \o\f F Y - h:i A", strtotime( $startTime ) );

            $places = $entry->getElementsByTagName( "where" ); 
            $where = $places->item(0)->getAttributeNode("valueString")->value;

            print $title . "\n"; 
            print $when . "\n"; 
            print $where . "\n"; 
	}
}
?>