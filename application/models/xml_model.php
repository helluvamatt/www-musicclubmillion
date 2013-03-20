<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xml_model extends CI_Model
{
	public function recursive_xml($object, $level)
	{
		if ($object instanceof IXmlNode)
		{
			$output = $this->indent($level) . "<" . $object->get_name() . $this->build_attr_string($object->get_attributes()) . ">";
			foreach ($object->get_children() as $child)
			{
				if ($child instanceof IXmlNode) $output .= "\n";
				$output .= $this->recursive_xml($child, $level + 1);
			}
			if ($child instanceof IXmlNode) $output .= "\n" . $this->indent($level);
			$output .= "</" . $object->get_name() . ">";
			return $output;
		}
		else
		{
			return $object;
		}
	}
	
	private function build_attr_string($attrs)
	{
		$output = '';
		foreach ($attrs as $name => $value)
		{
			$output .= ' ' . $name . '="' . $value . '"';
		}
		return $output;
	}
	
	private function indent($count, $char = '  ')
	{
		$output = '';
		for ($i = 0; $i < $count; $i++)
		{
			$output .= $char;
		}
		return $output;
	}
}

interface IXmlNode
{
	public function get_name();
	public function get_attributes();
	public function get_children();
}

class XmlRootNode implements IXmlNode
{
	private $child;

	public function __construct($c)
	{
		$this->child = $c;
	}
	
	public function get_name()
	{
		return "musicclub";
	}
	
	public function get_attributes()
	{
		return array();
	}
	
	public function get_children()
	{
		return array($this->child);
	}
}
