@extends('layouts.app');

@section('content')

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">

        <div class="row">
            <div class="col-lg-0 mt-5">
                <div class="card mb-1">

                </div>

            </div>
            <!-- col end -->
            <div class="col-lg-12 mt-5">
                <div class="row mb-4">
                    <div class="col-md-9">
                        <h3>Cart Items List</h3>
                    </div>
                    <div class="col-md-2">
                        <div class="col d-grid float-left">
                            <a href="{{ url('/shop') }}" class="btn btn-success btn-sm" name="submit" value="buy">Add
                                More</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <h3>Your Cart</h3>

                        @if(!empty($cart) && count($cart) > 0)
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php    $grandTotal = 0; @endphp <!-- Initialize grand total variable -->

                                                    @foreach($cart as $product)
                                                                                @php
                                                                                    // Calculate total price for each product
                                                                                    $productTotal = $product['price'] * $product['quantity'];
                                                                                    // Add to grand total
                                                                                    $grandTotal += $productTotal;
                                                                                @endphp

                                                                                <tr>
                                                                                    <td>
                                                                                        <img src="{{ asset('admin/uploads/products/' . $product['image']) }}"
                                                                                            alt="{{ $product['title'] }}" width="70" height="70">
                                                                                    </td>
                                                                                    <td>{{ $product['title'] }}</td>
                                                                                    <td>${{ number_format($product['price'], 2) }}</td>
                                                                                    <td>{{ $product['quantity'] }}</td>
                                                                                    <td>${{ number_format($productTotal, 2) }}</td> <!-- Display product total -->
                                                                                    <td>
                                                                                        <form action="{{ route('cart.remove', $product['id']) }}" method="POST">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                                                        </form>
                                                                                    </td>
                                                                                </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <div class="col-md-9 text-end">
                                                    <!-- Display Grand Total -->
                                                    <h4>Grand Total: ${{ number_format($grandTotal, 2) }}</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-grid float-left">
                                                        <a href="{{ url('/checkout') }}" class="btn btn-success btn-sm">Checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                        @else
                            <p>Your cart is empty.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- Close Content -->
@endsection
