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
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Formula</h5>
                        <!-- List group with active and disabled items -->
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
                        </ul><!-- End ist group with active and disabled items -->
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body" id="formulaDetails">
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<script>
    // Function to fetch formula details based on the selected name
    function fetchFormulaDetails(name) {
        // Find the formula by name in the array
        const selectedFormula = @json($formulas->keyBy('name')-> toArray())[name];

        // Display the details in the second card
        const formulaDetails = document.getElementById('formulaDetails');
        formulaDetails.innerHTML = '';

        if (selectedFormula) {
            const formulaName = document.createElement('h5');
            formulaName.classList.add('card-title');
            formulaName.textContent = selectedFormula.name;

            const formulaContent = document.createElement('p');
            formulaContent.textContent = selectedFormula.formula.replace(/,/g, ' '); // Replace commas with spaces

            formulaDetails.appendChild(formulaName);
            formulaDetails.appendChild(formulaContent);
        } else {
            // Handle the case when the formula is not found
            const errorMessage = document.createElement('p');
            errorMessage.textContent = 'Formula not found.';
            formulaDetails.appendChild(errorMessage);
        }
    }
</script>
@endsection