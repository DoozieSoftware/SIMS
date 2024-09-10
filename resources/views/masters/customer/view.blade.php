@extends('layouts.app')
@extends('layouts.common-scripts')
<link rel="stylesheet" href="{{ asset('build/css/style.css') }}">
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Masters</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Master</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0"><b>View Customer Master</b></h3>
        </div>
        <hr>

        <div class="tab-content" id="tabcontent">
            <div class="row mb-4 mt-3">
                <div class="form-group col-md-4">
                    <label for="customer_name"><b>Customer Name</b></label>
                    <input type="text" class="form-control" id="customer_name"
                        value="{{ old('name', $customers->name) }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="email_id"><b>Email Id</b></label>
                    <input type="text" class="form-control" id="email_id" value="{{ old('email', $customers->email) }}"
                        disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="phone_number"><b>Phone Number</b></label>
                    <input type="text" class="form-control" id="phone_number"
                        value="{{ old('phone_number', $customers->phone_number) }}" disabled>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-md-4">
                    <label for="payment terms"><b>Payment Terms</b></label>
                    <input type="text" class="form-control" id="payment terms"
                        value="{{ old('payment_terms', $customers->payment_terms) }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="credit days"><b>Credit Days</b></label>
                    <input type="text" class="form-control" id="credit days"
                        value="{{ old('credit_days', $customers->credit_days) }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="description"><b>Description</b></label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        disabled>{{ $customers->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-4">
                    <label for="billing_country_id"><b>Country</b></label>
                    <input type="text" class="form-control w-3" name="billing_country_id" id="billing_country_id"
                        value="{{ $customers->billingCountry ? $customers->billingCountry->name : '' }}" disabled>
                </div>

                <div class="form-group col-md-4">
                    <label for="billing_state_id"><b>State</b></label>
                    <input type="text" class="form-control w-3" name="billing_state_id" id="billing_state_id"
                        value="{{ $customers->billingState ? $customers->billingState->name : '' }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="billing_city_id"><b>City</b></label>
                    <input type="text" class="form-control w-3" name="billing_city_id" id="billing_city_id"
                        value="{{ $customers->billingCity ? $customers->billingCity->name : '' }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label for="address"><b>Address</b></label>
                    <textarea class="form-control" id="address" rows="3"
                        disabled>{{ $customers->billing_address }}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 d-flex align-items-center">
                    <h5 class="mb-0 me-2">Shipping Address</h5>

                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-4">
                    <label for="shipping_country_id"><b>Country</b></label>
                    <input type="text" class="form-control w-3" name="shipping_country_id" id="shipping_country_id"
                        value="{{ $customers->shippingCountry ? $customers->shippingCountry->name : '' }}" disabled>
                </div>

                <div class="form-group col-md-4">
                    <label for="shipping_state_id"><b>State</b></label>
                    <input type="text" class="form-control w-3" name="shipping_state_id" id="shipping_state_id"
                        value="{{ $customers->shippingState ? $customers->shippingState->name : '' }}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="shipping_city_id"><b>City</b></label>
                    <input type="text" class="form-control w-3" name="shipping_city_id" id="shipping_city_id"
                        value="{{ $customers->shippingCity ? $customers->shippingCity->name : '' }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label for="address"><b>Address</b></label>
                    <textarea class="form-control" id="address" rows="3"
                        disabled>{{ $customers->billing_address }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="gst_registration_number"><b>GST Registration Number</b></label>
                    <input type="text" class="form-control" id="gst_registration_number"
                        value="{{ old('gst_number', $customers->gst_number) }}" disabled>
                </div>
            </div>
            <div class="row mb-3 d-flex">
                <div class="form-group col-md-6">
                    <label for="services"><b>Services</b></label>
                    <div>
                        @foreach ($services as $service)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $service->id }}" name="services[]"
                                id="service_{{ $service->id }}"
                                {{ $customers->services->contains($service->id) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="service_{{ $service->id }}">
                                {{ $service->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="assigned_to"><b>Assigned To</b></label>
                    <input type="text" class="form-control w-3" name="assigned_to" id="assigned_to"
                        value="{{ $customers->assignedUser ? $customers->assignedUser->first_name . ' ' : 'Not assigned' }}"
                        disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row mb-4">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="form-group mb-2 mr-3">
                <a href="{{ route('customer.index') }}" class="btn btn-cancel btn-block">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection
