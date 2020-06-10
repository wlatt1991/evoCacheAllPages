<?php 
/* -----------------------------------------------------------------------------
* Module: Cache All Pages
* -----------------------------------------------------------------------------
* @author       AKots - e-kao.ru
* @version      1.1
* @date         28/06/2010
*/
 
global $modx,$manager_theme,$incPath,$_style,$modx_textdir,$SystemAlertMsgQueque,$_lang,$modx_manager_charset,$modx_lang_attribute,$manager_language;
 
if(IN_MANAGER_MODE != 'true') die('<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.');

$cap_lang=array();
if (file_exists(MODX_BASE_PATH.'assets/modules/cacheallpages/lang/'.$manager_language.'.inc.php'))
	include MODX_BASE_PATH.'assets/modules/cacheallpages/lang/'.$manager_language.'.inc.php';
else
	include MODX_BASE_PATH.'assets/modules/cacheallpages/lang/english.inc.php';

include_once $incPath."header.inc.php";

echo '<h1>'.$cap_lang['header'].'</h1>
 		<script type="text/javascript" src="'.MODX_SITE_URL.'assets/modules/cacheallpages/progressbar.js"></script>
		<style type="text/css">
			.progressbar_wrapper div{font:20px Arial;}
		</style>
		<div class="sectionBody">
        <ul class="actionButtons" style="margin: 10px 20px">
            <li id="Button2"><a href="#" onclick="$(\'progressbar_0_dark\').setStyle(\'background\', \'#006\');ajaxCache(0);"><img src="media/style/'.$manager_theme.'/images/icons/trash.png" /> '.$cap_lang['create'].'</a></li>
            <li id="Button1"><a href="#" onclick="document.location.href=\'index.php?a=106\';"><img src="media/style/'.$manager_theme.'/images/icons/stop.png" /> '.$cap_lang['close'].'</a></li>
 		</ul>		
		<div id="wrapper" style="margin: 10px 20px"></div>
		</div>
		<script type="text/javascript">
		var pb=new ProgressBar("0",{
				\'width\':400,
				\'height\':40
			});
			$(\'wrapper\').appendChild(pb);
function ajaxCache(progress) {
	new Ajax(\''.MODX_SITE_URL.'assets/modules/cacheallpages/ajaxEvoCacheAllPages.php\', {
		method: \'post\',
		postBody: Object.toQueryString({progress: progress}),
		onComplete: nextCache
	}).request();
}

function nextCache(result) {
	pb.setValue(result);
	if (result<100 && result>0) {
		if (result>20) {$(\'progressbar_0_dark\').setStyle(\'background\', \'#008\');}
		if (result>40) {$(\'progressbar_0_dark\').setStyle(\'background\', \'#00a\');}
		if (result>60) {$(\'progressbar_0_dark\').setStyle(\'background\', \'#00c\');}
		if (result>80) {$(\'progressbar_0_dark\').setStyle(\'background\', \'#00e\');}
		ajaxCache(result)
	} else {
		$(\'progressbar_0_dark\').setStyle(\'background\', \'#d00\');
	}
}
		</script>';

include_once $incPath."footer.inc.php";
?>