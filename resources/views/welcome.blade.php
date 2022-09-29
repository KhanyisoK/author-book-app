@extends('layouts.app')

@section('content')
    <div class="container center-align">
        <div class="row justify-content-center">
            <div class="col s6 m4">
              <div class="card">
                <div class="card-image">
                  <img src="img/author.jpeg">
                </div>
                <div class="card-content">
                    <h3>Authors</h3>
                    <p>Please click on the link to manage all the Authors.</p>
                </div>
                <div class="card-action">
                  <a href="{{ route('author.index')}}">Manage Authors</a>
                </div>
              </div>
            </div>
            <div class="col s6 m4">
                <div class="card">
                  <div class="card-image">
                    <img src="img/books.jpg">
                  </div>
                  <div class="card-content">
                    <h3>Books</h3>
                    <p>Please click on the link to manage all the books.</p>
                  </div>
                  <div class="card-action">
                    <a href="{{ route('book.index')}}">Manage Books</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection
