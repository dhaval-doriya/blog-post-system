@extends('backend.layout.master')

@section('title', 'create blog')
@section('path', 'create blog')

@section('Pagename', 'Create Blog')

@section('maindata')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mt-5">
                    Create Blog
                </h3>
                <div class="card card-primary shadow-lg  mb-5 bg-white rounded">
                    <div class="card-header">
                        <h3 class="card-title">blog</h3>
                    </div>

                    <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data" id="blog-create">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                @if ($errors->has('name'))
                                    <p class="error text-danger">{{ $errors->first('name') }}</p>
                                @endif
                                <label for="name">Blog name</label>
                                <input type="name" required class="form-control" placeholder="Enter blog name"
                                    name="name" id="name" data-action="{{ route('blog.slug') }}"
                                    content="{{ csrf_token() }}">
                            </div>


                            <div class="form-group">
                                @if ($errors->has('slug'))
                                    <p class="error text-danger">{{ $errors->first('slug') }}</p>
                                @endif

                                <label for="slug"> blog title slug</label>
                                <input type="name" class="form-control " required placeholder="Enter blog slug"
                                    name="slug" id="slug" data-action="{{ route('blog.slug') }}"
                                    content="{{ csrf_token() }}">
                                <p class="error-slug text-danger"></p>
                                <p class="success-slug text-success"></p>
                            </div>


                            <div class="col-md-12">
                                @if ($errors->has('short_description'))
                                    <div class="error text-danger">{{ $errors->first('short_description') }}</div>
                                @endif
                                <label for="short_description"> blog Short Description</label>
                                <input required class="form-control" required
                                    placeholder="Enter short description about blog" name="short_description"
                                    id="short_description" />
                            </div>


                            <br>
                            <div class="form-group mb-3">
                                <label for="select2Multiple">Select categories</label>
                                <select class="select2-multiple form-control" required name="categories[]"
                                    multiple="multiple" id="select2Multiple" style="width: 800px;">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label for="fileToUpload">Upload Blog Cover Image:</label>
                                <input required type="file" accept="image/png, image/gif, image/jpeg" name="image"
                                    id="fileToUpload" onchange="readURL(this);">
                                <br>
                                @if ($errors->has('image'))
                                    <div class="error text-danger">{{ $errors->first('image') }}</div>
                                @endif
                                <div class="image d-flex justify-content-center mb-3 mt-3 ml-5">
                                    <img src="https://coolbackgrounds.io/images/backgrounds/white/pure-white-background-85a2a7fd.jpg"
                                        alt="User Image" id="preview_image" height="0" width="auto">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div hidden id="description" data-action="{{ route('blog.description') }}"></div>

                                @if ($errors->has('description'))
                                    <div class="error text-danger">{{ $errors->first('description') }}</div>
                                @endif

                                <label for=" write Blog">Write Blog:</label>
                                <div class="card-body ">
                                    <textarea id="summernote" name="description" class="blog_description" data-action="{{ route('blog.description') }}"
                                        content="{{ csrf_token() }}">
                                         </textarea>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button id="submit" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('links')

    <script src="{{ asset('assets/custom_js/descriptionImageUpload.js') }}"></script>
    <script src="{{ asset('assets/custom_js/validate/blog.js') }}"></script>

@endsection
