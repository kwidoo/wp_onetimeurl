<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/kwidoo/wp_onetimeurl
 * @since      1.0.0
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/public/partials
 */

?>
<iframe src="/wp-content/plugins/OneTimeUrl/download.php?uuid=<?php echo esc_attr( (string) $uuid4 ); ?>"
 <?php //phpcs:ignore
 echo $output ? $output : null; ?>></iframe>

