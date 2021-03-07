<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('title')) {
	/**
	 * Display website title
	 */
  function title($page_title = '', $site_title = 'Anciens élèves de BeWeb') {

      return $page_title.' | '.$site_title;
  }
    
}


