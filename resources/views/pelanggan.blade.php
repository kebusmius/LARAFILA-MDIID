<!-- resources/views/pelanggan.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Pelanggan</h1>

    <table>
        <thead>
            <tr>
                <th>No Account</th>
                <th>Nama</th>
                <th>Total Tagihan</th>
                <th>PPH</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggan as $data)
                <tr>
                    <td>{{ $data->no_account }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->total }}</td>
                    <td>{{ $data->pph }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
