<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Process\Process;

class TikTokController extends Controller
{
    public function __invoke()
    {

    }

    public function index(Request $request)
    {
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://tik-tok-feed.p.rapidapi.com/?search=".$request->username."&type=user-feed-no-watermark&max=0",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => [
				"x-rapidapi-host: tik-tok-feed.p.rapidapi.com",
				"x-rapidapi-key: c1abb63253msh21a61937483ee9ap131d55jsn9a1324fc4ce4"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return response()->json([
				'data' => json_decode($response)
			]);
		}


        // $curl = curl_init();
		// curl_setopt_array($curl, [
		// 	CURLOPT_URL => "https://godownloader.com/api/tiktok-no-watermark-free?url=https://www.tiktok.com/@justinbieber/video/6943631942512315654&key=godownloader.com",
		// 	// CURLOPT_URL => "https://video-nwm.p.rapidapi.com/url/?url=https://www.tiktok.com/@ronnfr7",
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_FOLLOWLOCATION => true,
		// 	CURLOPT_ENCODING => "",
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 30,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => "GET",
		// 	CURLOPT_HTTPHEADER => [
		// 		"x-rapidapi-host: tiktok-video-downloader.p.rapidapi.com",
		// 		"x-rapidapi-key: c1abb63253msh21a61937483ee9ap131d55jsn9a1324fc4ce4"
		// 		// "x-rapidapi-host: video-nwm.p.rapidapi.com",
    	// 		// "x-rapidapi-key: c1abb63253msh21a61937483ee9ap131d55jsn9a1324fc4ce4"
		// 	],
		// ]);

		// $response = curl_exec($curl);
		// $err = curl_error($curl);

		// curl_close($curl);


		// if ($err) {
		// 	echo "cURL Error #:" . $err;
		// } 
		// else {
		// 	return response()->json([
		// 		'data' => json_decode($response)
		// 	]);
		// }
    }

	public function submitLink(Request $request)
	{
		// $url = $request->url;
		// $start = curl_init();
		// curl_setopt($start, CURLOPT_URL, $url);
		// curl_setopt($start, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($start, CURLOPT_SSLVERSION, 3);

		// $file_data = curl_exec($start);
		// curl_close($start);

		// $file_path = 'downloads/'. time(). '.mp4';
		// $file = fopen($file_path, 'w+');
		// fputs($file, $file_data);
		// fclose($file);

		// return response()->json([
		// 	'data' => json_decode($file_data)
		// ]);

		try {
            $process = new Process([
                'youtube-dl',
                $request->url,
                '-o',
                storage_path('app/public/downloads/%(title)s.%(ext)s')
                , '--print-json'
            ]);

            $process->mustRun();

            $output = json_decode($process->getOutput(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Could not download the file!");
            }

            return response()->download($output['_filename']);

        }  catch (\Throwable $exception) {
            $request->session()->flash('error', 'Could not download the given link!');
            logger()->critical($exception->getMessage());
            return back();
        }

	}

	public function force_download($url, $filename)
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header("Content-Transfer-Encoding: binary");
    header('Expires: 0');
    header('Pragma: public');
    if (isset($_SERVER['HTTP_REQUEST_USER_AGENT']) && strpos($_SERVER['HTTP_REQUEST_USER_AGENT'], 'MSIE') !== false) {
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    }
    header('Connection: Close');
    ob_clean();
    flush();
    readfile($url, "", stream_context_create([
        "ssl" => [
            "verify_peer"      => false,
            "verify_peer_name" => false,
        ],
    ]));
    exit;
}

}
