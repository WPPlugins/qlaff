<?php
/*
Plugin Name: QLAFF toplist
Plugin URI: 
Description: QLAFF affiliate matterials in WP.
Version: 1.5.0
Author: QLAFF
Author URI: http://www.qlaff.com
License: GPL2
*/

/*  Copyright 2010  QLAFF (email : margus.kiss@qlaff.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// ADMIN MENU ACTIONS

add_action('admin_menu', 'qlaff_toplist_admin');

function qlaff_toplist_admin() {
	
	add_menu_page( 'Qlaff', 'Qlaff Toplist', 'manage_options' , 'qlaff_identifier', 'qlaff_toplist_options' ); 
	add_submenu_page('qlaff_identifier', 'Qlaff Game Options', 'Qlaff Games', 'manage_options', 'qlaff_games_identifier', 'qlaff_games_options');
	add_submenu_page('qlaff_identifier', 'Qlaff Banner Options', 'Qlaff Banners', 'manage_options', 'qlaff_banner_identifier', 'qlaff_banner_options');
	add_action( 'admin_init', 'register_toplist_settings' );
	add_action( 'admin_init', 'register_toplist_bonus_settings' );
	add_action( 'admin_init', 'register_toplist_freeroll_settings' );
	add_action( 'admin_init', 'register_toplist_tournament_settings' );
	add_action( 'admin_init', 'register_game_settings');
	add_action( 'admin_init', 'register_banner_settings');
}
function register_toplist_settings() {
	register_setting( 'qlaff-toplist', 'qlaff_partner' );
	register_setting( 'qlaff-toplist', 'qlaff_ch' );
	register_setting( 'qlaff-toplist', 'qlaff_type' );
	register_setting( 'qlaff-toplist', 'qlaff_limit' );
	register_setting( 'qlaff-toplist', 'qlaff_geo' );
	register_setting( 'qlaff-toplist', 'qlaff_lang' );
	register_setting( 'qlaff-toplist', 'qlaff_width' );
}
function register_toplist_bonus_settings() {
	register_setting( 'qlaff-toplist-bonus', 'qlaff_bonus_type' );
	register_setting( 'qlaff-toplist-bonus', 'qlaff_bonus_limit' );
	register_setting( 'qlaff-toplist-bonus', 'qlaff_bonus_geo' );
	register_setting( 'qlaff-toplist-bonus', 'qlaff_bonus_lang' );
	register_setting( 'qlaff-toplist-bonus', 'qlaff_bonus_width' );
}
function register_toplist_freeroll_settings() {
	register_setting( 'qlaff-toplist-freeroll', 'qlaff_freeroll_type' );
	register_setting( 'qlaff-toplist-freeroll', 'qlaff_freeroll_limit' );
	register_setting( 'qlaff-toplist-freeroll', 'qlaff_freeroll_geo' );
	register_setting( 'qlaff-toplist-freeroll', 'qlaff_freeroll_lang' );
	register_setting( 'qlaff-toplist-freeroll', 'qlaff_freeroll_width' );
}
function register_toplist_tournament_settings() {
	register_setting( 'qlaff-toplist-tournament', 'qlaff_tournament_type' );
	register_setting( 'qlaff-toplist-tournament', 'qlaff_tournament_limit' );
	register_setting( 'qlaff-toplist-tournament', 'qlaff_tournament_geo' );
	register_setting( 'qlaff-toplist-tournament', 'qlaff_tournament_lang' );
	register_setting( 'qlaff-toplist-tournament', 'qlaff_tournament_width' );
}
function register_game_settings() {
	register_setting( 'qlaff-game', 'qlaff_game_partner' );
	register_setting( 'qlaff-game', 'qlaff_game_ch' );
	register_setting( 'qlaff-game', 'qlaff_game_type' );
	register_setting( 'qlaff-game', 'qlaff_game_gametype' );
	register_setting( 'qlaff-game', 'qlaff_game_gamename' );
	register_setting( 'qlaff-game', 'qlaff_game_geo' );
	register_setting( 'qlaff-game', 'qlaff_game_pop' );
	register_setting( 'qlaff-game', 'qlaff_game_lang' );
	register_setting( 'qlaff-game', 'qlaff_game_width' );
}
function register_banner_settings() {
	register_setting( 'qlaff-banner', 'qlaff_banner_partner' );
	register_setting( 'qlaff-banner', 'qlaff_banner_ch' );
	register_setting( 'qlaff-banner', 'qlaff_banner_type' );
	register_setting( 'qlaff-banner', 'qlaff_banner_size' );
	register_setting( 'qlaff-banner', 'qlaff_banner_lang' );
}

// Game Settings

//require_once(ABSPATH . 'wp-content/plugins/qlaff/banners_casino_en.php');

require_once(ABSPATH . 'wp-content/plugins/qlaff/game_list.php');

require_once(ABSPATH . 'wp-content/plugins/qlaff/qlaff-games.php');

require_once(ABSPATH . 'wp-content/plugins/qlaff/qlaff-banners.php');




// Toplist Settings

function qlaff_toplist_options() {

  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

?>

<!-- SMALL TOPLIST -->
<div style="padding: 20px;">
	<h2>Qlaff Toplist Options Page</h2>
	<h3><u><i>Small toplist:</i></u></h3>
	<form method="post" action="options.php" name="qlaff_toplist">
	<?php settings_fields( 'qlaff-toplist' ); ?>
		 <table width="1000">
			<tr valign="top">
				<th style="width:150px; text-align:left;">Partner ID</th>
				<td style="width:300px;">
					<select name="qlaff_partner" style="width:200px;">
						<?php $partnerArr = array();
							$partnerArr[]="RnD";
							$partnerArr[]="1";
							$partnerArr[]="dinv";
							$partnerArr[]="gimig";
							$partnerArr[]="gamaff";
							foreach($partnerArr as $v){
								if($v=='RnD') $partnername = "none";
								if($v=='1') $partnername = "Voorz";
								if($v=='dinv') $partnername = "Domain Invest";
								if($v=='gimig') $partnername = "GimiGames";
								if($v=='gamaff') $partnername = "Gamaff";
								if (get_option('qlaff_partner') == $v) {
									echo "<option name=\"qlaff_partner\" id=\"qlaff_partner\" value=\"$v\" selected=\"selected\">".$partnername."</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_partner\" id=\"qlaff_partner\" value=\"$v\">".$partnername."</option>\n";
								}
							}
						?>
					</select>
					<!-- <input name="qlaff_partner" type="text" id="qlaff_partner" value="<?php echo get_option('qlaff_partner'); ?>" />    -->
				</td>
				<td>(enter your partner ID provided by Qlaff)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Channel</th>
				<td>
					<select name="qlaff_ch" style="width:200px;">
						<?php $chArr = array();
							$chArr[]="seo";
							$chArr[]="qlaff";
							foreach($chArr as $v){
								if (get_option('qlaff_ch') == $v) {
									echo "<option name=\"qlaff_ch\" id=\"qlaff_ch\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_ch\" id=\"qlaff_ch\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(enter the channel name provided by Qlaff)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Type:</th>
				<td>
					<select name="qlaff_type" style="width:200px;">
						<?php $typeArr = array();
							$typeArr[]="casino";
							$typeArr[]="poker";
							$typeArr[]="whs";
							foreach($typeArr as $v){
								if (get_option('qlaff_type')== $v) {
									echo "<option name=\"qlaff_type\" id=\"qlaff_type\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_type\" id=\"qlaff_type\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. casino, poker, whs)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Limit:</th>
				<td><input name="qlaff_limit" type="text" id="qlaff_limit" value="<?php echo get_option('qlaff_limit'); ?>" style="width:200px;" /></td>
				<td>(# of rooms to display)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Geo:</th>
				<td>
					<select name="qlaff_geo" style="width:200px;">
						<?php $geoArr = array();
							$geoArr[]="all";
							$geoArr[]="us";
							$geoArr[]="eu";
							foreach($geoArr as $v){
								if (get_option('qlaff_geo')== $v) {
									echo "<option name=\"qlaff_geo\" id=\"qlaff_geo\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_geo\" id=\"qlaff_geo\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. All rooms = all; US rooms only = us, European rooms = eu)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Review language:</th>
				<td>
					<select name="qlaff_lang" style="width:200px;">
						<?php $langArr = array();
							$langArr[]="en";
							$langArr[]="fr";
							$langArr[]="de";
							$langArr[]="es";
							foreach($langArr as $v){
								if($v=='en') $language = "English";
								if($v=='fr') $language = "French";
								if($v=='de') $language = "German";
								if($v=='es') $language = "Spanish";
								if (get_option('qlaff_lang')== $v) {
									echo "<option name=\"qlaff_lang\" id=\"qlaff_lang\" value=\"$v\" selected=\"selected\">$language</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_lang\" id=\"qlaff_lang\" value=\"$v\">$language</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(NB! US rooms have only English language available)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Width:</th>
				<td><input name="qlaff_width" type="text" id="qlaff_width" value="<?php echo get_option('qlaff_width'); ?>" style="width:200px;" /></td>
				<td>(toplist widht in px)</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="qlaff_partner" />
		<input type="hidden" name="page_options" value="qlaff_ch" />
		<input type="hidden" name="page_options" value="qlaff_type" />
		<input type="hidden" name="page_options" value="qlaff_limit" />
		<input type="hidden" name="page_options" value="qlaff_geo" />
		<input type="hidden" name="page_options" value="qlaff_lang" />
		<input type="hidden" name="page_options" value="qlaff_width" />
		<p><input type="submit" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	<div>
		<p>In order to add toplist on the page, insert <b>&lt;?php qlaff_toplist() ?&gt;</b> to the appropriate place</p>
		<p><b>OR</b></p>
		<p>add shortcode <b>[qlaff_toplist_small]</b> inside the post/page content area.</p>
	</div>
</div>
<hr/>

<!-- BONUS TOPLIST -->
<div style="padding: 20px;">
	<h3><u><i>Best Bonus Toplist:</i></u></h3>
	<form method="post" action="options.php" name="qlaff_toplist_bonus">
	<?php settings_fields( 'qlaff-toplist-bonus' ); ?>
		 <table width="1000">
			<tr valign="top">
				<th style="width:150px; text-align:left;">Type:</th>
				<td>
					<select name="qlaff_bonus_type" style="width:200px;">
						<?php $typeArr = array();
							$typeArr[]="casino";
							$typeArr[]="poker";
							$typeArr[]="whs";
							foreach($typeArr as $v){
								if (get_option('qlaff_bonus_type')== $v) {
									echo "<option name=\"qlaff_bonus_type\" id=\"qlaff_bonus_type\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_bonus_type\" id=\"qlaff_bonus_type\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. casino, poker, whs)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Limit:</th>
				<td><input name="qlaff_bonus_limit" type="text" id="qlaff_bonus_limit" value="<?php echo get_option('qlaff_bonus_limit'); ?>" style="width:200px;" /></td>
				<td>(# of rooms to display)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Geo:</th>
				<td>
					<select name="qlaff_bonus_geo" style="width:200px;">
						<?php $geoArr = array();
							$geoArr[]="all";
							$geoArr[]="us";
							$geoArr[]="eu";
							foreach($geoArr as $v){
								if (get_option('qlaff_bonus_geo')== $v) {
									echo "<option name=\"qlaff_bonus_geo\" id=\"qlaff_bonus_geo\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_bonus_geo\" id=\"qlaff_bonus_geo\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. All rooms = all; US rooms only = us, European rooms = eu)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Review language:</th>
				<td>
					<select name="qlaff_bonus_lang" style="width:200px;">
						<?php $langArr = array();
							$langArr[]="en";
							$langArr[]="fr";
							$langArr[]="de";
							$langArr[]="es";
							foreach($langArr as $v){
								if($v=='en') $language = "English";
								if($v=='fr') $language = "French";
								if($v=='de') $language = "German";
								if($v=='es') $language = "Spanish";
								if (get_option('qlaff_bonus_lang')== $v) {
									echo "<option name=\"qlaff_bonus_lang\" id=\"qlaff_bonus_lang\" value=\"$v\" selected=\"selected\">$language</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_bonus_lang\" id=\"qlaff_bonus_lang\" value=\"$v\">$language</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(NB! US rooms have only English language available)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Width:</th>
				<td><input name="qlaff_bonus_width" type="text" id="qlaff_bonus_width" value="<?php echo get_option('qlaff_bonus_width'); ?>" style="width:200px;" /></td>
				<td>(toplist widht in px)</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="qlaff_bonus_type" />
		<input type="hidden" name="page_options" value="qlaff_bonus_limit" />
		<input type="hidden" name="page_options" value="qlaff_bonus_geo" />
		<input type="hidden" name="page_options" value="qlaff_bonus_lang" />
		<input type="hidden" name="page_options" value="qlaff_bonus_width" />
		<p><input type="submit" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	<div>
		<p>In order to add toplist on the page, insert <b>&lt;?php qlaff_toplist_bonus() ?&gt;</b> to the appropriate place</p>
		<p><b>OR</b></p>
		<p>add shortcode <b>[qlaff_toplist_bonus]</b> inside the post/page content area.</p>
	</div>
</div>
<hr/>

<!-- FREEROLL TOPLIST -->
<div style="padding: 20px;">
	<h3><u><i>Best Freeroll Toplist:</i></u></h3>
	<form method="post" action="options.php" name="qlaff_toplist_freeroll">
	<?php settings_fields( 'qlaff-toplist-freeroll' ); ?>
		 <table width="1000">
			<tr valign="top">
				<th style="width:150px; text-align:left;">Type:</th>
				<td>
					<select name="qlaff_freeroll_type" style="width:200px;">
						<?php $typeArr = array();
							$typeArr[]="casino";
							$typeArr[]="poker";
							$typeArr[]="whs";
							foreach($typeArr as $v){
								if (get_option('qlaff_freeroll_type')== $v) {
									echo "<option name=\"qlaff_freeroll_type\" id=\"qlaff_freeroll_type\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_freeroll_type\" id=\"qlaff_freeroll_type\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. casino, poker, whs)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Limit:</th>
				<td><input name="qlaff_freeroll_limit" type="text" id="qlaff_freeroll_limit" value="<?php echo get_option('qlaff_freeroll_limit'); ?>" style="width:200px;" /></td>
				<td>(# of rooms to display)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Geo:</th>
				<td>
					<select name="qlaff_freeroll_geo" style="width:200px;">
						<?php $geoArr = array();
							$geoArr[]="all";
							$geoArr[]="us";
							$geoArr[]="eu";
							foreach($geoArr as $v){
								if (get_option('qlaff_freeroll_geo')== $v) {
									echo "<option name=\"qlaff_freeroll_geo\" id=\"qlaff_freeroll_geo\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_freeroll_geo\" id=\"qlaff_freeroll_geo\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. All rooms = all; US rooms only = us, European rooms = eu)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Review language:</th>
				<td>
					<select name="qlaff_freeroll_lang" style="width:200px;">
						<?php $langArr = array();
							$langArr[]="en";
							$langArr[]="fr";
							$langArr[]="de";
							$langArr[]="es";
							foreach($langArr as $v){
								if($v=='en') $language = "English";
								if($v=='fr') $language = "French";
								if($v=='de') $language = "German";
								if($v=='es') $language = "Spanish";
								if (get_option('qlaff_freeroll_lang')== $v) {
									echo "<option name=\"qlaff_freeroll_lang\" id=\"qlaff_freeroll_lang\" value=\"$v\" selected=\"selected\">$language</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_freeroll_lang\" id=\"qlaff_freeroll_lang\" value=\"$v\">$language</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(NB! US rooms have only English language available)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Width:</th>
				<td><input name="qlaff_freeroll_width" type="text" id="qlaff_freeroll_width" value="<?php echo get_option('qlaff_freeroll_width'); ?>" style="width:200px;" /></td>
				<td>(toplist widht in px)</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="qlaff_freeroll_type" />
		<input type="hidden" name="page_options" value="qlaff_freeroll_limit" />
		<input type="hidden" name="page_options" value="qlaff_freeroll_geo" />
		<input type="hidden" name="page_options" value="qlaff_freeroll_lang" />
		<input type="hidden" name="page_options" value="qlaff_freeroll_width" />
		<p><input type="submit" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	<div>
		<p>In order to add toplist on the page, insert <b>&lt;?php qlaff_toplist_freeroll() ?&gt;</b> to the appropriate place</p>
		<p><b>OR</b></p>
		<p>add shortcode <b>[qlaff_toplist_freeroll]</b> inside the post/page content area.</p>
	</div>
</div>


<!-- TOURNAMENT TOPLIST -->
<div style="padding: 20px;">
	<h3><u><i>Best Tournament Toplist:</i></u></h3>
	<form method="post" action="options.php" name="qlaff_toplist_tournament">
	<?php settings_fields( 'qlaff-toplist-tournament' ); ?>
		 <table width="1000">
			<tr valign="top">
				<th style="width:150px; text-align:left;">Type:</th>
				<td>
					<select name="qlaff_tournament_type" style="width:200px;">
						<?php $typeArr = array();
							$typeArr[]="casino";
							$typeArr[]="poker";
							$typeArr[]="whs";
							foreach($typeArr as $v){
								if (get_option('qlaff_tournament_type')== $v) {
									echo "<option name=\"qlaff_tournament_type\" id=\"qlaff_tournament_type\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_tournament_type\" id=\"qlaff_tournament_type\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. casino, poker, whs)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Limit:</th>
				<td><input name="qlaff_tournament_limit" type="text" id="qlaff_tournament_limit" value="<?php echo get_option('qlaff_tournament_limit'); ?>" style="width:200px;" /></td>
				<td>(# of rooms to display)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Geo:</th>
				<td>
					<select name="qlaff_tournament_geo" style="width:200px;">
						<?php $geoArr = array();
							$geoArr[]="all";
							$geoArr[]="us";
							$geoArr[]="eu";
							foreach($geoArr as $v){
								if (get_option('qlaff_tournament_geo')== $v) {
									echo "<option name=\"qlaff_tournament_geo\" id=\"qlaff_tournament_geo\" value=\"$v\" selected=\"selected\">$v</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_tournament_geo\" id=\"qlaff_tournament_geo\" value=\"$v\">$v</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(ex. All rooms = all; US rooms only = us, European rooms = eu)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Review language:</th>
				<td>
					<select name="qlaff_tournament_lang" style="width:200px;">
						<?php $langArr = array();
							$langArr[]="en";
							$langArr[]="fr";
							$langArr[]="de";
							$langArr[]="es";
							foreach($langArr as $v){
								if($v=='en') $language = "English";
								if($v=='fr') $language = "French";
								if($v=='de') $language = "German";
								if($v=='es') $language = "Spanish";
								if (get_option('qlaff_tournament_lang')== $v) {
									echo "<option name=\"qlaff_tournament_lang\" id=\"qlaff_tournament_lang\" value=\"$v\" selected=\"selected\">$language</option>\n";
								} 
								else {
									echo "<option name=\"qlaff_tournament_lang\" id=\"qlaff_tournament_lang\" value=\"$v\">$language</option>\n";
								}
							}
						?>
					</select>
				</td>
				<td>(NB! US rooms have only English language available)</td>
			</tr>
			<tr valign="top">
				<th style="width:150px; text-align:left;">Width:</th>
				<td><input name="qlaff_tournament_width" type="text" id="qlaff_tournament_width" value="<?php echo get_option('qlaff_tournament_width'); ?>" style="width:200px;" /></td>
				<td>(toplist widht in px)</td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="qlaff_tournament_type" />
		<input type="hidden" name="page_options" value="qlaff_tournament_limit" />
		<input type="hidden" name="page_options" value="qlaff_tournament_geo" />
		<input type="hidden" name="page_options" value="qlaff_tournament_lang" />
		<input type="hidden" name="page_options" value="qlaff_tournament_width" />
		<p><input type="submit" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	<div>
		<p>In order to add toplist on the page, insert <b>&lt;?php qlaff_toplist_tournament() ?&gt;</b> to the appropriate place</p>
		<p><b>OR</b></p>
		<p>add shortcode <b>[qlaff_toplist_tournament]</b> inside the post/page content area.</p>
	</div>
</div>

<?php
}

// small TOPLIST

function qlaff_toplist() {
	echo '
	<div id="qlafftoplist" style="float: left;padding: 0 0 10px 0;">
		<table cellspacing="0" cellpadding="0" class="home" style="width:'; echo get_option("qlaff_width"); echo 'px">
			<caption>Best Online ';echo ucfirst(get_option('qlaff_type')); echo ' Rooms</caption>
			<tbody>
				<tr>
					<th>Room</th>
					<th></th>
					<th>Bonus</th>
					<th>Review</th>
				</tr>';
	$toplistxml = "http://www.qlaff.com/request.php?type=".get_option('qlaff_type')."&ch=".get_option('qlaff_ch')."&partner=".get_option('qlaff_partner')."&limit=".get_option('qlaff_limit')."&geo=".get_option('qlaff_geo')."";
	$xml = simplexml_load_file($toplistxml);
	foreach ($xml->room as $room) {
		echo '
				<tr>
					<td class="room"><a target="_blank" href="';echo $room->tracker; echo '"><img src="'; echo $room->icon; echo '"></a></td>
					<td class="geo">'; if($room->geo =='us') { echo '<span class="flag flag-us">us</span>'; } echo '</td>
					<td class="bonus"><a target="_blank" href="'; echo $room->tracker; echo '">'; echo $room->bonus; echo '</a></td>
					<td class="review">
						<a class="button" href="'; echo $room->tracker; echo '" target="_blank"><span>Get Bonus!</span></a>
						<br>
						<a class="review" href="http://www.qlaff.com/reviewext.php?type='; echo get_option("qlaff_type"); echo '&partner='; echo get_option("qlaff_partner"); echo '&ch='; echo get_option("qlaff_ch"); echo '&lang='; echo get_option("qlaff_lang"); echo '&id='; echo $room->id; echo '">Read Review</a>
					</td>
				</tr>';
	}
	echo '		<tr>
					<td class="accept" colspan="4"><span class="flag flag-us"></span><span>Accepts also US Players</span></td>
				</tr> 
			</tbody>
		</table>
	</div>';
}

// shortcode for placing small toplist in the post/page, ex: [qlaff_toplist_small]
function qlaff_toplist_small_shortcode() {
	
	return qlaff_toplist();
}
add_shortcode( 'qlaff_toplist_small', 'qlaff_toplist_small_shortcode' );



// BONUS TOPLIST

function qlaff_toplist_bonus() {
	echo '
	<div id="qlafftoplist" style="float: left;padding: 0 0 10px 0;">
		<table cellspacing="0" cellpadding="0" class="home" style="width:'; echo get_option("qlaff_bonus_width"); echo 'px">
			<caption>Best Online ';echo ucfirst(get_option('qlaff_bonus_type')); echo ' Bonus</caption>
			<tbody>
				<tr>
					<th></th>
					<th>Room</th>
					<th></th>
					<th>Rating</th>
					<th>Bonus</th>
					<th>Review</th>
				</tr>';
	$toplistxml = "http://www.qlaff.com/request_bonus.php?type=".get_option('qlaff_bonus_type')."&ch=".get_option('qlaff_ch')."&partner=".get_option('qlaff_partner')."&limit=".get_option('qlaff_bonus_limit')."&geo=".get_option('qlaff_bonus_geo')."";
	$xml = simplexml_load_file($toplistxml);
	foreach ($xml->room as $room) {
		echo '
				<tr>
					<td class="rank">';echo $room->rank; echo'</td>
					<td class="room"><a target="_blank" href="';echo $room->tracker; echo '"><img src="'; echo $room->icon; echo '"></a></td>
					<td class="geo">'; if($room->geo =='us') { echo '<span class="flag flag-us">us</span>'; } echo '</td>
					<td class="rating"><span class="stars';echo round($room->rating); echo'">';echo $room->rating; echo'</span></td>
					<td class="bonus"><a target="_blank" href="'; echo $room->tracker; echo '">'; echo $room->bonus; echo '</a></td>
					<td class="review big">
						<a class="button" href="'; echo $room->tracker; echo '" target="_blank"><span>Get Bonus!</span></a>
						<br>
						<a class="review" href="http://www.qlaff.com/reviewext.php?type='; echo get_option("qlaff_bonus_type"); echo '&partner='; echo get_option("qlaff_partner"); echo '&ch='; echo get_option("qlaff_ch"); echo '&lang='; echo get_option("qlaff_bonus_lang"); echo '&id='; echo $room->id; echo '">Read Review</a>
					</td>
				</tr>';
	}
	echo '		<tr>
					<td class="accept" colspan="6"><span class="flag flag-us"></span><span>Accepts also US Players</span></td>
				</tr> 
			</tbody>
		</table>
	</div>';
}

// shortcode for placing BONUS toplist in the post/page, ex: [qlaff_toplist_bonus]
function qlaff_toplist_bonus_shortcode() {
	
	return qlaff_toplist_bonus();
}
add_shortcode( 'qlaff_toplist_bonus', 'qlaff_toplist_bonus_shortcode' );


// FREEROLL TOPLIST

function qlaff_toplist_freeroll() {
	echo '
	<div id="qlafftoplist" style="float: left;padding: 0 0 10px 0;">
		<table cellspacing="0" cellpadding="0" class="home" style="width:'; echo get_option("qlaff_freeroll_width"); echo 'px">
			<caption>Best Online ';echo ucfirst(get_option('qlaff_freeroll_type')); echo ' Freerolls</caption>
			<tbody>
				<tr>
					<th></th>
					<th>Room</th>
					<th></th>
					<th>Rating</th>
					<th>Bonus</th>
					<th>Review</th>
				</tr>';
	$toplistxml = "http://www.qlaff.com/request_freeroll.php?type=".get_option('qlaff_freeroll_type')."&ch=".get_option('qlaff_ch')."&partner=".get_option('qlaff_partner')."&limit=".get_option('qlaff_freeroll_limit')."&geo=".get_option('qlaff_freeroll_geo')."";
	$xml = simplexml_load_file($toplistxml);
	foreach ($xml->room as $room) {
		echo '
				<tr>
					<td class="rank">';echo $room->rank; echo'</td>
					<td class="room"><a target="_blank" href="';echo $room->tracker; echo '"><img src="'; echo $room->icon; echo '"></a></td>
					<td class="geo">'; if($room->geo =='us') { echo '<span class="flag flag-us">us</span>'; } echo '</td>
					<td class="rating"><span class="stars';echo round($room->freeroll); echo'">';echo $room->freeroll; echo'</span></td>
					<td class="bonus"><a target="_blank" href="'; echo $room->tracker; echo '">'; echo $room->bonus; echo '</a></td>
					<td class="review big">
						<a class="button" href="'; echo $room->tracker; echo '" target="_blank"><span>Get Bonus!</span></a>
						<br>
						<a class="review" href="http://www.qlaff.com/reviewext.php?type='; echo get_option("qlaff_freeroll_type"); echo '&partner='; echo get_option("qlaff_partner"); echo '&ch='; echo get_option("qlaff_ch"); echo '&lang='; echo get_option("qlaff_freeroll_lang"); echo '&id='; echo $room->id; echo '">Read Review</a>
					</td>
				</tr>';
	}
	echo '		<tr>
					<td class="accept" colspan="6"><span class="flag flag-us"></span><span>Accepts also US Players</span></td>
				</tr> 
			</tbody>
		</table>
	</div>';
}

// shortcode for placing BONUS toplist in the post/page, ex: [qlaff_toplist_bonus]
function qlaff_toplist_freeroll_shortcode() {
	
	return qlaff_toplist_freeroll();
}
add_shortcode( 'qlaff_toplist_freeroll', 'qlaff_toplist_freeroll_shortcode' );


// TOURNAMENT TOPLIST

function qlaff_toplist_tournament() {
	echo '
	<div id="qlafftoplist" style="float: left;padding: 0 0 10px 0;">
		<table cellspacing="0" cellpadding="0" class="home" style="width:'; echo get_option("qlaff_tournament_width"); echo 'px">
			<caption>Best Online ';echo ucfirst(get_option('qlaff_tournament_type')); echo ' tournaments</caption>
			<tbody>
				<tr>
					<th></th>
					<th>Room</th>
					<th></th>
					<th>Rating</th>
					<th>Bonus</th>
					<th>Review</th>
				</tr>';
	$toplistxml = "http://www.qlaff.com/request_tournament.php?type=".get_option('qlaff_tournament_type')."&ch=".get_option('qlaff_ch')."&partner=".get_option('qlaff_partner')."&limit=".get_option('qlaff_tournament_limit')."&geo=".get_option('qlaff_tournament_geo')."";
	$xml = simplexml_load_file($toplistxml);
	foreach ($xml->room as $room) {
		echo '
				<tr>
					<td class="rank">';echo $room->rank; echo'</td>
					<td class="room"><a target="_blank" href="';echo $room->tracker; echo '"><img src="'; echo $room->icon; echo '"></a></td>
					<td class="geo">'; if($room->geo =='us') { echo '<span class="flag flag-us">us</span>'; } echo '</td>
					<td class="rating"><span class="stars';echo round($room->tournament); echo'">';echo $room->tournament; echo'</span></td>
					<td class="bonus"><a target="_blank" href="'; echo $room->tracker; echo '">'; echo $room->bonus; echo '</a></td>
					<td class="review big">
						<a class="button" href="'; echo $room->tracker; echo '" target="_blank"><span>Get Bonus!</span></a>
						<br>
						<a class="review" href="http://www.qlaff.com/reviewext.php?type='; echo get_option("qlaff_tournament_type"); echo '&partner='; echo get_option("qlaff_partner"); echo '&ch='; echo get_option("qlaff_ch"); echo '&lang='; echo get_option("qlaff_tournament_lang"); echo '&id='; echo $room->id; echo '">Read Review</a>
					</td>
				</tr>';
	}
	echo '		<tr>
					<td class="accept" colspan="6"><span class="flag flag-us"></span><span>Accepts also US Players</span></td>
				</tr> 
			</tbody>
		</table>
	</div>';
}

// shortcode for placing BONUS toplist in the post/page, ex: [qlaff_toplist_bonus]
function qlaff_toplist_tournament_shortcode() {
	
	return qlaff_toplist_tournament();
}
add_shortcode( 'qlaff_toplist_tournament', 'qlaff_toplist_tournament_shortcode' );

// CSS add

function my_init_method() {
    //wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
 
add_action('init', 'my_init_method');


    add_action('wp_head', 'qlaff_header');

	function qlaff_header() {
		echo '<link type="text/css" rel="stylesheet" href="'.plugins_url("/qlaff-master.css", __FILE__).'" />' . "\n";
		echo '<link type="text/css" rel="stylesheet" href="'.plugins_url("/fancybox/jquery.fancybox-1.3.4.css", __FILE__).'" />' . "\n";
		echo '<script type="text/javascript" src="'.plugins_url("fancybox/jquery.fancybox-1.3.4.pack.js", __FILE__).'" /></script>' . "\n";
		echo '<script type="text/javascript" src="'.plugins_url("fancybox/jquery.onload.qlaff.js", __FILE__).'" /></script>' . "\n";
	}

	
?>