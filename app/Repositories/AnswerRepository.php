<?php
namespace App\Repositories;
use App\Models\EvalAnswer;

class AnswerRepository implements AnswerRepositoryInterface {
  protected $answers;

  public function __construct(){
    $this->answers = new EvalAnswer;
  }

  public function create($data) {
    $this->answers = new EvalAnswer($data);
    $result = $this->answers->save();
    return json_encode(['result' => $result]);
  }
}