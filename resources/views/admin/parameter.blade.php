@extends('layout.main')
@section('title', 'Parameter')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Health Index Calculator</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Health Index</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <!-- Oil Quality Factor -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Oil Quality Factors</h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Parameter</th>
                                    <th scope="col">Weighting</th>
                                    <th scope="col">Scoring</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($oilFactor as $oil)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $oil->parameter}}</td>
                                    <td>{{ $oil->weightings }}</td>
                                    <td>{{ $oil->scorings }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</main>
@endsection