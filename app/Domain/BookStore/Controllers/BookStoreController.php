<?php

declare(strict_types=1);

namespace App\Domain\BookStore\Controllers;

use App\Domain\BookStore\Repositories\BookStoreRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    protected $repository;

    protected array $validators = [
        'name' => 'required|string',
        'isbn' => 'required|integer',
        'value' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',

    ];

    /**
     * @param BookStoreRepository $repository
     */
    public function __construct(BookStoreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     * tags={"BookStore- Create Book"},
     * path="/api/list-book",
     * summary="List All Books",
     * description="List All Books",
     * security={
     * {"bearer":{}}},
     * @OA\Parameter(
     * description="User",
     * in="header",
     * name="user",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64",
     * )
     * ),
     * @OA\Parameter(
     * description="Company",
     * in="header",
     * name="company",
     * required=true,
     * @OA\Schema(
     * type="string",
     * format="int64"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Success"
     * ),
     * @OA\Response(
     * response="default",
     * description="Unidentified error"
     * )
     * )
     */
    public function index(Request $request)
    {
        return $this->repository->listBooks($request->all());
    }

    public function store(Request $request)
    {
        return $this->repository->createBooks($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->repository->updateOrNewBook($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->repository->deleteBook($id);
    }
}
