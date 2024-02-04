<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		error_reporting(0);
		$this->load->model('Model');
	}

	public function index()
	{
		if(isMobile()){ $device = "Mobile"; } else{ $device = "Desktop"; }
		$array = [
			'device' => $device,
			'date' => "Date : ".date('d-F-Y')." | Time : ".date('h:i A'),
			'ua' => $_SERVER['HTTP_USER_AGENT'],
			'ip' => $_SERVER['REMOTE_ADDR']

		];
		$this->Model->modrow('1','iot',$array);
		$this->load->view('devices');
	}

	public function torch()
	{
		echo $this->Model->getcolval('torch','iot');
	}

	public function vibrate()
	{
		echo $this->Model->getcolval('vibrate','iot');
	}

	public function music()
	{
		echo $this->Model->getcolval('music','iot');
	}

	public function css()
	{
		$ur = $this->uri->segment(3);
		if($ur == 'bodybg'){ echo $this->Model->getcolval('bodybg','css'); }
		else if($ur == 'textc'){ echo $this->Model->getcolval('textc','css'); }
		else if($ur == 'text'){ echo $this->Model->getcolval('text','css'); }
		else if($ur == 'ts'){ echo $this->Model->getcolval('texts','css'); }
		else if($ur == 'div'){ echo $this->Model->getcolval('box','css'); }
	}

	public function gps()
	{
		$this->Model->editrowa('1','iot','lat',$this->uri->segment(3));
		$this->Model->editrowa('1','iot','lot',$this->uri->segment(4));
	}

}
