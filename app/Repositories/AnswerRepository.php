<?php
namespace App\Repositories;
use App\Models\EvalAnswer;
use Carbon\Carbon;
use DB;

class AnswerRepository implements AnswerRepositoryInterface {
  protected $answers;

  public function __construct(){
    $this->answers = new EvalAnswer;
  }

  public function create($data) {
    $this->answers = new EvalAnswer($data);
    $this->answers->save();
    return $data;
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

  public function getByTeam($teamId)
  {
    DB::select('select * from eval_answers a join eval_questions q on a.question_id = q.id where q.question_role_teams ='+$teamId);
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

  public function getCountById($userId) {
    return $this->answers->where('user_id', $userId)->count();
  }
}