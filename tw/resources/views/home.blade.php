@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ Auth::user()->name }}さんのタイムライン</div>
        
        @foreach ($tweets as $tweet)

        <div class="card-body">
          {{ $tweet->tweet }}
<?php
          $subject = $tweet->tweet;
          if(strpos($subject,'https://www.youtube.com/watch?v=') !== false){
            list($youtube,$url) = explode("=",$subject );
          


?>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<?php
        }else{

        }
?>          



          <br>
          <div style="display:flex; justify-content: left;align-items: center;">
            <div style="float:left">


              {{ $tweet->getData() }} / {{ $tweet->created_at }}
            </div>


            @if (!isset( $favtweet[ $tweet->id] ))
            <a href="{{ action('LikeController@like', ['id' => $tweet->id]) }}" style="float:left" class="heart"></a>
            @csrf
            @else
            <a href="{{ action('LikeController@release', ['id' => $tweet->id]) }}" style="float:left" class="heartkieru"></a>
            <!-- <a href="{{ action('LikeController@release', ['id' => $tweet->id]) }}" style="float:left" class="heart"></a> -->
            @endif



            @if($tweet->user_id == Auth::id())

            <form action="{{ action('TweetController@destroy', $tweet->id) }}" id="form_{{ $tweet->id }}" method="post">
              {{ csrf_field() }}
              {{ method_field('delete') }}
              <a href="#" data-id="{{ $tweet->id }}" class="btn btn-danger btn-sm" onclick="deletePost(this);">削除</a>
            </form>
            @else
            @endif

          </div>
        </div>


        <hr style="margin-top:0px; margin-bottom:0px">





        @endforeach
        <script>
          function deletePost(e) {
            'use strict';

            if (confirm('本当に削除していいですか?')) {
              document.getElementById('form_' + e.dataset.id).submit();
            }
          }
        </script>

          <!-- <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
          {{ session('status') }}
          </div>
          @endif

          You are logged in!
        </div> -->
      </div>

      
            {{ $tweets->links() }}
      
    </div>
  </div>
</div>

@endsection

