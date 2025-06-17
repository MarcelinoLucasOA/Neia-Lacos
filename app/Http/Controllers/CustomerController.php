<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\{
    StoreAddressRequest,
    StoreCustomerRequest,
    StorePhoneNumberRequest,
    UpdateAddressRequest,
    UpdateCustomerRequest,
    UpdatePhoneNumberRequest
};
use App\Models\{
    Address,
    Customer,
    PhoneNumber,
};

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['phoneNumbers', 'addresses'])->get();
        return view('customers.index', compact('customers'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = 'Ativo';

        $customer = Customer::create($validatedData);

        if ($request->filled('phone_number')) {
            $customer->phoneNumbers()->create([
                'number' => $request->input('phone_number'),
                'label' => $request->input('phone_label'),
            ]);
        }

        if (
            $request->filled('address_street') || $request->filled('address_number') ||
            $request->filled('address_neighborhood') || $request->filled('address_city') ||
            $request->filled('address_state') || $request->filled('address_zip_code')
        ) {

            $customer->addresses()->create([
                'street' => $request->input('address_street'),
                'number' => $request->input('address_number'),
                'complement' => $request->input('address_complement'),
                'neighborhood' => $request->input('address_neighborhood'),
                'city' => $request->input('address_city'),
                'state' => $request->input('address_state'),
                'zip_code' => $request->input('address_zip_code'),
                'label' => $request->input('address_label'),
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function show(Customer $customer)
    {
        $customer->load(['phoneNumbers', 'addresses']);
        return view('customers.show', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('customers.show', $customer->id)->with('success', 'Cliente atualizado com sucesso!');
    }

    public function storePhoneNumber(StorePhoneNumberRequest $request, Customer $customer)
    {
        $customer->phoneNumbers()->create($request->validated());
        return redirect()->route('customers.show', $customer->id)->with('success', 'Telefone adicionado com sucesso!');
    }

    public function updatePhoneNumber(UpdatePhoneNumberRequest $request, Customer $customer, PhoneNumber $phoneNumber)
    {
        if ($phoneNumber->customer_id !== $customer->id) {
            abort(403, 'Ação não autorizada.');
        }

        $phoneNumber->update($request->validated());
        return redirect()->route('customers.show', $customer->id)->with('success', 'Telefone atualizado com sucesso!');
    }

    public function destroyPhoneNumber(Customer $customer, PhoneNumber $phoneNumber)
    {
        if ($phoneNumber->customer_id !== $customer->id) {
            abort(403, 'Ação não autorizada.');
        }

        $phoneNumber->delete();
        return redirect()->route('customers.show', $customer->id)->with('success', 'Telefone excluído com sucesso!');
    }

    public function storeAddress(StoreAddressRequest $request, Customer $customer)
    {
        $customer->addresses()->create($request->validated());
        return redirect()->route('customers.show', $customer->id)->with('success', 'Endereço adicionado com sucesso!');
    }

    public function updateAddress(UpdateAddressRequest $request, Customer $customer, Address $address)
    {
        if ($address->customer_id !== $customer->id) {
            abort(404);
        }

        $address->update($request->validated());
        return redirect()->route('customers.show', $customer->id)->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroyAddress(Customer $customer, Address $address)
    {
        if ($address->customer_id !== $customer->id) {
            abort(404);
        }

        $address->delete();
        return redirect()->route('customers.show', $customer->id)->with('success', 'Endereço excluído com sucesso!');
    }
}
