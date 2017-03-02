<?php
class DatabaseClass {	
	var $conected;
	var $con;
	var $sql;
	var $error;
	var $host;
	var $user;
	var $password;
	var $database;
	var $config;
	var $secur;
	
	
	function query($qry){ 
	}	
	
	function fetchArray($qry){
	}

	function fetchObject($qry){
	}

	function numRows($qry){
	}

	function numField($qry){
	}	  
	
	function getData($table){
	}
	
	function getDataWhere($table,$wfield,$wvalue){
	}

	function paginate($sql,$limit,$page){

	}
	
	
}
?>