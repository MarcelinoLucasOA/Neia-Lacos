@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><strong>Lista de Matérias-Primas</strong></span>
                    <a class="btn-small green darken-2 right modal-trigger" href="#modal-create-raw_material" data-mode="create">Nova Matéria-Prima</a>

                    <table class="striped responsive-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Unidade</th>
                                <th>Custo/Unid.</th>
                                <th>Estoque Mínimo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rawMaterials as $rawMaterial)
                                <tr>
                                    <td>{{ $rawMaterial->name }}</td>
                                    <td>{{ $rawMaterial->unit->symbol ?? 'N/A' }}</td>
                                    <td>R$ {{ number_format($rawMaterial->cost_per_unit, 2, ',', '.') }}</td>
                                    <td>{{ $rawMaterial->min_stock_level }}</td>
                                    <td>
                                        <a href="#modal-edit-raw_material" class="modal-trigger grey-text text-darken-2 edit-raw-material-btn" data-id="{{ $rawMaterial->id }}" data-name="{{ $rawMaterial->name }}" data-description="{{ $rawMaterial->description }}" data-unit_id="{{ $rawMaterial->unit_id }}" data-cost_per_unit="{{ $rawMaterial->cost_per_unit }}" data-min_stock_level="{{ $rawMaterial->min_stock_level }}" title="Editar Matéria-Prima">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form action="{{ route('raw_materials.destroy', $rawMaterial->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta matéria-prima?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-flat red-text text-darken-2" title="Excluir Matéria-Prima">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Nenhuma matéria-prima cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('raw_materials._raw_materials_modals')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.modal').modal();

            const unitData = {};
            const unitIdMap = {};
            @foreach ($units as $unit)
                unitData['{{ $unit->name }} ({{ $unit->symbol }})'] = null;
                unitIdMap['{{ $unit->name }} ({{ $unit->symbol }})'] = {{ $unit->id }};
            @endforeach

            $('#modal-create-raw_material .autocomplete').autocomplete({
                data: unitData,
                limit: 5,
                onAutocomplete: function(val) {
                    $('#create_raw_material_unit_id').val(unitIdMap[val]);
                },
                minLength: 0,
            });

            $('#modal-edit-raw_material .autocomplete').autocomplete({
                data: unitData,
                limit: 5,
                onAutocomplete: function(val) {
                    $('#edit_raw_material_unit_id').val(unitIdMap[val]);
                },
                minLength: 0,
            });

            $('.edit-raw-material-btn').on('click', function() {
                const rawMaterialId = $(this).data('id');
                const rawMaterialName = $(this).data('name');
                const rawMaterialDescription = $(this).data('description');
                const rawMaterialUnitId = $(this).data('unit_id');
                const rawMaterialCostPerUnit = $(this).data('cost_per_unit');
                const rawMaterialMinStockLevel = $(this).data('min_stock_level');

                const form = $('#form-edit-raw_material');
                form.attr('action', `{{ route('raw_materials.update', ':raw_material_id') }}`.replace(':raw_material_id', rawMaterialId));

                $('#edit_raw_material_name').val(rawMaterialName);
                $('#edit_raw_material_description').val(rawMaterialDescription);

                $('#edit_raw_material_unit_id').val(rawMaterialUnitId);

                let unitText = '';
                for (const text in unitIdMap) {
                    if (unitIdMap[text] == rawMaterialUnitId) {
                        unitText = text;
                        break;
                    }
                }
                $('#edit_raw_material_unit_autocomplete').val(unitText);
                $('#edit_raw_material_cost_per_unit').val(rawMaterialCostPerUnit);
                $('#edit_raw_material_min_stock_level').val(rawMaterialMinStockLevel);

                M.updateTextFields();
            });

            @if ($errors->any() && session('modal_open') == 'create_raw_material')
                $('#modal-create-raw_material').modal('open');
                M.updateTextFields();

                @if (old('unit_id'))
                    $('#create_raw_material_unit_id').val('{{ old('unit_id') }}');
                @endif
            @elseif ($errors->any() && session('modal_open') == 'edit_raw_material')
                $('#modal-edit-raw_material').modal('open');
                M.updateTextFields();
                @if (old('unit_id'))
                    $('#edit_raw_material_unit_id').val('{{ old('unit_id') }}');
                @endif
                @if (old('unit_autocomplete_value'))
                    $('#edit_raw_material_unit_autocomplete').val('{{ old('unit_autocomplete_value') }}');
                @endif
            @endif
        });
    </script>
@endpush
