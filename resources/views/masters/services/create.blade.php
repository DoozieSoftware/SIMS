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
                <li class="breadcrumb-item active" aria-current="page">Service Master</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0"><b>Add Service Master</b></h3>
        </div>
        <hr>

        <div class="tab-content" id="tabcontent">
            <div class="row mb-4 mt-3">
                <div class="form-group col-md-4">
                    <label for="name"><b>Service Name*</b></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Service Name"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="details"><b>Details</b></label>
                    <textarea class="form-control" id="details" name="details" placeholder="Enter Details"
                        rows="3">{{ old('details') }}</textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="frequency_type"><b>Frequency*</b></label>
                    <select id="frequency_type" name="frequency_type" class="form-select">
                        @error('frequency_type')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <option value="">Select Frequency</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="biannually">Bi Annually</option>
                        <option value="annually">Annually</option>
                        <option value="onetime">One-Time</option>
                    </select>
                    @error('frequency_type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 card-wrapper" id="monthly-card" style="display: none;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Monthly</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Month Name</th>
                                    <th>From Day</th>
                                    <th>To Day</th>
                                </tr>
                            </thead>
                            <tbody id="monthly_table">
                                @php
                                $index = 0;
                                @endphp
                                @foreach (['january', 'february', 'march', 'april', 'may', 'june', 'july',
                                'august', 'september', 'october', 'november', 'december'] as $month)
                                <tr data-row_id="{{ $index }}">
                                    <td>
                                        <input type="checkbox" data-row_id="{{ $index }}"
                                            class="form-check-input select_month">
                                    </td>
                                    <td class="month_name" data-row_id="{{ $index }}">{{ ucfirst($month) }}</td>
                                    <td>
                                        <input type="number" data-row_id="{{ $index }}" class="form-control from_day"
                                            min="1" max="31">
                                    </td>
                                    <td>
                                        <input type="number" data-row_id="{{ $index }}" class="form-control to_day"
                                            min="1" max="31">
                                    </td>
                                </tr>
                                @php
                                $index++;
                                @endphp
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 card-wrapper" id="quarterly-card" style="display: none;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Quarterly</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Quarter Name</th>
                                    <th>From Month</th>
                                    <th>From Day</th>
                                    <th>To Month</th>
                                    <th>To Day</th>
                                </tr>
                            </thead>
                            <tbody id="quarterly_table">
                                @foreach ([
                                'january-march' => 'January-March',
                                'april-june' => 'April-June',
                                'july-september' => 'July-September',
                                'october-december' => 'October-December'
                                ] as $index => $label)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="quarter_{{ $index }}" name="quarter_name"
                                            value="{{ $index }}" class="form-check-input select_month"
                                            data-row_id="{{ $index }}">
                                    </td>
                                    <td class="quarter_name" data-row_id="{{ $index }}">{{ $label }}</td>
                                    <td>
                                        <select id="month_{{ $index }}" name="from_month[{{ $index }}]"
                                            data-row_id="{{ $index }}" class="form-select from_month">
                                            <option value="">Select Month</option>
                                            @if ($index == 'january-march')
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            @elseif ($index == 'april-june')
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            @elseif ($index == 'july-september')
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            @elseif ($index == 'october-december')
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" data-row_id="{{ $index }}" class="form-control from_day"
                                            min="1" max="31">
                                    </td>
                                    <td>
                                        <select id="month_{{ $index }}" name="to_month[{{ $index }}]"
                                            data-row_id="{{ $index }}" class="form-select to_month">
                                            <option value="">Select Month</option>
                                            @if ($index == 'january-march')
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            @elseif ($index == 'april-june')
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            @elseif ($index == 'july-september')
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            @elseif ($index == 'october-december')
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" data-row_id="{{ $index }}" class="form-control to_day"
                                            min="1" max="31">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 card-wrapper" id="biannually-card" style="display: none;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5> Bi Annually</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Biannual Name</th>
                                    <th>From Month</th>
                                    <th>From Day</th>
                                    <th>To Month</th>
                                    <th>To Day</th>
                                </tr>
                            </thead>
                            <tbody id="biannually_table">
                                @foreach ([
                                'january-june' => 'January-June',
                                'july-december' => 'July-December'
                                ] as $index => $label)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="biannual_{{ $index }}" name="biannual_name"
                                            value="{{ $index }}" class="form-check-input select_month"
                                            data-row_id="{{ $index }}">
                                    </td>
                                    <td class="biannual_name" data-row_id="{{ $index }}">{{ $label }}</td>
                                    <td>
                                        <select id="month_{{ $index }}" name="from_month[{{ $index }}]"
                                            data-row_id="{{ $index }}" class="form-select from_month">
                                            <option value="">Select Month</option>
                                            @if ($index == 'january-june')
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            @elseif ($index == 'july-december')
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" data-row_id="{{ $index }}" class="form-control from_day"
                                            min="1" max="31">
                                    </td>
                                    <td>
                                        <select id="month_{{ $index }}" name="to_month[{{ $index }}]"
                                            class="form-select to_month" data-row_id="{{ $index }}">
                                            <option value="">Select Month</option>
                                            @if ($index == 'january-june')
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            @elseif ($index == 'july-december')
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" data-row_id="{{ $index }}" class="form-control to_day"
                                            min="1" max="31">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 card-wrapper" id="onetime-card" style="display: none;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5> One Time</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                </tr>
                            </thead>
                            <tbody id="onetime_table">
                                @foreach (['range_1'] as $index => $range)
                                <tr>
                                    <td>
                                        <input type="date" data-row_id="{{ $index }}" class="form-control from_date">
                                    </td>
                                    <td>
                                        <input type="date" data-row_id="{{ $index }}" class="form-control to_date">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-md-12 card-wrapper" id="annually-card" style="display: none;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Annually</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>From Month</th>
                                    <th>From Day</th>
                                    <th>To Month</th>
                                    <th>To Day</th>
                                </tr>
                            </thead>
                            <tbody id="annually_table">
                                @foreach ([
                                'january-december' => ['from_month' => 'January', 'from_day' => 1, 'to_month' =>
                                'December', 'to_day' => 31]
                                ] as $index => $dates)
                                <tr>
                                    <td>
                                        <select name="from_month[{{ $index }}]" class="form-select from_month"
                                            data-row_id="{{ $index }}">
                                            <option value="">Select Month</option>
                                            @foreach ([
                                            'january' => 'January',
                                            'february' => 'February',
                                            'march' => 'March',
                                            'april' => 'April',
                                            'may' => 'May',
                                            'june' => 'June',
                                            'july' => 'July',
                                            'august' => 'August',
                                            'september' => 'September',
                                            'october' => 'October',
                                            'november' => 'November',
                                            'december' => 'December'
                                            ] as $month_value => $month_label)
                                            <option value="{{ $month_value }}"
                                                {{ $month_value === $dates['from_month'] ? 'selected' : '' }}>
                                                {{ $month_label }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="from_day[{{ $index }}]" class="form-control from_day"
                                            min="1" max="31">

                                    </td>
                                    <td>
                                        <select name="to_month[{{ $index }}]" class="form-select to_month"
                                            data-row_id="{{ $index }}">
                                            <option value="">Select Month</option>
                                            @foreach ([
                                            'january' => 'January',
                                            'february' => 'February',
                                            'march' => 'March',
                                            'april' => 'April',
                                            'may' => 'May',
                                            'june' => 'June',
                                            'july' => 'July',
                                            'august' => 'August',
                                            'september' => 'September',
                                            'october' => 'October',
                                            'november' => 'November',
                                            'december' => 'December'
                                            ] as $month_value => $month_label)
                                            <option value="{{ $month_value }}"
                                                {{ $month_value === $dates['to_month'] ? 'selected' : '' }}>
                                                {{ $month_label }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="to_day[{{ $index }}]" class="form-control to_day">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-md-12 d-flex justify-content-end">
                <div class="form-group mb-2 mr-3">
                    <a href="{{ route('services.index') }}" class="btn btn-cancel btn-block">Cancel</a>
                </div>
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-save btn-block" id="save_btn">Save</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#frequency_type').on('change', function() {
        var selectedType = $(this).val();
        $('.card-wrapper').hide();
        if (selectedType) {
            $('#' + selectedType + '-card').show();
        }
    });

   var monthly_type_list = [];
   function updateMonthlyList() {
    monthly_type_list = [];
    $('#monthly_table .select_month:checked').each(function() {
        var row_id = $(this).data('row_id');
        var month_name = $(`.month_name[data-row_id="${row_id}"]`).text().trim();
        var from_day = $(`.from_day[data-row_id="${row_id}"]`).val();
        var to_day = $(`.to_day[data-row_id="${row_id}"]`).val();

        monthly_type_list.push({
            month_name: month_name,
            from_day: from_day,
            to_day: to_day
        });
        console.log("monthly:", monthly_type_list)
    });
}

 $(document).on('change', 'input:checkbox, input.from_day, input.to_day', function() {
    updateMonthlyList();
});
$('#save_btn').click(function(e) {
    e.preventDefault();
    var name = $('#name').val();
    var details = $('#details').val();
    var frequency_type = $('#frequency_type').val();

      if (!name || !frequency_type) {
            alert("Please enter both the service name and select frequency type.");
            return;
        }
    if (frequency_type === "monthly") {
        $.ajax({
            url: '{{ route('services.storeMonthly') }}',
            method: 'POST',
            data: {
            name: name,
            details: details,
            frequency_type: frequency_type,
            monthly_type_list: monthly_type_list,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                window.location.href = '{{ route('services.index') }}';
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});

var quarterly_type_list = [];
function updateQuarterlyList() {
    quarterly_type_list = [];
    $('#quarterly_table .select_month:checked').each(function() {
        var row_id = $(this).attr('data-row_id');
        var quarter_name = $(`.quarter_name[data-row_id="${row_id}"]`).text().trim();
        var from_month = $(`.from_month[data-row_id="${row_id}"]`).val();
        var to_month = $(`.to_month[data-row_id="${row_id}"]`).val();
        var from_day = $(`.from_day[data-row_id="${row_id}"]`).val();
        var to_day = $(`.to_day[data-row_id="${row_id}"]`).val();

        quarterly_type_list.push({
            quarter_name: quarter_name,
            from_day: from_day,
            to_day: to_day,
            from_month: from_month,
            to_month: to_month,
        });
    });
    console.log("quarterly:", quarterly_type_list);
}

 $(document).on('change', 'input:checkbox, input.from_day, input.to_day', function() {
    updateQuarterlyList();
});
$('#save_btn').click(function(e) {
    e.preventDefault();
    var name = $('#name').val();
    var details = $('#details').val();
    var frequency_type = $('#frequency_type').val();
    if (frequency_type === "quarterly") {
        $.ajax({
            url: '{{ route('services.storeQuarterly') }}',
            method: 'POST',
            data: {
            name: name,
            details: details,
            frequency_type: frequency_type,
            quarterly_type_list: quarterly_type_list,
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                window.location.href = '{{ route('services.index') }}';
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});

var biannually_type_list = [];
function updateBiannuallyList() {
    biannually_type_list = [];
    $('#biannually_table .select_month:checked').each(function() {
        var row_id = $(this).data('row_id');
        var biannual_name = row_id === 'january-june' ? 'first' : 'second';
        var from_month = $(`.from_month[data-row_id="${row_id}"]`).val();
        var to_month = $(`.to_month[data-row_id="${row_id}"]`).val();
        var from_day = $(`.from_day[data-row_id="${row_id}"]`).val();
        var to_day = $(`.to_day[data-row_id="${row_id}"]`).val();

        biannually_type_list.push({
            biannual_name: biannual_name,
            from_day: from_day,
            to_day: to_day,
            from_month: from_month,
            to_month: to_month,
        });
    });
    console.log("biannually:", biannually_type_list);
}

$(document).on('change', 'input:checkbox, input.from_day, input.to_day', function() {
    updateBiannuallyList();
});

$('#save_btn').click(function(e) {
    e.preventDefault();
    var name = $('#name').val();
    var details = $('#details').val();
    var frequency_type = $('#frequency_type').val();

    if (frequency_type === "biannually") {
        console.log('Making AJAX request...');
        $.ajax({
            url: '{{ route('services.storeBiAnnually') }}',
            method: 'POST',
            data: {
                name: name,
                details: details,
                frequency_type: frequency_type,
                biannually_type_list: biannually_type_list,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Success:', response);
                window.location.href = '{{ route('services.index') }}';
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    }
});


var annually_type_list = [];
function updateAnnuallyList() {
    annually_type_list = [];
    $('#annually_table tr').each(function() {
        var row_id = $(this).find('.from_month').data('row_id');
        var from_month = $(this).find('.from_month').val();
        var to_month = $(this).find('.to_month').val();
        var from_day = $(this).find('.from_day').val();
        var to_day = $(this).find('.to_day').val();

        annually_type_list.push({
            from_day: from_day,
            to_day: to_day,
            from_month: from_month,
            to_month: to_month,
        });
    });
    console.log("annually:", annually_type_list);
}

$(document).on('change', 'input.from_day, input.to_day, select.from_month, select.to_month', function() {
    updateAnnuallyList();
});

$('#save_btn').click(function(e) {
    e.preventDefault();
    var name = $('#name').val();
    var details = $('#details').val();
    var frequency_type = $('#frequency_type').val();

    if (frequency_type === "annually") {
        $.ajax({
            url: '{{ route('services.storeAnnually') }}',
            method: 'POST',
            data: {
                name: name,
                details: details,
                frequency_type: frequency_type,
                annually_type_list: annually_type_list,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Success:', response);
                window.location.href = '{{ route('services.index') }}';
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    }
});

var onetime_type_list = [];
function updateonetimeList() {
    onetime_type_list = [];
    $('#onetime_table tr').each(function() {
        var row_id = $(this).find('.from_date').data('row_id');
        var from_date = $(this).find('.from_date').val();
        var to_date = $(this).find('.to_date').val();

            onetime_type_list.push({
                from_date: from_date,
                to_date: to_date,
            });
    });
    console.log("onetime:", onetime_type_list);
}

$(document).on('change', 'input.from_date, input.to_date', function() {
    updateonetimeList();
});

$('#save_btn').click(function(e) {
    e.preventDefault();
    var name = $('#name').val();
    var details = $('#details').val();
    var frequency_type = $('#frequency_type').val();

    if (frequency_type === "onetime") {
        $.ajax({
            url: '{{ route('services.storeOneTime') }}',
            method: 'POST',
            data: {
                name: name,
                details: details,
                frequency_type: frequency_type,
                onetime_type_list: onetime_type_list,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                window.location.href = '{{ route('services.index') }}';
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});
});
</script>
@endsection
