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
		    	sort: sort
		    },
			success: function(dat){
				if (dat === 0) flag = 0; //this is a hackish way, if db pull fails, 0 is being returned
				else{					
					var fromNow = moment(dat.timestamp).fromNow();
					var html = '<div class="row margin-10"><div class="col col-lg-12 col-md-12"><div class="card">'+
							'<div class="card-body">'+
							'<h4 class="card-title"><a href=opinion.php?token='+dat.token+'&id='+dat.data_id+'>'+dat.title+'</a></h4>'+
							'<div class="row">'+
							'<div class="col"><h6 class="card-subtitle mb-2 text-muted small">posted by: <a href="profile.php?id='+dat.fk_user_id+'">'+dat.user_name+'</a>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comment" aria-hidden="true"></i>&nbsp;'+dat.num_child+
							'</h6></div>'+
							'<div class="col offset-6"><h6 class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o"></i>&nbsp;<em>'+fromNow+'</em></h6></div>'+
							'</div>'+
							'<hr>'+
							'<p class="card-text">'+dat.data+'</p>'+							
							'</div></div></div></div>';
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
	$.post("./py/run_classifier.php");
})