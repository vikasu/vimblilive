

<style>
#duration_action_submit { margin-left: 70px; padding: 3px; width: 80px; }

th{
    height: 28px;
    text-align:left;
     font-size: smaller;
      font-style: normal;
         padding: 5px;
}
.CSSTableGenerator {
margin:0px;padding:0px;
width:100%;	

}
.CSSTableGenerator table{
width:100%;
height:100%;
margin:0px;padding:0px;
}
.CSSTableGenerator tr:last-child td:last-child {
-moz-border-radius-bottomright:0px;
-webkit-border-bottom-right-radius:0px;
border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
-moz-border-radius-topleft:0px;
-webkit-border-top-left-radius:0px;
border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
-moz-border-radius-topright:0px;
-webkit-border-top-right-radius:0px;
border-top-right-radius:0px;
}
.CSSTableGenerator tr:last-child td:first-child{
-moz-border-radius-bottomleft:0px;
-webkit-border-bottom-left-radius:0px;
border-bottom-left-radius:0px;
}
.CSSTableGenerator tr:hover td{

}
.CSSTableGenerator tr:nth-child(odd){ background-color:#e5e5e5; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }
.CSSTableGenerator td{
vertical-align:middle;

text-align:left;
padding:7px;
font-size:14px;
font-family:arial;
font-weight:normal;
color:##5D5C5C;
width: 40px;
}.CSSTableGenerator tr:last-child td{
border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
background:-o-linear-gradient(bottom, #4c4c4c 5%, #000000 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #4c4c4c), color-stop(1, #000000) );	background:-moz-linear-gradient( center top, #4c4c4c 5%, #000000 100% );	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#4c4c4c", endColorstr="#000000");	background: -o-linear-gradient(top,#4c4c4c,000000);
background-color:#4c4c4c;
border:0px solid #000000;
text-align:center;
border-width:0px 0px 1px 1px;
font-size:14px;
font-family:arial;
font-weight:bold;
color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
background:-o-linear-gradient(bottom, #4c4c4c 5%, #000000 100%);
background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #4c4c4c), color-stop(1, #000000) );
background:-moz-linear-gradient( center top, #4c4c4c 5%, #000000 100% );	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#4c4c4c", endColorstr="#000000");	background: -o-linear-gradient(top,#4c4c4c,000000);
background-color:#4c4c4c;
}
.CSSTableGenerator tr:first-child td:first-child{
border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
border-width:0px 0px 1px 1px;
}
.tk_actn{
   padding: 3px; margin-left: 82px;
}

</style>
<!--Current Mission Section Starts-->

<table class="CSSTableGenerator">
    <tr>
	<th>Date</th>
	<th>Title</th>
    </tr>
    
    <?php foreach($result as $res) { ?>
    <tr>
	<td><?php echo $res['start_time'];?></td>
	<td><?php echo $res['title'];?></td>
    </tr>
    <?php } ?>
   	  </table><hr/>
	  <div><span style="text-align: center;	 padding: 46px;">Want to schedule extra time?</span></div><br/>
	<?php   if(empty($path)) { ?>
	<?php //pr($path); ?>
	<div class="blubtn-small disableButton" style="margin-left:60px;"><input  type="button" value="Schedule Now" class="tk_actn" onClick="window.location.href='http://www.google.com/calendar'" style="padding-bottom:2px; width:116px; padding-left:-13px; margin-left:0px; padding:0px;"  /></div>
	
	
	
	 
	 <?php  } else { ?>
	 	<div class="blubtn-small disableButton" style="margin-left:60px;"><input  type="button" value="Schedule Now" class="tk_actn" onClick="window.location.href=<?php echo $path ?>" style="padding-bottom:2px; width:116px; padding-left:-13px; margin-left:0px; padding:0px;"  /></div>
	
	 <?php } ?>
	 
	
    <!--Select De-Select Blue Button-->

<!--Current Mission Section End-->