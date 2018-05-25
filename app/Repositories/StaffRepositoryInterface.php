<?php
namespace App\Repositories;

interface StaffRepositoryInterface {
    public function getAll();
    public function getStaff($id);
    public function create($id, $stdId, $flavorId);
    public function update($id, $section);
}