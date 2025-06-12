{{-- NOVO: Modal para Criar Cliente --}}
<div id="modal-create-customer" class="modal">
    <form id="form-create-customer" action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <h5><strong>Criar Novo Cliente</strong></h4>
            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="create_customer_name" type="text" name="name" class="validate" autocomplete="off" required value="{{ old('name') }}">
                    <label for="create_customer_name" class="active">Nome do Cliente</label>
                    @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m8">
                    <textarea id="create_customer_notes" name="notes" class="materialize-textarea" autocomplete="off">{{ old('notes') }}</textarea>
                    <label for="create_customer_notes" class="active">Notas</label>
                    @error('notes')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h6><strong>Telefone (Opcional)</strong></h6>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="create_customer_phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" class="phone_number_mask" autocomplete="off">
                    <label for="create_customer_phone_number">Número de Telefone</label>
                    @error('phone_number')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="create_customer_phone_label" type="text" name="phone_label" value="{{ old('phone_label') }}" autocomplete="off">
                    <label for="create_customer_phone_label">Rótulo do Telefone (ex: Celular, Comercial)</label>
                    @error('phone_label')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h6><strong>Endereço (Opcional)</strong></h6>
            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="create_customer_address_street" type="text" name="address_street" value="{{ old('address_street') }}" autocomplete="off">
                    <label for="create_customer_address_street">Rua</label>
                    @error('address_street')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6 m2">
                    <input id="create_customer_address_number" type="text" name="address_number" value="{{ old('address_number') }}" autocomplete="off">
                    <label for="create_customer_address_number">Número</label>
                    @error('address_number')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6 m2">
                    <input id="create_customer_address_complement" type="text" name="address_complement" value="{{ old('address_complement') }}" autocomplete="off">
                    <label for="create_customer_address_complement">Complemento</label>
                    @error('address_complement')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m4">
                    <input id="create_customer_address_neighborhood" type="text" name="address_neighborhood" value="{{ old('address_neighborhood') }}" autocomplete="off">
                    <label for="create_customer_address_neighborhood">Bairro</label>
                    @error('address_neighborhood')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6 m2">
                    <input id="create_customer_address_city" type="text" name="address_city" value="{{ old('address_city') }}" autocomplete="off">
                    <label for="create_customer_address_city">Cidade</label>
                    @error('address_city')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6 m2">
                    <input id="create_customer_address_state" type="text" name="address_state" value="{{ old('address_state') }}" autocomplete="off" maxlength="2">
                    <label for="create_customer_address_state">Estado (UF)</label>
                    @error('address_state')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6 m2">
                    <input id="create_customer_address_zip_code" type="text" name="address_zip_code" value="{{ old('address_zip_code') }}" class="zip_code" autocomplete="off">
                    <label for="create_customer_address_zip_code">CEP</label>
                    @error('address_zip_code')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6 m6">
                    <input id="create_customer_address_label" type="text" name="address_label" value="{{ old('address_label') }}" autocomplete="off">
                    <label for="create_customer_address_label">Rótulo do Endereço (ex: Casa, Trabalho)</label>
                    @error('address_label')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn-flat green darken-2 white-text">Salvar</button>
            <a href="#!" class="modal-close btn-flat">Cancelar</a>
        </div>
    </form>
</div>

{{-- NOVO: Modal para Editar Cliente --}}
<div id="modal-edit-customer" class="modal">
    <form id="form-edit-customer" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-content">
            <h5><strong>Editar Cliente</strong></h5>
            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="edit_customer_name" type="text" name="name" class="validate" autocomplete="off" required>
                    <label for="edit_customer_name" class="active">Nome do Cliente</label>
                    @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m8">
                    <textarea id="edit_customer_notes" name="notes" class="materialize-textarea" autocomplete="off"></textarea>
                    <label for="edit_customer_notes" class="active">Notas</label>
                    @error('notes')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn-flat green darken-2 white-text">Salvar</button>
            <a href="#!" class="modal-close btn-flat">Cancelar</a>
        </div>
    </form>
</div>

{{-- Os modais abaixo só serão incluídos se a variável $customer estiver definida --}}
@isset($customer)
    {{-- Modal para Adicionar Novo Telefone --}}
    <div id="modal-add-phone" class="modal">
        <form action="{{ route('phone_numbers.store', $customer->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <h5><strong>Adicionar Novo Telefone</strong></h5>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="add_phone_number" type="text" name="number" value="{{ old('number') }}" class="phone_number_mask" autocomplete="off" required>
                        <label for="add_phone_number">Número</label>
                        @error('number')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="add_phone_label" type="text" name="label" value="{{ old('label') }}" autocomplete="off">
                        <label for="add_phone_label">Rótulo (ex: Celular, Comercial)</label>
                        @error('label')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-flat green darken-2 white-text">Salvar</button>
                <a href="#!" class="modal-close btn-flat">Cancelar</a>
            </div>
        </form>
    </div>

    {{-- Modal para Adicionar Novo Endereço --}}
    <div id="modal-add-address" class="modal">
        <form action="{{ route('addresses.store', $customer->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <h5><strong>Adicionar Novo Endereço</strong></h5>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <input id="add_address_street" type="text" name="street" value="{{ old('street') }}" autocomplete="off" required>
                        <label for="add_address_street">Rua</label>
                        @error('street')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="add_address_number" type="text" name="number" value="{{ old('number') }}" autocomplete="off" required>
                        <label for="add_address_number">Número</label>
                        @error('number')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="add_address_complement" type="text" name="complement" value="{{ old('complement') }}" autocomplete="off">
                        <label for="add_address_complement">Complemento</label>
                        @error('complement')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12 m4">
                        <input id="add_address_neighborhood" type="text" name="neighborhood" value="{{ old('neighborhood') }}" autocomplete="off" required>
                        <label for="add_address_neighborhood">Bairro</label>
                        @error('neighborhood')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="add_address_city" type="text" name="city" value="{{ old('city') }}" autocomplete="off" required>
                        <label for="add_address_city">Cidade</label>
                        @error('city')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="add_address_state" type="text" name="state" value="{{ old('state') }}" autocomplete="off" required maxlength="2">
                        <label for="add_address_state">Estado (UF)</label>
                        @error('state')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="add_address_zip_code" type="text" name="zip_code" value="{{ old('zip_code') }}" class="zip_code" autocomplete="off">
                        <label for="add_address_zip_code">CEP</label>
                        @error('zip_code')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m6">
                        <input id="add_address_label" type="text" name="label" value="{{ old('label') }}" autocomplete="off">
                        <label for="add_address_label">Rótulo (ex: Casa, Trabalho)</label>
                        @error('label')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-flat green darken-2 white-text">Salvar</button>
                <a href="#!" class="modal-close btn-flat">Cancelar</a>
            </div>
        </form>
    </div>

    {{-- Modal Genérico para Edição de Telefone --}}
    <div id="modal-edit-phone" class="modal">
        <form id="form-edit-phone" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <h4>Editar Telefone</h4>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="edit_phone_number" type="text" name="number" class="phone_number_mask" autocomplete="off" required>
                        <label for="edit_phone_number" class="active">Número</label>
                        @error('number')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="edit_phone_label" type="text" name="label" autocomplete="off">
                        <label for="edit_phone_label" class="active">Rótulo (ex: Celular, Comercial)</label>
                        @error('label')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-flat green darken-2 white-text">Salvar</button>
                <a href="#!" class="modal-close btn-flat">Cancelar</a>
            </div>
        </form>
    </div>

    {{-- Modal Genérico para Edição de Endereço --}}
    <div id="modal-edit-address" class="modal">
        <form id="form-edit-address" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <h4>Editar Endereço</h4>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <input id="edit_address_street" type="text" name="street" autocomplete="off" required>
                        <label for="edit_address_street" class="active">Rua</label>
                        @error('street')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="edit_address_number" type="text" name="number" autocomplete="off" required>
                        <label for="edit_address_number" class="active">Número</label>
                        @error('number')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="edit_address_complement" type="text" name="complement" autocomplete="off">
                        <label for="edit_address_complement" class="active">Complemento</label>
                        @error('complement')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12 m4">
                        <input id="edit_address_neighborhood" type="text" name="neighborhood" autocomplete="off" required>
                        <label for="edit_address_neighborhood" class="active">Bairro</label>
                        @error('neighborhood')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="edit_address_city" type="text" name="city" autocomplete="off" required>
                        <label for="edit_address_city" class="active">Cidade</label>
                        @error('city')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="edit_address_state" type="text" name="state" autocomplete="off" required maxlength="2">
                        <label for="edit_address_state" class="active">Estado (UF)</label>
                        @error('state')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m2">
                        <input id="edit_address_zip_code" type="text" name="zip_code" class="zip_code" autocomplete="off">
                        <label for="edit_address_zip_code" class="active">CEP</label>
                        @error('zip_code')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s6 m6">
                        <input id="edit_address_label" type="text" name="label" autocomplete="off">
                        <label for="edit_address_label" class="active">Rótulo (ex: Casa, Trabalho)</label>
                        @error('label')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-flat green darken-2 white-text">Salvar</button>
                <a href="#!" class="modal-close btn-flat">Cancelar</a>
            </div>
        </form>
    </div>
@endisset
