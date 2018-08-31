<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class ScoreController extends Controller
{
	private function getHighScore($userId)
	{
		$highScore = false;
		if(Cache::has('highScore_' . $userId))
		{
			$highScore = Cache::get('highScore_' . $userId);
		}
		else
		{
			$dbScore = DB::table('TopList')->where('userId', '=', $userId)->get();
			if($dbScore->isNotEmpty())
			{
				$highScore = $dbScore[0]->score;
				Cache::put('highScore_' . $userId, $highScore, now()->addMinutes(10));
			}
		}

		return $highScore;
	}

	public function log(Request $request)
	{
		$userId = Session::get('userId') ? Session::get('userId') : 0;

		$input = Session::get('input');
		$score = 0;
		if(isset($input->score)) 
		{
			$score = intval($input->score);
			return Redis::rpush('playLog_'.$userId, $score, date('Y-m-d H:i:s'));
		}
	}
	
	public function refresh(Request $request)
	{
		$userId = Session::get('userId') ? Session::get('userId') : 0;

		$input = Session::get('input');
		$score = 0;
		if(!isset($input->score) || !$input->score) return 'Encrypt error';
		if(isset($input->score)) $score = intval($input->score);

		$lastScore = $this->getHighScore($userId);
		
		
		// If the user break his own record, save the log.
		if($lastScore <= $score || false === $lastScore)
		{
			if(false !== $lastScore) 
			{
				DB::table('TopList')->where('userId', '=', $userId)->update(['score' => $score, 'generateTime' => date('Y-m-d H:i:s')]);
			}
			else if(false === $lastScore) // Insert when the user is first play.
			{
				DB::table('TopList')->insert(['userId' => $userId, 'score' => $score, 'generateTime' => date('Y-m-d H:i:s')]);
			}

			$logLen = Redis::llen('playLog_'.$userId);
			$playLog = [];
			for($i = 0; $i < $logLen / 2; ++$i)
			{
				$score = Redis::lpop('playLog_'.$userId);
				$generateTime = Redis::lpop('playLog_'.$userId);
				$playLog[] = ['userId' => $userId, 'score' => $score, 'type' => 2, 'generateTime' => $generateTime];
			}
			Cache::put('highScore_' . $userId, $score, now()->addMinutes(10));
			DB::table('ScoreLog')->insert($playLog);
		}
		else
		{
			$logLen = Redis::llen('playLog_'.$userId);
			for($i = 0; $i < $logLen; ++$i)
			{
				Redis::lpop('playLog_'.$userId);
			}
		}
		DB::table('ScoreLog')->insert(['userId' => $userId, 'score' => $score, 'type' => 1, 'generateTime' => date('Y-m-d H:i:s')]);
		return ['status' => 'success', 'data' => ''];	
	}

	public function topList()
	{
		$userId = Session::get('userId') ? Session::get('userId') : 0;
		$topList = DB::table('TopList')->orderBy('score', 'DESC')->orderBy('generateTime', 'AES')->take(3)->get();
		$result = ['list' => $topList];
		$result['currentUser'] = $userId;
		
		return ['status' => 'success', 'data' => $result];
	}
}
