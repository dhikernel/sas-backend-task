<?php

declare(strict_types=1);

namespace App\Domain\BookStore\Repositories;

use App\Domain\BookStore\Models\BookStore;

class BookStoreRepository
{
    public function listBooks()
    {
        return BookStore::orderBy('book_id')->get();
    }

    public function createBooks(array $request): BookStore
    {
        return BookStore::create($request);
    }

    public function updateOrNewBook(array $data, int $id)
    {
        $book = BookStore::firstOrNew(['book_id' => $id]);

        return $book->fill($data)->save();
    }

    public function deleteBook(int $id): bool
    {
        return (bool) BookStore::destroy($id);
    }
}
