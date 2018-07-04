<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CUpload extends Controller
{
    private function config()
    {
      \Cloudinary::config(array(
  			"cloud_name" => env('CI_CLOUD_NAME'),
  			"api_key" => env("CI_API_KEY"),
  			"api_secret" => env("CI_API_SECRET")
		));
    }

  	public function upload($real_path)
    {
      $this->config();

      $data = \Cloudinary\Uploader::upload($real_path);

      return $data;
    }
}