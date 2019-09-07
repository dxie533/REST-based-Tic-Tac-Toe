var tttGrid = [" ", " ", " ", " ", " ", " ", " ", " ", " "];
function hideForms(){
	document.getElementById("formDisplay").style.display = "none";
	document.getElementById("table").style.display = "block";
	}
function playerAction(givenPlace){
tttGrid[givenPlace] = "X";
var xhr = new XMLHttpRequest();
var url = "play/index.php";
xhr.open("POST", url, true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var json = JSON.parse(xhr.responseText);
	if(json.winner !== " "){
	//UPDATE GRID
		for(i = 0; i < tttGrid.length; i++){
		tttGrid[i] = json.grid[i];
		if(json.grid[i] !== " "){
		document.getElementById(i).innerHTML = json.grid[i];
		}
		document.getElementById(i).disabled = true;
		}
		document.getElementById("winnerDiv").innerHTML = "Winner is " + json.winner;
	}
	else
	{
		//AI MOVE
		var emptyGrid = [];
		for(i = 0; i < tttGrid.length; i++){
			if(json.grid[i] == " "){
			emptyGrid.push(i);
			}
		}
		var randomNum = Math.floor(Math.random() * emptyGrid.length)
		var chosenNum = emptyGrid[randomNum];
		tttGrid[chosenNum] = "O";
		//CHECK WINNER
		var xhrs = new XMLHttpRequest();
		xhrs.open("POST", url, true);
		xhrs.setRequestHeader("Content-Type", "application/json");
		xhrs.onreadystatechange = function () {
			if (xhrs.readyState === 4 && xhrs.status === 200) {
        			var json = JSON.parse(xhrs.responseText);
				for(i = 0; i < tttGrid.length; i++){
					tttGrid[i] = json.grid[i];
					if(json.grid[i] !== " "){
					document.getElementById(i).innerHTML = json.grid[i];
					document.getElementById(i).disabled = true;
					}
				}
				if(json.winner !== " "){
					for(i = 0; i < tttGrid.length; i++){
					tttGrid[i] = json.grid[i];
					document.getElementById(i).disabled = true;
					}
					document.getElementById("winnerDiv").innerHTML = "Winner is " + json.winner;
				}

			}
		}
		var data = JSON.stringify({"grid": tttGrid});
		xhrs.send(data);
	}
	
    }
};
var data = JSON.stringify({"grid": tttGrid});
xhr.send(data);
}
