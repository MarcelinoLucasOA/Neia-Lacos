@extends('layouts.app')

@section('pageName', 'Detalhes do Cliente')

@section('content')
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><strong>Detalhes do Cliente: {{ $customer->name ?? 'N/A' }}</strong></span>

                    <p><strong>Nome:</strong> {{ $customer->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $customer->status ?? 'N/A' }}</p>
                    <p><strong>Notas:</strong> {{ $customer->notes ?? 'N/A' }}</p>
                    <p><strong>Criado em:</strong> {{ $customer->created_at->format('d/m/Y H:i') ?? 'N/A' }}</p>
                    <p><strong>Última Atualização:</strong> {{ $customer->updated_at->format('d/m/Y H:i') ?? 'N/A' }}</p>

                    <br><div class="divider"></div>

                    <h5 class="mt-4">Telefones:
                        <a class="btn-small green darken-2 right modal-trigger" href="#modal-add-phone">Adicionar Telefone</a>
                    </h5>
                    @if ($customer->phoneNumbers->isNotEmpty())
                        <ul class="collection" style="padding: .5em">
                            @foreach ($customer->phoneNumbers as $phoneNumber)
                                <li class="collection-item">
                                    <div>
                                        Número: {{ $phoneNumber->number ?? 'N/A' }}
                                        @if ($phoneNumber->label)
                                            <span class="chip customer-label-chip">{{ $phoneNumber->label }}</span>
                                        @endif
                                        <div class="secondary-content">
                                            <a href="#modal-edit-phone" class="modal-trigger yellow-text text-darken-4 edit-phone-btn" data-id="{{ $phoneNumber->id }}" data-number="{{ $phoneNumber->number }}" data-label="{{ $phoneNumber->label }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('phone_numbers.destroy', ['customer' => $customer->id, 'phone_number' => $phoneNumber->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="red-text text-darken-2 btn-flat" onclick="return confirm('Tem certeza que deseja excluir este telefone?');">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nenhum telefone cadastrado para este cliente.</p>
                    @endif

                    <br><div class="divider"></div>

                    <h5 class="mt-4">Endereços:
                        <a class="btn-small green darken-2 right modal-trigger" href="#modal-add-address">Adicionar Endereço</a>
                    </h5>
                    @if ($customer->addresses->isNotEmpty())
                        <ul class="collection" style="padding: .5em">
                            @foreach ($customer->addresses as $address)
                                <li class="collection-item">
                                    <div>
                                        {{ $address->street ?? 'N/A' }}, {{ $address->number ?? 'N/A' }}
                                        @if ($address->complement)
                                            - {{ $address->complement }}
                                        @endif
                                        <br>
                                        {{ $address->neighborhood ?? 'N/A' }}, {{ $address->city ?? 'N/A' }} - {{ $address->state ?? 'N/A' }} - CEP: {{ $address->zip_code ?? 'N/A' }}
                                        @if ($address->label)
                                            <span class="chip customer-label-chip">{{ $address->label }}</span>
                                        @endif
                                        <div class="secondary-content">
                                            <a href="#modal-edit-address" class="modal-trigger yellow-text text-darken-4 edit-address-btn" data-id="{{ $address->id }}" data-street="{{ $address->street }}" data-number="{{ $address->number }}" data-complement="{{ $address->complement }}" data-neighborhood="{{ $address->neighborhood }}" data-city="{{ $address->city }}" data-state="{{ $address->state }}" data-zip_code="{{ $address->zip_code }}" data-label="{{ $address->label }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('addresses.destroy', ['customer' => $customer->id, 'address' => $address->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="red-text text-darken-2 btn-flat" onclick="return confirm('Tem certeza que deseja excluir este endereço?');">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nenhum endereço cadastrado para este cliente.</p>
                    @endif
                </div>
                <div class="card-action right-align">
                    <a href="#modal-edit-customer" class="btn yellow darken-4 modal-trigger edit-customer-btn" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" data-status="{{ $customer->status }}" data-notes="{{ $customer->notes }}">
                        Editar Cliente
                    </a>
                    <a href="{{ route('customers.index') }}" class="btn blue darken-2">Voltar à Lista</a>
                </div>
            </div>
        </div>
    </div>

    @include('customers._customers_modals', ['customer' => $customer])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.modal').modal();
            $('select').formSelect();
            $('.zip_code').mask('00000-000');
            $('.phone_number_mask').mask('(00) 90000-0000');

            @if (session('success'))
                M.toast({
                    html: '{{ session('success') }}',
                    classes: 'green darken-2'
                });
            @endif

            $('a.modal-trigger.edit-customer-btn').on('click', function() {
                const form = $('#form-edit-customer');
                const customerId = $(this).data('id');

                form.attr('action', `/customers/${customerId}`);

                $('#edit_customer_name').val($(this).data('name')).focus();
                $('#edit_customer_notes').val($(this).data('notes')).focus();
                $('#edit_customer_status').val($(this).data('status'));
                M.FormSelect.init(document.getElementById('edit_customer_status'));

                M.updateTextFields();
            });

            $('a.modal-trigger.edit-phone-btn').on('click', function() {
                const phoneNumberId = $(this).data('id');
                const phoneNumberNumber = $(this).data('number');
                const phoneNumberLabel = $(this).data('label');

                const form = $('#form-edit-phone');
                form.attr('action', '{{ route('phone_numbers.update', ['customer' => $customer->id, 'phone_number' => ':phone_number_id']) }}'.replace(':phone_number_id', phoneNumberId));

                $('#edit_phone_number').val(phoneNumberNumber);
                $('#edit_phone_label').val(phoneNumberLabel);
                M.updateTextFields();
                $('.phone_number_mask').mask('(00) 90000-0000');
            });

            $('a.modal-trigger.edit-address-btn').on('click', function() {
                const addressId = $(this).data('id');
                const addressStreet = $(this).data('street');
                const addressNumber = $(this).data('number');
                const addressComplement = $(this).data('complement');
                const addressNeighborhood = $(this).data('neighborhood');
                const addressCity = $(this).data('city');
                const addressState = $(this).data('state');
                const addressZipCode = $(this).data('zip_code');
                const addressLabel = $(this).data('label');

                const form = $('#form-edit-address');
                form.attr('action', `/customers/{{ $customer->id }}/addresses/${addressId}`);

                $('#edit_address_street').val(addressStreet);
                $('#edit_address_number').val(addressNumber);
                $('#edit_address_complement').val(addressComplement);
                $('#edit_address_neighborhood').val(addressNeighborhood);
                $('#edit_address_city').val(addressCity);
                $('#edit_address_state').val(addressState);
                $('#edit_address_zip_code').val(addressZipCode);
                $('#edit_address_label').val(addressLabel);

                M.updateTextFields();
                $('.zip_code').mask('00000-000');
            });

            @if ($errors->any())
                @if ($errors->hasAny(['name', 'status', 'notes']))
                    $('#modal-edit-customer').modal('open');
                    $('#edit_customer_name').val('{{ old('name', $customer->name) }}');
                    $('#edit_customer_notes').val('{{ old('notes', $customer->notes) }}');
                    $('#edit_customer_status').val('{{ old('status', $customer->status) }}');
                    M.FormSelect.init(document.getElementById('edit_customer_status'));
                    M.updateTextFields();

                @elseif ($errors->hasAny(['number', 'label']) && Session::has('modal_add_phone_open'))
                    $('#modal-add-phone').modal('open');
                    $('#add_phone_number').val('{{ old('number') }}');
                    $('#add_phone_label').val('{{ old('label') }}');
                    M.updateTextFields();

                @elseif ($errors->hasAny(['street', 'number', 'neighborhood', 'city', 'state', 'zip_code', 'complement', 'label']) && Session::has('modal_add_address_open'))
                    $('#modal-add-address').modal('open');
                    $('#add_address_street').val('{{ old('street') }}');
                    $('#add_address_number').val('{{ old('number') }}');
                    $('#add_address_complement').val('{{ old('complement') }}');
                    $('#add_address_neighborhood').val('{{ old('neighborhood') }}');
                    $('#add_address_city').val('{{ old('city') }}');
                    $('#add_address_state').val('{{ old('state') }}');
                    $('#add_address_zip_code').val('{{ old('zip_code') }}');
                    $('#add_address_label').val('{{ old('label') }}');
                    M.updateTextFields();
                @endif
            @endif
        });
    </script>
@endpush
