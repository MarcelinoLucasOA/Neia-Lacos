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
                                <th>Estoque</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rawMaterials as $rawMaterial)
                                <tr>
                                    <td>{{ $rawMaterial->name }}</td>
                                    <td>{{ $rawMaterial->unit->symbol ?? 'N/A' }}</td>
                                    <td>R$ {{ number_format($rawMaterial->cost_per_unit, 2, ',', '.') }}</td>
                                    <td>{{ $rawMaterial->stock_level }}</td>
                                    <td>
                                        <a href="{{ route('raw_materials.show', $rawMaterial->id) }}" class="btn-small blue darken-1">Detalhes</a>
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
                const rawMaterialUnitId = $(this).data('unit_id');
                $('#edit_raw_material_unit_id').val(rawMaterialUnitId);

                let unitText = '';
                for (const text in unitIdMap) {
                    if (unitIdMap[text] == rawMaterialUnitId) {
                        unitText = text;
                        break;
                    }
                }
                $('#edit_raw_material_unit_autocomplete').val(unitText);
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
            @endif
        });
    </script>
@endpush
