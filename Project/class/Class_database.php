<?php
	class database{
		private $name;
		private $user;
		private $pass;
		private $_db;
		private $db_name;
	
	
		
		public function __set($a,$b)
			{
				$this->$a = $b;
			}
		public function __get($a)
			{
				return $this->$a;
			}
		
		public function connect()
			{
				if(empty($this->name)||empty($this->user)||empty($this->pass))
				{
					Echo("Missing Patamrter");
				}	
				else
				{
					
				$this->_db = mysql_connect($this->name,$this->user,$this->pass);
					
					if(!$this->_db)
					{
						//echo("Could not connect".mysql_error($this->_db));
					}
				}		
			}
		public function select()
		{//echo $this->_db;die();
		error_reporting (0);
			if (!mysql_select_db ($this->_db,$this->db_name))
			{
				
				//echo ("Could not select".mysql_error());
			}
		}
		
		public function query($q)
		{	$objDB = mysql_select_db("project");
			mysql_query("SET NAMES UTF8");
			return mysql_query($q);
		}	
		
		public function __construct($a)
		{error_reporting (E_ALL ^ E_DEPRECATED);
			//print_r ($a);
			//Debug constructor
			//Echo "This is Database Constructor";
			$this->name=$a[0];
			$this->user=$a[1];
			$this->pass=$a[2];
			$this->db_name=$a[3];
			mysql_query("SET NAMES UTF8");
			$this->connect();
			$this->select();
		}
		
		public function close()
			{
			mysql_close($this->_db);
			}
	}
?>