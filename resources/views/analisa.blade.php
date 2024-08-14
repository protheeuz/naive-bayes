@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('analisa.hitung') }}" method="post" id="form_analisa">
        @csrf
        @foreach ($kriteria as $k)
            @if ($k->tipe == 1)
                <div class="form-group">
                    <label for="kriteria_{{ $k->id_kriteria }}">{{ $k->nama }}</label>
                    <select class="form-control" name="kriteria_{{ $k->id_kriteria }}" id="kriteria_{{ $k->id_kriteria }}" required>
                        <option value=""></option>
                        @foreach ($subkriteria->where('id_kriteria', $k->id_kriteria) as $sk)
                            <option value="{{ $sk->id_subkriteria }}">{{ $sk->nama }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        @endforeach
        <div class="form-group">
            <button type="submit" class="btn btn-success">Hitung</button>
        </div>
    </form>
</div>
@endsection