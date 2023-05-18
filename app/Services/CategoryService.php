<?php

namespace App\Services;

use App\Interfaces\CategoryServiceInterface;
use App\Repositories\CategoryRepository;

class CategoryService implements CategoryServiceInterface
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }


}