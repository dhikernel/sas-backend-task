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
     * tags={"Book Store - List Books"},
     * path="/api/list-book",
     * summary="List All Books",
     * description="List All Books",
     * security={
     * {"bearer":{}}},
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

    /**
     * @OA\Post(
     * tags={"Book Store - Create Books"},
     * path="/api/create-book",
     * summary="Create Record",
     * description="Create Record",
     * security={
     * {"bearer":{}}},
     * @OA\RequestBody(
     * required = true,
     * @OA\MediaType(
     * mediaType="application/json",
     * @OA\Schema(
     * example={"book_item_id":1,"name":"Lord of the rings","isbn":102030,"value":"57.90"},
     * )
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Success"
     * ),
     * @OA\Response(
     * response="default",
     * description="Unidentified error"
     * )
     * )
     */
    public function store(Request $request)
    {
        return $this->repository->createBooks($request->all());
    }

    /**
     * @OA\Put(
     * tags={"Book Store - Update Books"},
     * path="/api/update-book/{id}",
     * summary="Create Record",
     * description="Create Record",
     * security={
     * {"bearer": {}}},
     * @OA\Parameter(
     * name="id",
     * description="Id",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\RequestBody(
     * @OA\MediaType(
     * mediaType="application/json",
     * @OA\Schema(
     * example={"name":"Lord of the rings","isbn":102030,"value":"57.90"},
     * )
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Success",
     * ),
     * @OA\Response(
     * response="default",
     * description="Unidentified error"
     * )
     * )
     */

    public function update(Request $request, int $id)
    {
        return $this->repository->updateOrNewBook($request->all(), $id);
    }
    /**
     * @OA\Delete (
     * tags={"Book Store - Delete Books"},
     * path="/api/delete-book/{id}",
     * summary="Delete Record",
     * description="Delete Record",
     * security={
     * {"bearer": {}}},
     * @OA\Parameter(
     * name="id",
     * description="Id",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=204,
     * description="Success",
     * ),
     * @OA\Response(
     * response="default",
     * description="Unidentified error"
     * )
     * )
     */

    public function destroy(int $id)
    {
        return $this->repository->deleteBook($id);
    }
}
