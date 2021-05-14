@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">       
                <div class="card-body">
                    <a  href="/posts/{{$post->id}}/edit" class="btn btn-warning"> Edit </a> 
                        <br>
                        Title: {{ $post->title }} <br>  
                        Created At: {{ $post->created_at }}  <br>
                        @if ($post->img != '')
                            <p>Image: </p>
                            <img src="{{ asset('/storage/img/'. $post->img) }}" alt="" title="" />
                        @endif

                        @if ($comments)

                            @foreach ($comments as $comment)
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="display-comment">
                                        <p>{{ $comment->description }}</p>
                                        <div class="media mt-3">
                                            <a class="pr-3" href="" id="reply"></a>
                                                <div class="media-body">
                                                    <form method="post" action="{{ route('comments.store') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="text" name="description" class="form-control" />
                                                            <input type="hidden" name="post_id"
                                                                value="{{ $comment->post_id }}" />
                                                            <input type="hidden" name="parent_id"
                                                                value="{{ $comment->id }}" />
                                                          </div>
                                                            <div class="form-group">
                                                                <input type="submit" class="btn btn-warning" value="Reply" />
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        @endif

                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1"> <strong>Comment:</strong></label>
                                    <textarea class="form-control" name="description" id="description" rows="3" cols="100"
                                        placeholder="Enter comments"></textarea>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn button btn-success" value="Add Comment">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
@endsection