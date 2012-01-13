<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * MyFonts Plugin
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @author		Blis Web Agency
 * @link		http://blis.net.au
 */

$plugin_info = array(
	'pi_name'		=> 'MyFonts',
	'pi_version'	=> '1.0',
	'pi_author'		=> 'Blis Web Agency',
	'pi_author_url'	=> 'http://blis.net.au',
	'pi_description'=> 'Pulls in MyFonts',
	'pi_usage'		=> Myfonts::usage()
);


class Myfonts {

	public $return_data;
    
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
		$this->CI =& get_instance();		
	} 
	 
	public function load()
	{
		
		
		#$restricted = $this->EE->TMPL->fetch_param('restricted');
		$path = $this->EE->TMPL->fetch_param('path');
		$font = $this->EE->TMPL->fetch_param('font');	
		
		$this->CI->load->library('user_agent');
		

		if ($this->CI->agent->is_browser())
		{
		    $agent = $this->CI->agent->browser();
		    $version = $this->CI->agent->version();
		    $format = "woff";
		    
		    if ($agent == "Firefox"){
			    if ($version >= 3.6){
	    		    $format = "woff";
			    } else {
	    		    $format = "data-css";
			    }
		    }
		    
		    if ($agent == "Opera"){
			    if ($version >= 11.1){
	    		    $format = "woff";
			    } else {
	    		    $format = "data-css";
			    }
		    }
		    
		    if ($agent == "Safari"){
			    $format = "data-css";
		    }
		    
		    if ($agent == "MobileSafari"){
			    if ($version >= 4.2){
	    		    $format = "data-css";
			    } else {
	    		    $format = "svg";
			    }
		    }
		    
		    if ($agent == "Chrome"){
			    if ($version >= 6){
	    		    $format = "woff";
			    } else {
	    		    $format = "data-css";
			    }
		    }
		    
		    if ($agent == "MSIE"){
		    
			    if ($version >= 9){
	    		    $format = "woff";
			    } else {
	    		    $format = "eot";
			    }
		    
		    }
		    
		    if ($agent == "Internet Explorer"){
		    
			    if ($version >= 9){
	    		    $format = "woff";
			    } else {
	    		    $format = "eot";
			    }
		    
		    }

		    
		    if ($format == "data-css") $format = "ttf";		    		    
		    
		    if ($format == "woff" || $format == "svg"){
		    $v = '<style>

			@font-face {font-family:"'.$font.'-Light";src:url("'.$path.'/'.$format.'/style_199448.'.$format.'") format("'.$format.'");}
			@font-face {font-family:"'.$font.'-LightIt";src:url("'.$path.'/'.$format.'/style_199447.'.$format.'") format("'.$format.'");}
			@font-face {font-family:"'.$font.'-BoldItalic";src:url("'.$path.'/'.$format.'/style_199446.'.$format.'") format("'.$format.'");}
			@font-face {font-family:"'.$font.'-Bold";src:url("'.$path.'/'.$format.'/style_199444.'.$format.'") format("'.$format.'");}
			@font-face {font-family:"'.$font.'-Regular";src:url("'.$path.'/'.$format.'/style_199443.'.$format.'") format("'.$format.'");}
			@font-face {font-family:"'.$font.'-Italic";src:url("'.$path.'/'.$format.'/style_199441.'.$format.'") format("'.$format.'");} 
			
			</style>';
			} else {
			$v = '<style>

			@font-face {font-family:"'.$font.'-Light";src:url("'.$path.'/'.$format.'/style_199448.'.$format.'");}
			@font-face {font-family:"'.$font.'-LightIt";src:url("'.$path.'/'.$format.'/style_199447.'.$format.'");}
			@font-face {font-family:"'.$font.'-BoldItalic";src:url("'.$path.'/'.$format.'/style_199446.'.$format.'");}
			@font-face {font-family:"'.$font.'-Bold";src:url("'.$path.'/'.$format.'/style_199444.'.$format.'");}
			@font-face {font-family:"'.$font.'-Regular";src:url("'.$path.'/'.$format.'/style_199443.'.$format.'");}
			@font-face {font-family:"'.$font.'-Italic";src:url("'.$path.'/'.$format.'/style_199441.'.$format.'");} 
			
			</style>';
			}
		    
		    return $v;
		}
		
	}
	
	// ----------------------------------------------------------------
	
	/**
	 * Plugin Usage
	 */
	public static function usage()
	{
		ob_start();
?>

This will allow you to ditch the MyFonts JS script and still get the same output on the page. It does it by doing it's own browser detection and then loading the right font type. Far from rocket science.
<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}


/* End of file pi.myfonts.php */
/* Location: /system/expressionengine/third_party/myfonts/pi.myfonts.php */