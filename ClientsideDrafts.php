<?php
# Alert the user that this is not a valid entry point to MediaWiki if they try to access the file directly.
if (!defined('MEDIAWIKI')) {
  echo <<<EOT
To install ClientsideDrafts extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/ClientsideDrafts/ClientsideDrafts.php" );
EOT;
  exit(1);
}

$dir = dirname( __FILE__ ) . '/';

$wgClientsideDraftsVersion = '0.1';
$wgAutoloadClasses['ClientsideDrafts'] = $dir. 'ClientsideDrafts.body.php';
$wgExtensionMessagesFiles['ClientsideDrafts'] = $dir. 'ClientsideDrafts.i18n.php';

$wgExtensionCredits['other'][] = array(
  'path' => __FILE__,
  'name' => 'Clientside drafts',
  'author' => 'Akzhan Abdulin',
  'url' => 'http://www.mediawiki.org/wiki/User:Akzhan',
  'version' => '0.1',
  'description' => 'This extenstion allows to save/restore article drafts in local computer using HTML5 localStorage',
  'descriptionmsg' => 'clientsidedrafts:description'
);

// Register load hook
$wgHooks['EditPage::showEditForm:initial'][] = 'ClientsideDrafts::loadForm';

// Register ajax add script hook
$wgHooks['AjaxAddScript'][] = 'ClientsideDrafts::addJS';

// Register css add script hook
$wgHooks['BeforePageDisplay'][] = 'ClientsideDrafts::addCSS';

