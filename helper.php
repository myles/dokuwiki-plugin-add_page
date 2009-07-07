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
			
			$id = idfilter($ID, false);
			
			//make nice URLs even for buttons
			if($conf['userewrite'] == 2){
				$script = DOKU_BASE.DOKU_SCRIPT.'/'.$id . "?";
			}elseif($conf['userewrite']){
				$script = DOKU_BASE.$id."?";
			}else{
				$script = DOKU_BASE.DOKU_SCRIPT . "?";
				$params['id'] = $id;
			}
			$params['idx'] = ":" . getNS($ID);
			$params['npd'] = 1;
			
			$url = $script;
			
			if(is_array($params)){
				reset($params);
				while (list($key, $val) = each($params)) {
					$url .= $key.'=';
					$url .= htmlspecialchars($val.'&');
				}
			}
			
			$link_type = $this->getConf('link_type');
			
			switch ($link_type) {
			case 'link':
				$ret .= '<a rel="nofollow" href="' . $url . '" style="display:none;" id="add_page_button" class="action add_page">' . $label . '</a>';
				break;
			default:
				$ret .= '<form class="button" action="' . $url . '"><div class="no">';
				$ret .= '<input id="add_page_button" type="submit" value="' . htmlspecialchars($label) . '" class="button" ';
				$ret .= 'title="' . $tip . '" ';
				// the button will be enabled by js, as it does not
				// make any sense in a browser without js ;)
				// $ret .= 'style="display: none;" ';
				$ret .= '/>';
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