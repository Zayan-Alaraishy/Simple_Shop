<?php
namespace App\Repositories;

use App\Models\Category;

use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return Category::all();
    }


}