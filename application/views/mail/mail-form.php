<?php
	
	echo '<form method="POST" action="' . base_url() .'?c=mail&m=send_mail">';
	
		echo 'Subject : <br /><input type="text" name="subject" style="width: 600px;" /><br /><br />';
		echo 'Message : <br /><textarea name="message" style="width: 600px; height: 300px;"></textarea><br />';
		echo '<input type="submit" />';
	
	echo '</form>';
