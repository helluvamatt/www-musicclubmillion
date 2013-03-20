<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DB_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
}

abstract class DB_Object implements IXmlNode
{
	public $id;
	
	public function get_attributes()
	{
		return array(
			'id' => $this->id,
		);
	}
	
	public function get_children()
	{
		return array();
	}
	
	abstract public function get_name();
	
}

class DB_Field implements IXmlNode
{
	private $name;
	private $value;
	private $attrs;

	public function __construct($name, $value, $attrs = array())
	{
		
		$this->name = $name;
		$this->value = $value;
		$this->attrs = $attrs;
	}
	
	public function get_name()
	{
		return $this->name;
	}
	
	public function get_children()
	{
		return array($this->value);
	}
	
	public function get_attributes()
	{
		return $this->attrs;
	}
}

