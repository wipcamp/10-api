<?php
namespace App\Repositories;

interface ScoreRepositoryInterface {
    public function create($flavorId, $score, $description);
    public function getAll();
    public function update($scoreId, $score, $description);
}