@extends('layout.main')
@section('title', 'Variabel')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Variabel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Health Index</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <!-- Variables List -->
                <div class="row">
                    @php
                    $icons = ['bi bi-puzzle', 'bi bi-gear-wide-connected', 'bi bi-box-seam', 'bi bi-archive'];
                    $color = ['sales-card', 'revenue-card', 'customers-card', 'product-card'];
                    $iconIndex = 0;
                    @endphp
                    @foreach($variable as $var)
                    <div class="col-xxl-4 col-md-6 col-6">
                        <a href="#" class="card-link">
                            <div class="card info-card {{ $color[$iconIndex] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $var->variable }}</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="{{ $icons[$iconIndex] }}"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span style="font-size: 10px;color: #899bbd;">TOTAL DATA:</span>
                                            <h6>{{ $var->jumlah_data }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                    @php
                    $iconIndex = ($iconIndex + 1) % count($icons);
                    @endphp
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Variabel</h5>

                        <!-- Accordion without outline borders -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($data as $tableName => $table)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading{{ $loop->index }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loop->index }}" aria-expanded="false" aria-controls="flush-collapse{{ $loop->index }}">
                                        {{ $tableName }} Data
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $loop->index }}" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @if (empty($table['rows']))
                                        No data available for {{ $tableName }}.
                                        @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    @foreach ($table['columns'] as $column)
                                                    @if ($column !== 'created_at' && $column !== 'updated_at')
                                                    <th>{{ $column }}</th>
                                                    @endif
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($table['rows'] as $row)
                                                <tr>
                                                    @foreach ($row as $value)
                                                    <td>{{ $value }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div><!-- End Accordion without outline borders -->

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</main>
@endsection