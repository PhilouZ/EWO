<?php
/**
 * Template par defaut - Header
 *
 * @author Simonet Fabrice <aigleblanc@gmail.com>
 * @version 1.0
 * @package template-defaut
 */

require_once __DIR__ . '/../../../conf/master.php';

$template_vanilla = true;
$_SESSION['utilisateur']['template_mage']=true;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
	if(isset($header['title'])){
		echo "<title>".$header['title']." | Eternal War One - EWO</title>";
	}else{
		echo "<title>Eternal War One - EWO</title>";
	}
	if(isset($header['desc'])){
		echo "<meta name='description' content=\"".$header['desc']."\" />";
	}else{
		echo "<meta name='description' content=\"Eternal War One est un jeu multi-joueur où une armée de démons, d'anges et d'humains s'affrontent dans une lutte sans merci pour leur propre survie.\" />";
	}
?>

<meta name="author" content="Ewo Team" />
<meta name="google-site-verification" content="rZADXCyuEh8aaWXfEkxQxz4uSd_X0k7Ksfw0Td7gimQ" />

<?php

	echo '<link rel="stylesheet" href="'.SERVER_URL.$template_url.'/css/jquery-ui.css?v='.filemtime(SERVER_ROOT.$template_url.'/css/jquery-ui.css').'" type="text/css" />';

	//error_reporting(E_ALL);
        
    include(SERVER_ROOT.'/template/less/lessc.inc.php');
    //try {
        $less = new lessc();

        $less->addImportDir(SERVER_ROOT . $template_url.'/less');
        $less->addImportDir(SERVER_ROOT . '/site/fonts');
        //$less->setFormatter("compressed");

        $less->setVariables(array(
        "template" => "'..'"
        ));

        
        $less->compileFile(SERVER_ROOT . $template_url.'/less/ewo.less', SERVER_ROOT . $template_url.'/css/ewo.css'); 
        //$less->checkedCompile(SERVER_ROOT . $template_url.'/less/ewo.less', SERVER_ROOT . $template_url.'/css/ewo.css');    
    //} catch (Exception $e) {
        // Nothing to do here
    //}
    echo '<link rel="stylesheet" href="'. SERVER_URL . $template_url.'/css/ewo.css?v='.filemtime( SERVER_ROOT . $template_url.'/css/ewo.css').'" type="text/css" />';
    
    // Fichiers CSS supplémentaires
    if(isset($css_files)) {
        $nom = md5($css_files);
        $array = explode(",", $css_files);

        

        //if(file_exists(SERVER_ROOT . $template_url.'/css/generate/'.$nom.'.css')) {
       // $time_gen = filemtime(SERVER_ROOT . $template_url.'/css/generate/'.$nom.'.css');
        //} else {
           $time_gen = 0; 
        //}
        $compile = false;
        $import = '@import url(couleurs.less);';

        foreach ($array as $link) {
            
            $less_url = SERVER_ROOT . $template_url.'/less/'.$link.'.less';
   
            if(filemtime($less_url) > $time_gen) {
                $compile = true;
            }
            
            $import .= '@import url('.$link.'.less);';
            
        }
        
        if($compile) {
            try {  
            $compiled = $less->compile($import);
            
            if(substr(decoct( fileperms(SERVER_ROOT . $template_url.'/css/generate/') ), 2) != 777) {
                chmod(SERVER_ROOT . $template_url.'/css/generate/', 777);
            }
            
            file_put_contents(SERVER_ROOT . $template_url.'/css/generate/'.$nom.'.css', $compiled);
            } catch(Exception $e) {
                // Nothing to do here
            }
            
        }
        
        echo '<link rel="stylesheet" href="'.SERVER_URL . $template_url.'/css/generate/'.$nom.'.css?v='.filemtime(SERVER_ROOT.$template_url.'/css/generate/'.$nom.'.css').'" type="text/css" />';        
    }
?>

<link rel="icon" type="image/png" href="<?php echo SERVER_URL; ?>/images/site/favicon.png" />

<script src="<?php echo SERVER_URL; ?>/js/lib/prefixfree.min.js" type="text/javascript"></script>
<script src="<?php echo SERVER_URL; ?>/js/jeu/autologin.js" type="text/javascript"></script>

<style>
#countdown {
	text-align: center;
	font-family: 'Arial Black', sans-serif;
	line-height: 1em;
	color: #ffffff;
	font-weight:bold;
	font-size: 47px;
	text-shadow:0px 0px 0 rgb(235,235,235),1px 1px 0 rgb(226,226,226),2px 2px 0 rgb(216,216,216),3px 3px 0 rgb(206,206,206),4px 4px 0 rgb(197,197,197),5px 5px 0 rgb(187,187,187),6px 6px 0 rgb(177,177,177),7px 7px 0 rgb(168,168,168),8px 8px 0 rgb(158,158,158), 9px 9px 0 rgb(148,148,148),10px 10px 9px rgba(0,0,0,0.55),10px 10px 1px rgba(0,0,0,0.5),0px 0px 9px rgba(0,0,0,.2);
}
</style>
<?php

require(SERVER_ROOT . '/template/JSLoader.php');

$js = new JSLoader(SERVER_URL);

$js->addScript('ajax');
$js->addScript('jeu');
$js->addCore('lib/jquery');
$js->addLib('jquery-ui');
$js->addVariables('root_url', SERVER_URL);

if(date("d") == 25) {
    $js->addLib('jquery.countdown');

    $js->addScript('special/countdown');
}
// Gestionnaire d'autologin
include(SERVER_ROOT."/autologin.php");

?>
</head>

<body>

<?php
//-- Menu top bar --
include(SERVER_ROOT."/site/menu.php"); ?>

<?php 
detect_sidebar("header");
?>

<div id="countdown"></div>
