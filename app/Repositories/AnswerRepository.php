<?php
namespace App\Repositories;
use App\Models\EvalAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

  public function getAnswerById($answerId){
    return EvalAnswer::where('id', $answerId)->get();
  }

  public function getByTeam($teamId)
  {
    return DB::select('select * from eval_answers a join eval_questions q on a.question_id = q.id where q.question_role_teams = '.$teamId);
  }

  public function getSuccessRegistranceAnswerByTeam($teamId)
  {
    return DB::select('select a.*,p.* from eval_answers a join eval_questions q on a.question_id = q.id join profiles p on a.user_id = p.user_id join profile_registrants pr on a.user_id = pr.user_id && pr.known_via is NOT NULL && pr.activities is NOT NULL && pr.skill_computer is NOT NULL && pr.activities is NOT NULL && p.user_id in (SELECT user_id FROM `eval_answers` GROUP BY user_id HAVING COUNT(*) = 6) && p.user_id in (SELECT user_id FROM `documents` WHERE type_id = 2 && user_id in (SELECT user_id FROM `documents` WHERE type_id = 3)) && q.question_role_teams = '.$teamId);
  }

  // public function checkerAnswer($roleId,$checkerId){
  //   $data =  DB::select('select a.id `answer_id` ,p.nickname,p.user_id,c.*,e.score FROM eval_answers a join eval_questions q on a.question_id = q.id join profiles p on a.user_id = p.user_id join profile_registrants pr on a.user_id = pr.user_id left join eval_criterias c on c.question_id = a.question_id left join evals e on a.id = e.answer_id where q.question_role_team = '.$roleId.' && pr.known_via is NOT NULL && pr.activities is NOT NULL && pr.skill_computer is NOT NULL && pr.activities is NOT NULL && p.user_id in (SELECT user_id FROM `eval_answers` GROUP BY user_id HAVING COUNT(*) = 6) && p.user_id in (SELECT user_id FROM `documents` WHERE type_id = 2 && user_id in (SELECT user_id FROM `documents` WHERE type_id = 3))');
  //   return $data;
  // }
  public function getAnswersSuccess(){
    $data =  DB::select('
    SELECT * FROM eval_answers eea JOIN profiles ppr on eea.user_id = ppr.user_id WHERE eea.user_id in (SELECT p.user_id FROM `profiles` as p JOIN `profile_registrants` as pr ON pr.user_id = p.user_id WHERE pr.known_via is NOT NULL && pr.activities is NOT NULL && pr.skill_computer is NOT NULL && pr.activities is NOT NULL && p.user_id in (SELECT user_id FROM `eval_answers` GROUP BY user_id HAVING COUNT(*) = 6) && p.user_id in (SELECT user_id FROM `documents` WHERE type_id = 2 && user_id in (SELECT user_id FROM `documents` WHERE type_id = 3)))
    ');
    return $data;
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