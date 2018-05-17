$(document).ready(function(){
	
	var first = 0, last = 5; /* Initial Pull Offset Values */
	var flag = 1;
	var sort = 0;

	$.ajaxCallPost = function(i,j,flag){
		if (flag==0) return;
		if (i === j) return;
		$.when($.ajax({
			url: './api/api-post-title-pull.php',
			type: "POST",
		    dataType: "json",
		    data: { 
		    	offset: i,
		    	sort: sort,
		    	type : 0
		    },
			success: function(dat){
				if (dat === 0) flag = 0; //this is a hackish way, if db pull fails, 0 is being returned
				else{
					var fromNow = moment(dat.timestamp).fromNow();
					var html = "<div class='post'><a class='post-title' href=opinion.php?token="+dat.token+"&id="+dat.data_id+">"+dat.title+"</a> <p class='post-subtitle'><span class='post-time'><i class='fa fa-clock-o'></i>&nbsp;<em>"+fromNow+"</em></span><span class='post-user'>posted by <strong>"+dat.user_name+"</strong></span></p><p class='post-data'>"+dat.data+"</p></div>";
					$('#main').append(html);
				}
			}
		})).done(function() {
			$.ajaxCallPost(i + 1, j,flag);
		});
	};				
	$.ajaxCallPost(first,last,flag);

	$(window).scroll(function() {
	   if($(window).scrollTop() + screen.height > $('body').height()) {
		first = last;
		last = first + 2;
		$.ajaxCallPost(first, last);
	   }
	});
})