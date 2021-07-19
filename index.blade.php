@extends('layout')
<!--
=== Coded by l1ght ===
=== https://vk.com/l1ghtcs ===
=== 06.06.2017 ===
-->
@section('content')
        
    <div class="rates">
        @foreach($bets as $bet)
            @if(Auth::check() && $u->is_admin)
                @include('includes.bet_admin')
                @else
                @include('includes.bet')
            @endif
        @endforeach
    </div>
	
	<div class="start">
        <div class="title">ИГРА НАЧАЛАСЬ! ВНОСИТЕ ДЕПОЗИТЫ!</div>
        <div class="hash">
            <a href="javascript://" onclick="$('#fair').arcticmodal()" class="btn orange">ЧЕСТНАЯ ИГРА</a>
            <div class="text" id="roundHash">Хэш раунда: {{ hash("SHA224", $game->rand_number, false) }}</div>
        </div>
    </div>
	
	<div style="display: none;">
	    <div class="box-modal" id="fair">

	        <div class="title">Честная игра</div>
	        <a href="javascript://" class="box-modal_close arcticmodal-close"></a>

	        <p>За каждую внесенную 1 копейку вы получаете 1 билет. Например, если вы внесли депозит на 100 р, то выполучите 10000 билетов (т.к. 100 р = 10000 копеек, а 1 копейка = 1 билет).</p>
	        <p>В начале каждого раунда наша система берет абсолютно рандомное длинное число от 0 до 1 (например 0.83952926436439157) и шифрует его через SHA-224 , и показывает его в зашифрованом виде в начале раунда (если вы не знаете, что такое SHA-224 - можете <a href="https://ru.wikipedia.org/wiki/SHA-2" target="_blank">почитать статью на википедии</a>).</p>
	        <p>Затем, когда раунд завершился, система показывает то число, которое было шифровано вначале и умножает его на банк (в копейках).</p>
	        <p>Например, в конце раунда банк составил 1000 р, а 1000 р = 100000 копеек (1 р = 100 копеек), то нужно будет число 0.83952926436439157 умножить на банк 100000 копеек (это цифры, которые мы брали для примера) и получим число 83952. То есть в раунде победит человек, у которого есть 83952 билет.</p>
	        <p>Следовательно, чем на большую сумму депозит вы внесете - тем больше билетов вы получите, а значит выше шанс получить выигрышный билет.</p>
	        <p>Вот и всё. Принцип работы честной игры заключается в том, что мы никак не можем знать какой будет банк в конце игры, а рандомное число для умножения на банк мы даем в самом начале раунда и следовательно даже если бы мы сильно этого захотели, то никак бы не смогли сделать подставного победителя.</p>

	        <div class="form">
			    <style>
                    .fair_input input::-webkit-outer-spin-button,
                    .fair_input input::-webkit-inner-spin-button {
	                -webkit-appearance: none;
                    margin: 0;
                    }
                </style>
	            <div class="top">Проверка честной игры</div>
	            <p>Число раунда * банк (в копейках) = выигрышный билет</p>
	            <input type="text" class="fair_input" id="roundHash1" placeholder="Хэш раунда">
	            <input type="number" class="fair_input" id="roundNumber1" placeholder="Число раунда">
	            <input type="number" class="fair_input" id="roundPrice1" placeholder="Кол-во копеек в раунде">
	            <button class="fair_button" id="fair-check">Проверить</button>
	        </div>
	    </div>
	</div>
@endsection