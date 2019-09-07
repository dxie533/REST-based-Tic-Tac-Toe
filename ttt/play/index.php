<?php
// 
//
header("Content-Type: application/json");
$rowAndColumn = 3;
$winner = " ";
$ai = "O";
$player = "X";
$decodedData = json_decode(stripslashes(file_get_contents("php://input")), true);
// check winner
function checkWinner(){
global $decodedData, $rowAndColumn, $winner, $ai, $player;
if(strcmp($decodedData['grid'][0], $player) == 0 and strcmp($decodedData['grid'][3], $player) == 0 and strcmp($decodedData['grid'][6], $player) == 0 or strcmp($decodedData['grid'][1], $player) == 0 and strcmp($decodedData['grid'][4], $player) == 0 and strcmp($decodedData['grid'][7], $player) == 0 or strcmp($decodedData['grid'][2], $player) == 0 and strcmp($decodedData['grid'][5], $player) == 0 and strcmp($decodedData['grid'][8], $player) == 0){
	$winner = "X";
}
if(strcmp($decodedData['grid'][0], $ai) == 0 and strcmp($decodedData['grid'][3], $ai) == 0 and strcmp($decodedData['grid'][6], $ai) == 0 or strcmp($decodedData['grid'][1], $ai) == 0 and strcmp($decodedData['grid'][4], $ai) == 0 and strcmp($decodedData['grid'][7], $ai) == 0 or strcmp($decodedData['grid'][2], $ai) == 0 and strcmp($decodedData['grid'][5], $ai) == 0 and strcmp($decodedData['grid'][8], $ai) == 0){
	$winner = "O";
}
//check rows
if(strcmp($decodedData['grid'][0], $player) == 0 and strcmp($decodedData['grid'][1], $player) == 0 and strcmp($decodedData['grid'][2], $player) == 0 or strcmp($decodedData['grid'][3], $player) == 0 and strcmp($decodedData['grid'][4], $player) == 0 and strcmp($decodedData['grid'][5], $player) == 0 or strcmp($decodedData['grid'][6], $player) == 0 and strcmp($decodedData['grid'][7], $player) == 0 and strcmp($decodedData['grid'][8], $player) == 0){
	$winner = "X";
}
if(strcmp($decodedData['grid'][0], $ai) == 0 and strcmp($decodedData['grid'][1], $ai) == 0 and strcmp($decodedData['grid'][2], $ai) == 0 or strcmp($decodedData['grid'][3], $ai) == 0 and strcmp($decodedData['grid'][4], $ai) == 0 and strcmp($decodedData['grid'][5], $ai) == 0 or strcmp($decodedData['grid'][6], $ai) == 0 and strcmp($decodedData['grid'][7], $ai) == 0 and strcmp($decodedData['grid'][8], $ai) == 0){
	$winner = "O";
}
//check diagonals
if(strcmp($decodedData['grid'][0], $player) == 0 and strcmp($decodedData['grid'][4], $player) == 0 and strcmp($decodedData['grid'][8], $player) == 0 or strcmp($decodedData['grid'][2], $player) == 0 and strcmp($decodedData['grid'][4], $player) == 0 and strcmp($decodedData['grid'][6], $player) == 0){
	$winner = "X";
}
if(strcmp($decodedData['grid'][0], $ai) == 0 and strcmp($decodedData['grid'][4], $ai) == 0 and strcmp($decodedData['grid'][8], $ai) == 0 or strcmp($decodedData['grid'][2], $ai) == 0 and strcmp($decodedData['grid'][4], $ai) == 0 and strcmp($decodedData['grid'][6], $ai) == 0){
	$winner = "O";
}
}

if($decodedData == null){
$emptyData['grid'][0] = " ";
$emptyData['grid'][1] = " ";
$emptyData['grid'][2] = " ";
$emptyData['grid'][3] = " ";
$emptyData['grid'][4] = " ";
$emptyData['grid'][5] = " ";
$emptyData['grid'][6] = " ";
$emptyData['grid'][7] = " ";
$emptyData['grid'][8] = " ";
$emptyData['winner'] = " ";
echo json_encode($emptyData);
}
else{
//CHECK WINNER
checkWinner();
//SEND WINNER
$decodedData['winner'] = $winner;
echo json_encode($decodedData);
}
?>
