<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome', ['dataTitle' => 'main']);
});

Route::get('artist/{artist}', function(Request $request, $artist) {
    $uppercase = ucwords(str_replace('-', ' ', $artist));     
    return view('artist', ['artist'=> $uppercase,
                            'dataTitle' => 'artist']);
				 });

function getTracksByArtist($tracks, $artist) {
	$array = array_values(array_filter($tracks, function ($value) use($artist){
	
		return $value['Artist'] == $artist;
	}));
	return $array;
}

Route::post('session', function(Request $request) {
	var_dump($request->input('data'));
    $data = $request->input('data'); 
    $json = json_decode($data, true);
    session(["tracks" => $json]); 
    return;
});
