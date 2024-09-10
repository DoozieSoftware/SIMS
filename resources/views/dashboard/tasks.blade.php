@extends('layouts.app')
@extends('layouts.common-scripts')
<link rel="stylesheet" href="{{ asset('build/css/style.css') }}">
@section('title', 'Tasks')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tasks</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ strtoupper($type) }} Tasks</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($tasks->isEmpty() && $completedTasks->isEmpty())
        <p>No tasks available for {{ strtoupper($type) }}</p>
        @else
        <div id="{{ $type }}Tasks" class="table-responsive">
            <h4 style="color:white;">{{ strtoupper($type) }} Tasks</h4>

            <form action="{{ route('dashboard.tasks', ['type' => $type]) }}" method="GET">
                @csrf
                <div class="row mb-3">
                    <div class="form-group col-md-3">
                        <select id="customer" name="customer" class="form-select">
                            <option value="">Select Customer Name</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ request('customer') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('customer')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <select id="month" name="month" class="form-select">
                            <option value="">Select by Month</option>
                            @php
                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                            'September', 'October', 'November', 'December'];
                            @endphp
                            @foreach($months as $month)
                            <option value="{{ $month }}"
                                {{ $month === request('month', $currentMonth) ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                            @endforeach
                        </select>
                        @error('month')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <select id="year" name="year" class="form-select">
                            <option value="">Select by Year</option>
                            @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == request('year', now()->year) ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                            @endforeach
                        </select>
                        @error('year')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-save btn-block" id="save_btn">Search</button>
                    </div>
                </div>
            </form>
            <hr>

            <form action="{{ route('update.task.status', ['type' => $type]) }}" method="POST">
                @csrf
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->customer ? $task->customer->name : 'N/A' }}</td>
                            <td>
                                <select name="tasks[{{ $task->id }}][status]" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                                    <option value="not_done"
                                        {{ $task->status == 'not_done' || !$task->status ? 'selected' : '' }}>Not Done
                                    </option>
                                </select>
                            </td>
                            <td><textarea name="remarks" class="form-control" rows="1"></textarea></td>
                            <td>
                                <button type="submit" class="btn btn-save btn-block" id="save_btn">Save</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>

            @if($completedTasks->isNotEmpty())
            <h4 style="color:white;">{{ strtoupper($type) }} Completed Tasks</h4><br>
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Completed On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($completedTasks as $task)
                    <tr>
                        <td>{{ $task->customer ? $task->customer->name : 'N/A' }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->status_remarks }}</td>
                        <td>{{ $task->action_on }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        @endif
    </div>
    <div class="form-row mb-4">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="form-group mb-2 mr-3">
                <a href="{{ route('dashboard') }}" class="btn btn-cancel btn-block">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection
