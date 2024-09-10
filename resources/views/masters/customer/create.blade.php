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
            <h3 class="mb-0"><b>Add Customer Master</b></h3>
        </div>
        <hr>

        <form action="{{ route('customer.store') }}" method="POST" id="customer-form">
            @csrf
            <div class="tab-content" id="tabcontent">
                <div class="row mb-4 mt-3">
                    <div class="form-group col-md-4">
                        <label for="customer_name"><b>Customer Name*</b></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Customer Name"
                            value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email"><b>Email</b></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email"
                            value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone_number"><b>Phone Number*</b></label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            placeholder="Enter Phone Number" value="{{ old('phone_number') }}"">
                        @error('phone_number')
                        <span class=" text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-group col-md-4">
                        <label for="payment_terms"><b>Payment Terms</b></label>
                        <input type="text" class="form-control" id="payment_terms" name="payment_terms"
                            placeholder="Enter Payment Terms"
                            value="{{ old('payment_terms', $customer->payment_terms ?? '') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="credit_days"><b>Credit Days</b></label>
                        <input type="text" class="form-control" id="credit_days" name="credit_days"
                            placeholder="Enter Credit Days" value="{{ old('credit_days') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="description"><b>Description</b></label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Enter Description" rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-4">
                        <label for="billing_country_id"><b>Country*</b></label>
                        <select class="form-select" name="billing_country_id" id="billing_country_id">
                            <option selected disabled>Select Country</option>
                            @foreach ($countries as $con)
                            <option value="{{ $con->id }}"
                                {{ old('billing_country_id') == $con->id ? 'selected' : '' }}>
                                {{ $con->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('billing_country_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="billing_state_id"><b>State/Region*</b></label>
                        <select class="form-select" name="billing_state_id" id="billing_state_id">
                            <option selected disabled>Select State</option>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('billing_state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('billing_state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="billing_city_id"><b>City*</b></label>
                        <select class="form-select" name="billing_city_id" id="billing_city_id">
                            <option selected disabled>Select City</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('billing_city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                    @error('billing_city_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="address"><b>Address*</b></label>
                        <textarea class="form-control" id="billing_address" name="billing_address"
                            placeholder="Enter Address" rows="3">{{ old('address') }}</textarea>
                    </div>
                    @error('billing_address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="row mb-2">
                    <div class="col-md-12 d-flex align-items-center">
                        <h5 class="mb-0 me-2">Shipping Address*</h5>
                        <input class="form-check-input" type="checkbox" id="same_as_billing" name="same_as_billing">
                        <label class="form-check-label" for="same_as_billing"></label>
                        <h5>(Same as Billing Address)</h5>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-4">
                        <label for="shipping_country_id"><b>Country*</b></label>
                        <select class="form-select" name="shipping_country_id" id="shipping_country_id">
                            <option selected disabled>Select Country</option>
                            @foreach ($countries as $con)
                            <option value="{{ $con->id }}">{{ $con->name }}</option>
                            @endforeach
                        </select>
                        @error('shipping_country_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="shipping_state_id"><b>State/Region*</b></label>
                        <select class="form-select" name="shipping_state_id" id="shipping_state_id">
                            <option selected disabled>Select State</option>
                        </select>
                        @error('shipping_state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="shipping_city_id"><b>City*</b></label>
                        <select class="form-select" name="shipping_city_id" id="shipping_city_id">
                            <option selected disabled>Select City</option>
                        </select>
                        @error('shipping_city_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label for="shipping_address_detail"><b>Address</b></label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address"
                            placeholder="Enter Address" rows="3">{{ old('address') }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gst_registration_number"><b>GST Registration Number</b></label>
                        <input type="text" class="form-control" id="gst_number" name="gst_number"
                            placeholder="Enter GST Registration Number" value="{{ old('gst_number') }}">
                    </div>
                </div>
                <div class="row mb-3 d-flex">

                    <div class="form-group col-md-6">
                        <label for="services"><b>Services</b></label>
                        <div>
                            @foreach ($services as $service)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                    name="services[]" id="service_{{ $service->id }}">
                                <label class="form-check-label" for="service_{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group col-md-6 justify-content-end">
                        <label for="assigned_to"><b>Assigned To*</b></label>
                        <select class="form-select" name="assigned_to" id="assigned_to">
                            <option value="" disabled selected>Select Assigned To</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="form-group mb-2 mr-3">
                            <a href="{{ route('customer.index') }}" class="btn btn-cancel btn-block">Cancel</a>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-save btn-block">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    $('#assigned_to').select2({
        placeholder: "Select Assigned To",
        allowClear: true
    });
});
    $(document).ready(function() {
            $('#billing_country_id').change(function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: "{{ route('get_states', ':id') }}".replace(':id', countryId),
                        type: 'GET',
                        success: function(states) {
                            $('#billing_state_id').empty().append(
                                '<option value="">Select State</option>');
                            $.each(states, function(key, state) {
                                $('#billing_state_id').append('<option value="' + state
                                    .id + '">' + state.name + '</option>');
                            });
                            $('#billing_city_id').empty().append(
                                '<option value="">Select City</option>');
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading states: ", error);
                        }
                    });
                }
            });

            $('#billing_state_id').change(function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: "{{ route('get_cities', ':id') }}".replace(':id', stateId),
                        type: 'GET',
                        success: function(cities) {
                            $('#billing_city_id').empty().append(
                                '<option value="">Select City</option>');
                            $.each(cities, function(key, city) {
                                $('#billing_city_id').append('<option value="' + city
                                    .id + '">' + city.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading cities: ", error);
                        }
                    });
                }
            });

            $('#shipping_address').change(function() {
                if ($(this).is(':checked')) {
                    var billingCountry = $('#billing_country_id').val();
                    $('#shipping_country_id').val(billingCountry).change();

                    var billingState = $('#billing_state_id').val();
                    $('#shipping_state_id').val(billingState).change();

                    var billingCity = $('#billing_city_id').val();
                    $('#shipping_city_id').val(billingCity);

                    var billingAddress = $('#billing_address').val();
                    $('#shipping_address').val(billingAddress);
                } else {
                    $('#shipping_country_id').val('').change();
                    $('#shipping_state_id').val('').change();
                    $('#shipping_city_id').val('');
                    $('#shipping_address').val('');
                }
            });

            $('#shipping_country_id').change(function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: "{{ route('get_states', ':id') }}".replace(':id', countryId),
                        type: 'GET',
                        success: function(states) {
                            $('#shipping_state_id').empty().append(
                                '<option value="">Select State</option>');
                            $.each(states, function(key, state) {
                                $('#shipping_state_id').append('<option value="' + state
                                    .id + '">' + state.name + '</option>');
                            });
                            $('#shipping_city_id').empty().append(
                                '<option value="">Select City</option>');
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading states: ", error);
                        }
                    });
                }
            });

            $('#shipping_state_id').change(function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: "{{ route('get_cities', ':id') }}".replace(':id', stateId),
                        type: 'GET',
                        success: function(cities) {
                            $('#shipping_city_id').empty().append(
                                '<option value="">Select City</option>');
                            $.each(cities, function(key, city) {
                                $('#shipping_city_id').append('<option value="' + city
                                    .id + '">' + city.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading cities: ", error);
                        }
                    });
                }
            });
        });

        $('#same_as_billing').change(function() {
            if ($(this).is(':checked')) {

                $('#shipping_country_id').val($('#billing_country_id').val()).trigger('change');

                setTimeout(function() {
                    $('#shipping_state_id').val($('#billing_state_id').val()).trigger('change');

                    setTimeout(function() {
                        $('#shipping_city_id').val($('#billing_city_id').val());
                    }, 300);
                }, 300);


                $('#shipping_address').val($('#billing_address').val());
            } else {

                $('#shipping_country_id').val('').change();
                $('#shipping_state_id').val('').change();
                $('#shipping_city_id').val('').change();
                $('#shipping_address').val('');
            }
        });
</script>
@endsection
