<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xmlapi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('xml_model');
		$this->load->model('db_model');
		//$this->load->model('artists_model');
		//$this->load->model('albums_model');
		//$this->load->model('songs_model');
		//$this->load->model('playlists_model');
	}
	
	public function search($q)
	{
	
	}
	
	public function artists($count = 0, $page = 0)
	{
	
	}
	
	public function artist_search($q, $count = 0, $page = 0)
	{
	
	}
	
	public function albums($count = 0, $page = 0)
	{
	
	}
	
	public function album_search($q, $count = 0, $page = 0)
	{
	
	}
	
	public function songs($count = 0, $page = 0)
	{
	
	}
	
	public function song_search($q, $count = 0, $page = 0)
	{
	
	}

}
