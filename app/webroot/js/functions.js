jQuery.noConflict();
jQuery(function($){

	//globals
	$("#fileListContent").click(function(){
		$(".preview .cols").html("");		
	});

	$('.content ul.contentdata li').live('click', function(e){
		if(!ctrlPressed){
			$('.content ul.contentdata li').each(function(index) {
				$(this).parent().removeClass('hover2');

			});
			var stat = $(this).parent().attr('stat');
			if(stat != 'desabled'){
				$(this).parent().toggleClass('hover2');
			}
		}
		else{
			var stat = $(this).parent().attr('stat');
			if(stat != 'desabled'){
				$(this).parent().toggleClass('hover2');
			}

		}

	});

	 $('a.root').live('click', function(){
		$("#dhtmlgoodies_topNodes li a").css("color","black");
		$(this).css("color","green");
		 $("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
		 var folderid = '0';		 
		folderid = $(this).attr('fid');	
		$.ajax({
			url: '/maillists/listfiles/' + folderid,
			success: function(data) {
				$('#fileListContent').html(data);
			}
		});
		/* for breadcrumb*/
		$(".breadcrumb-content").html("<img alt'loading...' src='/img/loader.gif' />");
		$.ajax({
			url: '/maillists/breadcrumb/' + folderid,
			success: function(data) {
				$(".breadcrumb-content").html(data);
							//refreshFileListHovers();
			}
		});
		$.ajax({
			url: '/maillists/batchupload',
			success: function(data) {
				$("#fileBoxHolder").html(data);
			}
		});
	 });


	$("#dhtmlgoodies_topNodes a").live('click', function(){
		$("#dhtmlgoodies_topNodes li a").css("color","black");
		$(this).css("color","green");
		$("#fileListContent").html("<img class='content-loader' alt'loading...' src='/img/loader.gif' />");
		var folderId = $(this).attr('fid');
		$('.search-form #searchTerm').val('Search');
	 	$.ajax({
			url: '/maillists/listfiles/' + folderId,
			success: function(data) {
				$("#fileListContent").html(data);
			}
		});
		/* for breadcrumb*/
		$(".breadcrumb-content").html("<img alt'loading...' src='/img/loader.gif' />");		
		$.ajax({
			url: '/maillists/breadcrumb/' + folderId,
			success: function(data) {
				$(".breadcrumb-content").html(data);
			}
		});
		$.ajax({
			url: '/maillists/batchupload',
			success: function(data) {
				$("#fileBoxHolder").html(data);
			}
		});
	 });
	 
	 $('.breadcrumbs a').live('click', function(){		 
		var folderid = '';		 
		folderid = $(this).attr('fid');	
		$("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
		$.ajax({
			url: '/maillists/listfiles/' + folderid,
			success: function(data) {
				$('#fileListContent').html(data);
			}
		});
		$(".breadcrumb-content").html("<img alt'loading...' src='/img/loader.gif' />");
		$.ajax({
			url: '/maillists/breadcrumb/' + folderid,
			success: function(data) {
				$('.breadcrumb-content').html(data);	
			}
		});
	 });	

	 $('#fileListContent ul.contentdata .folder').live('dblclick', function(){
		$("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
		var folderid = '';
		folderid = $(this).attr('fid');
		$.ajax({
			url: '/maillists/listfiles/' + folderid,
			success: function(data) {
				$('#fileListContent').html(data);
			}
		});
		
		 
	 });
	$('#fileListContent ul.contentdata.file li').live('dblclick', function(){
		$("#viewItemWindow").modal();
		jQuery('#viewItemWindow').html("<img class='content-loader' src='/img/loader.gif' />");
		var fileId = $(this).parent().attr('id');
		$.ajax({
			url: '/maillists/download/' + fileId,
			success: function(data) {
				$("#viewItemWindow").html(data);
			}
		});
	 });
	 

	
	 
	 
	 $("#searchsort").live('click', function(){
		var searchTerm = $('.search-form #searchTerm').val();
		if(searchTerm != 'Search'){
			$("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
			$.ajax({
				url: '/maillists/searchfiles/' + searchTerm,
				success: function(data) {
					$("#fileListContent").html(data);
				}
			});
		}
	 });
	 
	 $("#addFolderBtn").live('click', function(){
		 $("#addFolderWindow").modal();
		 $("#addFolderWindow").html("<img class='content-loader' src='/img/loader.gif' />");
		 $.ajax({
			url: '/maillists/addfolder/',
			success: function(data) {
				$("#addFolderWindow").html(data);
				$("#addFolderWindow").modal();
			}
		});
	 });
	
	//file list stuff for multiple selection
	 $('.content ul.contentdata li').live('hover', function(){
		$(this).parent().toggleClass('hover');
		$(this).toggleClass('hover');
	});


	var ctrlPressed = false;
	$(document).keydown(function(evt) {
		if (evt.keyCode == 16 || evt.keyCode == 17) { // ctrl = 17 shift = 16
		    ctrlPressed = true;
		}
	}).keyup(function(evt) {
		if (evt.keyCode == 16 || evt.keyCode == 17) { // ctrl
		    ctrlPressed = false;
		}
	});
	// shift clicked
	var shiftPressed = false;	
	$(document).keydown(function(evt) {
		if (evt.keyCode == 16 || evt.keyCode == 17) { // ctrl = 17 shift = 16
		    shiftPressed = true;

		}
	}).keyup(function(evt) {
		if (evt.keyCode == 16 || evt.keyCode == 17) { // ctrl
		    shiftPressed = false;
		    var shiftArr = new Array();
		}
	});
	

	// ctrl + a
	var aPressed = false;
	$(document).keydown(function(evt) {
		if (evt.keyCode == 65) { // ctrl = 17 shift = 16
		    aPressed = true;
		}
	}).keyup(function(evt) {
		if (evt.keyCode == 65) { // ctrl
		    aPressed = false;
		}
	});
	
	$(document).keydown(function(evt) {
		if(ctrlPressed && aPressed){
			$(".content ul.contentdata.file").each(function(index) {
				$(this).addClass('hover2');
			});
			$(".content ul.contentdata.folder").each(function(index) {
				$(this).addClass('hover2');
			});
			$(".content").click();
		}
	});


	// sorting for listfiles
	$("#fileListContent ul.contenthead li a.list").live('click', function(){
		$("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
		var order = $(this).html();		
		$.ajax({
			url: '/maillists/listfiles/*/' + order,
			success: function(data) {
				$("#fileListContent").html(data);
			}
		});
	 });
	 
	// sorting for searchfiles
	$("#fileListContent ul.contenthead li a.search").live('click', function(){
		$("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
		var order = $(this).html();
		var keyword = $('#searchTerm').val();
		$.ajax({
			url: '/maillists/searchfiles/' + keyword + '/' + order,
			success: function(data) {
				$("#fileListContent").html(data);
			}
		});
	 });

	 
	$("#downloadBtn").live('click', function(){
		$("#viewItemWindow").html("<img class='content-loader' src='/img/loader.gif' />");
		var fileid = $(this).attr('fid');
		$.ajax({
			url: '/maillists/download/' + fileid,
			success: function(data) {
				$("#viewItemWindow").html(data);
			}
		});
	 });

	 
	 //recent files list stuff
	 $("#recentBox ul li a").live('click', function(){
		$("#fileListContent").html("<img class='content-loader' src='/img/loader.gif' />");
		$(".preview .cols").html("<img class='content-loader' src='/img/loader.gif' />");
		var folderid = '';
		folderid = $(this).attr('folderid');
		$.ajax({
			url: '/maillists/listfiles/' + folderid,
			success: function(data) {
				$('#fileListContent').html(data);
			}
		});
	 	
	 	$.ajax({
			url: '/maillists/viewfile/' + $(this).attr('fid'),
			success: function(data) {
				$(".preview .cols").html(data);
			}
		});
	 });
	 
	//user management stuff	
	$('.management-table a.name').click(function(){
		if($(this).parent().parent().next().hasClass('options'))
		{
			$(this).parent().parent().next().children().toggle();
			$(this).parent().parent().toggleClass('active');
		}
		return false;
	});

	$('#fileListContent ul.contentdata .file').live('click', function(){

		var folderid = '';
		folderid = $(this).attr('fid');
		var stat = $(this).parent().attr('stat');
		if(stat != 'desabled'){
			var arr = new Array( );
			$("#fileListContent ul.contentdata.hover2").each(function(index) {
				arr[index] = $(this).attr("id");

			});
			if(arr.length == 1){
				$(".preview .cols").html("<img class='content-loader' src='/img/loader.gif' />");
				$.ajax({
					url: '/maillists/viewfile/' + folderid,
					success: function(data) {
						$(".preview .cols").html(data);
					}
				});
			}
			$.ajax({
				url: '/maillists/recentfiles/' + folderid,
				success: function(data) {
					$("#recentBox").html(data);
				}
			});






		}
	 });
})