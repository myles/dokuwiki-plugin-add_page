<?php
	/**
	 *	@license	GPL 2 (http://www.gnu.org/licenses/gpl.html)
	 *	@author		Myles Braithwaite <me@mylesbraithwaite.com>
	 */
	
	if(!defined('DOKU_INC')) die();
	if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
	require_once(DOKU_PLUGIN . 'action.php');
	
	class action_plugin_add_page extends DokuWiki_Action_Plugin {
		var $fck_location	= false;
		var $helper			= false;
		var $toc			= false;
		var $cache			= true;
		
		function getInfo() {
			return array(
				'author'	=> 'Myles Braithwaite',
				'email'		=> 'me@mylesbraithwaite.com',
				'date'		=> '2009-07-07',
				'name'		=> 'Add Page',
				'desc'		=> 'Add a new page button.',
				'url'		=> 'http://github.com/myles/dokuwiki-plugin-add_page'
			);
		}
	}
?>