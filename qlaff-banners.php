<?php function qlaff_banner_options($nr) {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
?>
<div style="padding: 20px;">
	<h2>Qlaff Banner Options Page</h2>

		<?php 
			if($_GET['result']=='result' && $_GET['updated']!='true') {
				$toppartner = $_POST['qlaff_banner_partner'];
				$topch = $_POST['qlaff_banner_ch'];
				$toptype = $_POST['qlaff_banner_type'];
				$toproom = $_POST['qlaff_banner_room'];
				$toplang = $_POST['qlaff_banner_lang'];
				$topsize = $_POST['qlaff_banner_size'];
			}
			else {
				$toppartner = get_option('qlaff_banner_partner');
				if(empty($toppartner))
						$toppartner='RnD';

				$topch = get_option('qlaff_banner_ch');
				if(empty($topch))
						$topch='qlaff';

				$toptype = get_option('qlaff_banner_type');
				if(empty($toptype))
						$toptype='casino';

				$toproom = get_option('qlaff_banner_room');
				if(empty($toproom))
						$toproom='all';

				$toplang = get_option('qlaff_banner_lang');
				if(empty($toplang))
						$toplang='en';

				$topsize = get_option('qlaff_banner_size');
				if(empty($topsize))
						$topsize='300x250';
			}
		?>
		<h3>Search the banner you want to place on the page.</h3>
		<div id="container" class="banners">
			<div id="selection">
				<form action="options.php" method="post" enctype="multipart/form-data" name="bannerselector">
				<?php settings_fields( 'qlaff-banner' ); ?>
					<table>
						<thead>
							<tr>
								<td>Partner</td>
								<td>Channel</td>
								<td>Type</td>
								<td>Language</td>
								<td>Size</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select name="qlaff_banner_partner" style="width: 150px;">
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
												if ($toppartner == $v) {
													echo "<option value=\"$v\" selected=\"selected\">$partnername</option>\n";
												} 
												else {
													echo "<option value=\"$v\">$partnername</option>\n";
												}
											}
										?>
									</select>
								</td>
								<td>
									<select name="qlaff_banner_ch" style="width: 80px;">
										<?php $chArr = array();
											$chArr[]="seo";
											$chArr[]="qlaff";
											foreach($chArr as $v){
												if ($topch == $v) {
													echo "<option value=\"$v\" selected=\"selected\">$v</option>\n";
												} 
												else {
													echo "<option value=\"$v\">$v</option>\n";
												}
											}
										?>
									</select>
								</td>
								<td>
									<select name="qlaff_banner_type" style="width: 100px;">
										<?php $typeArr = array();
											$typeArr[]="casino";
											$typeArr[]="poker";
											$typeArr[]="whs";
											foreach($typeArr as $v){
												if ($toptype == $v) {
													echo "<option value=\"$v\" selected=\"selected\">$v</option>\n";
												} 
												else {
													echo "<option value=\"$v\">$v</option>\n";
												}
											}
										?>
									</select>
								</td>
								<td>
									<select name="qlaff_banner_lang" style="width: 80px;">
										<?php $langArr = array();
											$langArr[]="en";
											$langArr[]="de";
											$langArr[]="fr";
											$langArr[]="es";
											foreach($langArr as $v){
												if ($toplang == $v) {
													echo "<option value=\"$v\" selected=\"selected\">$v</option>\n";
												} 
												else {
													echo "<option value=\"$v\">$v</option>\n";
												}
											}
										?>
									</select>
								</td>
								
								<td>
									<select name="qlaff_banner_size" style="width: 150px;">
									<?php $sizeArr = array();
										$sizeArr[]="120x60";
										$sizeArr[]="120x240";
										$sizeArr[]="120x600";
										$sizeArr[]="125x125";
										$sizeArr[]="160x600";
										$sizeArr[]="234x60";
										$sizeArr[]="250x250";
										$sizeArr[]="300x250";
										$sizeArr[]="468x60";
										$sizeArr[]="728x90";
										foreach($sizeArr as $v){
											if ($topsize == $v) {
												echo "<option value=\"$v\" selected=\"selected\">$v px</option>\n";
											} 
											else {
												echo "<option value=\"$v\">$v px</option>\n";
											}
										}
										?>
									</select>
								</td>
								<td>
									<input type="submit" value="<?php _e('Save Changes') ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div id="list">
				<style type="text/css">
					#list table td {padding: 5px 0;}
					#list table td.last {border-bottom: 1px solid #CACACA; padding: 0; }
					#list table td.name {width:150px;}
					#list table td.banner {width:750px}
					#list table td.code {width:350px}
				</style>
				<?php if($toproom!="all") $bannerroomsql="AND name = '".$toproom."'" ?>
				<?php $bannerxml = "http://www.qlaff.com/request_banner.php?type=".$toptype."&ch=".$topch."&partner=".$toppartner."&lang=".$toplang."&size=".$topsize."&room=all";
				$xml = simplexml_load_file($bannerxml); ?>
				<?php if(empty($xml)) { ?>
					<h2>Oops... we don't have these banners in our database, please try another search</h2>
				<?php } else { ?>
					<table border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th class="name">Room name</th>
								<th class="banner">Banner</td>
								<th class="code">Implementation guide - <br/>place this code to the page:</th>
							</tr>
							<tr>
								<td class="last"></td>
								<td class="last"></td>
								<td class="last"></td>
							</tr>
						</thead>
						<tbody>
							<?php if($toproom=="all") { ?>
							<tr style="height: 80px;">
								<td class="name">Random</td>
								<td class="banner"><img src="../../wp-content/plugins/qlaff/img/question_mark.jpg" height="80" style="vertical-align:middle;padding-right: 10px;">Show all the rooms in random order</td>
								<td class="code">
									<i>in the code</i><br/>
									<b>&lt;?php qlaff_banner('all','<?php echo $toplang; ?>','<?php echo $topsize; ?>'); ?&gt;</b><br/><br/>
									<i>in the post/page</i><br/>
									<b>[qlaff_banner room="all" lang="<?php echo $toplang; ?>" size="<?php echo $topsize; ?>"]</b>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<td class="last"></td>
								<td class="last"></td>
								<td class="last"></td>
							</tr>
							<?php foreach($xml->room as $room) { ?>
							<tr>
								<td class="name"><?php echo $room->name ?></td>
								<td class="banner">
									<a href="http://www.qlaff.com/proxy.php?partner=<?php echo $toppartner; ?>&ch=<?php echo $topch; ?>&type=<?php echo $toptype; ?>&id=<?php echo $room->id; ?>"" target="_blank">
										<img src="<?php echo "http://banners.gamaff.se/".$room->name."/".$toplang."_".$topsize.".gif" ?>"></td>
									</a>
								<td class="code">
									<i>in the code</i><br/>
									<b>&lt;?php qlaff_banner('<?php echo $room->name; ?>','<?php echo $toplang; ?>','<?php echo $topsize; ?>'); ?&gt;</b><br/><br/>
									<i>in the post/page</i><br/>
									<b>[qlaff_banner room="<?php echo $room->name; ?>" lang="<?php echo $toplang; ?>" size="<?php echo $topsize; ?>"]</b>
								</td>
							</tr>
							<tr>
								<td class="last"></td>
								<td class="last"></td>
								<td class="last"></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
			</div>
		</div><!-- container -->
	</div>
<?php } ?>
<?php function qlaff_banner($bannername,$bannerlang,$bannersize) { ?>
	<?php if($bannername!='all') $bannerroomif="&room=".$bannername; ?>
	<?php $bannerxml = "http://www.qlaff.com/request_banner.php?type=".get_option('qlaff_banner_type')."&ch=".get_option('qlaff_banner_ch')."&partner=".get_option('qlaff_banner_partner')."&lang=".$bannerlang."&size=".$bannersize.$bannerroomif; ?>
	<?php $xml = simplexml_load_file($bannerxml); ?>
		<?php foreach ($xml->room as $room) { ?>
			<a href="<?php echo $room->tracker ?>" target="_blank"><img src="<?php echo $room->icon ?>"></a>
		<?php } ?>
<?php } ?>
<?php
// shortcode for placing game in the post/page, ex: [qlaff_game name="luckydouble" lang="en" type="casino"]
function qlaff_banner_shortcode( $atts_banner ) {
	extract( shortcode_atts( array(
		'room' => $bannername,
		'lang' => $bannerlang,
		'size' => $bannersize,
	), $atts_banner ) );

	return qlaff_banner($room,$lang,$size);
}
add_shortcode( 'qlaff_banner', 'qlaff_banner_shortcode' );

?>