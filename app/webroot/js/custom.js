// JavaScript Document By Manjeet Singh

$(document).ready(function(){
	
	if($.browser.msie){
	  $('.banner-btn input, .blubtn-big input, .signuplogin-btn input').css('padding-top', '6px');
	  $('.signup-hdng h3').css('padding-top', '6px');
	  $('.about-pane h3').css('padding-top', '7px');
	}
	if($.browser.msie && $.browser.version==7){
	  $('.banner-btn, .blubtn-big').css('display', 'inline');
	}
	if($.browser.mozilla){
	  $('.banner-btn input, .blubtn-big input').css('padding-top', '5px');
	  $('.signuplogin-btn input').css('padding-top', '2px');
	  $('.signup-hdng h3').css('padding-top', '6px');
	  $('.about-pane h3').css('padding-top', '7px');
	}
	
	
	/********Added Dec-11-2012*********/
	$('.cntctlist').find('li').find("div:eq(2)").addClass('nobrdr');
	$('.cntctlist').find('li:even').addClass('even');
	
	
	/********Added Dec-12-2012*********/
	$('.crrntprgr-list').find('li:even').addClass('odd');
	$('.manag-actvty').find('li:even').addClass('odd');
	
	/********************/
	$('#scrollbar1').tinyscrollbar();	
	
	/******** Added Dec-14-2014 *****/
	//$(".con_list").find("tr:even").css("background-color","#EEE");
	
	$('.customform').jqTransform({imgPath:'images/form_img/'});
	
	
	
	/********************/
	//$('#scrollbar1').tinyscrollbar();	
	
	
		/********Add Remove Input fields Row**************/
		
		$('#addfields').click(function(){
		   $('.scf-list:first').clone().insertAfter($('.scf-list:last'));
		   $('#removefields').show();
		   return false;
		 });
		$('#removefields').click(function(){
		   if ($('.scf-list').length > 1) 
		     {
               $('.scf-list:last').remove();
             }
		  if ($('.scf-list').length <= 1) 
		  {
		      $('#removefields').hide();
		  }
		   return false;
		 }); 
	
	
	//SELECT/UNSELECT CHECK BOXEX OF A FORM 
	jQuery("#all").live('click',function(){ 
			if(jQuery(this).is(":checked")){
				jQuery(".allchk").each(function(){
						jQuery(this).attr("checked","checked");
				});
			}else{
				jQuery(".allchk").each(function(){ 
						jQuery(this).attr("checked",false);
				});	
			}
		});
	//END OF SELECT CHECK BOXEX OF A FORM
	
	
  });


function initMenus() {
	$('ul.menu li > ul').hide();
	$.each($('ul.menu'), function(){
		$('#' + this.id + '.expandfirst ul:first').show();
	});
	$('ul.menu li a').click(
		function() {
			
			$(this).parent().find('.innerexpand ul').show();
			
			var checkElement = $(this).next();
			var parent = this.parentNode.parentNode.id;

			if($('#' + parent).hasClass('noaccordion')) {
				$(this).next().slideToggle('normal');
				return false;
			}
			if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
				if($('#' + parent).hasClass('collapsible')) {
					$('#' + parent + ' ul:visible').slideUp('normal');
				}
				return false;
			}
			if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
				$('#' + parent + ' ul:visible').slideUp('normal');
				checkElement.slideDown('normal');
				return false;
			}
			
			
		}
	);
}