@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Danh Mục Hoa</h1>

    {{-- <div class="category-list">
        @foreach ($categories as $cat)
            <div class="category-item">
                <a href="{{ url('/danhmuc/'.$cat->id) }}">
                    {{ $cat->name }}
                </a>
            </div>
        @endforeach
    </div> --}}
</div>
@endsection
