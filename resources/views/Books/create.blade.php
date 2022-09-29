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
        <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="card" style="padding: 10px;">
                <div class="card-header card-header" style="background-color: white">
                    <h4 style="color: black" class="card-title">{{ __('Create Book') }}</h4>
                    <p class="card-category" style="color: black">{{ __('Enter Book Information') }}</p>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="title" name="title" type="text" class="validate">
                            <label for="title">Title</label>
                        </div>
                        <div class="input-field col s6">
                            <select multiple  name="authors[]">
                              <option value="" disabled selected>Choose the author</option>
                              @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                              @endforeach
                            </select>
                            <label>Select Author</label>
                          </div>
                    </div>
                </div>
                <br>
                <div class="card-footer ml-auto mr-auto">
                    <button id="submit-button" class="btn" style="background-color: rgb(31, 81, 255)">{{ __('Submit') }}</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
