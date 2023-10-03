<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : AnonymousResourceCollection
    {
        return CustomerResource::collection(Customer::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): CustomerResource
    {
        $request->validate([
            'name' => 'required',
            'tel' => 'required',
            'is_favourite' => 'nullable|boolean'
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'is_favourite' => $request->is_favourite ?? 0,
        ]);

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'tel' => 'required',
            'is_favourite' => 'nullable|boolean'
        ]);

        $customer->update($request->only(['name','tel','is_favourite']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->noContent();
    }
}
