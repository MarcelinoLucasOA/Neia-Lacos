@extends('layouts.app')

@section('pageName', 'Detalhes do Cliente')

@section('content')
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Detalhes do Cliente: {{ $customer->name ?? 'N/A' }}</span>

                    <p><strong>Nome:</strong> {{ $customer->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $customer->status ?? 'N/A' }}</p>
                    <p><strong>Notas:</strong> {{ $customer->notes ?? 'N/A' }}</p>
                    <p><strong>Criado em:</strong> {{ $customer->created_at->format('d/m/Y H:i') ?? 'N/A' }}</p>
                    <p><strong>Última Atualização:</strong> {{ $customer->updated_at->format('d/m/Y H:i') ?? 'N/A' }}</p>

                    <div class="divider"></div>

                    <h5 class="mt-4">Telefones:
                        <a class="btn-small green darken-2 right modal-trigger" href="#modal-add-phone">Adicionar Telefone</a>
                    </h5>
                    @if ($customer->phoneNumbers->isNotEmpty())
                        <ul class="collection">
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

                    <div class="divider"></div>

                    <h5 class="mt-4">Endereços:
                        <a class="btn-small green darken-2 right modal-trigger" href="#modal-add-address">Adicionar Endereço</a>
                    </h5>
                    @if ($customer->addresses->isNotEmpty())
                        <ul class="collection">
                            @foreach ($customer->addresses as $address)
                                <li class="collection-item">
                                    <div>
                                        {{ $address->street ?? 'N/A' }}, {{ $address->number ?? 'N/A' }}
                                        @if ($address->complement)
                                            - {{ $address->complement ?? '' }}
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
                    <a href="#modal-customer-upsert" class="btn yellow darken-4 modal-trigger edit-customer-btn" data-mode="edit" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" data-status="{{ $customer->status }}" data-notes="{{ $customer->notes }}">Editar Cliente</a>
                    <a href="{{ route('customers.index') }}" class="btn blue darken-2">Voltar para Lista</a>
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
            $('.phone_number_mask').mask('(00) 0 0000-0000');

            @if (session('success'))
                M.toast({
                    html: '{{ session('success') }}',
                    classes: 'green darken-2'
                });
            @endif

            $('a.modal-trigger[href="#modal-customer-upsert"]').on('click', function() {
                const mode = $(this).data('mode');
                const form = $('#form-customer-upsert');

                $('#customer-create-optional-fields').hide();
                $('#address-create-optional-fields').hide();

                if (mode === 'edit') {
                    const customerId = $(this).data('id');
                    const customerName = $(this).data('name');
                    const customerStatus = $(this).data('status');
                    const customerNotes = $(this).data('notes');

                    $('#modal-customer-upsert-title').text('Editar');
                    form.attr('action', `/customers/${customerId}`);
                    $('#customer_upsert_method_field').val('PUT');

                    $('#customer_upsert_name').val(customerName).focus();
                    $('#customer_upsert_notes').val(customerNotes).focus();

                    $('#customer_upsert_status').val(customerStatus);
                    M.FormSelect.init(document.getElementById('customer_upsert_status'));
                }
                M.updateTextFields();
            });

            $('.edit-phone-btn').on('click', function() {
                const phoneId = $(this).data('id');
                const phoneNumber = $(this).data('number');
                const phoneLabel = $(this).data('label');
                const customerId = {{ $customer->id }};

                const form = $('#form-edit-phone');
                form.attr('action', `/customers/${customerId}/phone-numbers/${phoneId}`);

                $('#edit_phone_number').val(phoneNumber).focus();
                $('#edit_phone_label').val(phoneLabel).focus();
                M.updateTextFields();
            });

            $('.edit-address-btn').on('click', function() {
                const addressId = $(this).data('id');
                const addressStreet = $(this).data('street');
                const addressNumber = $(this).data('number');
                const addressComplement = $(this).data('complement');
                const addressNeighborhood = $(this).data('neighborhood');
                const addressCity = $(this).data('city');
                const addressState = $(this).data('state');
                const addressZipCode = $(this).data('zip_code');
                const addressLabel = $(this).data('label');
                const customerId = {{ $customer->id }};

                const form = $('#form-edit-address');
                form.attr('action', `/customers/${customerId}/addresses/${addressId}`);

                $('#edit_address_street').val(addressStreet).focus();
                $('#edit_address_number').val(addressNumber).focus();
                $('#edit_address_complement').val(addressComplement).focus();
                $('#edit_address_neighborhood').val(addressNeighborhood).focus();
                $('#edit_address_city').val(addressCity).focus();
                $('#edit_address_state').val(addressState).focus();
                $('#edit_address_zip_code').val(addressZipCode).focus();
                $('#edit_address_label').val(addressLabel).focus();
                M.updateTextFields();
            });

            @if ($errors->any())
                const hasCustomerCoreErrors = @json($errors->hasAny(['name', 'status', 'notes']));
                const hasPhoneCreateErrors = @json($errors->hasAny(['phone_number', 'phone_label']));
                const hasAddressCreateErrorsPart1 = @json($errors->hasAny(['address_street', 'address_number', 'address_complement']));
                const hasAddressCreateErrorsPart2 = @json($errors->hasAny(['address_neighborhood', 'address_city', 'address_state']));
                const hasAddressCreateErrorsPart3 = @json($errors->hasAny(['address_zip_code', 'address_label']));

                const hasCustomerUpsertErrors = hasCustomerCoreErrors || hasPhoneCreateErrors ||
                    hasAddressCreateErrorsPart1 || hasAddressCreateErrorsPart2 ||
                    hasAddressCreateErrorsPart3;

                const isEditError = @json(old('name')) && !@json(old('phone_number')) && !@json(old('address_street'));

                if (hasCustomerUpsertErrors) {
                    var instance = M.Modal.getInstance(document.getElementById('modal-customer-upsert'));
                    if (instance) {
                        if (isEditError) {
                            $('#modal-customer-upsert-title').text('Editar');
                            $('#form-customer-upsert').attr('action', '/customers/{{ $customer->id }}');
                            $('#customer_upsert_method_field').val('PUT');

                            $('#customer-create-optional-fields').hide();
                            $('#address-create-optional-fields').hide();

                            $('#customer_upsert_name').val('{{ old('name') }}');
                            $('#customer_upsert_notes').val('{{ old('notes') }}');
                            $('#customer_upsert_status').val('{{ old('status') }}');

                        }
                        M.updateTextFields();
                        M.FormSelect.init(document.getElementById('customer_upsert_status'));
                        instance.open();
                    }
                } else {
                    const hasAddPhoneErrors = @json($errors->hasAny(['number', 'label'])) && @json(!session('edited_phone_id'));
                    const hasEditPhoneErrors = @json($errors->hasAny(['number', 'label'])) && @json(session('edited_phone_id'));

                    const hasAddAddressErrorsPart1 = @json($errors->hasAny(['street', 'number', 'complement']));
                    const hasAddAddressErrorsPart2 = @json($errors->hasAny(['neighborhood', 'city', 'state']));
                    const hasAddAddressErrorsPart3 = @json($errors->hasAny(['zip_code', 'label']));
                    const hasAddAddressErrors = (hasAddAddressErrorsPart1 || hasAddAddressErrorsPart2 || hasAddAddressErrorsPart3) && @json(!session('edited_address_id'));

                    const hasEditAddressErrors = (hasAddAddressErrorsPart1 || hasAddAddressErrorsPart2 || hasAddAddressErrorsPart3) && @json(session('edited_address_id'));


                    if (hasAddPhoneErrors) {
                        var instance = M.Modal.getInstance(document.getElementById('modal-add-phone'));
                        if (instance) {
                            $('#add_phone_number').val('{{ old('number') }}').focus();
                            $('#add_phone_label').val('{{ old('label') }}').focus();
                            M.updateTextFields();
                            instance.open();
                        }
                    } else if (hasEditPhoneErrors) {
                        var instance = M.Modal.getInstance(document.getElementById('modal-edit-phone'));
                        if (instance) {
                            const phoneId = {{ session('edited_phone_id') }};
                            const customerId = {{ $customer->id }};
                            $('#form-edit-phone').attr('action', `/customers/${customerId}/phone-numbers/${phoneId}`);
                            $('#edit_phone_number').val('{{ old('number') }}').focus();
                            $('#edit_phone_label').val('{{ old('label') }}').focus();
                            M.updateTextFields();
                            instance.open();
                        }
                    } else if (hasAddAddressErrors) {
                        var instance = M.Modal.getInstance(document.getElementById('modal-add-address'));
                        if (instance) {
                            $('#add_address_street').val('{{ old('street') }}').focus();
                            $('#add_address_number').val('{{ old('number') }}').focus();
                            $('#add_address_complement').val('{{ old('complement') }}').focus();
                            $('#add_address_neighborhood').val('{{ old('neighborhood') }}').focus();
                            $('#add_address_city').val('{{ old('city') }}').focus();
                            $('#add_address_state').val('{{ old('state') }}').focus();
                            $('#add_address_zip_code').val('{{ old('zip_code') }}').focus();
                            $('#add_address_label').val('{{ old('label') }}').focus();
                            M.updateTextFields();
                            instance.open();
                        }
                    } else if (hasEditAddressErrors) {
                        var instance = M.Modal.getInstance(document.getElementById('modal-edit-address'));
                        if (instance) {
                            const addressId = {{ session('edited_address_id') }};
                            const customerId = {{ $customer->id }};
                            $('#form-edit-address').attr('action', `/customers/${customerId}/addresses/${addressId}`);
                            $('#edit_address_street').val('{{ old('street') }}').focus();
                            $('#edit_address_number').val('{{ old('number') }}').focus();
                            $('#edit_address_complement').val('{{ old('complement') }}').focus();
                            $('#edit_address_neighborhood').val('{{ old('neighborhood') }}').focus();
                            $('#edit_address_city').val('{{ old('city') }}').focus();
                            $('#edit_address_state').val('{{ old('state') }}').focus();
                            $('#edit_address_zip_code').val('{{ old('zip_code') }}').focus();
                            $('#edit_address_label').val('{{ old('label') }}').focus();
                            M.updateTextFields();
                            instance.open();
                        }
                    }
                }
            @endif
        });
    </script>
@endpush
