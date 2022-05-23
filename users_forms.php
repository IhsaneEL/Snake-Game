<div id ="center">  
<img src="giphy.gif">  
</div>  
<p>Choose a mode:</p>
<div class="btn1">
<button class="btn-mode1" type="button "id="mode1" onclick="display_mode1()" >1 player</button>
</div>
<div class="btn2">
<button class="btn-mode2" type="button "id="mode2" onclick="display_mode2()" >2 players</button>
</div>
<form id="fform" action="1pmode.php" method="post" style="display: none">
<label for="user">one player</label><br>
<input type="text" name="s_p_n" placeholder="enter your user name"><br>
<input type="hidden" name="u_score" value="0"  ><br>
<input type="submit"value="Play">
<input type="reset" value="Reset">
</form>

<form id="secform" action="2pmode.php" method="post" style="display: none">
<label for="user"> multi_players</label><br>
<input type="text" name="p1_u_n" placeholder="player 1 user name (&#x2190&#x2195&#x2192)"><br>
<input type="hidden" name="u1_score" value="0" ><br>
<input type="text" name="p2_u_n" placeholder="player 2 user name (z q s d)"><br>
<input type="hidden" name="u2_score" value="0" ><br>
<input type="submit"value="Play">
<input type="reset" value="Reset">
</form>

<script>
function display_mode2() {
  var x = document.getElementById('secform');
  if (x.style.display === 'none') {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
}
function display_mode1() {
  var x = document.getElementById('fform');
  if (x.style.display === 'none') {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
}
</script>
