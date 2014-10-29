<?php
	
	echo '<span class="bar-' . $msg_type . '" style="margin-top: 10px;"">' . $msg_content . '</span>';
	echo '<script type="text/javascript">';
	if ( $msg_type == 'success' ) {
		echo '$(\'#schoolid_' . $school_id . '\').slideUp(showtimer, function () {
			$(\'#schoolid_' . $school_id . '\').remove();
			setTimeout(function () {
				var oddeven_school_list = 1;
				$(\'.table-rows\').each(function () {
					$(this).removeClass(\'odd\');
					if ( oddeven_school_list == 0 ) {
						$(this).addClass(\'odd\');
						oddeven_school_list = 1;
					}
					else if ( oddeven_school_list == 1 ) {
						oddeven_school_list = 0;
					}
				});
			}, showtimer);
		});';
	}
	echo '</script>';
