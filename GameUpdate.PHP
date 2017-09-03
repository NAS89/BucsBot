<?php

#UPDATE THE JSON
#TO DO SO
#GO TO http://www.nfl.com/liveupdate/scorestrip/ss.xml
#Find the team you want
#Copy the EID and PASTE it to the link below
#You need to modify it like so
#'http://www.nfl.com/liveupdate/game-center/XXXXXXXXXX/XXXXXXXXXX_gtd.json'
#WHERE XXXXXXXXXX is the EID
#Because of the complexity of the use, do a FIND AND REPLACE on this file
#FIND the old ten digit string
#REPLACE with the new ten digit string

#Get the JSON File
$json = file_get_contents('http://www.nfl.com/liveupdate/game-center/2017091006/2017091006_gtd.json');

#Make a usable JSON object
$obj = json_decode($json, true);

#Time
$Clock = $obj['2017091006'];

#rushing stats
$awayrushingObj = array_values($obj['2017091006']['away']['stats']['rushing']);
$homerushingObj = array_values($obj['2017091006']['home']['stats']['rushing']);

#passing stats
$awaypassingObj = array_values($obj['2017091006']['away']['stats']['passing']);
$homepassingObj = array_values($obj['2017091006']['home']['stats']['passing']);

#receiving stats
$awayreceivingObj = array_values($obj['2017091006']['away']['stats']['receiving']);
$homereceivingObj = array_values($obj['2017091006']['home']['stats']['receiving']);

#punting stats
$awaypuntingObj = array_values($obj['2017091006']['away']['stats']['punting']);
$homepuntingObj = array_values($obj['2017091006']['home']['stats']['punting']);

#kicking stats
$awaykickingObj = array_values($obj['2017091006']['away']['stats']['kicking']);
$homekickingObj = array_values($obj['2017091006']['home']['stats']['kicking']);

#kick return stats
$awaykickretObj = array_values($obj['2017091006']['away']['stats']['kickret']);
$homekickretObj = array_values($obj['2017091006']['home']['stats']['kickret']);

#punt return stats
$awaypuntretObj = array_values($obj['2017091006']['away']['stats']['puntret']);
$homepuntretObj = array_values($obj['2017091006']['home']['stats']['puntret']);

#defense stats
$awaydefenseObj = array_values($obj['2017091006']['away']['stats']['defense']);
$homedefenseObj = array_values($obj['2017091006']['home']['stats']['defense']);

#scores
$awayteamscoreObj = array_values($obj['2017091006']['away']['score']);
$hometeamscoreObj = array_values($obj['2017091006']['home']['score']);

#names
$awayteamnameObj = $obj['2017091006']['away'];
$hometeamnameObj = $obj['2017091006']['home'];

#team stats
$awayteamstatsObj = $obj['2017091006']['away']['stats']['team'];
$hometeamstatsObj = $obj['2017091006']['home']['stats']['team'];

#Make the Header Changes Here
#Maintain the format of [](/ABBV)[FULL AWAY TEAM NAME](/r/subreddit) [at](at) [](/ABBV)[FULL HOME TEAM NAME](/r/subreddit)
$Header = '---';
$Header .= "\n";
$Header .= '[](/PIT)[Pittsburgh Steelers](/r/Steelers) [at](#at) [](/CAR)[Carolina Panthers](/r/Panthers)';
$Header .= "\n";
$Header .= "---";
$Header .= "\n";
$Header .= "Quarter: ";
$Header .= $Clock['qtr'];
$Header .= " ; ";
$Header .= "Time Remaining: ";
$Header .= $Clock['clock'];
$Header .= "\n";
$Header .= "---";
$Header .= "\n";

#Begin the Data Collection
$A = "[](/";
$A .= $awayteamnameObj['abbr'];
$A .= ")";
$A .= '  |  ';
$A .= $awayteamscoreObj['0'];
$A .= '  |  ';
$A .= $awayteamscoreObj['1'];
$A .= '  |  ';
$A .= $awayteamscoreObj['2'];
$A .= '  |  ';
$A .= $awayteamscoreObj['3'];
$A .= '  |  ';
$A .= $awayteamscoreObj['4'];
$A .= '  |  ';
$A .= $awayteamscoreObj['5'];
$B = "[](/";
$B .= $hometeamnameObj['abbr'];
$B .= ")";
$B .= '  |  ';
$B .= $hometeamscoreObj['0'];
$B .= '  |  ';
$B .= $hometeamscoreObj['1'];
$B .= '  |  ';
$B .= $hometeamscoreObj['2'];
$B .= '  |  ';
$B .= $hometeamscoreObj['3'];
$B .= '  |  ';
$B .= $hometeamscoreObj['4'];
$B .= '  |  ';
$B .= $hometeamscoreObj['5'];

$C = "";
foreach (array_values($awaypassingObj) as $player) {
$C .=  $player['name'];
$C .= '  |  ';
$C .= $player['cmp'];
$C .= '  |  ';
$C .= $player['att'];
$C .= '  |  ';
$C .= $player['yds'];
$C .= '  |  ';
$C .= $player['tds'];
$C .= '  |  ';
$C .= $player['ints'];
$C .= "\n";
}

$D = "";
foreach (array_values($homepassingObj) as $player) {
$D .=  $player['name'];
$D .= '  |  ';
$D .= $player['cmp'];
$D .= '  |  ';
$D .= $player['att'];
$D .= '  |  ';
$D .= $player['yds'];
$D .= '  |  ';
$D .= $player['tds'];
$D .= '  |  ';
$D .= $player['ints'];
$D .= "\n";
}

$E ="";
foreach (array_values($awayrushingObj) as $player) {
$E .= $player['name'];
$E .= '  |  ';
$E .= $player['att'];
$E .= '  |  ';
$E .= $player['yds'];
$E .= '  |  ';
$E .= $player['lng'];
$E .= '  |  ';
$E .= $player['tds'];
$E .= '  |  ';
$E .= round($player['yds'] / $player['att'],1,PHP_ROUND_HALF_EVEN);
$E .= "\n";
};

$F ="";
foreach (array_values($homerushingObj) as $player) {
$F .= $player['name'];
$F .= '  |  ';
$F .= $player['att'];
$F .= '  |  ';
$F .= $player['yds'];
$F .= '  |  ';
$F .= $player['lng'];
$F .= '  |  ';
$F .= $player['tds'];
$F .= '  |  ';
$F .= round($player['yds'] / $player['att'],1,PHP_ROUND_HALF_EVEN);
$F .= "\n";
};

$G = "";
foreach (array_values($awayreceivingObj) as $player) {
$G .= $player['name'];
$G .= '  |  ';
$G .= $player['rec'];
$G .= '  |  ';
$G .= $player['yds'];
$G .= '  |  ';
$G .= $player['tds'];
$G .= '  |  ';
$G .= $player['lng'];
$G .= "\n";
}

$H = "";
foreach (array_values($homereceivingObj) as $player) {
$H .= $player['name'];
$H .= '  |  ';
$H .= $player['rec'];
$H .= '  |  ';
$H .= $player['yds'];
$H .= '  |  ';
$H .= $player['tds'];
$H .= '  |  ';
$H .= $player['lng'];
$H .= "\n";
}

$I = "";
foreach (array_values($awaypuntingObj) as $player) {
$I .= $player['name'];
$I .= '  |  ';
$I .= $player['pts'];
$I .= '  |  ';
$I .= $player['yds'];
$I .= '  |  ';
$I .= $player['avg'];
$I .= '  |  ';
$I .= $player['i20'];
$I .= '  |  ';
$I .= $player['lng'];
$I .= "\n";
}

$J = "";
foreach (array_values($homepuntingObj) as $player) {
$J .= $player['name'];
$J .= '  |  ';
$J .= $player['pts'];
$J .= '  |  ';
$J .= $player['yds'];
$J .= '  |  ';
$J .= $player['avg'];
$J .= '  |  ';
$J .= $player['i20'];
$J .= '  |  ';
$J .= $player['lng'];
$J .= "\n";
}


$K = "[](/";
$K .= $awayteamnameObj['abbr'];
$K .= ")";
$K .= '  |  ';
$K .= $awayteamstatsObj['totfd'];
$K .= '  |  ';
$K .= $awayteamstatsObj['totyds'];
$K .= '  |  ';
$K .= $awayteamstatsObj['pyds'];
$K .= '  |  ';
$K .= $awayteamstatsObj['ryds'];
$K .= '  |  ';
$K .= $awayteamstatsObj['pen'];
$K .= '  |  ';
$K .= $awayteamstatsObj['penyds'];
$K .= '  |  ';
$K .= $awayteamstatsObj['trnovr'];
$K .= '  |  ';
$K .= $awayteamstatsObj['top'];


$L = "[](/";
$L .= $hometeamnameObj['abbr'];
$L .= ")";
$L .= '  |  ';
$L .= $hometeamstatsObj['totfd'];
$L .= '  |  ';
$L .= $hometeamstatsObj['totyds'];
$L .= '  |  ';
$L .= $hometeamstatsObj['pyds'];
$L .= '  |  ';
$L .= $hometeamstatsObj['ryds'];
$L .= '  |  ';
$L .= $hometeamstatsObj['pen'];
$L .= '  |  ';
$L .= $hometeamstatsObj['penyds'];
$L .= '  |  ';
$L .= $hometeamstatsObj['trnovr'];
$L .= '  |  ';
$L .= $hometeamstatsObj['top'];

$M = "";
foreach (array_values($awaykickingObj) as $player) {
$M .= $player['name'];
$M .= '  |  ';
$M .= $player['fgm'];
$M .= '  |  ';
$M .= $player['fga'];
$M .= '  |  ';
$M .= $player['totpfg'];
$M .= '  |  ';
$M .= $player['xpmade'];
$M .= '  |  ';
$M .= $player['xpmissed'];
$M .= '  |  ';
$M .= $player['xpa'];
$M .= "\n";
}

$N = "";
foreach (array_values($homekickingObj) as $player) {
$N .= $player['name'];
$N .= '  |  ';
$N .= $player['fgm'];
$N .= '  |  ';
$N .= $player['fga'];
$N .= '  |  ';
$N .= $player['totpfg'];
$N .= '  |  ';
$N .= $player['xpmade'];
$N .= '  |  ';
$N .= $player['xpmissed'];
$N .= '  |  ';
$N .= $player['xpa'];
$N .= "\n";
}

$O = "";
foreach (array_values($awaykickretObj) as $player) {
$O .= $player['name'];
$O .= '  |  ';
$O .= $player['ret'];
$O .= '  |  ';
$O .= $player['avg'];
$O .= '  |  ';
$O .= $player['lng'];
$O .= '  |  ';
$O .= $player['tds'];
$O .= "\n";
}

$P = "";
foreach (array_values($homekickretObj) as $player) {
$P .= $player['name'];
$P .= '  |  ';
$P .= $player['ret'];
$P .= '  |  ';
$P .= $player['avg'];
$P .= '  |  ';
$P .= $player['lng'];
$P .= '  |  ';
$P .= $player['tds'];
$P .= "\n";
}

$Q = "";
foreach (array_values($awaypuntretObj) as $Player) {
$Q .= $Player['name'];
$Q .= '  |  ';
$Q .= $Player['ret'];
$Q .= '  |  ';
$Q .= $Player['avg'];
$Q .= '  |  ';
$Q .= $Player['lng'];
$Q .= '  |  ';
$Q .= $Player['tds'];
$Q .= "\n";
}

$R = "";
foreach (array_values($homepuntretObj) as $Player) {
$R .= $Player['name'];
$R .= '  |  ';
$R .= $Player['ret'];
$R .= '  |  ';
$R .= $Player['avg'];
$R .= '  |  ';
$R .= $Player['lng'];
$R .= '  |  ';
$R .= $Player['tds'];
$R .= "\n";
}

$S = "";
foreach (array_values($awaydefenseObj) as $Player) {
$S .= $Player['name'];
$S .= '  |  ';
$S .= $Player['tkl'];
$S .= '  |  ';
$S .= $Player['ast'];
$S .= '  |  ';
$S .= $Player['sk'];
$S .= '  |  ';
$S .= $Player['int'];
$S .= '  |  ';
$S .= $Player['ffum'];
$S .= "\n";
}

$T = "";
foreach (array_values($homedefenseObj) as $Player) {
$T .= $Player['name'];
$T .= '  |  ';
$T .= $Player['tkl'];
$T .= '  |  ';
$T .= $Player['ast'];
$T .= '  |  ';
$T .= $Player['sk'];
$T .= '  |  ';
$T .= $Player['int'];
$T .= '  |  ';
$T .= $Player['ffum'];
$T .= "\n";
}

#Build the tables

$Scores = "Scores  | Q1 | Q2 | Q3 | Q4 | OT | Final";
$Scores .= "\n";
$Scores .= ":-:|:-:|:-:|:-:|:-:|:-:|:-:";
$Scores .= "\n";
$Scores .= $A;
$Scores .= "\n";
$Scores .= $B;


$AwayPassing = "Name  | Completions | Attempts | Yards | TDs| INTs";
$AwayPassing .= "\n";
$AwayPassing .= ":-:|:-:|:-:|:-:|:-:|:-:";
$AwayPassing .= "\n";
$AwayPassing .= $C;

$HomePassing = "Name  | Completions | Attempts | Yards | TDs| INTs";
$HomePassing .= "\n";
$HomePassing .= ":-:|:-:|:-:|:-:|:-:|:-:";
$HomePassing .= "\n";
$HomePassing .= $D;

$AwayRushing = "Name  | Attempts | Yards | Long | TDs";
$AwayRushing .= "\n";
$AwayRushing .= ":-:|:-:|:-:|:-:|:-:";
$AwayRushing .= "\n";
$AwayRushing .= $E;

$HomeRushing = "Name  | Attempts | Yards | Long | TDs";
$HomeRushing .= "\n";
$HomeRushing .= ":-:|:-:|:-:|:-:|:-:";
$HomeRushing .= "\n";
$HomeRushing .= $F;

$AwayRecieving = "Name  | Receptions | Yards | TDs | Long";
$AwayRecieving .= "\n";
$AwayRecieving .= ":-:|:-:|:-:|:-:|:-:";
$AwayRecieving .= "\n";
$AwayRecieving .= $G;

$HomeRecieving = "Name  | Receptions | Yards | TDs | Long";
$HomeRecieving .= "\n";
$HomeRecieving .= ":-:|:-:|:-:|:-:|:-:";
$HomeRecieving .= "\n";
$HomeRecieving .= $H;

$AwayPunting = "Name  | Punts | Yards | Average | In 20  |  Long  ";
$AwayPunting .= "\n";
$AwayPunting .= ":-:|:-:|:-:|:-:|:-:|:-:";
$AwayPunting .= "\n";
$AwayPunting .= $I;

$HomePunting = "Name  | Punts | Yards | Average | In 20  |  Long  ";
$HomePunting .= "\n";
$HomePunting .= ":-:|:-:|:-:|:-:|:-:|:-:";
$HomePunting .= "\n";
$HomePunting .= $J;

$AwayKicking = "Name  | FG Made | FG Attempted | FG Points | XP Made | XP Missed  | XP Attempted  ";
$AwayKicking .= "\n";
$AwayKicking .= ":-:|:-:|:-:|:-:|:-:|:-:|:-:";
$AwayKicking .= "\n";
$AwayKicking .= $M;

$HomeKicking = "Name  | FG Made | FG Attempted | FG Points | XP Made | XP Missed  | XP Attempted  ";
$HomeKicking .= "\n";
$HomeKicking .= ":-:|:-:|:-:|:-:|:-:|:-:|:-:";
$HomeKicking .= "\n";
$HomeKicking .= $N;

$AwayKickRet = "Name  | Returns | Average | Long | TDs ";
$AwayKickRet .= "\n";
$AwayKickRet .= ":-:|:-:|:-:|:-:|:-:";
$AwayKickRet .= "\n";
$AwayKickRet .= $O;

$HomeKickRet = "Name  | Returns | Average | Long | TDs ";
$HomeKickRet .= "\n";
$HomeKickRet .= ":-:|:-:|:-:|:-:|:-:";
$HomeKickRet .= "\n";
$HomeKickRet .= $P;

$AwayPuntRet = "Name  | Returns | Average | Long | TDs ";
$AwayPuntRet .= "\n";
$AwayPuntRet .= ":-:|:-:|:-:|:-:|:-:";
$AwayPuntRet .= "\n";
$AwayPuntRet .= $Q;

$HomePuntRet = "Name  | Returns | Average | Long | TDs ";
$HomePuntRet .= "\n";
$HomePuntRet .= ":-:|:-:|:-:|:-:|:-:";
$HomePuntRet .= "\n";
$HomePuntRet .= $R;

$AwayDefense = "Name  | Tackles | Assists | Sacks | Int | Forced Fumbles ";
$AwayDefense .= "\n";
$AwayDefense .= ":-:|:-:|:-:|:-:|:-:|:-:";
$AwayDefense .= "\n";
$AwayDefense .= $S;

$HomeDefense = "Name  | Tackles | Assists | Sacks | Int | Forced Fumbles ";
$HomeDefense .= "\n";
$HomeDefense .= ":-:|:-:|:-:|:-:|:-:|:-:";
$HomeDefense .= "\n";
$HomeDefense .= $T;



$TeamStats = "Team  | 1st Downs | Total Yards | Passing | Rushing | Penalties | P Yards | Turnovers | Time of Poss ";
$TeamStats .= "\n";
$TeamStats .= ":-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:";
$TeamStats .= "\n";
$TeamStats .= $K;
$TeamStats .= "\n";
$TeamStats .= $L;

#Load all the above stats/header/etc into one long text (with formatting) to post to reddit

$Everything = $Header;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $Scores;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayPassing;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomePassing;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayRushing;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomeRushing;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayRecieving;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomeRecieving;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
#everything below in red has been removed from our "gamedaybot" because 
#it was too much data. Feel free to uncomment the ones you want.
/*$Everything .= $AwayDefense;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomeDefense;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayPunting;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomePunting;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayKicking;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomeKicking;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayKickRet;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomeKickRet;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $AwayPuntRet;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";
$Everything .= $HomePuntRet;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";*/
$Everything .= $TeamStats;
$Everything .= "\n";
$Everything .= "\n";
$Everything .= "\n";

#save this to a text file, it's important for mr. beep boop bot
$file = 'C:\Users\<name>\AppData\Local\Programs\Python\Python35\thisfile.txt';

file_put_contents ($file,$Everything);

#this is just to show that the website is displaying the data
echo $Everything;

?>
