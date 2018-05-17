$("#logout").on("click", function(){
		  $.ajax({
		    type: "POST",
		    url: './api/api-logout.php',
		    dataType: "json",
		    data: JSON.stringify( { "flag": 440} ),
		    success: function(dat) {
		        if (dat === 0) alert("Logout Failed");
		        window.location.replace("login.php");
		    }
		  });
		  return false;
    });