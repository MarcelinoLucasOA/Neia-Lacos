{{-- resources/views/raw_materials/_raw_materials_modals.blade.php --}}

{{-- Modal para Criar Matéria-Prima --}}
<div id="modal-create-raw_material" class="modal">
    <form id="form-create-raw_material" action="{{ route('raw_materials.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <h4>Criar Nova Matéria-Prima</h4>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="create_raw_material_name" type="text" name="name" class="validate" autocomplete="off" required value="{{ old('name') }}">
                    <label for="create_raw_material_name" class="{{ old('name') ? 'active' : '' }}">Nome da Matéria-Prima</label>
                    @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" id="create_raw_material_unit_autocomplete" class="autocomplete" autocomplete="off" required value="{{ old('unit_autocomplete_value') }}">
                    <label for="create_raw_material_unit_autocomplete" class="{{ old('unit_autocomplete_value') ? 'active' : '' }}">Unidade de Medida</label>
                    <input type="hidden" id="create_raw_material_unit_id" name="unit_id" value="{{ old('unit_id') }}">
                    @error('unit_id')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="create_raw_material_description" name="description" class="materialize-textarea" autocomplete="off">{{ old('description') }}</textarea>
                    <label for="create_raw_material_description" class="{{ old('description') ? 'active' : '' }}">Descrição (Opcional)</label>
                    @error('description')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="create_raw_material_cost_per_unit" type="number" step="0.01" name="cost_per_unit" class="validate" autocomplete="off" value="{{ old('cost_per_unit') }}">
                    <label for="create_raw_material_cost_per_unit" class="{{ old('cost_per_unit') ? 'active' : '' }}">Custo por Unidade (R$)</label>
                    @error('cost_per_unit')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="create_raw_material_stock_level" type="number" name="stock_level" class="validate" autocomplete="off" required value="{{ old('stock_level', 0) }}">
                    <label for="create_raw_material_stock_level" class="{{ old('stock_level') ? 'active' : '' }}">Nível Mínimo de Estoque</label>
                    @error('stock_level')
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

{{-- Modal para Editar Matéria-Prima --}}
<div id="modal-edit-raw_material" class="modal">
    <form id="form-edit-raw_material" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <h4>Editar Matéria-Prima</h4>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="edit_raw_material_name" type="text" name="name" class="validate" autocomplete="off" required>
                    <label for="edit_raw_material_name" class="active">Nome da Matéria-Prima</label>
                    @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" id="edit_raw_material_unit_autocomplete" class="autocomplete" autocomplete="off" required>
                    <label for="edit_raw_material_unit_autocomplete" class="active">Unidade de Medida</label>
                    <input type="hidden" id="edit_raw_material_unit_id" name="unit_id">
                    @error('unit_id')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="edit_raw_material_description" name="description" class="materialize-textarea" autocomplete="off"></textarea>
                    <label for="edit_raw_material_description" class="active">Descrição (Opcional)</label>
                    @error('description')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="edit_raw_material_cost_per_unit" type="number" step="0.01" name="cost_per_unit" class="validate" autocomplete="off">
                    <label for="edit_raw_material_cost_per_unit" class="active">Custo por Unidade (R$)</label>
                    @error('cost_per_unit')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="edit_raw_material_stock_level" type="number" name="stock_level" class="validate" autocomplete="off" required>
                    <label for="edit_raw_material_stock_level" class="active">Nível de Estoque</label>
                    @error('stock_level')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn-flat green darken-2 white-text">Salvar Alterações</button>
            <a href="#!" class="modal-close btn-flat">Cancelar</a>
        </div>
    </form>
</div>