@extends('admin/layouts.app');
@section('content')
<div class="pagetitle">
    <h1>Categories</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Catoegory List</li>
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
                    <h5 class="card-title">All Categories</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isNotEmpty())

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($category->category_image != '')
                                                <img style="width: 50%; height: 50px;"
                                                    src="{{ asset('admin/uploads/category/' . $category->category_image)}}">
                                            @endif
                                        </td>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->category_desc}}</td>
                                        <td>
                                            <a href='{{ route('update.category', $category->id)}}'
                                                class='btn btn-warning btn-sm'>Update</a>
                                            <form action="{{ route('delete.category', $category->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this Category?');">
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
