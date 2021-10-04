<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PETools;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Facebook\FacebookSession;
use Illuminate\Support\Facades\Auth;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdCreativeFields;
use FacebookAds\Object\Fields\AdFields;

class PEToolsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * https://www.sammyk.me/upgrading-the-facebook-php-sdk-from-v4-to-v5
   */
  public function list()
  {
    $fb = new \Facebook\Facebook([
      'app_id' => '{app-id}',
      'app_secret' => '{app-secret}',
      'default_graph_version' => 'v2.10',
    ]);

    $helper = $fb->getPageTabHelper();

    try {
      $accessToken = $helper->getAccessToken();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    if (!isset($accessToken)) {
      echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
      exit;
    }

    // Logged in
    echo '<h3>Page ID</h3>';
    var_dump($helper->getPageId());

    echo '<h3>User is admin of page</h3>';
    var_dump($helper->isAdmin());

    echo '<h3>Signed Request</h3>';
    var_dump($helper->getSignedRequest());

    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());
  }

  public function submitAccessToken(Request $request)
  {
    $url = "https://graph.facebook.com/v11.0/me/?fields=id,name,link,picture&access_token=" . $request->facebook_access_token;

    $petool = PETools::where('fb_access_token',$request->facebook_access_token)->first();
    if($petool){
      return response()->json([
          'status' => 'error',
          'mode' => '0',
          'error' => 'Access token is already taken'],200);
    }

    try {
      $response = file_get_contents($url);
      $obj = json_decode($response);

      $petool = new PETools();
      $petool->fb_id = $obj->id;
      $petool->fb_name = $obj->name;
      $petool->fb_link = $obj->link;
      $petool->fb_picture = $obj->picture->data->url;
      $petool->fb_access_token = $request->facebook_access_token;
      $petool->created_by = Auth::user()->id;
      $petool->updated_by = Auth::user()->id;

      if ($petool->save()) {
        return response()->json([
          'status' => 'success',
          'mode' => '1',
          'data' => $petool
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'mode' => '2',
          'access_token' => 'Facebook Access Token is invalid',
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'mode' => '2',
        'data' => $e->getMessage(),
      ], 200);
    }
  }

  public function getFacebookGroups(Request $request)
  {
    try {
      $url = "https://graph.facebook.com/me/groups?access_token=" . $request->facebook_access_token;
      $response = file_get_contents($url);
      $obj = json_decode($response);
      return response()->json([
        'status' => 'success',
        'data' => $obj
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'access_token' => 'Facebook Access Token is invalid',
      ], 200);
    }
  }

  public function getFacebookKeywords(Request $request)
  {

    $url = "https://graph.facebook.com/search?q=graph+api&type=user&date_format=U&limit=60&access_token=" . $request->facebook_access_token;

    $response = file_get_contents($url);
    $obj = json_decode($response);
    dd($obj);
  }

  public function getFacebookProfiles(Request $request)
  {
    $url = "https://graph.facebook.com/v11.0/me/?fields=id,name,link,picture&access_token=EAAAAZAw4FxQIBAH3yQOLMMjaJPoZCZCzMBot7ZCcsGngyPUtyijWAN6zlb22WPlnAdzeqVZClvn84qBChtFnObxNtYg4ZAZBl28bccx9fpsbU3tsmn77ZAxjRaUwbnW2RJrKKL6qhK8MukI0xJPtUqdnUIGcjnIsoXIoIjiUBZBaCmGCB4n5ZCJnlZC";

    $response = file_get_contents($url);
    $obj = json_decode($response);
    dd($obj);
  }

  public function adimage(Request $request)
  {

  }
  public function postProfile(Request $request)
  {
    $fb = new \Facebook\Facebook([
      'app_id' => '594163061937619',
      'app_secret' => '4a86c9794ba790e74d4d1690048b2b8e',
      'default_graph_version' => 'v2.10',
    ]);

    $data = [
      "message" => "testing post"
    ];

    // $helper = $fb->getJavaScriptHelper();

    
    // try {
    //   $accessToken = $helper->getAccessToken();
    // } catch(\Facebook\Exceptions\FacebookSDKException $e) {
    //   // There was an error communicating with Graph
    //   // Or there was a problem validating the signed request
    //   echo $e->getMessage();
    //   exit;
    // }
    
    // if ($accessToken) {
    //   // Logged in.
    //   $_SESSION['facebook_access_token'] = (string) $accessToken;
    // }

    $response = $fb->post('/me/feed', $data, 'EAAAAZAw4FxQIBALDqpWbIvhqbULPTRZCAwxzJswB3utlHFdB94AZCai34AxcLlSGMGNq9nrX1ZArXNFyxNjcqrk1GQfN4lZCPz05kZBZCSfTjcEPnZCtdjAEP745viSznTXXtcKwfH7lS4MhSqU4iPNXv2fbzP74B2ZATMT6fDZBJFSSFzqpbsvgQX');
    return response()->json($response->getDecodedBody());
  }


  public function deleteFacebookToken($id)
  {
    $petool = PETools::find($id);

    if($petool){
      $petool->delete();
      return response()->json([
        'status' => 'success',
        'message' => 'The petool successfully deleted',
        'data' => $petool
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Data not found.',
    ]);
  }
}
