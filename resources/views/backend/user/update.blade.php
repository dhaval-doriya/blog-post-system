@extends('backend.layout.master')

@section('title', 'update user')
@section('path', 'update user')
@section('Pagename', 'User')


@section('headerlinks')

    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <link rel="stylesheet" href="{{ asset('assets/custom_css/updateprofile.css') }}">
@endsection

@section('maindata')

    <section class="content container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Update User</h2>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update User Form</h3>
                    </div>

                    @if (auth()->user()->role == 'user')
                        <div class="profile_image">
                            <div id="profileRoute" hidden data-action="{{ route('profile.edit', ['id' => $user->id]) }}">
                            </div>
                            <div class="container" align="center">
                                <br />
                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="image_area">
                                            <form method="post">
                                                <label for="upload_image">
                                                    @if ($user->profile_image)
                                                        <img src="{{ asset('profile-images/' . $user->profile_image) }}"
                                                            id="uploaded_image" class="img-responsive img-circle"
                                                            height="250px" />
                                                    @else
                                                        <img src="{{ asset('assets/dashboard/dist/img/user2-160x160.jpg') }}"
                                                            id="uploaded_image" class="img-responsive img-circle"
                                                            height="250px" />
                                                    @endif
                                                    <div class="overlay">
                                                        <div class="text">Click to Change Profile Image</div>
                                                    </div>
                                                    <input type="file" name="image" class="image" id="upload_image"
                                                        style="display:none" accept="image/png, image/gif, image/jpeg" />
                                                </label>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                        aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Crop Image Before Upload</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="img-container">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <img src="" id="sample_image" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="preview"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="crop"
                                                        class="btn btn-primary">Crop</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="remove-profile-btn" @if ($user->profile_image) @else hidden @endif>
                                <div class="d-flex justify-content-center mt-3">
                                    <form action="{{ route('profile.remove', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Picture
                                            <i class="fa fa-trash " aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @endif

                    <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="name" class="form-control" placeholder="Enter name"
                                    value="{{ $user->name }}" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="title">Phone</label>
                                <input type="name" class="form-control" placeholder="Enter phone number"
                                    value="{{ $user->phone }}" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

    </section>



@endsection
@section('links')
    <script src="{{ asset('assets/custom_js/uploadProfile.js') }}"></script>
@endsection
