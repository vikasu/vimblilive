<?php
    $g_confirmed = 'http://schemas.google.com/g/2005#event.confirmed';

    $g_entries = array();
    $g_tagName = null;
	$g_in_entry = false;
	$g_in_originalevent = false;
	$g_is_confirmed = false;

    function startElement( $parser, $tagName, $attr )
    {
        global $g_entries, $g_tagName, $g_confirmed, $g_is_confirmed, $g_in_entry, $g_in_originalevent;

        if ( $tagName == 'ENTRY' ) {
			if ($g_is_confirmed || count( $g_entries ) == 0) {
				$g_entries []= array();
			}
        	$g_is_confirmed = false;
			$g_in_entry = true;
		}
		else if ($tagName == 'GD:EVENTSTATUS')
    	{
			if ($attr['VALUE'] == $g_confirmed) {
	        	$g_is_confirmed = true;
			}
    	}
		else if ($tagName == 'GD:WHEN' && $g_is_confirmed && $g_in_originalevent == false)
    	{
			$startTime = date( "l jS \o\f F Y - h:i A", strtotime($attr['STARTTIME']) );
        	$g_entries[ count( $g_entries ) - 1 ]['when'] = $startTime;
    	}
		else if ($tagName == 'GD:WHERE' && $g_is_confirmed)
    	{
        	$g_entries[ count( $g_entries ) - 1 ]['where'] = $attr['VALUESTRING'];
    	}
        else if ( $tagName == 'GD:ORIGINALEVENT' ) {
			$g_in_originalevent = true;
		}
        $g_tagName = $tagName;
    }

    function endElement( $parser, $tagName ) 
    {
        global $g_tagName, $g_in_entry, $g_in_originalevent;

        if ( $tagName == 'ENTRY' ) {
			$g_in_entry = false;
		}
        else if ( $tagName == 'GD:ORIGINALEVENT' ) {
			$g_in_originalevent = false;
		}
        $g_tagName = null;
    }

    function textData( $parser, $text )
    {
        global $g_entries, $g_tagName, $g_in_entry;
		if ($g_tagName == 'TITLE' && $g_in_entry) {
			$g_entries[ count( $g_entries ) - 1 ]['title'] = $text;
		}
    }

    $three_months_in_seconds = 60 * 60 * 24 * 28 * 3;
    $three_months_ago = date("Y-m-d\Th:i:sP", time() - $three_months_in_seconds);
    $three_months_from_today = date("Y-m-d\Th:i:sP", time() + $three_months_in_seconds);

    $feed = "http://www.google.com/calendar/feeds/incredible.sndp%40gmail.com/public/full?orderby=starttime&singleevents=true&start-min=2012-09-21&start-max=2013-03-08";

    $parser = xml_parser_create();

    xml_set_element_handler( $parser, "startElement", "endElement" );
    xml_set_character_data_handler( $parser, "textData" );

    $f = fopen( $feed, 'r' );

    while( $data = fread( $f, 4096 ) )
    {
        xml_parse( $parser, $data );
    }

    xml_parser_free( $parser );

    foreach( $g_entries as $entry )
    {
	    print $entry['title'] . "\n"; 
	    print $entry['when'] . "\n"; 
	    print $entry['where'] . "\n"; 
        print "\n"; 
    }
?>
