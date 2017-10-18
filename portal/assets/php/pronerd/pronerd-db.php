<?php
	/*This class makes objects that connect to the database, with build in
 *functions for basic queries
 */
class database
{
	public $sql;
	public $host;
	public $username;
	public $password;
	public $db;
	/*Connect to the database*/
	public function __construct($host, $username, $password, $database)
	{
		$this->host=$host;
		$this->username=$username;
		$this->password=$password;
		$this->db=$database;
		$this->sql=mysqli_connect($host,$username,$password, $database);
		if(!$this->sql || $this->sql==null)
		{
			echo "Unable to connect";
			echo mysqli_error($this->sql);
			die;
		}
		
	}
	public function set($host,$username,$password, $database)
	{
		$this->host=$host;
		$this->username=$username;
		$this->password=$password;
		$this->db=$database;
		$this->sql=mysqli_connect($host,$username,$password, $database);
		if(!$this->sql || $this->sql==null)
		{
			echo "Unable to connect";
			echo mysqli_error($this->sql);
			die;
		}	
	}
	public function connect()
	{
		return mysqli_connect($this->host,$this->username,$this->password, $this->db);
	}


	/*Remove spaces , and invalid characters in the given $data*/
	public function clean_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;

	}
	/*given an associative array, this function equates the $key with the value
	 *useful for making queries and comma separates each equation
	 */
	public function equate($values)
	{
		$stmt=""; 
		$count=count($values);
		$i=0;
		if(!is_array($values) || $count==0)
			die("ERROR 1920: please make sure that the values you want equate are in an associative array . eg array('name'=>'joe') if you want name='joe'");

		foreach ($values as $key => $value) 
		{
			if($i<$count-1)
			{
				$value=$this->clean_input($value);
				$stmt=$stmt." $key='$value', ";
			}
			else
			{
				$value=$this->clean_input($value);
				$stmt=$stmt."$key='$value' ";
			}
			$i++;
		}
		
		return $stmt;
	}

	/*given an array this function takes it and then comma separates the values
	 * and then returns the converted array in string form
	 */
	public function comma_separate($val)
	{
		if(isset($val) && is_array($val))
		{
			$stmt="";
			$count=count($val);
			$i=0;
			foreach ($val as  $value) 
			{
				
				if($i<$count-1)
				{
					$stmt=$stmt." $value, ";
				}
				else
				{
					$stmt=$stmt." $value ";
				}
				$i++;
			}
			return $stmt;
		}
		else
		{
			echo "ERROR 2012: invalid argument given for the columns, please make sure you sent an array of the columns you want";
			die;
		}
	}
	/*get gsa stands for get select array, it takes a select query and then returns an associative array
	 *of the results
	 */
	public function gsa($query)
	{
		$sql=$this->connect();
		if($res=mysqli_query($sql,$query))
		{
			for ($arr=array(); $row=mysqli_fetch_assoc($res); array_push($arr, $row));
			if(count($arr)>0)
			{
				return $arr;
			}
			else
			{
				return null;
			}
		}
		else
		{
			return null;
		}
	}
	public function get_keys($array)
	{
		$count=count($array);
		if($count==0 || !is_array($array))
		{
			die ("Error 001: Invalid arguments provided please sent the conditions as array");
		}
		$keys=array();
		$p=array();
		foreach ($array as $v) 
		{
			$p=$v;
			break;
		}
		foreach ($p as $key => $v) 
		{
			array_push($keys, "`".$key."`");
		}
		if(count($keys)>0)
		{
			return $keys;
		}
		else
		{
			return null;
		}
	}

	public function like($columns,$value)
	{
		// SELECT * FROM `product` WHERE `product_id` LIKE '%2%' ORDER BY `catergory` ASC
		$count=count($columns);
		if($count==0 || !is_array($columns))
			die ("Error 001: Invalid arguments provided please sent the conditions as array");
		$return=" ";
		foreach ($columns as $key => $v) 
		{
			if($key==0)
				$return=$return.$v." LIKE '%".$value."%' ";
			else
				$return=$return." OR ".$v." LIKE '%".$value."%' ";
		}
		return $return;
	}
	/*given an associative array, this function equates the $key with the value
	 *useful for making queries and 'and' separates each equation
	 */
	public function condition($values)
	{
		$stmt=""; 
		$count=count($values);
		$i=0;
		if($count==0 || !is_array($values))
		{
			echo "Error 001: Invalid arguments provided please sent the conditions as array";
			die;
		}
		foreach ($values as $key => $value) 
		{
			if($i<$count-1)
			{
				$stmt=$stmt." $key='$value' and ";
			}
			else
			{
				$stmt=$stmt."$key='$value' ";
			}
			$i++;
		}
		
		return $stmt;
	}

	//INSERT FUNCTIONS 

	/*insert into the table $table the values inside $values
	 *$values shhould be an associative array with the $key being
	 *the name of the column
	 */
	public function insert($table, $values)
	{
		$state=false;
		$sql=$this->connect();
		$columns="";
		$v="";
		$count=count($values);
		$i=0;
		if($count==0 || !is_array($values))
		{
			die("ERROR 8190: please make sure that the values you want insert are in an associative array . eg array('name'=>'joe') if you want INSERT INTO table ('name') VALUES ('joe')");
		}


		foreach ($values as $key => $value) 
		{
			if($i<$count-1)
			{
				$columns=$columns." `$key`,";
				$value=$this->clean_input($value);
				$v=$v."'$value',";
			}
			else
			{
				$columns=$columns." `$key`";
				$value=$this->clean_input($value);
				$v=$v." '$value'";
			}
			$i++;
		}

		$stmt=$sql->prepare()
		$stmt="INSERT INTO $table ($columns) VALUES ($v)";
		if(mysqli_query($sql, $stmt))
		{
			$state=true;
		}
		echo $stmt;
		mysqli_close($sql);
		return $state;
	}

	//UPDATE FUNCTIONS

	/*UPDATES the given $table using the associative array $values 
	 * according to the associative $condition
	 */
	public function update($table, $values, $condition)
	{
    	$sql=$this->connect();
		$state=false;
		if(isset($values) && isset($table))
		{
			$stmt="UPDATE $table SET ".$this->equate($values);
			$stmt=$stmt." WHERE ".$this->condition($condition);
			$re=mysqli_query($sql,$stmt);
			if($re)
			{
				$state = true;
			}
			
		}
		// echo $stmt;
		mysqli_close($sql);
		return $state;
	}

	//SELECT FUNCTIONS

	/*SELECT everything from the specified table returns an array of the results*/

	public function select($table)
	{
		return $this->select_all_rows($table);
	}
	public function select_all_columns($table)
	{
		return $this->select_all_rows($table);
	}
	public function select_all_rows($table)
	{
		$sql=$this->connect();
		$stmt="SELECT * FROM $table";
		
		if($res=mysqli_query($sql,$stmt))
		{
			for ($arr=array(); $row=mysqli_fetch_assoc($res); array_push($arr, $row));
			if(count($arr)>0)
			{
				return $arr;
			}
			else
			{
				return null;
			}
		}
		else
			return null;
		
	}
	/*SELECT everyting in the specified comma separated columns returns an array of the results*/
	public function select_column($table, $columns)
	{
		$sql=$this->connect();
		$stmt="SELECT $columns FROM $table";
		$res=mysqli_query($sql,$stmt);

		for ($arr=array(); $row=mysqli_fetch_assoc($res); array_push($arr, $row));
		if(count($arr)>0)
		{
			return $arr;
		}
		else
		{
			return null;
		}
		
	}

	/*SELECT everything that conforms to your condition where condition is an
	 *associative array with the column name being the key and the value being the actual value
	 * returns an array of the results
	 */
	public function select_where($table,$condition)
	{
		$sql=$this->connect();
		$stmt="SELECT * FROM $table WHERE ".$this->condition($condition);
		$res=mysqli_query($sql,$stmt);
		$arr=null;
		//echo $stmt."<br/>";
		if($res!=null)
			for ($arr=array(); $row=mysqli_fetch_assoc($res); array_push($arr, $row));

		return $arr;
	}

	/*SELECT columns which is an array of the columns that conforms to your condition returns an array of the results*/
	public function select_column_where($table,$columns,$condition)
	{
		$sql=$this->connect();
		$stmt="SELECT ".$this->comma_separate($columns)." FROM $table WHERE ".$this->condition($condition);
		if($res=mysqli_query($sql,$stmt))
		{
			$arr;
			if(mysqli_num_rows($res)==1)
			{
				$arr=mysqli_fetch_assoc($res);
			}	
			else
			{
				$arr=array();
				while($row=mysqli_fetch_assoc($res))
				{
					array_push($arr,$row);
				}
			}
			
			return $arr;
		}
		else
		{
			return null;
		}
		
	}

	public function search($table, $value)
	{
		$query="SELECT * FROM `".$table."` WHERE ".$this->like($this->get_keys($this->select_all_rows($table)),$value);
		return $this->gsa($query);
	}

	/*check if item exists then return true if exists, false otherwise
	 *can be used for login
	 */
	public function exists($table, $condition)
	{
		$state=false;
		$sql=$this->connect();
		$stmt="SELECT * FROM $table WHERE ".$this->condition($condition);
		if($res=mysqli_query($sql,$stmt))
		{
			if(mysqli_num_rows($res)>0)
			{
				$state = true;
			}
		}
		mysqli_close($sql);
		return $state;
	}

	//DELETE FUNCTIONS
	/*deletes in the specified table according to the associative array condition
	 */
	public function delete($table, $condition)
	{
    	$sql=$this->connect();
		$state=false;
		if(isset($condition) && isset($table))
		{
			$stmt="DELETE FROM $table WHERE ".$this->condition($condition);
			$re=mysqli_query($sql,$stmt);
			if($re)
			{
				$state = true;
			}
			
		}
		mysqli_close($sql);
		return $state;
	}

	public function truncate($table)
	{
    	$sql=$this->connect();
		$state=false;
		if(isset($table))
		{
			$stmt="DELETE FROM $table WHERE 1=1";
			$re=mysqli_query($sql,$stmt);
			if($re)
			{
				$state = true;
			}
			
		}
		mysqli_close($sql);
		return $state;
	}

	public function clean_table($table, $columns)
	{
		$delete=false;
		$v=$this->select_all_rows($table);
		if(isset($v))
		{
			foreach ($v as $key => $va) 
			{
				foreach ($columns as $c) 
				{
					if($va[$c]=='')
					{
						$delete=true;
					}
				}
				if($delete)
				{
					$this->delete($table, $va);
					$delete=false;
				}
			}
			return true;
		}
		else
			return false;
		
	}
}

/**
* This class is for specific table, the functions applied above is qualify with some extensions
*/
class table
{
	public $db;
	public $table;
	function __construct($table, $database)
	{
		$this->db=$database;
		$this->table=$table;
	}

	function set($table, $database)
	{
		$this->db=$database;
		$this->table=$table;
	}

	//INSERT FUNCTIONS 

	/*insert into the table $table the values inside $values
	 *$values shhould be an associative array with the $key being
	 *the name of the column
	 */
	public function insert($values)
	{
		return $this->db->insert($this->table, $values);
	}

	//UPDATE FUNCTIONS

	/*UPDATES the given $table using the associative array $values 
	 * according to the associative $condition
	 */
	public function update($values, $condition)
	{
    	return $this->db->update($this->table, $values, $condition);
	}

	//SELECT FUNCTIONS
	public function select()
	{
		return $this->db->select_all_rows($this->table);
	}
	/*SELECT everything from the specified table returns an array of the results*/
	public function select_all_rows()
	{
		return $this->db->select_all_rows($this->table);
	}
    public function select_all_columns()
    {
        return $this->db->select_all_rows($this->table);
    }
	/*SELECT everyting in the specified comma separated columns returns an array of the results*/
	public function select_column($columns)
	{
		return $this->db->select_column($this->table,$columns);	
	}

	/*SELECT everything that conforms to your condition where condition is an
	 *associative array with the column name being the key and the value being the actual value
	 * returns an array of the results
	 */
	public function select_where($condition)
	{
		return $this->db->select_where($this->table,$condition); 
	}

	/*SELECT columns which is an array of the columns that conforms to your condition returns an array of the results*/
	public function select_column_where($columns,$condition)
	{
		return $this->db->select_column_where($this->table,$columns,$condition); 
	}

	public function search($value)
	{
		return $this->db->search($this->table, $value);
	}
	/*check if item exists then return true if exists, false otherwise
	 *can be used for login
	 */
	public function exists($condition)
	{
		return $this->db->exists($this->table,$condition);
	}

	//DELETE FUNCTIONS
	/*deletes in the specified table according to the associative array condition
	 */
	public function delete( $condition)
	{
    	return $this->db->delete($this->table,$condition);
	}

}



?>