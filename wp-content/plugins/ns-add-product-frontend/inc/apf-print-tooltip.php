<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Helper function to print wp style tooltip
function apf_print_tooltip($text = '') {
    echo '<span class="apf-tooltip">?
            <span class="apf-tooltiptext">'.$text.'</span>
          </span>';
}
?>