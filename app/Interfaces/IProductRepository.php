<?php

namespace App\Interfaces;

interface IProductRepository
{
    public function getById($id);
    public function save($details);
    public function update($id, $new_details);
    public function delete($id);
}