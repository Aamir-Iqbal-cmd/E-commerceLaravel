@extends('layouts.app');

@section('content')

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">

        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="{{asset('admin/uploads/products/' . $products->pro_image)}}"
                        alt="Card image cap" id="product-detail">
                </div>

            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">{{$products->product_name}}</h1>
                        <p class="h3 py-2">{{$products->product_price}}</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            @php

                                $subcategory = $subcategories->where('id', $products->subcat_id)->first();
                            @endphp
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>{{$subcategory->subcategory_name}}</strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p>{{$products->product_desc}}</p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_title" value="{{ $products->product_name }}">
                            <input type="hidden" name="product_price" value="{{ $products->product_price }}">
                            <input type="hidden" name="product_image" value="{{ $products->pro_image }}">
                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <div class="row pb-3">
                                
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="cart"
                                        value="addtocart">Add To Cart</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Close Content -->
@endsection
