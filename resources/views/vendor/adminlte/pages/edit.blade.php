@extends('backend.master')


@section('content')
    <div class="content-wrapper">
        <div class="card border-yellow">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Edit Page
                                <div class="float-end">
                                    <a class="btn btn-primary" href="{{ route('admin.pages.index') }}"> Back</a>
                                </div>
                            </h2>
                        </div>
                    </div>
                </div>


                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Slug:</strong>
                                <input type="text" name="slug" value="{{ $page->slug }}" class="form-control" placeholder="Slug">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Title:</strong>
                                <input type="text" name="title" value="{{ $page->title }}" class="form-control" placeholder="Title">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status:</label>
                                <select class="form-select form-control" name="status" value="{{ $page->status }}" id="input-status">
                                    <option value="draft">Choose Status...</option>
                                    @foreach($status as $i => $r)
                                    <option value="{{ $r }}" @selected($r == $page->status)>{{ $r }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                        
                        
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Template:</strong>
                                <select class="form-select form-control" name="template" value="{{ $page->template }}" id="input-template">
                                    <option value="default">Choose Template ...</option>
                                    @foreach($templates as $i => $r)
                                    <option value="{{ $r }}" @selected($r == $page->template )>{{$r}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea name="description" class="form-control" placeholder="Description" rows="20" style="min-height: 450px;">{{ $page->description }}</textarea>
                            </div>
                        </div>

                        
                        <div class="col-xs-12 mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
