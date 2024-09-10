<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    // Use SoftDeletes;
    protected $table = 'customers';

    protected $guarded = [];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'customer_services', 'customer_id', 'service_id');
    }

    public function customer_service()
    {
        return $this->belongsTo(CustomerService::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }
    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function State()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function billingCountry()
    {
        return $this->belongsTo(Country::class, 'billing_country_id');
    }

    public function billingState()
    {
        return $this->belongsTo(State::class, 'billing_state_id');
    }

    public function billingCity()
    {
        return $this->belongsTo(City::class, 'billing_city_id');
    }

    public function shippingCountry()
    {
        return $this->belongsTo(Country::class, 'shipping_country_id');
    }

    public function shippingState()
    {
        return $this->belongsTo(State::class, 'shipping_state_id');
    }

    public function shippingCity()
    {
        return $this->belongsTo(City::class, 'shipping_city_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }
}