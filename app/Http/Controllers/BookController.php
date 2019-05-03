<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Book;
class BookController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $books = Book::all();
        return $this->successResponse($books);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //The rules
        $rules = [
            'author_id'   => 'required|min:1',
            'title'       => 'required|max:255',
            'description' => 'required|max:255',
            'price'       => 'required|min:1',
        ];
        //validate the request
       $this->validate($request, $rules);
        // $book = Book::create($request->all());
        // return $this->successResponse($book, Response::HTTP_CREATED);
        //instantiate the Author
        $book = new Book();
        $book->author_id   = $request->input('author_id');
        $book->title       = $request->input('title');
        $book->description = $request->input('description');
        $book->price       = $request->input('price');
        //Save the author
        $book->save();
        //Return the new author
        return $this->successResponse($book, Response::HTTP_CREATED);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($book) {
        $book = Book::findOrFail($book);
        return $this->successResponse($book);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book) {
        //The rules
        $rules = [
            'author_id'   => 'min:1',
            'title'       => 'max:255',
            'description' => 'max:255',
            'price'       => 'min:1',
        ];
        //validate the request
        $this->validate($request, $rules);
        //find the author using its id
        $book = Book::findOrFail($book);

        //Check if the request has title
        if ($request->has('title')) {
            $book->title = $request->input('title');
        }
        //Check if the request has author_id
        if ($request->has('author_id')) {
            $book->author_id = $request->input('author_id');
        }
        //Check if the request has name
        if ($request->has('description')) {
            $book->description    = $request->input('description');
        }
        //Check if the request has price
        if ($request->has('price')) {
            $book->price = $request->input('price');
        }
        //Check if anything changed in author
        if ($book->isClean()) {
            return $this->errorResponse('You must specify a new value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //Save the author
        $book->save();
        //Return the new author
        return $this->successResponse($book, Response::HTTP_CREATED);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($book) {
        //find the author using its id
        $book = Book::findOrFail($book);
        $book->delete();
        //Return the new author
        return $this->successResponse($book);
    }
}
