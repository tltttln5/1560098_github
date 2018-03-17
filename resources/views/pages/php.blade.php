@extends('layouts.master')
@section('NoiDung')
{{--
@if ($monhoc != "")
{{$monhoc}}
@else
{{"Khong co mon hoc nao!"}}
@endif
--}}
{{$monhoc or "Khong co khoa hoc nao!!!"}}
<br>

@for ($i = 0; $i < 10; $i++)
    {{ $i}}
@endfor
{{--day la chu thich--}}

@endsection