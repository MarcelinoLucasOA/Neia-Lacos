@extends('layouts.app')

@section('pageName', 'Clientes')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Lista de Clientes</span>
                    {{-- Botão para ABRIR O MODAL UNIFICADO no modo CRIAÇÃO --}}
                    <a class="btn-small waves-effect waves-light green darken-2 right modal-trigger" href="#modal-create-customer" data-mode="create">Novo Cliente</a>
                    <table class="striped responsive-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone(s)</th>
                                <th>Endereço(s)</th>
                                <th>Ações(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($customer->phoneNumbers->isNotEmpty())
                                            @foreach ($customer->phoneNumbers as $phoneNumber)
                                                {{ $phoneNumber->number ?? 'N/A' }}
                                                @if ($phoneNumber->label)
                                                    <span class="chip customer-label-chip">{{ $phoneNumber->label }}</span>
                                                @endif
                                                <br>
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($customer->addresses->isNotEmpty())
                                            @foreach ($customer->addresses as $address)
                                                {{ $address->street ?? 'N/A' }}, {{ $address->number ?? 'N/A' }}
                                                @if ($address->complement)
                                                    - {{ $address->complement ?? '' }}
                                                @endif
                                                <br>
                                                {{ $address->neighborhood ?? 'N/A' }}, {{ $address->city ?? 'N/A' }} - {{ $address->state ?? 'N/A' }} - CEP: {{ $address->zip_code ?? 'N/A' }}
                                                @if ($address->label)
                                                    <span class="chip customer-label-chip">{{ $address->label }}</span>
                                                @endif
                                                <br>
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}" class="btn-small blue darken-1">Detalhes</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nenhum cliente cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('customers._customers_modals')
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
                    classes: 'my-custom-toast'
                });
            @endif

            $('a.modal-trigger[href="#modal-customer-upsert"]').on('click', function() {
                const mode = $(this).data('mode');
                const form = $('#form-customer-upsert');

                if (mode === 'create') {
                    $('#modal-customer-upsert-title').text('Novo');
                    form.attr('action', '{{ route('customers.store') }}');
                    $('#customer_upsert_method_field').val('POST');

                    $('#customer_upsert_name').val('');
                    $('#customer_upsert_notes').val('');
                    $('#customer_upsert_status').val('');
                    
                    M.FormSelect.init(document.getElementById('customer_upsert_status'));

                    $('#customer-create-optional-fields').show();
                    $('#address-create-optional-fields').show();

                    $('#customer_upsert_phone_number').val('');
                    $('#customer_upsert_phone_label').val('');
                    $('#customer_upsert_address_street').val('');
                    $('#customer_upsert_address_number').val('');
                    $('#customer_upsert_address_complement').val('');
                    $('#customer_upsert_address_neighborhood').val('');
                    $('#customer_upsert_address_city').val('');
                    $('#customer_upsert_address_state').val('');
                    $('#customer_upsert_address_zip_code').val('');
                    $('#customer_upsert_address_label').val('');

                }
                M.updateTextFields();
            });

            @if ($errors->any())
                const hasCustomerCoreErrors = @json($errors->hasAny(['name', 'status', 'notes']));
                const hasPhoneCreateErrors = @json($errors->hasAny(['phone_number', 'phone_label']));
                const hasAddressCreateErrorsPart1 = @json($errors->hasAny(['address_street', 'address_number', 'address_complement']));
                const hasAddressCreateErrorsPart2 = @json($errors->hasAny(['address_neighborhood', 'address_city', 'address_state']));
                const hasAddressCreateErrorsPart3 = @json($errors->hasAny(['address_zip_code', 'address_label']));

                const hasCustomerUpsertErrors = hasCustomerCoreErrors || hasPhoneCreateErrors || hasAddressCreateErrorsPart1 || hasAddressCreateErrorsPart2 || hasAddressCreateErrorsPart3;

                const isCreateError = @json(old('phone_number') || old('address_street'));

                if (hasCustomerUpsertErrors) {
                    var instance = M.Modal.getInstance(document.getElementById('modal-customer-upsert'));
                    if (instance) {
                        if (isCreateError) {
                            $('#modal-customer-upsert-title').text('Novo');
                            $('#form-customer-upsert').attr('action', '{{ route('customers.store') }}');
                            $('#customer_upsert_method_field').val('POST');

                            $('#customer-create-optional-fields').show();
                            $('#address-create-optional-fields').show();

                            $('#customer_upsert_name').val('{{ old('name') }}');
                            $('#customer_upsert_notes').val('{{ old('notes') }}');
                            $('#customer_upsert_status').val('{{ old('status') }}');
                            $('#customer_upsert_phone_number').val('{{ old('phone_number') }}');
                            $('#customer_upsert_phone_label').val('{{ old('phone_label') }}');
                            $('#customer_upsert_address_street').val('{{ old('address_street') }}');
                            $('#customer_upsert_address_number').val('{{ old('address_number') }}');
                            $('#customer_upsert_address_complement').val('{{ old('address_complement') }}');
                            $('#customer_upsert_address_neighborhood').val('{{ old('neighborhood') }}');
                            $('#customer_upsert_address_city').val('{{ old('city') }}');
                            $('#customer_upsert_address_state').val('{{ old('state') }}');
                            $('#customer_upsert_address_zip_code').val('{{ old('zip_code') }}');
                            $('#customer_upsert_address_label').val('{{ old('label') }}');

                        }
                        
                        M.updateTextFields();
                        M.FormSelect.init(document.getElementById('customer_upsert_status'));
                        instance.open();
                    }
                }
            @endif
        });
    </script>
@endpush
