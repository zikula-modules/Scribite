<?php
/********************************************************************
 * openImageLibrary addon Copyright (c) 2006 openWebWare.com
 * Contact us at devs@openwebware.com
 * This copyright notice MUST stay intact for use.
 *
 * Heavily extended and partly rewritten by Sven Strickroth (2010), email@cs-ware.de
 ********************************************************************/

chdir('../../../../../../');

// start Zikula
/****************************************************************/
include 'includes/pnAPI.php';
pnInit();
/****************************************************************/

if (!pnUserLoggedin() || !SecurityUtil::checkPermission('scribite:openwysiwyg:selectimage', '::', ACCESS_COMMENT)) {
    die("permission denied");
}

require('config.inc.php');
error_reporting(0);
if((substr($imagebaseurl, -1, 1)!='/') && $imagebaseurl!='') $imagebaseurl = $imagebaseurl . '/';
if((substr($imagebasedir, -1, 1)!='/') && $imagebasedir!='') $imagebasedir = $imagebasedir . '/';

$opendir = realpath($imagebasedir);
$loadon = '';
$dotdotdir = false;

$dirok = false;

if($_GET['dir'] && $browsedirs) {
    $_GET['dir'] = realpath($imagebasedir.$_GET['dir']);
    if (strpos($_GET['dir'], $opendir) === 0 && file_exists($_GET['dir'])) {
        if($_GET['dir'] != $opendir) {
            $dotdotdir = substr(realpath($_GET['dir'].'/..'), strlen($opendir));
            if ($dotdotdir === false) {
                $dotdotdir = '';
            }
        }
        $leadon = substr($_GET['dir'], strlen($opendir)+1).'/';
        $opendir = $_GET['dir'];
    }
}

if((substr($opendir, -1, 1)!='/') && $opendir!='') $opendir = $opendir . '/';

clearstatcache();
if ($handle = opendir($opendir)) {
	while (false !== ($file = readdir($handle))) { 
		//first see if this file is required in the listing
		if (strpos($file,'.') !== false && strpos($file,'.')==0)  continue;
		if (@filetype($opendir.$file) == "dir") {
			if(!$browsedirs) continue;

			$n++;
			if($_GET['sort']=="date") {
				$key = @filemtime($opendir.$file) . ".$n";
			}
			else {
				$key = $n;
			}
			$dirs[$key] = $file;
		}
		else {
			$n++;
			if($_GET['sort']=="date") {
				$key = @filemtime($opendir.$file) . ".$n";
			}
			elseif($_GET['sort']=="size") {
				$key = @filesize($opendir.$file) . ".$n";
			}
			else {
				$key = $n;
			}
			$files[$key] = $file;
		}
	}
	closedir($handle); 
}

//sort our files
if($_GET['sort']=="date") {
	@ksort($dirs, SORT_NUMERIC);
	@ksort($files, SORT_NUMERIC);
}
elseif($_GET['sort']=="size") {
	@natcasesort($dirs); 
	@ksort($files, SORT_NUMERIC);
}
else {
	@natcasesort($dirs); 
	@natcasesort($files);
}

//order correctly
if($_GET['order']=="desc" && $_GET['sort']!="size") {$dirs = @array_reverse($dirs);}
if($_GET['order']=="desc") {$files = @array_reverse($files);}
$dirs = @array_values($dirs); $files = @array_values($files);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>openWYSIWYG | Select Image</title>
<style type="text/css">
body {
	margin: 0px;
}
a {
	font-family: Arial, verdana, helvetica; 
	font-size: 11px; 
	color: #000000;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
</style>
<script type="text/javascript">
	function selectImage(url) {
		if(parent) {
			parent.document.getElementById("src").value = url;
		}
	}
	
	if(parent) {
		parent.document.getElementById("dir").value = '<?php echo str_replace("'", "\\'", str_replace('\\', '\\\\', $leadon)); ?>';
	}
	
</script>
</head>
<body>
	<table border="0">
		<tbody>
		<tr>
			<td>
				  <?php
					if($dotdotdir !== false) {
					?>
					<a href="<?php echo $_SERVER['PHP_SELF'].'?dir='.rawurlencode($dotdotdir); ?>"><img src="images/dirup.png" alt="Folder" border="0" /> <strong>..</strong></a><br>
					<?php
					}
					foreach ($dirs as $dir) {
						?>
							<a href="<?php echo $_SERVER['PHP_SELF'].'?dir='.rawurlencode($leadon).rawurlencode($dir); ?>"><img src="images/folder.png" alt="<?php echo htmlspecialchars($dir); ?>" border="0" /> <strong><?php echo htmlspecialchars($dir); ?></strong></a><br>
						<?php
					
					}
					foreach ($files as $file) {
					?>
					<p><a href="javascript:void(0)" onclick="selectImage('<?php echo $imagebaseurl.str_replace("%2F", "/", rawurlencode($leadon)).rawurlencode($file); ?>');"><img src="<?php echo $imagebaseurl.str_replace("%2F", "/", rawurlencode($leadon)).rawurlencode($file); ?>" width="60" alt="<?php echo htmlspecialchars($file); ?>" border="0" /><br /><strong><?php echo htmlspecialchars($file); ?></strong></a></p>
					<?php
					}	
					?>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>
