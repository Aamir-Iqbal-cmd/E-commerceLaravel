@extends('admin/layouts.app')
@section('content')
<div class="pagetitle">
    <h1>Update Product</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Update Product</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
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
                                    <strong>Success!</strong> {{ Session::get('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <h5 class="card-title">Update Product</h5>

                            <!-- Update Product Form -->
                            <form method="POST" action="{{ route('edit.product', $product->id)}}" class="row g-3" enctype="multipart/form-data">
                                @csrf
                                @method('put') <!-- For updating records -->

                                <!-- Product Name -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="product_name"
                                            value="{{ old('product_name', $product->product_name ) }}"
                                            class="@error('product_name') is-invalid @enderror form-control"
                                            id="floatingName" placeholder="Product Name">
                                        @error('product_name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingName">Product Name</label>
                                    </div>
                                </div>

                                <!-- Product Price -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="product_price"
                                            value="{{ old('product_price', $product->product_price) }}"
                                            class="@error('product_price') is-invalid @enderror form-control"
                                            id="floatingPrice" placeholder="Product Price">
                                        @error('product_price')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingPrice">Product Price</label>
                                    </div>
                                </div>

                                <!-- Product Category -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="@error('cat_id') is-invalid @enderror form-select" name="cat_id"
                                            id="categorySelect" aria-label="Select Product Category">
                                            <option selected disabled value="">Select a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('cat_id', $product->cat_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('cat_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="categorySelect">Select Product Category</label>
                                    </div>
                                </div>

                                <!-- Product Subcategory -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="@error('subcat_id') is-invalid @enderror form-select" name="subcat_id"
                                            id="subcategorySelect" aria-label="Select Subcategory">
                                            <option selected disabled value="">Select a Subcategory</option>
                                            @if($subcategories)
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ old('subcat_id', $product->subcat_id) == $subcategory->id ? 'selected' : '' }}>
                                                        {{ $subcategory->subcategory_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('subcat_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="subcategorySelect">Select Product Subcategory</label>
                                    </div>
                                </div>

                                <!-- Product Quantity -->
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" name="quantity"
                                            value="{{ old('quantity', $product->quantity) }}"
                                            class="@error('quantity') is-invalid @enderror form-control"
                                            id="floatingQuantity" placeholder="Quantity" min="0">
                                        @error('quantity')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingQuantity">Quantity</label>
                                    </div>
                                </div>

                                <!-- Product Image -->
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="file" name="pro_image"
                                            class="@error('pro_image') is-invalid @enderror form-control"
                                            id="floatingImage">
                                        @error('pro_image')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <label for="floatingImage">Image</label>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="product_desc" class="form-control"
                                            placeholder="Product Description" id="floatingTextarea"
                                            style="height: 90px;">{{ old('product_desc', $product->product_desc) }}</textarea>
                                        <label for="floatingTextarea">Product Description</label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#categorySelect').on('change', function () {
            var categoryId = $(this).val();
            $('#subcategorySelect').html('<option selected disabled value="">Select a Subcategory</option>');

            $.ajax({
                url: '{{ url("/get-subcategories") }}',
                type: 'POST',
                data: {
                    cat_id: categoryId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $.each(response, function (index, subcategory) {
                        $('#subcategorySelect').append('<option value="' + subcategory.id + '">' + subcategory.subcategory_name + '</option>');
                    });
                },
                error: function () {
                    alert('Failed to fetch subcategories. Please try again.');
                }
            });
        });
    });
</script>

@endsection
