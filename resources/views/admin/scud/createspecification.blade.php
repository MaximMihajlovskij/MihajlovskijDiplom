@extends('admin')

@section('title', 'Добавить технические характеристики')

@section('specification_create')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.scud.storespecification') }}" method="POST">
        @csrf
        <!-- Выбор категории устройства -->
        <label>Выберите тип устройства</label>
        <select id="device-type" class="form-select">
            <option value="">-</option>
            <option value="turniket">Турникет</option>
            <option value="camera">Видеокамера</option>
            <option value="barrier">Шлагбаум</option>
        </select>

        <!-- Турникеты -->
        <div id="turniket-container" style="display: none;">
            <label>Турникет</label>
            <select name="turniket_id" class="form-select">
                <option value="">-</option>
                @foreach($turnikets as $turniket)
                    <option value="{{ $turniket->id }}">{{ $turniket->name_turniket }}</option>
                @endforeach
            </select>
        </div>

        <!-- Видеокамеры -->
        <div id="camera-container" style="display: none;">
            <label>Видеокамера</label>
            <select name="camera_id" class="form-select">
                <option value="">-</option>
                @foreach($cameras as $camera)
                    <option value="{{ $camera->id }}">{{ $camera->name_camera }}</option>
                @endforeach
            </select>
        </div>

        <!-- Шлагбаумы -->
        <div id="barrier-container" style="display: none;">
            <label>Шлагбаум</label>
            <select name="barrier_id" class="form-select">
                <option value="">-</option>
                @foreach($barriers as $barrier)
                    <option value="{{ $barrier->id }}">{{ $barrier->name_barrier }}</option>
                @endforeach
            </select>
        </div>

        <div id="specifications">
            <label>Технические характеристики:</label>
            <div class="specification-item">
                <input type="text" name="key[]" class="form-control" placeholder="Ключ">
                <div class="values">
                    <input type="text" name="value[0][]" class="form-control mt-2" placeholder="Значение">
                </div>
                <button type="button" class="btn btn-success mt-2 add-value">Добавить значение</button>
                <button type="button" class="btn btn-danger mt-2 remove-specification">Удалить характеристику</button>
            </div>
        </div>
        
        <button type="button" class="btn btn-secondary mt-3" id="add-specification">Добавить ещё характеристику</button>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
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
        let specIndex = 0;

        document.getElementById('add-specification').addEventListener('click', function () {
            specIndex++;
            let newField = document.createElement('div');
            newField.classList.add('specification-item');
            newField.innerHTML = `
                <input type="text" name="key[]" class="form-control mt-2" placeholder="Ключ">
                <div class="values">
                    <input type="text" name="value[${specIndex}][]" class="form-control mt-2" placeholder="Значение">
                </div>
                <button type="button" class="btn btn-success mt-2 add-value">Добавить значение</button>
                <button type="button" class="btn btn-danger mt-2 remove-specification">Удалить характеристику</button>
            `;
            document.getElementById('specifications').appendChild(newField);
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-specification')) {
                event.target.parentElement.remove();
            }

            if (event.target.classList.contains('add-value')) {
                let parent = event.target.previousElementSibling;
                let input = document.createElement('input');
                input.type = 'text';
                input.name = parent.querySelector('input').name;
                input.classList.add('form-control', 'mt-2');
                input.placeholder = "Значение";
                parent.appendChild(input);
            }
        });
    </script>
@endsection
