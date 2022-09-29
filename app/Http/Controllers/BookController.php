<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('Books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('Books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // BookRequest validation
        $request->validate([
            'title' => 'required|string',
            'authors' => 'required'
        ]);
        try {
            $authors = $request->authors;
            $book = Book::create($request->except('authors'));

            if ($authors) {
                foreach ($authors as $author) {
                    $book->authors()->attach($author);
                }
            } else {
                return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Please select Author.');
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('success', 'Successfully Created A Author.');
        }
        catch (\Exception $e)
        {
            info($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('authors')->where('id',$id)->first();

        return view('Books.authors', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        try {
            $author = Book::findOrFail($id);
            $author->update($request->validated());
            return redirect()
            ->back()
                ->withInput()
                ->with('success', 'Successfully Updated Book.'
            );
        }catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //removes the relationship before deleting the book
        $book = Book::findOrFail($id);
        $book->authors()->detach();
        $book->delete();

        $books = Book::paginate(10);
        return view('Books.index', compact('books'));
    }

    // Function creates co author view for the selected book
    public function addCoAuthor($id)
    {
        $book = Book::findOrFail($id);
        return view('Books.create-author', compact('book'));
    }

    // Function store co author information for the selected book
    public function storeCoAuthor(Request $request)
    {
        try {
            $book_id = $request->book_id;
            $author = Author::create($request->except('book_id'));

            $author->books()->attach($book_id);

            return redirect()
                ->back()
                ->withInput()
                ->with('success', 'Successfully Created Co Author.');
        }
        catch (\Exception $e)
        {
            info($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }
}
