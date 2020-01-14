<?php

if ( !function_exists('get_meta')) {
    function get_meta(){
        return array(
			array('name' => 'description','content' => 'Rexx Systems Coding Challenge'),
			array('name' => 'keywords','content' => 'rexx, coding, challege','filter','search'),
			array('name' => 'Content-type','content' => 'text/html; charset=utf-8','type' => 'equiv')
		);
    }
}