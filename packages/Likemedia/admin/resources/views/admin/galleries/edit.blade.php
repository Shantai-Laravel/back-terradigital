@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('galleries.index') }}">Galleries</a></li>
        <li class="breadcrumb-item active" aria-current="gallery">Edit gallery</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Editarea gallery </h3>
    @include('admin::admin.list-elements', [
    'actions' => [
            trans('variables.add_element') => route('galleries.create'),
        ]
    ])
</div>

@include('admin::admin.alerts')

<div class="list-content">
    <form class="form-reg" role="form" method="POST" action="{{ route('galleries.update', $gallery->id) }}" id="add-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="tab-content active-content">
            <div class="part full-part">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <div class="form-group">
                            <label for="alias">Alias (Short Code)</label>
                            <input type="text" name="alias" class="form-control" id="alias" value="{{ $gallery->alias }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                Upload  Images
                                <div class="form-group">
                                    <input type="file" id="upload_file" name="images[]" multiple/><hr>
                                </div>
                            </div>
                            <div class="col-md-3">
                                Upload  Video
                                <div class="form-group">
                                    <input type="file" name="video" /><hr>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Iframe</label>
                                <input type="text" name="iframe" value="" class="form-control" placeholder="https://www.youtube.com/embed/u2kJ8om_VAQ">
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br><hr><br>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            @if (!empty($imagesDesktop))
                                @foreach ($imagesDesktop as $key => $image)
                                    <div class="row">
                                        {{-- @if ($image->type == 'image') --}}
                                            <div class="col-md-3">
                                                @if ($image->type == 'image')
                                                    <a href="#" class="delete-btn" data-id="{{ $image->id }}"><i class="fa fa-trash"></i></a>
                                                    <img src="{{ $image->src }}" height="auto" width="100%" class="{{ $image->main == 1 ? 'main-image' : '' }}">
                                                    <input type="file" name="new_image[{{ $image->id }}]" value="">
                                                @elseif ($image->type == 'video')
                                                    <a href="#" class="delete-btn" data-id="{{ $image->id }}"><i class="fa fa-trash"></i></a>
                                                    <video src="/images/galleries/videos/{{ $image->src }}"  poster="/fronts/img/icons/logo-svg.svg" height="230px" width="100%" autostart="false" controls></video>
                                                    <input type="file" name="new_video[{{ $image->id }}]" value="">
                                                @elseif ($image->type == 'iframe')
                                                    <a href="#" class="delete-btn" data-id="{{ $image->id }}"><i class="fa fa-trash"></i></a>
                                                    <iframe width="100%" height="230px" src="{{ $image->src }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    <input type="text" name="new_iframe[{{ $image->id }}]" value="{{ $image->src }}" class="form-control" placeholder="https://www.youtube.com/embed/u2kJ8om_VAQ">
                                                @endif
                                            </div>
                                            @foreach ($langs as $key => $lang)
                                                <div class="col-md-3">
                                                    @foreach ($image->translations as $key => $translation)
                                                        @if ($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="">Title [{{ $lang->lang }}]</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="name[{{ $image->id }}][{{ $lang->id }}]" value="{{ $translation->title }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="">Subtitle [{{ $lang->lang }}]</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="alt[{{ $image->id }}][{{ $lang->id }}]" value="{{ $translation->alt }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="">Text [{{ $lang->lang }}]</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="text[{{ $image->id }}][{{ $lang->id }}]" value="{{ $translation->text }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="">Link [{{ $lang->lang }}]</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="link[{{ $image->id }}][{{ $lang->id }}]" value="{{ $translation->link }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        {{-- @else
                                            <div class="col-md-11">
                                                <video src="/images/galleries/videos/{{ $image->src }}"  poster="posterimage.jpg" height="250px" autostart="false" controls></video>
                                                <img src="{{ $image->src }}" alt="" class="{{ $image->main == 1 ? 'main-image' : '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                <a href="#" class="delete-btn" data-id="{{ $image->id }}"><i class="fa fa-trash"></i></a>
                                            </div> --}}
                                        {{-- @endif --}}
                                    </div><hr>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                        Upload  Images/Videos Mobile
                        <div class="form-group">
                            <input type="file" id="upload_file" name="images_mobile[]" multiple/><hr>
                        </div>
                        <div>
                            @if (!empty($imagesMobile))
                                @foreach ($imagesMobile as $key => $image)
                                    <div class="row">
                                        @if ($image->type == 'image')
                                            <div class="col-md-11">
                                                <img src="{{ $image->src }}" height="350px" class="{{ $image->main == 1 ? 'main-image' : '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                <a href="#" class="delete-btn" data-id="{{ $image->id }}"><i class="fa fa-trash"></i></a>
                                            </div>
                                        @else
                                            <div class="col-md-11">
                                                <video src="{{ $image->src }}"  poster="posterimage.jpg" height="250px" autostart="false" controls="true"></video>
                                                <img src="{{ $image->src }}" alt="" class="{{ $image->main == 1 ? 'main-image' : '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                <a href="#" class="delete-btn" data-id="{{ $image->id }}"><i class="fa fa-trash"></i></a>
                                            </div>
                                        @endif
                                    </div> <hr>
                                @endforeach
                            @endif
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function preview_image(){
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0; i < total_file; i++){
            $('#image_preview').append(
                "<div class='row append'><div class='col-md-12'><img src='"+URL.createObjectURL(event.target.files[i])+"'alt=''></div><div class='col-md-12'>@foreach ($langs as $key => $lang)<label for=''>Text[{{ $lang->lang }}]</label><input type='text' name='text[{{ $lang->id }}][]'> <label for=''>Alt[{{ $lang->lang }}]</label><input type='text' name='alt[{{ $lang->id }}][]'><label for=''>Title[{{ $lang->lang }}]</label><input type='text' name='title[{{ $lang->id }}][]'><hr><br><br> @endforeach </div>"
            );
        }
    }

    $().ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        $('.delete-btn').on('click', function(){
            $id = $(this).attr('data-id');
            $galleryId = '{{ $gallery->id }}';

            $.ajax({
                type: "POST",
                url: '/back/gallery/images/delete',
                data: {
                    id: $id,
                    galleryId: $galleryId,
                },
                success: function(data) {
                    if (data === 'true') {
                        location.reload();
                    }
                }
            });
        });
    });
</script>


@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
