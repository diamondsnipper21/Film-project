    @if(!is_null($video))
        <tr>
            <td>{{ $option }}</td>
            <td>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#videoModal" title="Add" class="thumbnail widget widget-hover-effect1">
                    <img id="video_{{$option}}" data-quality="{{$option}}" src="{{ $video->featured_image->url }}" alt="featured" />
                </a>
            </td>
            <td>{{ $video->name }}</td>
            <td>{{ $video->duration }}</td>
            <td>
                <a method="DELETE" class="btn btn-danger" href="{{ route('admin.plays.remove_video', [$video->play->id, $video->id] ) }}" data-confirm="Are you sure to delete?">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @else
        <tr>
            <td>{{ $option }}</td>
            <td>
                <a href="javascript:void(0); set_quality('{{$option}}')" data-toggle="modal" data-target="#videoModal" title="Add" class="thumbnail widget widget-hover-effect1">
                    <img id="video_{{$option}}" data-quality="{{$option}}" src="" alt="featured" />
                </a>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endif
