@extends('admin/layouts.app');
@section('content')
<div class="pagetitle">
    <h1>Subcategory</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Add Subcatoegory</li>
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
                            <h5 class="card-title">Add New Subcategory</h5>
                            <form method="POST" action="{{ route('creat.subcategory')}}" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="subcategory_name"
                                            class="@error('subcategory_name') is-invalid @enderror form-control"
                                            id="floatingName" placeholder="Category Name">
                                        @error('subcategory_name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingName">Subcategory Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="@error('cat_id') is-invalid @enderror form-select" name="cat_id"
                                            id="floatingSelect" aria-label="subcategory">
                                            <option selected="" disabled="" value="">--------</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('cat_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingSelect">Select Category</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="subcategory_desc" class="form-control"
                                            placeholder="SubCategory Description" id="floatingTextarea"
                                            style="height: 90px;"></textarea>
                                        <label for="floatingTextarea">Subcategory Description</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="add_subcategory" class="btn btn-primary">Submit</button>
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
