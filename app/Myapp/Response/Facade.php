<?php namespace Myapp\Response;
use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Facades\Response as IlluminateFacade;

class Facade extends IlluminateFacade {

	
	/**
	 * Return a new response from the application.
	 *
	 * @param  string  $content
	 * @param  int     $status
	 * @param  array   $headers
	 * @return \Illuminate\Http\Response
	 */
	public static function make($content = '', $status = 200, array $headers = array())
	{
		return new MyResponseClass($content, $status, $headers);
	}

	
	/**
	 * Return a new JSON response from the application.
	 *
	 * @param  string|array  $data
	 * @param  int    $status
	 * @param  array  $headers
	 * @param  int    $options
	 * @return \Illuminate\Http\JsonResponse
	 */
	public static function json($data = array(), $status = 200, array $headers = array(), $options = 0)
	{
		if ($data instanceof ArrayableInterface)
		{
			$data = $data->toArray();
		}

		return new MyJsonResponseClass($data, $status, $headers, $options);
	}
}


