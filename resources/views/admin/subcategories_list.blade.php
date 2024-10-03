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
                                <th>Subcategory Name</th>
                                <th>Description</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subcategories->isNotEmpty() && $categories->isNotEmpty())
                                                    @foreach ($subcategories as $Subcategory)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $Subcategory->subcategory_name }}</td>
                                                                                <td>{{ $Subcategory->subcategory_desc }}</td>
                                                                                <td>
                                                                                    @php
                                                                                        $category = $categories->where('id', $Subcategory->category_id)->first();
                                                                                    @endphp
                                                                                    {{ $category ? $category->category_name : 'No Category' }}
                                                                                </td>

                                                                                <td>
                                                                                    <a href='{{ route('update.subcategory', $Subcategory->id) }}'
                                                                                        class='btn btn-warning btn-sm'>Update</a>
                                                                                    <form action="{{ route('delete.subcategory', $Subcategory->id) }}" method="POST"
                                                                                        onsubmit="return confirm('Are you sure you want to delete this Subcategory?');">
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
