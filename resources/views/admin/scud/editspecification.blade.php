@extends('admin')

@section('title', 'Редактировать технические характеристики')

@section('specification-edit')
    <h1>Редактирование технических характеристик</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.scud.updatespecification', $specification) }}" method="POST">
        @csrf @method('PUT')
   
    <label>Выберите тип устройства</label>
        <select id="device-type" class="form-select">
            <option value="">-</option>
            <option value="turniket" {{ $specification->turniket_id ? 'selected' : '' }}>Турникет</option>
            <option value="camera" {{ $specification->camera_id ? 'selected' : '' }}>Видеокамера</option>
            <option value="barrier" {{ $specification->barrier_id ? 'selected' : '' }}>Шлагбаум</option>
        </select>

        <div id="turniket-container" style="display: {{ $specification->turniket_id ? 'block' : 'none' }};">
            <label>Турникет</label>
            <select name="turniket_id" class="form-select">
                <option value="">-</option>
                @foreach($turnikets as $turniket)
                    <option value="{{ $turniket->id }}" {{ $specification->turniket_id == $turniket->id ? 'selected' : '' }}>
                        {{ $turniket->name_turniket }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="camera-container" style="display: {{ $specification->camera_id ? 'block' : 'none' }};">
            <label>Видеокамера</label>
            <select name="camera_id" class="form-select">
                <option value="">-</option>
                @foreach($cameras as $camera)
                    <option value="{{ $camera->id }}" {{ $specification->camera_id == $camera->id ? 'selected' : '' }}>
                        {{ $camera->name_camera }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="barrier-container" style="display: {{ $specification->barrier_id ? 'block' : 'none' }};">
            <label>Шлагбаум</label>
            <select name="barrier_id" class="form-select">
                <option value="">-</option>
                @foreach($barriers as $barrier)
                    <option value="{{ $barrier->id }}" {{ $specification->barrier_id == $barrier->id ? 'selected' : '' }}>
                        {{ $barrier->name_barrier }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="specifications">
            <label>Технические характеристики:</label>
            <div class="specification-item">
                <input type="text" name="key[]" class="form-control" value="{{ $specification->key }}">
                <div class="values">
                    @foreach (explode('; ', $specification->value) as $val)
                        <input type="text" name="value[0][]" class="form-control mt-2" value="{{ trim($val) }}">
                    @endforeach
                </div>
                <button type="button" class="btn btn-success mt-2 add-value">Добавить значение</button>
                <button type="button" class="btn btn-danger mt-2 remove-specification">Удалить характеристику</button>
            </div>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Сохранить изменения</button>
    </form>

    <script>
        document.getElementById('device-type').addEventListener('change', function () {
            let selectedType = this.value;

            document.getElementById('turniket-container').style.display = selectedType === 'turniket' ? 'block' : 'none';
            document.getElementById('camera-container').style.display = selectedType === 'camera' ? 'block' : 'none';
            document.getElementById('barrier-container').style.display = selectedType === 'barrier' ? 'block' : 'none';
        });
    </script>
    <script>
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('add-value')) {
                let parent = event.target.previousElementSibling;
                let input = document.createElement('input');
                input.type = 'text';
                input.name = parent.querySelector('input').name;
                input.classList.add('form-control', 'mt-2');
                input.placeholder = "Новое значение";
                parent.appendChild(input);
            }
        });
    </script>
@endsection
