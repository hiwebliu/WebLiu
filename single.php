<?php
if ( in_category('valuetheme') ) {
	get_template_part('single_ValueTheme' );
}else if (in_category('myworks')) {
	get_template_part('single_MyWorks' );
}
else {
	get_template_part('single_default' );
}
?>
