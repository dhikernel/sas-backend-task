<?php

declare(strict_types=1);

namespace App\Domain\BookStore\Repositories;

use App\Domain\BookStore\Models\BookStore;
use App\Domain\BookStore\Resources\BookStoreCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookStoreRepository
{
    public function listBooks()
    {
        $query = QueryBuilder::for(BookStore::class)
            ->allowedFilters([
                AllowedFilter::partial('book', 'name'),
                AllowedFilter::exact('book_id'),
            ])
            ->defaultSort('book_id')
            ->paginate(request('per_page', config('settings.AMOUNT_PAGINATE_DEFAULT')))
            ->appends(request()->query());

        $resultBookCollection = new BookStoreCollection($query);

        return $resultBookCollection->resource;
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
