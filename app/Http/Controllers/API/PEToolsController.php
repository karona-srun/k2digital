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
use Facebook\FileUpload\FileUpload;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        'data' => $obj->data,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'access_token' => 'Facebook Access Token is invalid',
      ], 200);
    }
  }

  public function getFacebookGroupMembers(Request $request)
  {
    $url = "https://graph.facebook.com/".$request->group_id."/opted_in_members&access_token=" . $request->facebook_access_token;
    $response = file_get_contents($url);
    $obj = json_decode($response);
      
    return response()->json([
      'status' => 'success',
      'data' => $obj->data,
    ], 200);
  }

  public function postToGroup(Request $request)
  {
    $post_type = $request->post_type;
    $groups = $request->group_id;
    $result = array();
    if($post_type == "text")
    {
      foreach ($groups as $group)
      {
        $url = "https://graph.facebook.com/".$group."/feed?feilds=message=".$request->message ."&access_token=".$request->facebook_access_token;
        $response = Http::post($url);
        $result[] = $response->json();
      }
    }
    else if($post_type == "picture"){

    }
    else if($post_type == "video"){

    }
    return response()->json([
      'status' => 'success',
      'data' => $result,
    ], 200);
  }

  public function getFacebookKeywords(Request $request)
  {

    $url = "https://graph.facebook.com/search?q=graph+api&type=user&date_format=U&limit=60&access_token=" . $request->facebook_access_token;

    $response = file_get_contents($url);
    $obj = json_decode($response);
    dd($obj);
  }

  public function getFacebookProfile(Request $request)
  {
    $url = "https://graph.facebook.com/v11.0/me/?fields=id,name,link,picture&access_token=" . $request->facebook_access_token;

    $response = file_get_contents($url);
    $obj = json_decode($response);
    dd($obj);
  }

  public function adimage(Request $request)
  {

  }

  public function scheduled_publish_time()
  {
    // https://graph.facebook.com/{page-id}/feed
    // ?published=false
    // &message=A scheduled post
    // &scheduled_publish_time={unix-time-stamp-of-a-future-date}
  }

  /**
   * 
   * Function Post to facebook page
   * Features: Text, Link, Images, Videos
   * 
   */
  public function postToPage(Request $request)
  {
    $pages = $request->pages;
    $post_type = $request->post_type;
    $text = $request->text;
    $result = [];

    if($post_type == "text")
    {
      if($request->link != null){
        foreach ($pages as $page)
        {
          $response = Http::post('https://graph.facebook.com/'.$page['page_id'].'/feed?message='.$request->message.'&link='.$request->link.'&access_token='.$page['access_token']);
          $result[] = $response->json();
        }
      }else{
        foreach ($pages as $page)
        {
          $response = Http::post('https://graph.facebook.com/'.$page['page_id'].'/feed?message='.$request->message.'&access_token='.$page['access_token']);
          $result[] = $response->json();
        }
      }
    }
    else if($post_type == "picture")  
    {
      foreach (json_decode($request->pages) as $page)
      {
        foreach($request->images as $key => $image){
          $profileImage = date('YmdHis').'_'.time() . "." .$image->getClientOriginalExtension();
          
          $path = $image->storeAs('posts/'.Auth::id(), $profileImage, 'public');
          $url = Storage::url($path);

          $response = Http::post("https://graph.facebook.com/".$page->page_id."/photos?message=". $text ."&url=".url($url)."&access_token=".$page->access_token);
          $result[] = $response->json();
        }
      }
    }else if($post_type == "video")
    {
      foreach ($pages as $page)
      {
        $response = Http::post('https://graph.facebook.com/'.$page['page_id'].'/videos');
        $result[] = $response->json();
      }
    }
    return response()->json($result);
  }

  /**
   * 
   * Function Post to facebook page
   * Features: Text, Link, Images, Videos
   * 
   */
  public function postProfile(Request $request)
  {
    $fb = new \Facebook\Facebook([
      'app_id' => '1665764083630003',
      'app_secret' => '996f92ec341a00a941df94d80f6ab9bc',
      'default_graph_version' => 'v2.10',
    ]);
    
    $data = [
      'message' => 'My awesome photo upload example.',
      'link' =>'https://upload.wikimedia.org/wikipedia/commons/7/78/Image.jpg',
    ];
    
    try {
      // Returns a `Facebook\Response` object
      $response = $fb->post('/me/feed', $data, 'access_token='. $request->facebook_access_token);
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    
    $graphNode = $response->getGraphNode();
    
    echo $graphNode;
  }

  /**
   * 
   * Function Post to facebook page
   * Features: Text, Link, Images, Videos
   * 
   */
  public function getFacebookPages(Request $request)
  {
        $url = "https://graph.facebook.com/me/accounts?access_token=".$request->facebook_access_token;

        $response = file_get_contents( $url );
        $item = json_decode($response);

        $item = $item->data;

        return array_map(function ($item) {
            return [
                'provider' => 'facebook page',
                'access_token' => $item->access_token,
                'id' => $item->id,
                'name' => $item->name,
                'image' => "https://graph.facebook.com/{$item->id}/picture?type=large"
            ];
        }, $item);
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
