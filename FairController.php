<?php

// Coded by l1ght
// https://vk.com/l1ghtcs
// 06.06.2017

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Db;

class FairController extends Controller
{
	
	public function Fair (Request $request) {
		/* Получаем инфу */
		$hash_r = $request->get('roundHash');
		$number_r = $request->get('roundNumber');
		$price_r = $request->get('roundPrice');
		
		if(empty($hash_r) || empty($number_r) || empty($price_r)) {
			return response()->json(['message' => 'Заполните каждое поле!', 'type' => 'error']);
		} else {
			$hash_r = $request->get('roundHash');
		    $number_r = $request->get('roundNumber');
		    $price_r = $request->get('roundPrice');
		    $price_n = $price_r / 100;
			
		    /* Ищем нужную игру и получаем её id */
		    $game = \DB::table('games')->where('rand_number', $number_r)->where('price', $price_n)->where('hash', $hash_r)->where('status', 3)->pluck('id');
		
		    /* Проверяем наличие игры */
		    if(is_null($game)) {
			    return response()->json(['message' => 'Игра не существует или не завершена!', 'type' => 'error']);
		    } else {
			
				/* Проверяем наличие подкрутки и выводим выигрышный билет */
			    if ($hash_r == hash("SHA224", $number_r, false)) {
		            /* Получаем выигрышный билет */
		            $result1 = round($price_r * $number_r);
			        return response()->json(['message' => 'Хеш и число раунда совпадают. Победный билет - '. $result1 .' ', 'type' => 'success']);
			    } else {
					/* Получаем выигрышный билет */
					$result2 = \DB::table('winner_tickets')->where('game_id', $game)->pluck('winnerticket');
				    return response()->json(['message' => 'Хеш и число раунда совпадают. Победный билет - '. $result2 .' ', 'type' => 'success']);
			    }
	        }
	    }
	}
}