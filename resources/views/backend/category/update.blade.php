@extends('backend.layout.master')

@section('title', 'update category')
@section('path', 'update category')
@section('Pagename', 'Category')


@section('maindata')

<section class="content container">
  <div class="row">
    <h4 class="mt-5">Update Category</h4>
    <div class="col-md-12 mt-2">
      <div class="card card-primary shadow-lg mb-5 bg-white rounded">
        <div class="card-header">
          <h3 class="card-title">Category</h3>
        </div>
        <form action="{{route('category.update',['category' => $category->id])}}" method="post" id="category-update">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              @if($errors->has('name'))
              <div class="error text-danger">{{ $errors->first('name') }}</div>
              @endif
              <label for="title">category name</label>
              <input type="name" class="form-control" placeholder="Enter Category name" value="{{$category->name}}" name="name" id="name">
            </div>
            <div class="form-group">
              @if($errors->has('slug'))
              <div class="error text-danger">{{ $errors->first('slug') }}</div>
              @endif
              <label for="title">category slug</label>
              <input type="name" class="form-control" value="{{$category->slug}}" placeholder="Enter category slug" name="slug" id="slug" data-action="{{route('category.slug')}}" data-id="{{$category->id}}" content="{{ csrf_token() }}">
              <p class="error-slug text-danger"></p>
              <p class="success-slug text-success"></p>
            </div>
          </div>
          <div class="card-footer">
            <button id="submit" data-action="{{route('category.edit',['category' => $category->id])}}" class="btn btn-primary category-update">category-update</button>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection
@section('links')

    <script src="{{ asset('assets/custom_js/validate/category.js') }}"></script>

@endsection
