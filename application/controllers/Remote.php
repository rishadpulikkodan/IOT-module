<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remote extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		error_reporting(0);
		$this->load->model('Model');

	}

	public function index()
	{
		$data['lat'] = $this->Model->getcolval('lat','iot');
		$data['lot'] = $this->Model->getcolval('lot','iot');
		$this->load->view('remote',$data);
	}

	public function torch()
	{
		$ur = $this->uri->segment(3);
		if($ur == 'on'){
			$this->Model->editrowa('1','iot','torch','1');
		}
		else if($ur == 'off'){
			$this->Model->editrowa('1','iot','torch','0');
		}
		else if($ur == 'blink'){
			$this->Model->editrowa('1','iot','torch','10');
		}
		else{
			echo "err";
		}
	}

	public function vibrate()
	{
		$ur = $this->uri->segment(3);
		if($ur == 'on'){
			$this->Model->editrowa('1','iot','vibrate','1');
		}
		else if($ur == 'off'){
			$this->Model->editrowa('1','iot','vibrate','0');
		}
		else if($ur == 'blink'){
			$this->Model->editrowa('1','iot','vibrate','10');
		}
		else{
			echo "err";
		}
	}

	public function music()
	{
		$ur = $this->uri->segment(3);
		if($ur == 'on'){
			$this->Model->editrowa('1','iot','music','1');
		}
		else if($ur == 'off'){
			$this->Model->editrowa('1','iot','music','0');
		}
		else{
			echo "err";
		}
	}

	public function div()
	{
		$ur = $this->uri->segment(3);
		if($ur == 'on'){
			$this->Model->editrowa('1','css','box','1');
		}
		else if($ur == 'off'){
			$this->Model->editrowa('1','css','box','0');
		}
		else if($ur == 'rotate'){
			$this->Model->editrowa('1','css','box','10');
		}
		else{
			echo "err";
		}
	}

	public function css()
	{
		$ur = $this->uri->segment(3);
		$val = '#'.$this->uri->segment(4);
		$text = $this->uri->segment(4);
		if($ur == 'bgcolor'){ $this->Model->editrowa('1','css','bodybg',$val); }
		else if($ur == 'textc'){ $this->Model->editrowa('1','css','textc',$val); }
		else if($ur == 'text'){ $this->Model->editrowa('1','css','text',$text); }
		else if($ur == 'ts'){ $this->Model->editrowa('1','css','texts',$text); }


	}

	public function live()
	{
		$ur = $this->uri->segment(3);
		if($ur=='device'){ echo $this->Model->getcolval('device','iot'); }
		else if($ur=='date'){ echo $this->Model->getcolval('date','iot'); }
		else if($ur=='ua'){ echo $this->Model->getcolval('ua','iot'); }
		else if($ur=='ip'){ echo $this->Model->getcolval('ip','iot'); }
	}

	public function reset()
	{
		$array = [
			'music' => '0',
			'vibrate' => '0',
			'torch' => '0',
			'lat' => 'null',
			'lot' => 'null',
			'device' => '',
			'date' => '',
			'ua' => '',
			'ip' => ''
		];
		$this->Model->modrow('1','iot',$array);
		$arrayb = [
			'bodybg' => 'white',
			'textc' => 'black',
			'texts' => '40px',
			'text' => '',
			'box' => '0'
		];
		$this->Model->modrow('1','css',$arrayb);
		redirect(base_url().'remote');
	}
}
