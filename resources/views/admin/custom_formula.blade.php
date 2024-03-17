@extends('layout.main')
@section('title', 'Kustom Rumus')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Formula</h5>
                        <ul class="list-group" id="formulaList">
                            @if ($formulas->isEmpty())
                            <p>No formulas available.</p>
                            @else
                            <ul class="list-group" id="formulaList">
                                @foreach ($formulas as $formula)
                                <li class="list-group-item" onclick="fetchFormulaDetails('{{ $formula->name }}')">
                                    {{ $formula->name }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                <div class="card-header py-0 ps-3" style="border-color: #fff;">
                    <h5 class="card-title mb-0" id="formulaTitle"></h5>
                </div>
                    <div class="card-body">
                        <div id="formulaDetails"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<script>
    function fetchFormulaDetails(name) {
        const selectedFormula = @json($formulas->keyBy('name')-> toArray())[name];

        const formulaTitle = document.getElementById('formulaTitle');
        formulaTitle.innerHTML = '';
        const formulaDetails = document.getElementById('formulaDetails');
        formulaDetails.innerHTML = '';

        if (selectedFormula) {
            formulaTitle.textContent = selectedFormula.name; // Mengatur judul formula

            const formulaContent = document.createElement('p');
            formulaContent.textContent = selectedFormula.formula.replace(/,/g, ' '); // Replace commas with spaces

            formulaDetails.appendChild(formulaContent);
        } else {
            const errorMessage = document.createElement('p');
            errorMessage.textContent = 'Formula not found.';
            formulaDetails.appendChild(errorMessage);
        }
    }
</script>
@endsection