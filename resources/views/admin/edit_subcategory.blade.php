@extends('admin/layouts.app');
@section('content')
<div class="pagetitle">
    <h1>Subcategory</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Update Subcatoegory</li>
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
                            <h5 class="card-title">Update Subcategory</h5>
                            <form method="POST" action="{{route('edit.subcategory', $subcategory->id)}}" class="row g-3">
                                @method('put')
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="subcategory_name" value="{{ old('subcategory_name', $subcategory->subcategory_name)}}"
                                            class="@error('category_name') is-invalid @enderror form-control"
                                            id="floatingName" placeholder="Subcategory Name">
                                        @error('category_name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingName">Subategory Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="@error('cat_id') is-invalid @enderror form-select" name="cat_id"
                                            id="floatingSelect" aria-label="subcategory">
                                            <option selected="" disabled="" value="">--------</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('cat_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
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
                                            placeholder="Subcategory Description" id="floatingTextarea"
                                            style="height: 90px;">{{ $subcategory->subcategory_desc}}</textarea>
                                        <label for="floatingTextarea">Subategory Description</label>
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
