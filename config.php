<?php if(!defined('PLX_ROOT')) exit; ?>
<?php

# Control du token du formulaire
plxToken::validateFormToken($_POST);

if(!empty($_POST)) {
        $plxPlugin->setParam('activate', $_POST['activate'], 'string');
        $plxPlugin->setParam('RSSurl', $_POST['RSSurl'], 'string');
        $plxPlugin->saveParams();
        header('Location: parametres_plugin.php?p=hamRSS');
        exit;
}
$RSSurl =  $plxPlugin->getParam('RSSurl')=='' ? '' : $plxPlugin->getParam('RSSurl');
$activation = ($plxPlugin->getParam('activate')=='ok') ? 'Redirection activée' : 'Activer la redirection';
$style = ($plxPlugin->getParam('activate')=='ok') ? 'success' : 'danger';
?>
<style type="text/css">
<!--
  @import url("../../plugins/hamRSS/style.css");
-->
</style>
<div class="container pull-left">
<ol class="breadcrumb">
  <li><a href="./">Accueil</a></li>
  <li><a href="./parametres_plugins.php">Plugins</a></li>
  <li class="active"><?php echo $plxPlugin->getInfo('title') ?></li>
</ol>
<div class="panel panel-<?php echo $style; ?>">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $plxPlugin->getInfo('description') ?></h3>
  </div>
  <div class="panel-body">
	  <p>Ce plugin est compatible avec <a href="http://feedpress.it/" title="FeedPress" target="_blank"><span class="glyphicon glyphicon-heart"></span> FeedPress</a> et <a href="http://feedburner.google.com/" title="FeedBurner" target="_blank"><span class="glyphicon glyphicon-fire"></span> FeedBurner</a>.</p>
	  <form class="form" role="form" action="parametres_plugin.php?p=hamRSS" method="post">
	  	<div class="row">
	  	  <div class="col-lg-6">
	  	    <div class="input-group">
	  	      <span class="input-group-addon">
	  	        <input class="btn-info" name="activate" type="checkbox" value="ok" <?php if($plxPlugin->getParam('activate') == 'ok'){?>checked<?php }?>> <?php echo $activation; ?>
	  	      </span>
	  	      <input type="text" name="RSSurl" class="form-control" placeholder="<?php if($RSSurl == ''){?>Adresse du nouveau flux RSS<?php }?>" value="<?php echo $RSSurl ?>">
	  		  <span class="input-group-btn">
	  			  	<?php echo plxToken::getTokenPostMethod() ?>
	  		        <button name="submit" class="btn btn-default" type="submit">Sauvegarder</button>
	  		  </span>
	  	    </div><!-- /input-group -->
	  	  </div><!-- /.col-lg-6 -->
	  	</div><!-- /.row -->
	  </form>
  </div>
</div>
</div>

