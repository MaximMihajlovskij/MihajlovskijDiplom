@extends('base')

@section('content')
<div class="container">
    <h2>Поиск оборудования</h2>
    <input type="text" id="search" placeholder="Введите название..." class="form-control">
    <div id="searchResults" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Результаты поиска</h2>
            <ul id="resultsList"></ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        let query = this.value;
        if (query.length > 2) {
            fetch("{{ route('search') }}?query=" + query)
                .then(response => response.json())
                .then(data => {
                    let results = "";
                    [...data.cameras, ...data.turnikets, ...data.barriers, ...data.accessories].forEach(item => {
                        results += `<li><strong>${item.name_camera ?? item.name_turniket ?? item.name_barrier ?? item.name}</strong></li>`;
                    });

                    document.getElementById('resultsList').innerHTML = results;
                    document.getElementById('searchResults').style.display = "block";
                });
        } else {
            document.getElementById('searchResults').style.display = "none";
        }
    });

    document.querySelector(".close").addEventListener("click", function() {
        document.getElementById("searchResults").style.display = "none";
    });
</script>
@endsection
