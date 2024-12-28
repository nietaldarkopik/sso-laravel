@extends('backend.master')


@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-start align-items-start g-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 margin-tb mb-4">
                                <div class="pull-left">
                                    <h2> Show Page
                                        <div class="float-end">
                                            <a class="btn btn-primary" href="{{ route('admin.pages.index') }}"> Back</a>
                                        </div>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mh-100">
                    <ul class="list-group list-group-flush">
                        
                        <li class="list-group-item row d-flex m-0 p-0">
                            <div class="col-md-4 bg-dark text-light p-3">
                                <strong>Slug</strong>
                            </div>
                            <div class="col-md-8 p-3">
                                {{ $page->slug }}
                            </div>
                        </li>
                        
                        <li class="list-group-item row d-flex m-0 p-0">
                            <div class="col-md-4 bg-dark text-light p-3">
                                <strong>Title</strong>
                            </div>
                            <div class="col-md-8 p-3">
                                {{ $page->title }}
                            </div>
                        </li>
                        
                        <li class="list-group-item row d-flex m-0 p-0">
                            <div class="col-md-4 bg-dark text-light p-3">
                                <strong>Status</strong>
                            </div>
                            <div class="col-md-8 p-3">
                                {{ $page->status }}
                            </div>
                        </li>
                        
                        <li class="list-group-item row d-flex m-0 p-0">
                            <div class="col-md-4 bg-dark text-light p-3">
                                <strong>Template</strong>
                            </div>
                            <div class="col-md-8 p-3">
                                {{ $page->template }}
                            </div>
                        </li>

                        <li class="list-group-item row d-flex m-0 p-0">
                            <div class="col-md-4 bg-dark text-light p-3">
                                <strong>Description</strong>
                            </div>
                            <div class="col-md-8 p-3">
                                {{ $page->description }}
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        @endsection
