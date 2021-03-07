<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom Lib_access_session Class
 */
class Lib_access_session extends CI_Session {

	/**
	 * Class constructor
	 */
	public function __construct() {	//	array $params = array()
//		parent::__construct();
	}

	/**
	 * get session data
	 */
	public function get_sess_data() {
//		$data['num_sess'] = $this->session->__ci_last_regenerate;
/*		
		echo "<pre>session depuis lib";
		print_r ($_SESSION);
		echo "</pre>";
*/		
		return $data = $this->get_userdata();

	}
	

/*
	public function set_userdata($data, $value = NULL) {
		if (is_array($data)) {
			foreach ($data as $key => &$value) {
				$_SESSION[$key] = $value;
			}
			return;
		}
		$_SESSION[$data] = $value;
	}
*/


}

