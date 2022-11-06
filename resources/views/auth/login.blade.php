@php
    use \App\Helpers\AppHelper;
    $helper = AppHelper::instance();
@endphp

@extends('layouts.auth')

@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>

        <!-- Content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">
                <!-- page content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <img src="{{ $helper->getGeneralSettigns()->logo }}" class="logo" alt="{{ $helper->getGeneralSettigns()->companyName }}">
                            <p class="text-muted mb-4 text-bold">{{ __('Please Select A Login ') }}</p>
                            <form method="POST" action="{{ route('check.user') }}" class="login-form">
                                @csrf
                            <select type="text" class="form-control form-select" name="user">
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="wholeseller">Whole Seller</option>
                            <option value="retailer">Retailer</option>
                            <option value="shopkeeper">Shopkeeper</option>
                            <option value="customer">Customer</option>
                            </select>
                            <br>
                            <button class="btn btn-danger w-100" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div><!-- End page content -->
            </div>
        </div><!-- End content half-->
    </div>
</div>
@endsection
