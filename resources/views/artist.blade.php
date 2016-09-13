@extends('main')
@section('content')
<!--Body content-->
<div class="row artist-page">            
    <div class="player-wrapper m-x-auto">
        <h4><?php echo $artist; ?> - <span class="song-name"></span></h4>
        <img class="cover"  alt="artist image" >
        <div class="player gradient">
            <a class="gradient" id="play" href="" title=""><i class="fa fa-play"></i></a>
            <a class="gradient" id="mute" href="" title=""><i class="fa fa-volume-off"></i></a>
            <input type="range" id="seek" value="50" min="0" max="100" step="1" >
            <output for="seek" id="volume">50</output>
            <a class="gradient" id="close" href="" title=""><i class="fa fa-stop"></i></a>
        </div><!-- / player -->
        <div class="playlist list-group"></div>
    </div><!-- player-wrapper -->
</div><!-- end row -->
@endsection
