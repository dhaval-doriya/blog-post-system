@extends('backend.layout.master')
@section('title', 'update blog')
@section('path', 'Update Blog')
@section('Pagename', 'Update Blog')

@section('maindata')

    <div class=" container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="mt-5">
                    Update Blog
                </h3>
                <div class="card card-primary shadow-lg  mb-5 bg-white rounded">
                    <div class="card-header">
                        <h3 class="card-title">update blog</h3>
                    </div>

                    <form action="{{ route('blog.update', ['blog' => $blog->id]) }}" method="post" enctype="multipart/form-data" id="blog-update">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <input hidden value="{{ $blog->id}}" name="id">

                            <div class="form-group">
                                <label for="name">Blog name</label>
                                {{-- @if ($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                @endif --}}
                                <input type="name" class="form-control" placeholder="Enter blog name"
                                    value="{{ $blog->name }}" name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label for="slug"> blog title slug</label>
                                {{-- @if ($errors->has('slug'))
                                    <div class="error text-danger">{{ $errors->first('slug') }}</div>
                                @endif --}}
                                <input type="name" class="form-control " value="{{ $blog->slug }}"
                                    placeholder="Enter blog slug" name="slug" id="slug"
                                    data-id="{{ $blog->id }}" data-action="{{ route('blog.slug') }}"
                                    content="{{ csrf_token() }}">
                                <p class="error-slug text-danger"></p>
                                <p class="success-slug text-success"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="short_description"> blog Short Description</label>
                                {{-- @if ($errors->has('short_description'))
                                    <div class="error text-danger">{{ $errors->first('short_description') }}</div>
                                @endif --}}
                                <input class="form-control" value="{{ $blog->short_description }}"
                                    name="short_description" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="select2Multiple">Select Multiple categories</label>
                                {{-- @if ($errors->has('categories'))
                                    <div class="error text-danger">{{ $errors->first('categories') }}</div>
                                @endif --}}
                                <select required class="select2-multiple form-control" name="categories[]"
                                    multiple="multiple" id="select2Multiple">
                                    @foreach ($categories as $cat)
                                        @if (in_array($cat->id, $selected))
                                            <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                        @else
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="align-items-center">
                                    <label for="fileToUpload">Upload Blog Cover Image:</label>
                                    <input type="file" accept="image/png, image/gif, image/jpeg" name="image"
                                        id="fileToUpload" onchange="readURL(this);">
                                    <br>
                                    {{-- @if ($errors->has('image'))
                                        <div class="error text-danger">{{ $errors->first('image') }}</div>
                                    @endif --}}
                                </div>

                                <div class="image d-flex justify-content-center mb-3 mt-3 ml-5">
                                    <img src="{{ asset('blog-cover-images/' . $blog->image) }}" alt="User Image"
                                        id="preview_image" height="150px" width="auto">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div hidden id="description" data-action="{{ route('blog.description') }}"></div>
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            write blog
                                        </h3>
                                    </div>
                                    <div class="card-body ">
                                        <textarea id="summernote" name="description">
                                        {{ $blog->description }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('links')

{!! JsValidator::formRequest('App\Http\Requests\UpdateBlogRequest', '#blog-update') !!}

<script src="{{ asset('assets/custom_js/validate/blog.js') }}"></script>

<script src="{{ asset('assets/custom_js/descriptionImageUpload.js') }}"></script>
@endsection
