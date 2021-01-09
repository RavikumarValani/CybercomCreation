//team1 is john's team
var team1_game1,team1_game2,team1_game3;

//team2 is Mike's team
var team2_game1,team2_game2,team2_game3;

//team3 is Mary's team
var team3_game1,team3_game2,team3_game3;

//team1 score
team1_game1=89;
team1_game2=120;
team1_game3=103;

//team2 score
team2_game1=116;
team2_game2=94;
team2_game3=123;

//team3 score
team3_game1=97;
team3_game2=134;
team3_game3=105;

var team1_average,team2_average,team3_average;

//find average of team1 score
team1_average=(team1_game1+team1_game2+team1_game3)/3;

//find average of team2 score
team2_average=(team2_game1+team2_game2+team2_game3)/3;

//find average of team3 score
team3_average=(team3_game1+team3_game2+team3_game3)/3;

//check winner
if(team1_average > team2_average && team1_average > team3_average )
{
    console.log("Winner : John's Team and Score : ",team1_average);
}
else if(team2_average > team1_average && team2_average > team3_average)
{
    console.log("Winner : Mike's Team and Score : ",team2_average);
}
else if(team3_average > team1_average && team3_average > team2_average)
{
    console.log("Winner : Mary's Team and Score : ",team3_average);
}
else
{
    console.log("Match draw and Score : ",team1_average);
}

//get team1 score from user
alert("Enter john's team score");
team1_game1= prompt('Enter game1 score:');
team1_game2= prompt('Enter game2 score:');
team1_game3= prompt('Enter game3 score:');

//get team2 score from user
alert("Enter Mike's team score");
team2_game1= prompt('Enter game1 score:');
team2_game2= prompt('Enter game2 score:');
team2_game3= prompt('Enter game3 score:');

//get team3 score from user
alert("Enter Mary's team score");
team3_game1= prompt('Enter game1 score:');
team3_game2= prompt('Enter game2 score:');
team3_game3= prompt('Enter game3 score:');

//find average of team1 score
team1_average= (Number(team1_game1)+Number(team1_game2)+Number(team1_game3))/3;

//find average of team2 score
team2_average=(Number(team2_game1)+Number(team2_game2)+Number(team2_game3))/3;

//find average of team3 score
team3_average=(Number(team3_game1)+Number(team3_game2)+Number(team3_game3))/3;

//check winner
if(team1_average > team2_average && team1_average > team3_average )
{
    console.log("Winner : John's Team and Score : ",team1_average);
}
else if(team2_average > team1_average && team2_average > team3_average)
{
    console.log("Winner : Mike's Team and Score : ",team2_average);
}
else if(team3_average > team1_average && team3_average > team2_average)
{
    console.log("Winner : Mary's Team and Score : ",team3_average);
}
else
{
    console.log("Match draw and Score : ",team1_average);
}
