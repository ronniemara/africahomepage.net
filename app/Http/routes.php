<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('artist/{artist}', function(Request $request, $artist) {
    $url = $request->input('url');
    $policy = $request->input('Policy');
    $signature = $request->input('Signature'); 
   $keyId =  $request->input('Key-Pair-Id');
    $thumbnail =  $url . '?Policy=' . $policy .'&Signature=' . $signature . '&Key-Pair-Id=' .$keyId;
    $artist = ucwords(str_replace('-', ' ', $artist));
    $tracks = session("tracks");

    $artist_tracks = [];

    foreach( $tracks as $track) {
        $tracksArtist = $track['Artist'];
        if($tracksArtist == $artist) {
            $artist_tracks[] = $track;
}
} 
    $string = json_encode($artist_tracks);
    return view('artist', [ 
        'artist' => $artist,
        'tracks' => $string,
        'thumbnail' => $thumbnail
    ]);
});

Route::post('session', function(Request $request) {
    $data = $request->input('data'); 
    $json = json_decode($data, true);
    session(["tracks" => $json]); 
    return;
});
