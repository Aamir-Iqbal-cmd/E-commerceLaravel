@extends('admin/layouts.app');
@section('content')
<div class="pagetitle">
    <h1>Subcategories</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Subcatoegory List</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3">
                            <strong>Success!</strong> {{Session::get('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="card-title">All
                        Sub categories</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Products Name</th>
                                <th>Products Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Subcategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->isNotEmpty() && $subcategories->isNotEmpty())
                                                    @foreach ($products as $product)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>
                                                                                    @if($product->pro_image != '')
                                                                                        <img style="width: 50%; height: 50px;"
                                                                                            src="{{ asset('admin/uploads/products/' . $product->pro_image)}}">
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $product->product_name }}</td>
                                                                                <td>{{ $product->product_price }}</td>
                                                                                <td>{{ $product->quantity }}</td>
                                                                                <td>{{ $product->product_desc }}</td>
                                                                                <td>
                                                                                    @php
                                                                                        $subcategories = $subcategories->where('id', $product->subcat_id)->first();
                                                                                    @endphp
                                                                                    {{ $subcategories ? $subcategories->subcategory_name : 'No Product' }}
                                                                                </td>
                                                                                <td>
                                                                                    <a href='{{ route('update.product', $product->id) }}'
                                                                                        class='btn btn-warning btn-sm'>Update</a>

                                                                                    <form action="{{ route('delete.product', $product->id) }}" method="POST"
                                                                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                                    </form>



                                                                                </td>
                                                                            </tr>
                                                    @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>

            </div>

        </div>

    </div>
</section>
@endsection
