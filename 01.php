<?php
$distance = 30;
$fields = [];
$iterations = 0;
$wallet = 10;
$bets = (int)readline("Place your bet:|");
$symbols = (explode(' ',readline("Enter symbols without spaces| ")));
$currentBet = readline("Enter who is going too be winner.If you guess you will win your bet multiplied by symbols| ");
$wallet -=$bets;
echo "$wallet$ is your current balance after bet";
for($i = 0;$i<count($symbols);$i++){
    $fields[$i] = array_fill(0,$distance,'_');
    $fields[$i][0] = $symbols[$i];
}
$winners =[];
while(count($winners)< count($symbols)){
    popen('cls', 'w');
    for($i = 0; $i<count($symbols);$i++) {
        $currentPosition = array_search($symbols[$i],$fields[$i]);
        if($currentPosition === false) continue;
        $turn = rand(1,3);
        $nexPosition = $currentPosition + $turn;
        if($nexPosition > $distance ){
            $nexPosition = $distance;

        }if(!in_array($symbols[$i],$winners)) {
            $fields[$i][$currentPosition + $turn] = $symbols[$i];
            $fields[$i][$currentPosition] = '_';
        }
        if($nexPosition === $distance && !in_array($symbols[$i],$winners)){
            $winners[] = $symbols[$i];
        }
    }
    foreach ($fields as $field){
        echo implode('', $field);
        echo PHP_EOL;
    }
    echo PHP_EOL;
    $iterations++;
    sleep (1);
}
for($i=0;$i<count($winners);$i++){
    $place = $i +1;
    echo "#$place) $winners[$i]" .PHP_EOL;
}
if($currentBet===$winners[0]){
    $finalBet = $bets*count($symbols);
    $wallet+=$finalBet;
    echo "Congratulations!!!You guessed the winner!! You win $finalBet$.Now your balance is $wallet$".PHP_EOL;
}
elseif ($currentBet===$winners[1]){
    $finalBet = $bets*count($symbols)/2;
    $wallet+=$finalBet;
    echo "Congratulations!!!You guessed the second place!! You win $finalBet$.Now your balance is $wallet$".PHP_EOL;
}
elseif ($currentBet===$winners[2]){
    $finalBet = $bets*count($symbols)/4;
    $wallet+=$finalBet;
    echo "Congratulations!!!You guessed the third place!! You win $finalBet$.Now your balance is $wallet$".PHP_EOL;
}
else{
    echo "You lost. $wallet$ left on your balance".PHP_EOL;
}