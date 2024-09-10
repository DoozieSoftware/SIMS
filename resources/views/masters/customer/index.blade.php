@extends('layouts.app')
@extends('layouts.common-scripts')
<link rel="stylesheet" href="{{ asset('build/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('title')
Customer
@endsection
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
            <h3 class="mb-0"><b>Customer Master</b></h3>
            <a href="{{ route('customer.create') }}" class="btn btn-primary btn-add">
                Add Customer
            </a>
        </div>
        <div class="search-bar flex-grow-1">
            <div class="position-relative">
                <div class="col-lg-5">
                    <input class="form-control rounded-5 px-6 search-control d-lg-block d-none" type="text"
                        placeholder="Search by Customer Name, Aadhar Number">
                </div>
            </div>
        </div>
        <hr>
        <div class="row gy-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Assigned To</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone_number }}</td>
                                <td>
                                    @if ($customer->services->isNotEmpty())
                                    @foreach ($customer->services as $service)
                                    {{ $service->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                    @else
                                    No Services Selected
                                    @endif
                                </td>
                                <td>{{ $customer->employee ? $customer->employee->first_name : 'N/A' }}</td>
                                <td>
                                    @if (is_null($customer->deleted_at))
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('customer.edit', $customer->id) }}"
                                            class="btn btn-edit btn-sm me-2 rounded">
                                            Edit
                                        </a>
                                        <a href="{{ route('customer.show', $customer->id) }}"
                                            class="btn btn-view btn-sm me-2 rounded">
                                            View
                                        </a>

                                        @if ($customer->deleted_at == null)
                                        <form id="deactivate-form-{{ $customer->id }}" method="POST"
                                            action="{{ route('customer.deactivate', $customer->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-deactivate btn-sm rounded deactivate-btn"
                                                data-id="{{ $customer->id }}"
                                                onclick="confirmDeactivation(event, '{{ $customer->id }}')">Deactivate</button>
                                        </form>
                                        @else
                                        <form id="activate-form-{{ $customer->id }}" method="POST"
                                            action="{{ route('customer.activate', $customer->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-activate btn-sm rounded activate-btn"
                                                data-id="{{ $customer->id }}"
                                                onclick="confirmActivation(event, '{{ $customer->id }}')">Activate</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    function confirmDeactivation(ev, customerId) {
            ev.preventDefault();
            swal({
                    title: "Are you sure you want to deactivate this?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDeactivate) => {
                    if (willDeactivate) {
                        document.getElementById('deactivate-form-' + customerId).submit();
                    }
                });
        }

        function confirmActivation(ev, customerId) {
            ev.preventDefault();
            swal({
                    title: "Are you sure you want to activate this?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willActivate) => {
                    if (willActivate) {
                        document.getElementById('activate-form-' + customerId).submit();
                    }
                });
        }
</script>
@endsection
