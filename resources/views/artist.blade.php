@extends('main')
@section('content')
<!--Body content-->
<div class="row artist-page">            
    <div class="player-wrapper">
        <h4><?php echo $artist; ?> - <span class="song-name"></span></h4>
        <img class="cover"  alt="artist image" >
        <div class="player gradient">
            <a class="gradient" id="play" href="" title="">
                <img src="/img/ic_play_arrow_black_36dp.png">
</a>
            <a class="gradient" id="mute" href="" title=""></a>
            <input type="range" id="seek" value="50" min="0" max="100" step="1" >
            <output for="seek" id="volume">50</output>
            <a class="gradient" id="close" href="" title=""></a>
        </a>
        </div><!-- / player -->
        <div class="playlist-wrapper list-group">

        <ul class="playlist"></ul>
</div>
    </div><!-- player-wrapper -->
     <div class="lyric-wrapper"></div> <!-- end lyrics wrapper  -->
     <div class="translation-wrapper"></div> <!-- end translation wrapper  -->
</div><!-- end row -->
@endsection
