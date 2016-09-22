@extends('main')
@section('content')
<!--Body content-->
<div class="row artist-page">
  <h4>{{ $artist }}- <span class="song-name"></span></h4>
  <div class="player-wrapper">
        <div class="player gradient">
          <img class="cover"  alt="artist image" >

            <div class="progress-wrapper">
              <span style="width : 25%" />
            </div>
            <div class="controls-wrapper">
              <a class="controls gradient" id="play" href="" title=""></a>
              <!-- <div class="volume-wrapper"> -->
              <a class="controls gradient" href="" id="toggle-vol" ></a>
              <div class="volume-wrapper">
                  <span style="width: 30%"></span>
              </div>
              <a class="controls gradient" id="close" href="" title=""></a>
            </div> <!--controls-wrapper -->

    </div><!-- / player -->
    <div class="playlist-wrapper list-group">
            <p>Playlist</p>
            <ul class="playlist"></ul>
    </div>
  </div><!-- player-wrapper -->

  <div class="lyric-wrapper"></div> <!-- end lyrics wrapper  -->
  <div class="translation-wrapper"></div> <!-- end translation wrapper  -->
</div><!-- end row -->
@endsection
