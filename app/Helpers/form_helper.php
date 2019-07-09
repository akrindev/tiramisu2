<?php

use App\Helpers\ConverterText;
use Illuminate\Support\HtmlString;

if ( ! function_exists('waktu'))
	{
	    function waktu($tgl)
        {

	        $pecah = explode(" ",$tgl);
			$waktu = explode(":",$pecah[1]);
			return longdate_indo($pecah[0] ).'  '.$waktu[0].':'.$waktu[1];
	    }
	}


	if ( ! function_exists('tgl_indo'))
	{
	    function date_indo($tgl)
	    {
	        $ubah = gmdate($tgl, time()+60*60*8);
	        $pecah = explode("-",$ubah);
	        $tanggal = $pecah[2];
	        $bulan = bulan($pecah[1]);
	        $tahun = $pecah[0];
	        return $tanggal.' '.$bulan.' '.$tahun;
	    }
	}

	if ( ! function_exists('bulan'))
	{
	    function bulan($bln)
	    {
	        switch ($bln)
	        {
	            case 1:
	                return "Januari";
	                break;
	            case 2:
	                return "Februari";
	                break;
	            case 3:
	                return "Maret";
	                break;
	            case 4:
	                return "April";
	                break;
	            case 5:
	                return "Mei";
	                break;
	            case 6:
	                return "Juni";
	                break;
	            case 7:
	                return "Juli";
	                break;
	            case 8:
	                return "Agustus";
	                break;
	            case 9:
	                return "September";
	                break;
	            case 10:
	                return "Oktober";
	                break;
	            case 11:
	                return "November";
	                break;
	            case 12:
	                return "Desember";
	                break;
	        }
	    }
	}

	//Format Shortdate
	if ( ! function_exists('shortdate_indo'))
	{
	    function shortdate_indo($tgl)
	    {
	        $ubah = gmdate($tgl, time()+60*60*8);
	        $pecah = explode("-",$ubah);
	        $tanggal = $pecah[2];
	        $bulan = short_bulan($pecah[1]);
	        $tahun = $pecah[0];
	        return $tanggal.'/'.$bulan.'/'.$tahun;
	    }
	}

	if ( ! function_exists('short_bulan'))
	{
	    function short_bulan($bln)
	    {
	        switch ($bln)
	        {
	            case 1:
	                return "01";
	                break;
	            case 2:
	                return "02";
	                break;
	            case 3:
	                return "03";
	                break;
	            case 4:
	                return "04";
	                break;
	            case 5:
	                return "05";
	                break;
	            case 6:
	                return "06";
	                break;
	            case 7:
	                return "07";
	                break;
	            case 8:
	                return "08";
	                break;
	            case 9:
	                return "09";
	                break;
	            case 10:
	                return "10";
	                break;
	            case 11:
	                return "11";
	                break;
	            case 12:
	                return "12";
	                break;
	        }
	    }
	}

	//Format Medium date
	if ( ! function_exists('mediumdate_indo'))
	{
	    function mediumdate_indo($tgl)
	    {
	        $ubah = gmdate($tgl, time()+60*60*8);
	        $pecah = explode("-",$ubah);
	        $tanggal = $pecah[2];
	        $bulan = medium_bulan($pecah[1]);
	        $tahun = $pecah[0];
	        return $tanggal.'-'.$bulan.'-'.$tahun;
	    }
	}

	if ( ! function_exists('medium_bulan'))
	{
	    function medium_bulan($bln)
	    {
	        switch ($bln)
	        {
	            case 1:
	                return "Jan";
	                break;
	            case 2:
	                return "Feb";
	                break;
	            case 3:
	                return "Mar";
	                break;
	            case 4:
	                return "Apr";
	                break;
	            case 5:
	                return "Mei";
	                break;
	            case 6:
	                return "Jun";
	                break;
	            case 7:
	                return "Jul";
	                break;
	            case 8:
	                return "Ags";
	                break;
	            case 9:
	                return "Sep";
	                break;
	            case 10:
	                return "Okt";
	                break;
	            case 11:
	                return "Nov";
	                break;
	            case 12:
	                return "Des";
	                break;
	        }
	    }
	}

	//Long date indo Format
	if ( ! function_exists('longdate_indo'))
	{
	    function longdate_indo($tanggal)
	    {
	        $ubah = gmdate($tanggal, time()+60*60*8);
	        $pecah = explode("-",$ubah);
	        $tgl = $pecah[2];
	        $bln = $pecah[1];
	        $thn = $pecah[0];
	        $bulan = medium_bulan($pecah[1]);

	        $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
	        $nama_hari = "";
	        if($nama=="Sunday") {$nama_hari="Minggu";}
	        else if($nama=="Monday") {$nama_hari="Senin";}
	        else if($nama=="Tuesday") {$nama_hari="Selasa";}
	        else if($nama=="Wednesday") {$nama_hari="Rabu";}
	        else if($nama=="Thursday") {$nama_hari="Kamis";}
	        else if($nama=="Friday") {$nama_hari="Jumat";}
	        else if($nama=="Saturday") {$nama_hari="Sabtu";}
	        return $nama_hari.', '.$tgl.'-'.$bulan.'-'.$thn;
	    }
	}


if ( ! function_exists('stringify_attributes'))
{
	/**
	 * Stringify attributes for use in HTML tags.
	 *
	 * Helper function used to convert a string, array, or object
	 * of attributes to a string.
	 *
	 * @param   mixed $attributes string, array, object
	 * @param   bool  $js
	 *
	 * @return  string
	 */
	function stringify_attributes($attributes, $js = false): string
	{
		$atts = '';
		if (empty($attributes))
		{
			return $atts;
		}
		if (is_string($attributes))
		{
			return ' ' . $attributes;
		}
		$attributes = (array) $attributes;
		foreach ($attributes as $key => $val)
		{
			$atts .= ($js) ? $key . '=' . e($val, 'js') . ',' : ' ' . $key . '="' . e($val, 'attr') . '"';
		}
		return rtrim($atts, ',');
	}
}

if ( ! function_exists('form_open'))
{

	/**
	 * Form Declaration
	 *
	 * Creates the opening portion of the form.
	 *
	 * @param    string $action     the URI segments of the form destination
	 * @param    array  $attributes a key/value pair of attributes
	 * @param    array  $hidden     a key/value pair hidden data
	 *
	 * @return    string
	 */
	function form_open(string $action = '', array $attributes = [], array $hidden = []): string
	{
		// If no action is provided then set to the current url
		if ( ! $action)
		{
			$action = url()->current();
		} // If an action is not a full URL then turn it into one
		elseif (strpos($action, '://') === false)
		{
			$action = url($action);
		}

		$attributes = stringify_attributes($attributes);

		if (stripos($attributes, 'method=') === false)
		{
			$attributes .= ' method="post"';
		}
		if (stripos($attributes, 'accept-charset=') === false)
		{
			$attributes .= ' accept-charset="' . strtolower('utf8') . '"';
		}

		$form = '<form action="' . $action . '"' . $attributes . ">\n ";



		if (is_array($hidden))
		{
			foreach ($hidden as $name => $value)
			{
				$form .= '<input type="hidden" name="' . $name . '" value="' . $value . '" style="display: none;" />' . "\n";
			}
		}

		return $form;
	}

}

//--------------------------------------------------------------------

if ( ! function_exists('form_open_multipart'))
{

	/**
	 * Form Declaration - Multipart type
	 *
	 * Creates the opening portion of the form, but with "multipart/form-data".
	 *
	 * @param    string $action     The URI segments of the form destination
	 * @param    array  $attributes A key/value pair of attributes
	 * @param    array  $hidden     A key/value pair hidden data
	 *
	 * @return    string
	 */
	function form_open_multipart(string $action = '', array $attributes = [], array $hidden = []): string
	{
		if (is_string($attributes))
		{
			$attributes .= ' enctype="multipart/form-data"';
		}
		else
		{
			$attributes['enctype'] = 'multipart/form-data';
		}

		return form_open($action, $attributes, $hidden);
	}

}

//--------------------------------------------------------------------

if ( ! function_exists('form_hidden'))
{

	/**
	 * Hidden Input Field
	 *
	 * Generates hidden fields. You can pass a simple key/value string or
	 * an associative array with multiple values.
	 *
	 * @param    mixed        $name  Field name
	 * @param    string|array $value Field value
	 * @param    bool         $recursing
	 *
	 * @return    string
	 */
	function form_hidden($name, $value, bool $recursing = false): string
	{
		static $form;

		if ($recursing === false)
		{
			$form = "\n";
		}

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				form_hidden($key, $val, true);
			}

			return $form;
		}

		if ( ! is_array($value))
		{
			$form .= '<input type="hidden" name="' . $name . '" value="' . $value . "\" />\n";
		}
		else
		{
			foreach ($value as $k => $v)
			{
				$k = is_int($k) ? '' : $k;
				form_hidden($name . '[' . $k . ']', $v, true);
			}
		}

		return $form;
	}

}

//--------------------------------------------------------------------


if ( ! function_exists('form_close'))
{

	/**
	 * Form Close Tag
	 *
	 * @param    string $extra
	 *
	 * @return    string
	 */
	function form_close(string $extra = ''): string
	{
		return '</form>' . $extra;
	}

}

//--------------------------------------------------------------------


//--------------------------------------------------------------------

if ( ! function_exists('parse_form_attributes'))
{

	/**
	 * Parse the form attributes
	 *
	 * Helper function used by some of the form helpers
	 *
	 * @param    array $attributes List of attributes
	 * @param    array $default    Default values
	 *
	 * @return    string
	 */
	function parse_form_attributes($attributes, $default): string
	{
		if (is_array($attributes))
		{
			foreach ($default as $key => $val)
			{
				if (isset($attributes[$key]))
				{
					$default[$key] = $attributes[$key];
					unset($attributes[$key]);
				}
			}
			if (! empty($attributes))
			{
				$default = array_merge($default, $attributes);
			}
		}

		$att = '';

		foreach ($default as $key => $val)
		{
			if ($key === 'value')
			{
				$val = e($val, 'html');
			}
			elseif ($key === 'name' && ! strlen($default['name']))
			{
				continue;
			}
			$att .= $key . '="' . $val . '" ';
		}

		return $att;
	}

	//--------------------------------------------------------------------
}

// convert to html
if(! function_exists('toHtml'))
{
  function toHtml($text, $nl2br = false)
  {
    $converter = new ConverterText;
    $output = $converter->text($text, $nl2br);

    return $output;
  }
}

// canonical
if(! function_exists('canonical'))
{
  function canonical()
  {
      return new HtmlString('<link rel="canonical" href="'. url()->current() .'">');
  }
}