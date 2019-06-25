<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap dpp_page_settings">
<h1><?php _e('Plugin Settings', 'dpp_wpp_page')?></h1>
<?php $dpp_options = array();
$opt = get_option('dpp_wpp_page_options');
$instruct = isset($_GET['instruct']) ? $_GET['instruct'] : '';
if(isset($_POST['submit_dpp_wpp_page']) && wp_verify_nonce( $_POST['dpp_nonce_field'], 'dpp_page_action' )):
	_e("<strong>changes saving..</strong>", 'dpp_wpp_page');
	$dpp_nosave = array('submit_dpp_wpp_page');
	foreach($dpp_nosave as $noneed):
	  unset($_POST[$noneed]);
	endforeach;
		foreach($_POST as $key => $val):
		$dpp_options[$key] = $val;
		endforeach;
		 $dpp_settings_save = update_option('dpp_wpp_page_options', $dpp_options );
		if($dpp_settings_save){ dpp_wpp_page::dp_redirect('options-general.php?page=dpp_page_settings&instruct=1'); }
		else{ dpp_wpp_page::dp_redirect('options-general.php?page=dpp_page_settings&instruct=2'); }endif;
if(!empty($instruct) && $instruct == 1):
  _e( '<div class="updated settings-error dpp_pluginnotice is-dismissible" id="setting-error-settings_updated"> 
<p><strong>Changes saved.</strong></p><button class="notice-ignore" type="button"><span class="screen-reader-text">Ignore this notice.</span></button></div>', 'dpp_wpp_page');	
elseif(!empty($instruct) && $instruct == 2):
  _e( '<div class="error settings-error dpp_pluginnotice is-dismissible" id="setting-error-settings_updated"> 
<p><strong>Changes not saved.</strong></p><button class="notice-ignore" type="button"><span class="screen-reader-text">Ignore this notice.</span></button></div>', 'dpp_wpp_page');
endif;
//$dpp_post_status = array('draft');
?> 
<div id="dpp-stuff"><div id="dpp-post-body" class="metabox-holder columns-2"><div id="dpp-post-body-content" style="position: relative;">
<form style="padding: 10px; border: 1px solid #333;" action="" method="post" name="dpp_wpp_page_form">
<?php  wp_nonce_field( 'dpp_page_action', 'dpp_nonce_field' ); ?>
<table class="form-table">
<tbody>
<tr><th scope="row"><label for="dpp_posteditor"><?php _e('Select Editor<br><em>Default: Classic Editor</em>', 'dpp_wpp_page'); ?></label></th>
<td><select id="dpp_posteditor" name="dpp_posteditor"><option value="classic" <?php echo (isset($opt['dpp_posteditor']) && $opt['dpp_posteditor'] == 'classic') ? "selected = 'selected'" : ''; ?>><?php _e('Classic Editor', 'dpp_wpp_page'); ?></option><option value="gutenberg" <?php echo (isset($opt['dpp_posteditor']) && $opt['dpp_posteditor'] == 'gutenberg') ? "selected = 'selected'" : ''; ?>><?php _e('Gutenberg Editor', 'dpp_wpp_page'); ?></option></select>
<p><?php _e('Please select which editor you are using.<br> If you are using Gutenberg, select gutenberg editor otherwise it will not show Duplicate button on edit screen.', 'dpp_wpp_page'); ?></p>
</td>
</tr>
<tr><th scope="row"><label for="dpp_post_status"><?php _e('Post Status<br><em>Default: Draft</em>', 'dpp_wpp_page'); ?></label></th>
<td><select id="dpp_post_status" name="dpp_post_status"><option value="draft" <?php echo($opt['dpp_post_status'] == 'draft') ? "selected = 'selected'" : ''; ?>><?php _e('Draft', 'dpp_wpp_page'); ?></option><option value="publish" <?php echo($opt['dpp_post_status'] == 'publish') ? "selected = 'selected'" : ''; ?>><?php _e('Publish', 'dpp_wpp_page'); ?></option><option value="private" <?php echo($opt['dpp_post_status'] == 'private') ? "selected = 'selected'" : ''; ?>><?php _e('Private', 'dpp_wpp_page'); ?></option><option value="pending" <?php echo($opt['dpp_post_status'] == 'pending') ? "selected = 'selected'" : ''; ?>><?php _e('Pending', 'dpp_wpp_page'); ?></option></select>
<p><?php _e('Please select any post status you want to assign for duplicate post.', 'dpp_wpp_page'); ?></p>
</td>
</tr>
<tr><th scope="row"><label for="dpp_post_redirect"><?php _e('Redirect<br><em>Default: To current list.</em><br>(After click on <strong>Duplicate</strong>)', 'dpp_wpp_page'); ?></label></th>
<td><select id="dpp_post_redirect" name="dpp_post_redirect"><option value="to_list" <?php echo($opt['dpp_post_redirect'] == 'to_list') ? "selected = 'selected'" : ''; ?>><?php _e('All Post List', 'dpp_wpp_page'); ?></option><option value="to_page" <?php echo($opt['dpp_post_redirect'] == 'to_page') ? "selected = 'selected'" : ''; ?>><?php _e('Direct Edit', 'dpp_wpp_page'); ?></option></select>
<p><?php _e('Please select any post redirection, redirect you to selected after click on duplicate.', 'dpp_wpp_page'); ?></p>
</td>
</tr>
<tr><th scope="row"><label for="dpp_post_suffix"><?php _e('Duplicate Post Suffix<br><em>Default: Empty</em>', 'dpp_wpp_page')?></label></th>
<td><input type="text" class="regular-text" value="<?php echo !empty($opt['dpp_post_suffix']) ? $opt['dpp_post_suffix'] : ''?>" id="dpp_post_suffix" name="dpp_post_suffix">
<p><?php _e('Add a suffix for duplicate page and post. It will show after title.', 'dpp_wpp_page')?></p>
</td>
</tr>
    
<tr><th scope="row"><label for="dpp_post_link_title"><?php _e('Duplicate Link Text<br><em>Default: Duplicate</em>', 'dpp_wpp_page')?></label></th>
<td><input type="text" class="regular-text" value="<?php echo !empty($opt['dpp_post_link_title']) ? $opt['dpp_post_link_title'] : ''?>" id="dpp_post_link_title" name="dpp_post_link_title">
<p><?php _e('It will show above text on duplicate page/post link button instead of default (Duplicate)', 'dpp_wpp_page')?></p>
</td>
</tr> 
    
</tbody>
</table>
<p class="submit"><input type="submit" value="Save Settings" class="button button-primary" id="submit" name="submit_dpp_wpp_page"></p>
</form></div></div>
</div>
</div>