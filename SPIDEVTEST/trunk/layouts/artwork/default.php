<?php
BuildHelperDiv($artwork_row['campaignName'].' - '.$artwork_row['artworkName']);
$navStatus = array("campaigns");
require_once(MODULES.'mod_header.php');
BuildPageIntro('<a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=campaigns\');">'.$lang->display('Campaigns').'</a>'.BREADCRUMBS_ARROW.'<a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=campaign&id='.$artwork_row['campaignID'].'\');">'.DisplayString($artwork_row['campaignName']).'</a>'.BREADCRUMBS_ARROW.$artworkName);
?>
<div id="wrapperWhite">
	<div class="controlScroll">
		<div class="controlselectScroll">
			<!-- Toolbar -->
			<div class="toolbar">
				<div class="title">
					<div class="ico">
						<?php echo '<img src="'.IMG_PATH.'header/ico_artwork.png">'; ?>
					</div>
					<div class="txt">
						<?php echo $lang->display('Artwork Details'); ?>
						<div class="intro"><?php echo $lang->display('Artwork Details Intro'); ?></div>
					</div>
				</div>
				<div class="options">
					<?php if($artwork_editable) { ?>
						<!-- Prework -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Amend Artwork'); ?>">
							<a href="javascript:void(0);" onclick="goToURL('parent','index.php?layout=amend&id=<?php echo $artworkID; ?>');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_config.png">'; ?></div>
								<div><?php echo $lang->display('Amend'); ?></div>
							</a>
						</div>
						<!-- Story Groups -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Storey Groups'); ?>">
							<a href="javascript:void(0);" onclick="goToURL('parent','index.php?layout=artstories&id=<?php echo $artworkID; ?>');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'header/ico_stories.png">'; ?></div>
								<div><?php echo $lang->display('Storey Groups'); ?></div>
							</a>
						</div>
                                                <!-- Customise -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Customise'); ?>">
							<a href="javascript:void(0);" onclick="goToURL('parent','index.php?layout=artbox&id=<?php echo $artworkID; ?>');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'header/ico_customise.png">'; ?></div>
								<div><?php echo $lang->display('Customise'); ?></div>
							</a>
						</div>
						<!-- Template -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Template'); ?>">
							<a href="javascript:void(0);" onclick="goToURL('parent','index.php?layout=arttpl&id=<?php echo $artworkID; ?>');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'header/ico_template.png">'; ?></div>
								<div><?php echo $lang->display('Template'); ?></div>
							</a>
						</div>
						<!-- Edit -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Edit'); ?>">
							<a href="javascript:void(0);" onclick="Popup('helper','blur');DoAjax('ref=<?php echo $artworkID; ?>&redirect=artwork','window','modules/mod_art_edit.php');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_edit.png">'; ?></div>
								<div><?php echo $lang->display('Edit'); ?></div>
							</a>
						</div>
						<!-- Fonts -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Fonts'); ?>">
							<a href="javascript:void(0);" onclick="window.location='/index.php?layout=cp_font_sub&artworkID=<?php echo $artworkID; ?>&show=Used';">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'header/ico_font_sub.png">'; ?></div>
								<div><?php echo $lang->display('Fonts'); ?></div>
							</a>
						</div>
						<?php
							$query = sprintf("SELECT service_package_items.id
											FROM service_package_items
											LEFT JOIN service_transaction_process ON service_transaction_process.id = service_package_items.service_tID
											LEFT JOIN service_engines ON service_engines.id = service_transaction_process.serviceID
											WHERE service_package_items.packageID = %d
											AND service_transaction_process.serviceID = %d
											AND service_transaction_process.transactionID = %d
											LIMIT 1",
											$_SESSION['packageID'],
											$artwork_row['artworkType'],
											SERVICE_REBUILD);
							$result = mysql_query($query, $conn) or die(mysql_error());
							if(mysql_num_rows($result)) {
						?>
						<!-- Rebuild -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Rebuild'); ?>">
							<a href="javascript:void(0);" onclick="if(confirm('Rebuild function will only address problems associated with styling. For parsing issue such as missing content, please re-upload this artwork. Are you sure you want to rebuild this artwork?')) goToURL('parent','index.php?layout=artwork&id=<?php echo $artworkID; ?>&do=rebuild');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_rebuild.png">'; ?></div>
								<div><?php echo $lang->display('Rebuild'); ?></div>
							</a>
						</div>
						<?php } ?>
					<?php } ?>
					<?php if($artwork_trashable) { ?>
						<!-- Trash -->
						<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Trash'); ?>">
							<a href="javascript:void(0);" onclick="Popup('helper','blur');DoAjax('id=<?php echo $artworkID; ?>','window','modules/mod_art_trash.php');">
								<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_trash.png">'; ?></div>
								<div><?php echo $lang->display('Trash'); ?></div>
							</a>
						</div>
					<?php } ?>
					<!-- Refresh -->
					<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Refresh'); ?>">
						<a href="javascript:void(0);" onclick="if(confirm('<?php echo $lang->display('Refreshing all pages would take longer to process. Are you sure you want to continue?'); ?>')) goToURL('parent','index.php?layout=artwork&id=<?php echo $artworkID; ?>&do=refresh');process_start('<?php echo $artwork_row['fileName']; ?>');">
							<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_refresh.png">'; ?></div>
							<div><?php echo $lang->display('Refresh'); ?></div>
						</a>
					</div>
					<!-- Download -->
					<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Download'); ?>">
						<a href="javascript:void(0);" onclick="Popup('helper','blur');DoAjax('id=<?php echo $artworkID; ?>','window','modules/mod_art_download.php');">
							<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_download.png">'; ?></div>
							<div><?php echo $lang->display('Download'); ?></div>
						</a>
					</div>
					<!-- Options -->
					<div class="optionOff" onmouseover="this.className='optionOn'" onmouseout="this.className='optionOff'" title="<?php echo $lang->display('Options'); ?>">
						<a href="javascript:void(0);" onclick="Popup('helper','blur');DoAjax('artwork_id=<?php echo $artworkID; ?>','window','modules/mod_options.php');">
							<div class="ico"><?php echo '<img src="'.IMG_PATH.'toolbar/ico_options.png">'; ?></div>
							<div><?php echo $lang->display('Options'); ?></div>
						</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php
				if($acl->acl_check("tasks","new",$_SESSION['companyID'],$_SESSION['userID'])) {
					BuildTipMsg($lang->display('Task Home Intro').' <a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=artwork&id='.$artworkID.'&task=step1\');">'.$lang->display('Tender New Translation Task').'</a>');
				}
			?>
			<div class="mainwrap">
				<div class="artworkdetailPanel">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr valign="top">
							<td width="50%" align="center" id="pages">
								<?php BuildPageViewer($artworkID); ?>
							</td>
							<td width="50%" class="detailTxt">
								<table width="100%" cellspacing="0" cellpadding="3" border="0">
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td width="25%" class="subject"><?php echo $lang->display('Artwork Title'); ?>:</td>
										<td width="75%" class="title"><?php echo $artwork_row['artworkName']; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Version'); ?>:</td>
										<td><?php echo $artwork_row['version']; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Language'); ?>:</td>
										<td><img src="images/flags/<?php echo $artwork_row['flag']; ?>" title="<?php echo $artwork_row['languageName']; ?>"  /> <?php echo $lang->display($artwork_row['languageName']); ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Subject'); ?>:</td>
										<td><?php echo !empty($artwork_row['subjectID']) ? $lang->display($artwork_row['subjectTitle']) : '<i>'.$lang->display('N/S').'</i>'; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Pages'); ?>:</td>
										<td><?php echo $artwork_row['pageCount']; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="display('layer_edit');" onmouseout="hidediv('layer_edit');">
										<td class="subject" valign="top"><?php echo $lang->display('Layers'); ?>:</td>
										<td>
										<?php
											$query = sprintf("SELECT *
															FROM artwork_layers
															WHERE artwork_id = %d
															ORDER BY ref ASC",
															$artworkID);
											$result = mysql_query($query, $conn) or die(mysql_error());
											echo '<div>';
											echo '<div class="left">';
											echo '<div id="layers" class="arrrgt" onclick="ChangeArrow(\'layers\');openandclose(\'layer_list\');">'.mysql_num_rows($result).'</div>';
											echo '</div>';
											echo '<div class="right" id="layer_edit" style="display:none;">';
											if($artwork_editable && mysql_num_rows($result)) echo '<a href="javascript:void(0);" onclick="Popup(\'helper\',\'blur\');DoAjax(\'id='.$artworkID.'\',\'window\',\'modules/mod_art_layers.php\');" title="'.$lang->display('Edit').'"><img src="'.IMG_PATH.'ico_edit.png" /></a>';
											echo '</div>';
											echo '<div class="clear"></div>';
											echo '</div>';
											echo '<div id="layer_list" style="display:none;">';
											echo '<table width="100%" cellspacing="0" cellpadding="3" border="0">';
											echo '<tr>';
											echo '<th align="center" width="5%"></th>';
											echo '<th align="center" width="5%"></th>';
											echo '<th width="10%">ID</th>';
											echo '<th width="75%">'.$lang->display('Name').'</th>';
											echo '<th align="center" width="5%"></th>';
											echo '</tr>';
											$count = 0;
											while($row = mysql_fetch_assoc($result)) {
												echo '<tr class="bgWhite" onmouseover="this.className=\'hover\'" onmouseout="this.className=\'bgWhite\'">';
												echo '<td align="center">';
												if($row['visible']) {
													echo '<img src="'.IMG_PATH.'ico_visible.png" title="'.$lang->display('Visible').'" /> ';
												}
												echo '</td>';
												echo '<td align="center">';
												if($row['locked']) {
													echo '<img src="'.IMG_PATH.'ico_locked.png" title="'.$lang->display('Locked').'" />';
													$count++;
												}
												echo '</td>';
												echo '<td>'.$row['ref'].'</td>';
												echo '<td>'.$row['name'].'</td>';
												echo '<td align="center"><div style="width:10px;height:10px;background-color:#'.$row['colour'].';"></div></td>';
												echo '</tr>';
											}
											echo '</table>';
											echo '</div>';
											if($count) BuildTipMsg($lang->display('Locked').': '.$lang->display('Layers').' ('.$count.')');
										?>
										</td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Word Count'); ?>:</td>
										<td><?php echo $artwork_row['wordCount']; ?></td>
									</tr>
									
									<!-- multiple translations? -->
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject">Multi Translation:</td>
										<td><?php if($artwork_row['mt_flag'] >= 0) { echo 'Yes ('.$artwork_row['mt_flag'].')'; } else { echo 'No'; } ?></td>
									</tr>
									
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('File Type'); ?>:</td>
										<td>
											<?php
												echo $artwork_row['serviceName'];
												if(!empty($artwork_row['note'])) echo ' - '.$artwork_row['note'];
											?>
										</td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Width'); ?>:</td>
										<td><?php echo ceil(PXtoMM($artwork_row['width']))." mm ( ".ceil($artwork_row['width'])." px )"; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Height'); ?>:</td>
										<td><?php echo ceil(PXtoMM($artwork_row['height']))." mm ( ".ceil($artwork_row['height'])." px )"; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('File Name'); ?>:</td>
										<td><?php echo $artwork_row['fileName']; ?></td>
									</tr>
									<tr onmouseover="display('font_substitue');" onmouseout="hidediv('font_substitue');">
										<td class="subject" valign="top"><?php echo $lang->display('Fonts'); ?>:</td>
										<td>
										<?php
											$query = sprintf("SELECT artwork_fonts.font_id,
															fonts.family, fonts.name, fonts.installed
															FROM artwork_fonts
															LEFT JOIN fonts ON artwork_fonts.font_id = fonts.id
															WHERE artwork_fonts.artwork_id = %d
															ORDER BY fonts.name ASC",
															$artworkID);
											$result = mysql_query($query, $conn) or die(mysql_error());
											echo '<div>';
											echo '<div class="left">';
											echo '<div id="font_usage" class="arrrgt" onclick="ChangeArrow(\'font_usage\');openandclose(\'font_list\');">'.mysql_num_rows($result).'</div>';
											echo '</div>';
											echo '<div class="right" id="font_substitue" style="display:none;">';
											if($artwork_editable && mysql_num_rows($result)) echo '<a href="/index.php?layout=cp_font_sub&artworkID='.$artworkID.'&show=Used" title="'.$lang->display('Substitute').'"><img src="'.IMG_PATH.'ico_swap.png" /></a>';
											echo '</div>';
											echo '<div class="clear"></div>';
											echo '</div>';
											echo '<div id="font_list" style="display:none;max-height:200px;overflow:auto;">';
											echo '<table width="100%" cellspacing="0" cellpadding="3" border="0">';
											echo '<tr>';
											echo '<th width="10%" align="center">'.$lang->display('Status').'</th>';
											echo '<th width="45%">'.$lang->display('Original').'</th>';
											echo '<th width="45%">'.$lang->display('Current Font').'</th>';
											echo '</tr>';
											$count = 0;
											
											require_once(CLASSES.'/Font_Substitution.php');
											
											while($row = mysql_fetch_assoc($result)) {
												echo '<tr class="bgWhite" onmouseover="this.className=\'hover\'" onmouseout="this.className=\'bgWhite\'">';
												echo '<td align="center">';
												if($row['installed']) {
													echo '<img src="'.IMG_PATH.'ico_s_tick.png" title="'.$lang->display('Installed').'" /> ';
												} else {
													echo '<img src="'.IMG_PATH.'ico_error.png" title="'.$lang->display('Missing').'" /> ';
												}
												echo '</td>';
												echo '<td>';
												#echo !empty($row['name']) ? $row['name'] : '('.$row['family'].')';
												echo '('.$row['family'].') '.$row['name'] ;
												echo '</td>';
												echo '<td>';
												
												$sub_font_info = Font_Substitution::useFont($row['font_id'],$artworkID,'artwork');
												$sub_font_id = $sub_font_info['font'];
												$sub_type = $sub_font_info['sub_type'];
												$substitute = $DB->get_font_info($sub_font_id);
												echo $sub_type.'('.$substitute['family'].') '.$substitute['name'] ;
												
												echo '</td>';
												echo '</tr>';
											}
											echo '</table>';
											echo '</div>';
											if($count||true) BuildTipMsg($lang->display('Missing').': '.$lang->display('Fonts').' ('.$count.')<span class="span">|</span><a href="javascript:void(0);" onclick="Popup(\'helper\',\'blur\');DoAjax(\'id='.$artworkID.'\',\'window\',\'modules/mod_art_fonts.php\');">'.$lang->display('Substitute').'</a><span class="span">|</span><a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=cp_font\');">'.$lang->display('Font Manager').'</a>');
										?>
										</td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Default Substitute Font'); ?>:</td>
										<td><?php echo !empty($artwork_row['default_sub_font_id']) ? $artwork_row['default_sub_font_name'] : '<i>'.$lang->display('N/S').'</i>'; ?></td>
									</tr>
									<tr onmouseover="display('img_edit');" onmouseout="hidediv('img_edit');">
										<td class="subject" valign="top"><?php echo $lang->display('Images'); ?>:</td>
										<td>
										<?php
											//images
											$IM = new ImageManager();
											$default_img_dir = $IM->get_default_img_dir($artworkID);
											$query = sprintf("SELECT img_links.id AS img_link_id, images.content
															FROM img_links
															LEFT JOIN images ON img_links.img_id = images.id
															LEFT JOIN boxes ON img_links.box_id = boxes.uID
															LEFT JOIN pages ON boxes.PageID = pages.uID
															LEFT JOIN artworks ON pages.ArtworkID = artworks.artworkID
															WHERE artworks.artworkID = %d
															ORDER BY img_links.img_id ASC",
															$artworkID);
											$result = mysql_query($query, $conn) or die(mysql_error());
											echo '<div>';
											echo '<div class="left">';
											echo '<div id="img_usage" class="arrrgt" onclick="ChangeArrow(\'img_usage\');openandclose(\'img_list\');">'.mysql_num_rows($result).'</div>';
											echo '</div>';
											echo '<div class="right" id="img_edit" style="display:none;">';
											if($artwork_editable && mysql_num_rows($result)) {
												echo '<a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=artwork&id='.$artworkID.'&do=autolookup\');" title="'.$lang->display('Auto Lookup').'"><img src="'.IMG_PATH.'ico_lookup.png" /></a>';
												echo '<span class="span"></span>';
												echo '<a href="javascript:void(0);" onclick="if(confirm(\''.$lang->display('Are you sure you want to reset all the image links?').'\')) goToURL(\'parent\',\'index.php?layout=artwork&id='.$artworkID.'&do=reset\');" title="'.$lang->display('Reset').'"><img src="'.IMG_PATH.'ico_reset.png" /></a>';
											}
											echo '</div>';
											echo '<div class="clear"></div>';
											echo '</div>';
											echo '<div id="img_list" style="display:none;max-height:200px;overflow:auto;">';
											echo '<table width="100%" cellspacing="0" cellpadding="3" border="0">';
											echo '<tr>';
											echo '<th width="10%" align="center">'.$lang->display('Status').'</th>';
											echo '<th width="80%">'.$lang->display('File Name').'</th>';
											echo '<th width="10%" align="center"></th>';
											echo '</tr>';
											$count = 0;
											while($row = mysql_fetch_assoc($result)) {
												echo '<tr  onmouseover="this.className=\'hover\';display(\'img_link_'.$row['img_link_id'].'\');" onmouseout="this.className=\'bgWhite\';hidediv(\'img_link_'.$row['img_link_id'].'\');">';
												echo '<td align="center">';
												if($IM->CheckImageStatus($artworkID,$row['img_link_id'])) {
													echo '<img src="'.IMG_PATH.'ico_s_tick.png" title="'.$lang->display('Found').'" /> ';
												} else {
													$count++;
													echo '<img src="'.IMG_PATH.'ico_error.png" title="'.$lang->display('Missing').'" /> ';
												}
												echo '</td>';
												echo '<td>';
												echo !empty($row['content']) ? $IM->get_img_basename($row['content']) : '<i>'.$lang->display('N/S').'</i>';
												echo '</td>';
												echo '<td align="center">';
												echo '<div id="img_link_'.$row['img_link_id'].'" style="display:none;"><a href="javascript:void(0);" onclick="Popup(\'helper\',\'blur\');DoAjax(\'artwork_id='.$artworkID.'&img_link_id='.$row['img_link_id'].'\',\'window\',\'modules/mod_art_img.php\');" title="'.$lang->display('Lookup').'"><img src="'.IMG_PATH.'ico_lookup.png" /></a></div>';
												echo '</td>';
												echo '</tr>';
											}
											echo '</table>';
											echo '</div>';
											if($count) BuildTipMsg($lang->display('Missing').': '.$lang->display('Images').' ('.$count.')<span class="span">|</span><a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=artwork&id='.$artworkID.'&do=autolookup\');">'.$lang->display('Auto Lookup').'</a><span class="span">|</span><a href="javascript:void(0);" onclick="goToURL(\'parent\',\'index.php?layout=cp_file\');">'.$lang->display('File Manager').'</a>');
										?>
										</td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Default Image Folder'); ?>:</td>
										<td><?php echo !empty($artwork_row['default_img_dir']) ? '<img src="'.IMG_PATH.'ico_home.png" />'.$artwork_row['default_img_dir'] : '<i>'.$lang->display('N/S').'</i>'; ?></td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject" valign="top"><?php echo $lang->display('Uploaded by'); ?>:</td>
										<td>
											<a href="javascript:void(0);" onclick="goToURL('parent','index.php?layout=user&id=<?php echo $artwork_row['uploaderID']; ?>');"><?php echo $artwork_row['forename'].' '.$artwork_row['surname']; ?></a>
											<?php if(!empty($artwork_row['time'])) echo '<span class="span"></span><span class="grey">'.date(FORMAT_TIME,$artwork_row['time'])."</span>"; ?>
										</td>
									</tr>
									<tr class="bgWhite" onmouseover="this.className='hover'" onmouseout="this.className='bgWhite'">
										<td class="subject"><?php echo $lang->display('Last Update'); ?>:</td>
										<td><?php echo date(FORMAT_TIME, strtotime($artwork_row['lastUpdate'])); ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php if($acl->acl_check("artworks","viewtasks",$_SESSION['companyID'],$_SESSION['userID'])) require_once(MODULES.'mod_art_tasks.php'); ?>
                        <?php if($acl->acl_check("artworks","viewtasks",$_SESSION['companyID'],$_SESSION['userID'])) require_once(MODULES.'mod_art_view_tasks.php'); ?>
		</div>
	</div>
</div>
<?php require_once(MODULES.'mod_footer.php'); ?>
<script type="text/javascript" src="javascripts/ajax.js"></script>
<script type="text/javascript" src="javascripts/datepicker.js"></script>
<script type="text/javascript" src="javascripts/jscolor/jscolor.js"></script>
<script type="text/javascript" src="javascripts/dom_drag.js"></script>
<script language="javascript">Drag.init(document.getElementById('handle'),document.getElementById('root'));</script>