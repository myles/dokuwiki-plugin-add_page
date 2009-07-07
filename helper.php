<?php
	/**
	 *	@license	GPL 2 (http://www.gnu.org/licenses/gpl.html)
	 *	@author		Pierre Spring <pierre.spring@liip.ch>
	 *	@author		Myles Braithwaite <me@mylesbraithwaite.com>
	 */
	
	if(!defined('DOKU_INC')) die();
	
	class helper_plugin_add_page extends DokuWiki_Plugin {
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
		
		function getMethods() {
			return array(
				'name'		=> 'html_add_page_button',
				'desc'		=> 'include a html button',
				'params'	=> array(),
				'return'	=> array()
			);
		}
		
		function html_add_page_button($return=false) {
			global $conf;
			global $ID;
			
			if (auth_quickaclcheck($ID) < AUTH_EDIT) {
				return '';
			}
			
			$label = $this->getLang('btn_add_new_page');
			if (!$label) {
				$label = 'Add Page';
			}
			
			$tip = htmlspecialchars($label);
			
			$ret = '';
			
			//make nice URLs even for buttons
			if ($conf['userewrite'] == 2) {
				$url = DOKU_BASE . DOKU_SCRIPT . '/';
			} elseif ($conf['userewrite'] == 1) {
				$url = DOKU_BASE;
			} else {
				$url = DOKU_BASE . DOKU_SCRIPT . "?id=";
			}
			
			$link_type = $this->getConf('link_type');
			switch ($link_type) {
			case 'link':
				$ret .= '<a rel="nofollow" href="#" style="display:none;" id="add_page_button" class="action add_page">' . $label . '</a>';
				break;
			default:
				$ret .= '<form class="button" action="' . $url .'"><div class="no">';
				$ret .= '<input id="add_page_button" type="button" ';
				$ret .= 'value="' . htmlspecialchars($label) . '" class="button" ';
				$ret .= 'style="display: none;" ';
				$ret .= 'accesskey="a" ';
				$ret .= 'title="' . $tip . ' [A]" ';
				$ret .= '/>';
				$ret .= '<input id="dokuwiki_url" value="' . $url .'" type="hidden" />';
				$ret .= '</div>';
				$ret .= '</form>';
			}
			
			if ($return) {
				return $ret;
			} else {
				echo $ret;
			}
		}
	}
?>