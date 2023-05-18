<?php

namespace App\Interfaces;

interface RatingRepositoryInterface
{
    public function getUserRatingForProduct($product_id, $user_id);
    public function save(array $details);
    public function update($id, array $new_details);
}