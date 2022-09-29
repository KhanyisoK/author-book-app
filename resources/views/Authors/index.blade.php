@extends('layouts.app')

@section('content')
<div class="container">
    @if (session()->has('success'))
            <div class="font-semibold rounded-full bg-green-100 text-green-800">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="font-semibold rounded-full bg-red-100 text-red-800">
                {{ session()->get('error') }}
            </div>
        @endif
    <div class="row justify-content-center">
        <div class="container">
            <h3>Manage Authors</h3>
        </div>
        <div class="col-md-8">
            <a type="button" class="btn" style="background-color: rgb(31, 81, 255)" data-toggle="tooltip" data-placement="bottom"
                    href="{{ route('author.create')}}"
                title="Add Author"><i class="large material-icons">add</i>
            </a>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Surname
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($authors as $author)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $author->name }}
                        </div>
                    </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ $author->surname }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a type="button" class="btn" style="background-color: rgb(31, 81, 255)" data-toggle="tooltip" data-placement="bottom"
                        href="{{ route('author.edit', $author->id)}}"
                            title="Edit Author"><i class="large material-icons">create</i>
                        </a>
                        <a type="submit" class="btn" style="background-color: red" data-toggle="tooltip" data-placement="bottom"
                        id="{{$author->id}}" onclick="confirm_delete_author(this.id)"
                            title="Delete Author"><i class="large material-icons">delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $authors->links() }}
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
    function confirm_delete_author(obj){
        var r = confirm("Are you sure want to delete this record?");
        if (r == true) {
            let author_id = obj;
            $.get('/delete-author/'+author_id,function(data,status){
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
