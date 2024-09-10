<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\CustomerRequest;
use App\Models\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Employee;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $customers = Customer::with('services')->get();
        $services = Service::all();
        return view('masters.customer.index', compact('customers', 'services'));
    }


    public function create()
    {
        $customers = Customer::with('country', 'state', 'city')->get();
        $employees = Employee::select('id', 'first_name')->get();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $services = Service::all();

        return view('masters.customer.create', compact('customers', 'countries', 'states', 'cities', 'employees', 'services'));
    }


    public function store(CustomerRequest $request)
    {

        // dd($request->all());
        $validatedData = $request->validated();

        $customer = new Customer();
        $customer->name = $validatedData['name'];
        $customer->email = $validatedData['email'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->payment_terms = $validatedData['payment_terms'];
        $customer->credit_days = $validatedData['credit_days'];
        $customer->description = $validatedData['description'];
        $customer->billing_country_id = $validatedData['billing_country_id'];
        $customer->billing_state_id = $validatedData['billing_state_id'];
        $customer->billing_city_id = $validatedData['billing_city_id'];
        $customer->billing_address = $validatedData['billing_address'];
        $customer->gst_number = $validatedData['gst_number'];
        $customer->assigned_to = $validatedData['assigned_to'];


        if ($request->filled('same_as_billing')) {
            $customer->shipping_country_id = $customer->billing_country_id;
            $customer->shipping_state_id = $customer->billing_state_id;
            $customer->shipping_city_id = $customer->billing_city_id;
            $customer->shipping_address = $customer->billing_address;
        } else {
            $customer->shipping_country_id = $validatedData['shipping_country_id'] ?? null;
            $customer->shipping_state_id = $validatedData['shipping_state_id'] ?? null;
            $customer->shipping_city_id = $validatedData['shipping_city_id'] ?? null;
            $customer->shipping_address = $validatedData['shipping_address'] ?? null;
        }
        $customer->save();

        if (isset($validatedData['services']) && is_array($validatedData['services'])) {
            foreach ($validatedData['services'] as $serviceId) {
                DB::table('customer_services')->insert([
                    'customer_id' => $customer->id,
                    'service_id' => $serviceId
                ]);
            }
        }

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }


    public function update(CustomerRequest $request, $id)
    {
        $validatedData = $request->validated();
        $customer = Customer::findOrFail($id);

        $customer->name = $validatedData['name'];
        $customer->email = $validatedData['email'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->payment_terms = $validatedData['payment_terms'];
        $customer->credit_days = $validatedData['credit_days'];
        $customer->description = $validatedData['description'] ?? null;
        $customer->billing_country_id = $validatedData['billing_country_id'];
        $customer->billing_state_id = $validatedData['billing_state_id'];
        $customer->billing_city_id = $validatedData['billing_city_id'];
        $customer->billing_address = $validatedData['billing_address'];
        $customer->gst_number = $validatedData['gst_number'];
        $customer->assigned_to = $validatedData['assigned_to'];


        if ($request->has('shipping_address')) {
            $customer->shipping_country_id = $customer->billing_country_id;
            $customer->shipping_state_id = $customer->billing_state_id;
            $customer->shipping_city_id = $customer->billing_city_id;
            $customer->shipping_address = $customer->billing_address;
        } else {
            $customer->shipping_country_id = $validatedData['shipping_country_id'] ?? null;
            $customer->shipping_state_id = $validatedData['shipping_state_id'] ?? null;
            $customer->shipping_city_id = $validatedData['shipping_city_id'] ?? null;
            $customer->shipping_address = $validatedData['shipping_address'] ?? null;
        }

        $customer->save();
        $customer->services()->sync($validatedData['services'] ?? []);

        return redirect()->route('customer.index')->with('status', 'Customer Updated Successfully');
    }

    public function show($id)
    {
        $customers = Customer::with('assignedUser')->findOrFail($id);
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $services = Service::select('id', 'name')->get();

        return view('masters.customer.view', compact('customers', 'countries', 'states', 'cities', 'employees', 'services'));
    }


    public function edit($id)
    {
        $customers = Customer::findOrFail($id);

        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $employees = Employee::select('id', 'first_name')->get();
        $services = Service::select('id', 'name')->get();


        return view('masters.customer.edit', compact('customers', 'countries', 'states', 'cities', 'employees', 'services'));
    }

    public function deactivate($id)
    {
        $customers = Customer::findOrFail($id);
        $customers->deleted_at = Carbon::now();
        $customers->save();
        return redirect()->back()->with('status', 'Customer deactivate successfully.');
    }

    public function activate($id)
    {
        $customers = Customer::findOrFail($id);
        $customers->deleted_at = null;
        $customers->save();
        return redirect()->back()->with('success', 'Customer activated Successfully .');
    }

    public function state($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function city($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
}