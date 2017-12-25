<?php
use Illuminate\Http\Request;
use App\Model\Access;

if (!function_exists('array_encode_return')) {
	/**
	 * 制式的 return array
	 * <p>v1.0 2017-06-12</p>
	 * @param number $result
	 * @param string $message
	 * @param string $redirect
	 * @param string /array $data
	 * @return array
	 */
	function array_encode_return($result, $message = null, $redirect = null, $data = null)
	{
		$return = [];
		$return['result'] = $result;
		if ($message !== null) $return['message'] = $message;
		if ($redirect !== null) $return['redirect'] = $redirect;
		if ($data !== null) $return['data'] = $data;

		return $return;
	}
}

if (!function_exists('base64toImage')) {

    function base64toImage($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );
        return $output_file;
    }

}

if (!function_exists('get_label')) {
	/**
	 * 後台顯示不同狀態用的底色label
	 * <p>v1.0 2017-06-07</p>
	 * @param string $status
	 * @return response;
	 */
	function get_label($status)
	{
		$return = '';

		switch ($status) {
			case '0' :
				$return = '<span class="label label-warning">否</span>';
				break;

			case '1' :
				$return = '<span class="label label-success">是</span>';
				break;

			case 'archive' :
				$return = '<div><span style="font-weight:bold;" class="bg-light-blue color-palette">'.ucfirst($status).'</span></div>';
				break;

			case 'close' :
			case 'unread' :
				$return = '<span class="label label-warning">'.ucfirst($status).'</span>';
				break;

			case 'open' :
			case 'read' :
				$return = '<span class="label label-success">'.ucfirst($status).'</span>';
				break;

		}

		return $return;
	}
}

if (!function_exists('inserttime')) {
	/**
	 * 回傳制式時間格式
	 * <p>v1.0 2017-06-07</p>
	 * @param string $second
	 * @return string
	 */
	function inserttime($second = null)
	{
		return date('Y-m-d H:i:s', time() + (int)$second);
	}
}

if (!function_exists('is_email')) {
	/**
	 * 判斷是否為 email
	 * <p>v1.0 2017-12-25</p>
	 * @param string $value
	 * @return mixed
	 */
	function is_email($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL) ;
	};
}

if (!function_exists('is_url')) {
	/**
	 * 判斷是否為 url
	 * <p>v1.0 2017-06-13</p>
	 * @param string $value
	 * @return mixed
	 */
	function is_url($value)
	{
		return filter_var($value, FILTER_VALIDATE_URL);
	}
}

if (!function_exists('json_encode_return')) {
	/**
	 * Ajax呼叫時制式的回傳 return json
	 * <p>v1.0 2017-06-07</p>
	 * @param number $result
	 * @param string $message
	 * @param string $redirect
	 * @param string /array $data
	 * @return response;
	 */
	function json_encode_return($result, $message = null, $redirect = null, $data = null)
	{
		$return = [];
		$return['status'] = $result;
		switch ($result) {
			case 0 :
				$HttpStatus = 401;
				break;
			case 1 :
				$HttpStatus = 200;
				break;
		}
		if ($message !== null) $return['message'] = $message;
		if ($redirect !== null) $return['redirect'] = $redirect;
		if ($data !== null) $return['data'] = $data;

		return response(json_encode($return), $HttpStatus)->header('Content-Type', 'application/json');
	}
}

if (!function_exists('set_ip_log')) {
	function set_ip_log($ip) {
		$request = new Request();
		$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$e_access = Access::where('ip', $ip)->first();
		$result = json_decode($e_access, true);

		$param = [
			'ip' => $ip,
			'url' => $url,
		];

		if ($result) {
			$param['num'] = $result['num'] + 1;
			Access::where('ip', $ip)->update($param);
		} else {
			$param['num'] = 1;
			Access::where('ip', $ip)->insert($param);
		}
	};
}



