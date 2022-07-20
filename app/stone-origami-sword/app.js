function randomNumber(min, max) {  
    min = Math.ceil(min); 
    max = Math.floor(max); 
    return Math.floor(Math.random() * (max - min + 1)) + min; 
}
//Randomizer I copied from the internet

var output =  '';
var win = 0;
var rounds = 0;
var winr = 0;
//Variables

function rockButton() {
    output = '';
    document.getElementById('rock').style.border = "3px solid #333333";
    document.getElementById('paper').style.border = "3px solid #000000";
    document.getElementById('scissors').style.border = "3px solid #000000";
    output += 1;
}

function paperButton() {
    output = '';
    document.getElementById('paper').style.border = "3px solid #333333";
    document.getElementById('rock').style.border = "3px solid #000000";
    document.getElementById('scissors').style.border = "3px solid #000000";
    output += 2;
}

function scissorsButton() {
    output = '';
    document.getElementById('scissors').style.border = "3px solid #333333";
    document.getElementById('rock').style.border = "3px solid #000000";
    document.getElementById('paper').style.border = "3px solid #000000";
    output += 3;
}
//Buttons for the options

function button() {
    var bot = (randomNumber(1, 3));
    var final = output / bot;

    switch (bot) {
        case 1: 
            document.getElementById("bot").innerHTML = "Bot chose stone.";
        break;
        case 2: 
            document.getElementById("bot").innerHTML = "Bot chose origami.";
        break;
        case 3: 
            document.getElementById("bot").innerHTML = "Bot chose sword.";
        break;
    }

    switch (final) {
        case 1:
            document.getElementById("answer").innerHTML = "Tie";
        break;
        case 0.5:
            document.getElementById("answer").innerHTML = "You chose stone and lost...";
            rounds += 1;
        break;
        case 0.3333333333333333:
            document.getElementById("answer").innerHTML = "You chose stone and won!";
            win += 1;
            rounds += 1;
        break;
        case 2:
            document.getElementById("answer").innerHTML = "You chose origami and won!";
            win += 1;
            rounds += 1;
        break;
        case 0.6666666666666666:
            document.getElementById("answer").innerHTML = "You chose origami and lost...";
            rounds += 1;
        break;
        case 3:
            document.getElementById("answer").innerHTML = "You chose sword and lost...";
            rounds += 1;
        break;
        case 1.5:
            document.getElementById("answer").innerHTML = "You chose sword and won!";
            win += 1;
            rounds += 1;
        break;
        case 0:
            document.getElementById("answer").innerHTML = "You didn't pick anything.";
    }
    //Yikes that's a lot of cases and repetition
    if (rounds >= 1) {
    winr = Math.round(win/rounds*100);
    document.getElementById("winrate").innerHTML = "Winrate: " + winr + "%";
    } else {
        document.getElementById("winrate").innerHTML = "Winrate:";
    }
    //I made this in like 2 minutes there's probably a more efficient way to calculate without it breaking

}

//Probably too many functions in a button but that's only way I know how to update page on press