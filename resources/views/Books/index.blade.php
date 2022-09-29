@extends('layouts.app')

@section('content')
<div class="container">
    @if (session()->has('success'))
            <div class="green">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="red">
                {{ session()->get('error') }}
            </div>
        @endif
    <div class="row justify-content-center">
        <div class="container">
            <h3>Manage Books</h3>
        </div>
        <div class="col-md-8">
            <a type="button" class="btn" style="background-color: rgb(31, 81, 255)" data-toggle="tooltip" data-placement="bottom"
                    href="{{ route('book.create')}}"
                title="Add Book"><i class="large material-icons">add</i>
            </a>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($books as $book)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $book->title }}
                        </div>
                    </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a type="button" class="btn" style="background-color: rgb(31, 81, 255)" data-toggle="tooltip" data-placement="bottom"
                        href="{{ route('book.edit', $book->id)}}"
                            title="Edit Author"><i class="large material-icons">create</i>
                        </a>
                        <a type="button" class="btn" style="background-color: green" data-toggle="tooltip" data-placement="bottom"
                        href="{{ route('book.show', $book->id)}}"
                            title="View Authors"><i class="large material-icons">remove_red_eye</i>
                        </a>
                        <a type="submit" class="btn" style="background-color: red" data-toggle="tooltip" data-placement="bottom"
                        id="{{$book->id}}" onclick="confirm_delete_book(this.id)"
                            title="Delete Author"><i class="large material-icons">delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
    function confirm_delete_book(obj){
        var r = confirm("Are you sure want to delete this record?");
        if (r == true) {
            let book_id = obj;
            $.get('/delete-books/'+book_id,function(data,status){
                console.log('Status',status);
                if(status=='success'){
                    alert("Deleted Successfully");
                    window.location.reload();
                }
            });
        } else {
            alert('Delete action cancelled');
        }
    }
</script>
  </div>
@endsection
