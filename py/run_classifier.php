<?php
function run_classify(){
		#$python = `python classify.py`;
		#echo exec('python classify.py');
		echo exec('python /var/www/html/forum/py/classify.py');
		#echo $python;
	}
run_classify();
?>

