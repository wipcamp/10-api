<?php
namespace App\Repositories;
use App\Models\EvalAnswer;
use Carbon\Carbon;

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

  public function get() {
    $result = $this->answers->get();
    return $result;
  }

  public function getById($user_id, $question_id) {
    $result = $this->answers
      ->where([
        'user_id' => (int) $user_id,
        'question_id' => (int) $question_id
        ])
      ->get();
    return $result;
  }

  public function update($data) {
    $time = new Carbon;
    $this->answers
      ->where([
        'user_id' => $data['user_id'],
        'question_id' => $data['question_id']
        ])
      ->update([
        'data' => $data['data'],
        'updated_at' => $time->now()->toDateTimeString()
      ]);
    return $data;
  }
}