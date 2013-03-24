<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tools extends CI_Controller
{
	function import($path, $recurse = true, $read_id3 = true)
	{
		// CLI ONLY
		if (PHP_SAPI !== 'cli')
		{
			return show_404('tools/import');
		}
		
		// Resolve $path (must be absolute)
		if (($r_path = realpath($path)) === FALSE)
		{
			echo "import: Path does not exist: `$path'" . PHP_EOL;
			return;
		}
		
		// (Optionally recursively) Scan directory
		echo "Scanning path..." . PHP_EOL;
		$files = Tools::_recursive_path_scan($r_path, "Tools::_is_audio_file");
		
		// Did we find files?
		$count = count($files);
		if ($count < 1)
		{
			echo "No files found." . PHP_EOL;
			return;
		}
		
		echo "Found $count files." . PHP_EOL;
		
		// Loop over file list
		for ( $files as $file )
		{
			echo "Processing `$file' ..." . PHP_EOL;
		
			// (Optionally) check each file for ID3 tags
			if ($read_id3)
			{
				echo "Reading ID3 tags..." . PHP_EOL;
				// TODO
			}
			
			// Import to database
			//TODO
		
		}
		
		echo "Done." . PHP_EOL;
		
	}
	
	private static function _recursive_path_scan($path, $cb_include, $recurse_level = 0, $max_recurse_level = 16, $print_tree = true)
	{
		if ($recurse_level > $max_recurse_level) return array();
		if ($print_tree) echo Tools::_indent($recurse_level) . $path . PHP_EOL;
		$files = array();
		$dir = opendir($path);
		while (($entry = readdir($dir)) !== FALSE)
		{
			if (is_dir($entry))
			{
				$files = array_merge(Tools::_recursive_path_scan($entry, $cb_include, $recurse_level + 1, $max_recurse_level, $print_tree), $files);
			}
			else if (is_file($entry) && call_user_func($cb_include, $entry))
			{
				$files[] = $entry;
			}
			// else, ignore
		}
		return $files;
	}
	
	private static function _indent($level, $char = '  ')
	{
		$str = '';
		for ($i = 0; $i < $level; $i++)
		{
			$str .= $char;
		}
		return $str;
	}
	
	private static function _is_audio_file($file)
	{
		return Tools::ends_with($file, 'mp3'); // TODO OR '.flac' (when we learn to use those)
	}
	
	public static function ends_with($haystack, $needle)
	{
		return substr($haystack, 0, strlen($needle)) === $needle;
	}
}