@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="card-title">Dataset</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="40">NO</th>
                    <th>KODE</th>
                    @foreach ($kriteria as $k)
                        <th>{{ strtoupper($k->nama) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($datasets as $index => $dataset)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-nowrap">{{ $dataset->kode }}</td>
                        @foreach ($kriteria as $k)
                            <td class="text-nowrap">
                                @foreach ($dataset->details->where('id_kriteria', $k->id_kriteria) as $detail)
                                    {{ $detail->subkriteria->nama }}
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h4 class="card-title">Probabilitas Prior</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>TARGET</th>
                    <th class="text-center">FREKUENSI</th>
                    <th class="text-center">PROBABILITAS</th>
                </tr>
            </thead>
            <tbody>
                {{-- Add probabilitas prior rows here --}}
            </tbody>
        </table>
    </div>

    {{-- Add more tables and calculations as per the original code --}}
</div>
@endsection
