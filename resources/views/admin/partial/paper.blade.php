@if(!empty($matchParameters))
<div class="col-12">
    <div class="form-floating">
        <select class="form-select mb-3" id="floatingPaper" name="comparison_paper" aria-label="Floating label select example">
            <option value="0" selected>Open to select comparison</option>
            @foreach ($compare as $cmpr)
            <option value="{{ $cmpr->variable }}">{{ $cmpr->variable }}</option>
            @endforeach
        </select>
        <label for="floatingPaper">Comparing</label>
    </div>
</div>
@foreach($matchParameters as $parameter)
<div class="col-12 mb-3">
    <div class="form-floating">
        <input type="text" class="form-control" id="{{ $parameter }}" name="{{ $parameter }}" placeholder="Input {{ $parameter }}.." required>
        <label for="{{ $parameter }}" class="form-label">{{ $parameter }}</label>
    </div>
</div>
@endforeach
@endif