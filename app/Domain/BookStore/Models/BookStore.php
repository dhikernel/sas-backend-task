<?php

declare(strict_types=1);

namespace App\Domain\BookStore\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *
 * @OA\Property(property="name", type="string", description="Book Name"),
 * @OA\Property(property="isbn", type="integer", description="integer"),
 * @OA\Property(property="value", type="decimal", description="Value")
 * )
 * Class BookStore
 */
class BookStore extends Model
{
    use HasFactory;

    use SoftDeletes;

    public const TABLE_NAME = 'book_store';

    public const PRIMARY_KEY = 'book_id';

    public const FILLABLE = [
        'name',
        'isbn',
        'value',
    ];

    public $fillable = self::FILLABLE;

    protected $primaryKey = self::PRIMARY_KEY;

    protected $table = self::TABLE_NAME;

}
