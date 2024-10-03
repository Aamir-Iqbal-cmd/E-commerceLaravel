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
                    <div class="col-md-10">

                    </div>
                    <div class="col-md-2">
                        <div class="col d-grid float-left">
                            <a href="{{url('/cart')}}" class="btn btn-success btn-sm" name="submit" value="buy">Go
                                Back</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Information</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="floatingName"
                                        placeholder="Your Name" required>
                                    <label for="floatingName">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="floatingEmail"
                                        placeholder="Your Email" required>
                                    <label for="floatingEmail">Your Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control" id="floatingPhone"
                                        placeholder="Your Phone" required>
                                    <label for="floatingPhone">Your Phone</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="address" placeholder="Address"
                                        id="floatingTextarea" style="height: 100px;" required></textarea>
                                    <label for="floatingTextarea">Address</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg">Submit</button>
                            </div>
                        </form>
                        <!-- End floating Labels Form -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Close Content -->
@endsection
