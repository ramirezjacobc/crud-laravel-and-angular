<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use JavaScript;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->get();
        $categories = Category::all();

        JavaScript::put([
            'books' => $books,
            'categories' => $categories,
        ]);

        return view('books');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->only('name', 'description', 'author', 'user', 'category_id', 'available', 'published_date'));

        if($book) {
          $data = $this->setData($book->id);
          return json_encode(array('type' => 'success', 'msg' => 'Book added successfully', 'data' => $data));
        } else {
          return json_encode(array('type' => 'error', 'msg' => 'Error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $book->available = $book->availble == 1 ? false : true;

        if($book->save()) {
          $data = $this->setData($book->id);
          return json_encode(array('type' => 'success', 'msg' => 'status changed successfully', 'data' => $data));
        } else {
          return json_encode(array('type' => 'error', 'msg' => 'Error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->name = $request->name;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->user = $request->user;
        $book->published_date = $request->published_date;
        $book->available = $request->available;
        $book->category_id = $request->category_id;

        if($book->save()) {
          $data = $this->setData($book->id);
          return json_encode(array('type' => 'success', 'msg' => 'Book updated successfully', 'data' => $data));
        } else {
          return json_encode(array('type' => 'error', 'msg' => 'Error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if($book) {
          $book->delete();
          return json_encode(array('type' => 'success', 'msg' => 'Book updated successfully'));
        } else {
          return json_encode(array('type' => 'error', 'msg' => 'Error'));
        }
    }

    public function setData($id)
    {
      return Book::with('category')->find($id);
    }
}
