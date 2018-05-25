<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\ScoreRepositoryInterface;

class ScoreController extends Controller
{
    protected $score;

    public function __construct(ScoreRepositoryInterface $score) {
        $this->score = $score;
    }

    public function getAll() {
        return response()->json([
            'status' => 200,
            'data' => $this->score->getAll()
        ]);
    }

    public function getScoreByFlavorId(Request $request, $flavorId) {
        return response()->json([
            'status' => 200,
            'data' => $this->score->getScoreByFlavorId($flavorId)
        ]);
    }

    public function create(Request $request) {
        $newScore = $request->all();

        $schema = [
            'sectionId' => 'required',
            'score' => 'required',
            'description' => 'required'
        ];
        $validator = Validator::make($newScore, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $this->score->create($newScore['sectionId'], $newScore['score'], $newScore['description'])
        ]);
    }

    public function update(Request $request, $scoreId) {
        $newScore = $request->all();

        $schema = [
            'score' => 'required',
            'description' => 'required'
        ];
        $validator = Validator::make($newScore, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Data.'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $this->score->update($scoreId, $newScore['score'], $newScore['description'])
        ]);
    }
}
