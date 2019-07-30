@extends('layouts.admin.app')

@section('title')
  <title>{{ $play->title }}</title>
@endsection

@section('content')

    <div class="container-fluid">

        <?php $playable_type = snake_case(str_after($play->playable_type, 'App\\')); ?>
        {!! view('admin.plays.' . ( $playable_type == '' ? 'movie' : $playable_type.'_preview' ), [ 'play'=>$play ]) !!}

    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>Videos</h3>
            </div>
            <div class="panel-body">
                <div id='videos'></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i>Subtitles</h3>
            </div>
            <div class="panel-body">
                <div id="subtitles"></div>
            </div>
        </div>
    </div>

{!! view('admin.videos.modal') !!}
{!! view('admin.subtitles.modal') !!}

@endsection

@section('script')

    <script type="text/javascript">

        var play = {!! $play->toJSON() !!};
        var qualitys = [];

        @foreach (App\Play::RESOLUTION_OPTIONS as $option)
            qualitys.push("{{ $option }}");
        @endforeach

        var Page = require('plays_edit');
        var pageObject = new Page.default();

        function load(){
            pageObject.init(play, qualitys);
        }

        load();

    </script>

@endsection
