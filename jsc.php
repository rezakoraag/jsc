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

		$result = [];
		foreach($resultRS->data as $key=>$val)
	    {

			foreach($resultKelurahan->data as $key2=>$val2)
			 {
				 if($val->kode_kelurahan == $val2->kode_kelurahan){
					 $nama_kel = $val2->nama_kelurahan;
					 break;
				 };
			 }
			 foreach($resultKelurahan->data as $key2=>$val2)
 			 {
 				 if($val->kode_kecamatan == $val2->kode_kecamatan){
 					 $nama_kec = $val2->nama_kecamatan;
 					 break;
 				 };
 			 }
			 foreach($resultKelurahan->data as $key2=>$val2)
 			 {
 				 if($val->kode_kota == $val2->kode_kota){
 					 $nama_kotanya = $val2->nama_kota;
 					 break;
 				 };
 			 }

			$result[] = [

					   'nama_rsu' => $val->nama_rsu,
					   'jenis_rsu' => $val->jenis_rsu,
					   'location' => [
						   'latitude' => $val->location->latitude,
						   'longitude' => $val->location->longitude,
					   ],
					   'alamat' => $val->location->alamat,
					   'kode_pos' => $val->kode_pos,
					   'telepon' => $val->telepon,
					   'faximile' => $val->faximile,
					   'website' => $val->website,
					   'email' => $val->email,
					   'kelurahan' => [
						   'kode' => $val->kode_kelurahan,
						   'nama' => $nama_kel,
					   ],
					   'kecamatan' => [
						   'kode' => $val->kode_kecamatan,
						   'nama' => $nama_kec,
					   ],
					   'kota' => [
						   'kode' => $val->kode_kota,
						   'nama' => $nama_kotanya,
					   ],
			   ];
	    }

		echo json_encode(array(
			'count' => count($result),
			'data' => $result
		));

	}
}
