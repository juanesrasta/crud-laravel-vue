<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
		return Inertia::render(
			'Books/Index',
			[
				'books' => $books
			]
		);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
			'Books/Create'
		);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
			'title' => 'required',
			'autor' => 'required',
			'review' => 'required'
		]);
		Book::create([
			'title' => $request->title,
			'autor' => $request->autor,
			'review' => $request->review
		]);
		sleep(1);
		return redirect()->route('books.index')->with('message', 'Book Created Succesfully');

    }

    /**
     * Display the specified resource.
     */
    public function edit(Book $book)
    {
        return Inertia::render(
			'Books/Edit',
			[
				'book' => $book
			]
		);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
			'title' => 'required',
			'autor' => 'required',
			'review' => 'required'
		]);
		$book->title = $request->title;
		$book->autor = $request->autor;
		$book->review = $request->review;
		$book->save();
		sleep(1);
		return redirect()->route('books.index')->with('message', 'Book Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
		sleep(1);
		return redirect()->route('books.index')->with('message', 'Book Delete Successfully');
    }
}
