<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jsc extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }

	function index() {

		$this->data['APPS_SITETITLE'] = "Jakarta Smart City";

		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "http://api.jakarta.go.id/v1/rumahsakitumum");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: ' . "LdT23Q9rv8g9bVf8v/fQYsyIcuD14svaYL6Bi8f9uGhLBVlHA3ybTFjjqe+cQO8k",
		'Content-Type: application/json'
		));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $output1 = curl_exec($ch);

		$resultRS = json_decode($output1);
	    curl_close($ch);

		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "http://api.jakarta.go.id/v1/kelurahan");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: ' . "LdT23Q9rv8g9bVf8v/fQYsyIcuD14svaYL6Bi8f9uGhLBVlHA3ybTFjjqe+cQO8k",
		'Content-Type: application/json'
		));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $output2 = curl_exec($ch);

		$resultKelurahan = json_decode($output2);
	    curl_close($ch);
	}
}
