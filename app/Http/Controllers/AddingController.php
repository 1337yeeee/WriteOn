<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Product;

class AddingController extends Controller
{
    static public function addBookProduct($file_path) {
        $errors = [];

        $file = fopen($file_path, "r");
        $data = [];
        while (($row = fgetcsv($file, 0, ';')) !== false) {
            $data[] = $row;
        }

        fclose($file);

        $headers = $data[0];
        $headers[0] = trim($headers[0], "\xEF\xBB\xBF");
        if ($headers != ['title', 'author', 'year',
            'image', 'publisher', 'genre', 'oldprice', 'price', 'description']) {
            return ['Заголовки не соответствуют форме'];
        }
        $data = array_slice($data, 1);

        foreach ($data as $row) {
            $author_name = $row[array_search('author', $headers)];
            $author_id = DB::table('authors')->where('name', $author_name)->first();
            if (!$author_id) {
                $errors[] = "Ошибка с автором: author_name=".$author_name."; author_id=".$author_id;
                continue;
            }

            $title = $row[array_search('title', $headers)];
            $year = $row[array_search('year', $headers)];
            $image = $row[array_search('image', $headers)];
            $oldprice = $row[array_search('oldprice', $headers)];
            $price = $row[array_search('price', $headers)];
            $publisher = $row[array_search('publisher', $headers)];
            $description = $row[array_search('description', $headers)];

            $book_id = DB::table('books')
                ->where('title', $title)
                ->where('author_id', $author_id->id)
                ->where('year', $year)
                ->where('publisher', $publisher)
                ->first();
            if ($book_id) {
                $errors[] = "Проблема с записью книги: title=".$title."; book_id=".$book_id->id;
                continue;
            }

            $book = new Book;
            $book->title = $title;
            $book->author_id = $author_id->id;
            $book->year = $year;
            $book->publisher = $publisher;
            $book->save();

            $genres = $row[array_search('genre', $headers)];
            $genres = explode(', ', $genres);

            foreach ($genres as $genre) {
                $existing_genre = DB::table('genres')->where('genre', $genre)->first();
                if (!$existing_genre) {
                    DB::table('genres')->insert([
                        'genre' => $genre
                    ]);
                    $existing_genre = DB::table('genres')->where('genre', $genre)->first();
                }

                $existing_book_genre = DB::table('book_genre')
                    ->where('genre_id', $existing_genre->id)
                    ->where('book_id', $book->id)
                    ->first();
                if (!$existing_book_genre) {
                    DB::table('book_genre')->insert([
                        'genre_id' => $existing_genre->id,
                        'book_id' => $book->id,
                    ]);
                }
            }

            $product = new Product;
            $product->name = $title;
            $product->category_id = 1;
            $product->book_id = $book->id;
            $product->description = $description;
            $product->image = $image;
            $product->oldprice = ($oldprice==='') ? null : $oldprice;
            $product->price = $price;
            $product->save();

            return $errors;
        }
    }

    static public function addAuthors($file_path) {
        $errors = [];

        $file = fopen($file_path, "r");
        $data = [];
        while (($row = fgetcsv($file, 0, ';')) !== false) {
            $data[] = $row;
        }

        fclose($file);

        $headers = $data[0];
        $headers[0] = trim($headers[0], "\xEF\xBB\xBF");
        $data = array_slice($data, 1);

        foreach ($data as $row) {
            $insert_data = array_combine($headers, $row);

            $name = $row[array_search('name', $headers)]; 
            $existing_author = DB::table('authors')->where('name', $name)->first();
            if($existing_author) {
                $errors[] = "Автор уже существует: name=".$name;
                continue;
            }

            $author = DB::table('authors')->insert($insert_data);
            if (!$author) {
                $errors[] = "Не удалось добавить автора: ".$insert_data;
            }
        }

        return $errors;
    }
}
