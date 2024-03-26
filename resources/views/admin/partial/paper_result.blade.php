<h5 class="card-title py-0 mb-2">Wavg Paper Result</h5>

<div class="row">
    <div class="col-lg-4 col-md-4" style="font-weight: 600;color: rgba(1, 41, 112, 0.6);">Wavg result </div>
    <div class="col-lg-8 col-md-8">{{ $result }}</div>
</div>
@foreach($rating as $key => $value)
<div class="row">
    <div class="col-lg-4 col-md-4" style="font-weight: 600;color: rgba(1, 41, 112, 0.6);">{{ ucfirst($key) }}</div>
    <div class="col-lg-8 col-md-8"> {{ $value }}</div>
</div>
@endforeach