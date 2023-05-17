<?php
namespace App\Repositories;

use App\Models\Category;

use App\Interfaces\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
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