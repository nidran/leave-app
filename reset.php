<html>
<head>
<script src="http://wcetdesigns.com/assets/javascript/jquery.js"></script>
<script> 
function password_strength(password, strlen){
  //SEARCHES FOR EACH OF THESE PATTERNS FOR VARIETY 
  var lo = /[a-z]+/g;
  var up = /[A-Z]+/g;
  var num = /[0-9]+/g;
  var sym = /[^A-Za-z0-9]+/g;
   //BLANK UNTIL COUNTS VARIETY AND SYMBOLS (DO NOT REMOVE) 
  var variety = 0;
  var symbols = 0;
   //checks strength of password based on variety in password(lowercase,uppercase,numbers used)
  if(strlen>=0&&strlen<=6){
    if(password.match(lo)){
      variety++;
    }
    if(password.match(up)){
      variety++;
    }
    if(password.match(num)){
      variety++;
    }
    if(password.match(sym)){
      variety++;
    }
     //COUNTS SYMBOLS, USED FOR EXTRA POINTS 
    for(i=0; i<strlen; i++){
      if(password.substr(i, 1).match(sym)){
        symbols++;
      }
    }

    var score = strlen; //POINT GIVEN FOR EVERY CHARACTER
     //IF THERE ARE 3 VARIETIES, 1.5 FOR EACH & 2 FOR EACH SYMBOL 
    if(variety==2){
      score += (variety * 1.5)+(symbols*2);
    }
     //IF THERE ARE >=3 VARIETIES, 1.5 FOR EACH & 3 FOR EACH SYMBOL
    //BUT, IF <= 8 CHARS, ONLY 2 GIVEN FOR EACH SYMBOL 
    if(variety>=3){
      if(strlen>=4){
        score += (variety * 1.5)+(symbols*3);
      } else {
        score += (variety * 1.5)+(symbols*2);
      }
    }

    var scale = 10; //MEASURES OUT OF 25 PTS, MAY BE MORE FOR SUPERSTRONG PASSWORDS
    var percent = (score / scale) * 100; //GETS PERCENT OF THE SCALE
     //MAY BE > 100%, THEREFORE SCALES BACK TO 100 FOR CSS PURPOSES 
    if(percent>100){
      percent = 100;
    }
     //WIDTH OF THE BAR 
    var bar = $("#bar").width();
     //WIDTH OF SHADED AREA 
    var shade = (percent * bar) / 100;

     //GRADING JUDGMENTS & SHADE BG COLOR 
    if(percent<50){
      var grade = "Weak";
      var bg = "#e899ff";
    }
    if(percent>=50&&percent<70){
      var grade = "Fair";
      var bg = "#e869ff";
    }
    if(percent>=70&&percent<85){
      var grade = "Good";
      var bg = "#32baed";
    }
    if(percent>=85){
      var grade = "Strong";
      var bg = "#12495d";
    }
     //CHANGES COLOR & WIDTH OF SHADED AREA 
    $("#score").css({"background":bg, "width":shade+"px"});
  }
   else 
  {
    $("#score").css({"background":"#ffffff", "width":"0px"});
    var grade = "Password must be less than 6 characters";
  }
  $("#grade").html(grade); //DISPLAY JUDGMENT IN HTML
}
</script> 
<style> 
#bar {
  background: #ffffff;
  border: 1px #000000 ;
  height: 20px;
  width: 80px
}
#score {
  height: 10px;
  width: 100;
} 
</style> 
</head>
<body>
<form method="POST" action="resetnew.php">
<img id="line" src="newheader.png" width="100%" height="250" align="left">
<div align="right">
<a href="booking.php">Back</a>
</div>
<div align="center">
<br> &nbsp &nbsp &nbsp &nbsp  Username: &nbsp &nbsp<input type="Text" name="username"  style="width:193px" id="pq" ><br><br>
 Old Password: &nbsp &nbsp <input type="Text" name="old" style="width:193px" id="pq">
</div>

<div align="center">
<br>New password: &nbsp &nbsp &nbsp<input onKeyUp="password_strength(this.value, this.value.length)" placeholder="Password:" type="password" style="width:193px" id="pq"><br>

<div id="bar"></div>
<div id="score"></div>
<span id="grade"></span>
<br>Confirm Password:&nbsp &nbsp  <input type="password" name="new1"  style="width:193px" id="pq" size="30"><br><br>
<br><br><input type="Submit" name="submit" value="Submit"> 
</div>
</div>
 </form>
</body>
</html>






