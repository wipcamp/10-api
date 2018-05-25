<?php
namespace App\Repositories;

use App\Models\SectionScore;
use Illuminate\Support\Facades\DB;

class ScoreRepository implements ScoreRepositoryInterface {

  public function create($flavorId, $score, $description) {
    $flavor = new SectionScore;
    return $flavor->create([
      'score' => $score,
      'section_id' => $flavorId,
      'description' => $score,
    ]);
  }

  public function getAll() {
    return DB::table('section_scores')
    ->join('camp_sections', 'camp_sections.id', '=', 'section_scores.section_id')
    ->select('section_scores.*', 'camp_sections.display_name', 'camp_sections.label_color')
    ->groupBy('section_scores.section_id')
    ->get();
  }

  public function getScoreByFlavorId($flavorId) {
    return DB::table('section_scores')
    ->join('camp_sections', 'camp_sections.id', '=', 'section_scores.section_id')
    ->select('section_scores.*', 'camp_sections.display_name', 'camp_sections.label_color')
    ->where('section_scores.section_id', $flavorId)
    ->get();
  }

  public function update($scoreId, $score, $description){
    $staff = new SectionScore;;
    return $staff->where('id', $scoreId)->update([
      'score' => $score,
      'description' => $description
    ]);
  }

}