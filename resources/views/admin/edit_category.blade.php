@extends('admin/layouts.app');
@section('content')
<div class="pagetitle">
    <h1>Category</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Update catoegory</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Floating Labels Form -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3">
                                    <strong>Success!</strong> {{Session::get('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h5 class="card-title">Update Category</h5>
                            <form method="POST" action="{{route('edit.category', $category->id)}}" class="row g-3">
                                @method('put')
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="category_name" value="{{ old('category_name', $category->category_name)}}"
                                            class="@error('category_name') is-invalid @enderror form-control"
                                            id="floatingName" placeholder="Category Name">
                                        @error('category_name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingName">Category Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="file" name="cat_image" 
                                            class="@error('cat_image') is-invalid @enderror form-control"
                                            id="floatingImage">
                                        @error('cat_image')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingImage">Image</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="category_desc" class="form-control"
                                            placeholder="Category Description" id="floatingTextarea"
                                            style="height: 90px;">{{ $category->category_desc}}</textarea>
                                        <label for="floatingTextarea">Category Description</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="update_category" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                </div>
            </div>
        </div><!-- End Left side columns -->

    </div>
</section>
@endsection
