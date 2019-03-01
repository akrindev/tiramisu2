<?php

namespace App\Helpers;

class Cloudinary
{
	public function __construct()
	{
		$this->getConfig();
	}

	public function uploadImg($real_path)
	{
      $data = \Cloudinary\Uploader::upload($real_path);

      return $data;
	}

	protected function getConfig()
	{
      \Cloudinary::config([
  			"cloud_name" => env('CI_CLOUD_NAME'),
  			"api_key" => env("CI_API_KEY"),
  			"api_secret" => env("CI_API_SECRET")
		]);
	}
}