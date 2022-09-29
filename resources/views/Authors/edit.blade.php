@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
        <div class="success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if (session()->has('error'))
            <div class="danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('author.update', $author->id)}}">
            @method('PUT')
            @csrf
            <div class="card" style="padding: 10px;">
                <div class="card-header card-header" style="background-color: white">
                    <h4 style="color: black" class="card-title">{{ __('Edit Author') }}</h4>
                    <p class="card-category" style="color: black">{{ __('Update Author Information') }}</p>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Name" name="name" value="{{$author->name}}" type="text" class="validate">
                            <label for="name">Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="surname" value="{{$author->surname}}" type="text" class="validate">
                            <label for="surname">Surname</label>
                        </div>
                        </div>
                </div>
                <br>
                <div class="card-footer ml-auto mr-auto">
                    <button id="submit-button" class="btn" style="background-color: rgb(31, 81, 255)">{{ __('Update') }}</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
