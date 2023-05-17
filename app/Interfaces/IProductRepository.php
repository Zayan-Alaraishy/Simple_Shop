<?php

namespace App\Interfaces;

interface IProductRepository
{
    public function getById($id);
    public function save(array $details);
    public function update($id, array $new_details);
    public function delete($id);
}