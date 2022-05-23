
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snake Game</title>
<?php include 'users_m2.php';?>
<?php include 'score2.php';?>
</head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
body {
background-color: #000000;
}
#score1{
	color: white;
	text-align: center;
        font-size: 20px;
}
#score2{
	color: white;
	text-align: center;
        font-size: 20px;
}
#user{
	color: white;
}
#table-container{
	color: #03e9f4;
}
a{
	position: relative;
	display: inline-block;
	padding:10px 5px;
	margin: 10px 0;
	color: white;
	
	text-decoration: none;
	text-transformation: uppercase;
	transition: 0.5s;
	letter-spacing: 4px;
}
a:hover{
	background: #03e9f4;
	color: #050801;
	box-shadow: 0 0 5px #03e9f4,
	            0 0 25px #03e9f4,
				0 0 50px #03e9f4,
				0 0 200px #03e9f4;
}
#showData{
	color: white;
	background-color: black; 
	padding: 5px 10px; 
    text-align: left;
    border-radius: 15px;
    border: 2px solid rgb(255,255,255,1);
}
.fs-red{
	color: white;
	background-color: black;
	width: 30px;
	box-shadow: 0 0 15px #ff005b;
	text-align: center;
 }
 .fs-blue{
	color: white;
	background-color: black;
	width: 30px;
	box-shadow: 0 0 15px rgba(0, 200, 255, 0.8);
	text-align: center;
 }
 #scr1{
	color: white;
	box-shadow: 0 0 15px #ff005b;
 }
  #scr2{
	color: white;
	box-shadow: 0 0 15px rgba(0, 200, 255, 0.8);
 }
 button:hover{
	 background: #03e9f4;
	color: #050801;
	box-shadow: 0 0 5px #03e9f4,
	            0 0 25px #03e9f4,
				0 0 50px #03e9f4,
				0 0 200px #03e9f4;
 }
 #game{
	 position: absolute;
	 color: white;
	 font-size: 20px;
     text-align: center;
	 bottom: 10%;
	left: 42%;
 }
 #blue{
	 color: #87CEFA;
	 text-align: center;
	 margin: 0;
	 padding: 0 20px;
        font-size: 20px;
		text-shadow: 0 0 10px #87CEFA,
		             0 0 20px #87CEFA,
					 0 0 30px #87CEFA,
					 0 0 40px #87CEFA;
 }
#red{
	 color: #ff005b;
	 text-align: center;
	 margin: 0;
	 padding: 0 20px;
        font-size: 20px;
		text-shadow: 0 0 10px #ff005b,
		             0 0 20px #ff005b,
					 0 0 30px #ff005b,
					 0 0 40px #ff005b;
	
 }
  #snakeboard {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
		border: 2px solid white ; 
    }
</style>
<body>
<div id="blue">Blue snake</div>
<div id="score1" >0</div>
<div id="red">Red snake</div>
<div id="score2">0</div>
<div id="game">GOOD LUCK</div>

<div id="user"> &nbsp; &nbsp;  Users: <br>
<?php include 'users_info2.php';?></div><br>
<label id="scr1" for="fscore2">&nbsp;score player 1</label><br>
<input class="fs-red"id="fscore2" type="text" value='0'><br><br>
<label id="scr2" for="fscore1">&nbsp;score player 2 </label><br>
<input class="fs-blue"id="fscore1" type="text" value='0'><br>
<button id="showData" >top 10</button>
<div id="table-container"></div>
<script type="text/javascript" src="ajax-script.js"></script>

<a href="firstpage.php" id="replay"  role="button" >play again</a>
<canvas id="snakeboard" width="400" height="400" style="border:2px solid #FFFAFA ; box-shadow: 0 0 20px rgba(0, 200, 255, 0.8);"></canvas>

</body>

<script>
    const board_border = 'black';
    const board_background = "black";
    const snake_col = 'lightblue';
    const snake_border = 'darkblue';
    const snake_col1 = 'red';
    const snake_border1 = 'darkblue';

    let snake1 = [
        {x: 50, y: 100},
        {x: 40, y: 100},
        {x: 30, y: 100},
        {x: 20, y: 100}

    ]
    let snake = [
        {x: 50, y: 200},
        {x: 40, y: 200},
        {x: 30, y: 200},
        {x: 20, y: 200},


    ]

    let food_x;
    let food_y;

    // True if changing direction
    let changing_direction = false;


    // Get the canvas element
    const snakeboard = document.getElementById("snakeboard");
    // Return a two dimensional drawing context
    const snakeboard_ctx = snakeboard.getContext("2d");



    // Start game
    main();

    gen_food();


    function main() {


        if (has_game_ended())
		{
		
		return   document.getElementById("game").innerHTML = "GAME OVER  "		;
		}
	
        changing_direction = false;

        if (has_game_ended1())
		{	
	    
	    return  document.getElementById("game").innerHTML = "GAME OVER " ;
	    }
        changing_direction = false;




        setTimeout(function onTick() {
            clear_board();
            drawFood();
            move_snake();
            move_snake1();
            scoreTest();
            if (scoreTest())return document.getElementById("game").innerHTML = "GAME OVER  RED wins " ;
            changing_direction = false;
            if(scoreTest1())return   document.getElementById("game").innerHTML = "GAME OVER  Blue wins " ;
            changing_direction = false;

            drawSnake();
            // Call main again
            main();
        }, 100)
    }

    // drawing the canvas
    function clear_board() {
        snakeboard_ctx.fillStyle = board_background;
        snakeboard_ctx.strokestyle = board_border;
        snakeboard_ctx.fillRect(0, 0, snakeboard.width, snakeboard.height);
        snakeboard_ctx.strokeRect(0, 0, snakeboard.width, snakeboard.height);
    }
    //drawing the food
    function drawFood() {
        snakeboard_ctx.fillStyle = 'lightgreen';
        snakeboard_ctx.strokestyle = 'darkgreen';
        snakeboard_ctx.fillRect(food_x, food_y, 10, 10);
        snakeboard_ctx.strokeRect(food_x, food_y, 10, 10);
    }

    //generating the food
    function random_food(min, max) {
        return Math.round((Math.random() * (max-min) + min) / 10) * 10;
    }

    function gen_food() {
        // Generate a random  x&y-coordinates
        food_x = random_food(0, snakeboard.width - 10);
        food_y = random_food(0, snakeboard.height - 10);
        // if the new food location is where the snake currently is, generate a new food location
        snake.forEach(function has_snake_eaten_food(part) {
            const has_eaten = part.x == food_x && part.y == food_y;
            if (has_eaten) gen_food();
        });
        snake1.forEach(function has_snake_eaten_food1(part) {
            const has_eaten1 = part.x == food_x && part.y == food_y;
            if (has_eaten1) gen_food();
        });


    }
            //score win condition
        function scoreTest(){
           const bluewins= score2===250;
          return bluewins
        }
        function scoreTest1(){
            const redwins= score1===250;
            return redwins
    }

    // Draw the whole snake on the canvas
    function drawSnake() {
        snake.forEach(drawSnakePart)
        snake1.forEach(drawSnakePart1)
    }

    // Draw one square of the  snake
    function drawSnakePart1(snakePart1) {
        snakeboard_ctx.fillStyle = snake_col1;
        snakeboard_ctx.strokestyle = snake_border1;
        snakeboard_ctx.fillRect(snakePart1.x, snakePart1.y, 10, 10);
        snakeboard_ctx.strokeRect(snakePart1.x, snakePart1.y, 10, 10);
    }


    // Draw one snake part of the second snake
    function drawSnakePart(snakePart) {
        snakeboard_ctx.fillStyle = snake_col;
        snakeboard_ctx.strokestyle = snake_border;
        snakeboard_ctx.fillRect(snakePart.x, snakePart.y, 10, 10);
        snakeboard_ctx.strokeRect(snakePart.x, snakePart.y, 10, 10);
    }




    // collision condition for the blue snake
    function has_game_ended() {
        for (let i = 4; i < snake.length; i++) {
            if (snake[i].x === snake[0].x && snake[i].y === snake[0].y) return true
        }
        const hitLeftWall = snake[0].x < 0;
        const hitRightWall = snake[0].x > snakeboard.width - 10;
        const hitToptWall = snake[0].y < 0;
        const hitBottomWall = snake[0].y > snakeboard.height - 10;


        return hitLeftWall || hitRightWall || hitToptWall || hitBottomWall

    }


    // collision condition for the red snake
    function has_game_ended1() {

        const hitLeftWall1 = snake1[0].x < 0;
        const hitRightWall1 = snake1[0].x > snakeboard.width - 10;
        const hitToptWall1 = snake1[0].y < 0;
        const hitBottomWall1 = snake1[0].y > snakeboard.height - 10;


        return  hitLeftWall1 || hitRightWall1 || hitToptWall1 || hitBottomWall1

    }




    //key codes for arrows + zasd
    document.addEventListener("keydown", change_direction);
    function change_direction(event) {
        const LEFT_KEY = 37;
        const RIGHT_KEY = 39;
        const UP_KEY = 38;
        const DOWN_KEY = 40;
        const left_key1=81;
        const right_key1=68;
        const up_key1=90;
        const down_key1=83;

        // Prevent the snake from reversing

        if (changing_direction) return;
        changing_direction = true;
        const keyPressed = event.keyCode;
        const goingUp = dy1 === -10;
        const goingDown = dy1 === 10;
        const goingRight = dx1 === 10;
        const goingLeft = dx1 === -10;
        const goingUp1 = dy2 === -10;
        const goingDown1 = dy2 === 10;
        const goingRight1 = dx2 === 10;
        const goingLeft1 = dx2 === -10;
        if (keyPressed===left_key1 && !goingRight1){
            dx2=-10;
            dy2=0;}
        if (keyPressed === LEFT_KEY && !goingRight) {
            dx1=-10;
            dy1=0;

        }
        if (keyPressed===up_key1 && !goingDown1){
            dx2=0;
            dy2=-10;}
        if (keyPressed === UP_KEY && !goingDown) {
            dx1 = 0;
            dy1 = -10;
        }

        if (keyPressed===right_key1 && !goingLeft1){
            dx2=10;
            dy2=0;}
        if (keyPressed === RIGHT_KEY && !goingLeft) {

            dx1 = 10;
            dy1 = 0;
        }
        if (keyPressed===down_key1 && !goingUp1){
            dx2=0;
            dy2=10;}
        if (keyPressed === DOWN_KEY && !goingUp) {

            dx1 = 0;
            dy1 = 10;
        }
    }






    let score1=0;
    let score2=0;

    let dx1=10;
    let dy1=0;
    let dx2=10;
    let dy2=0;

    //moving the blue snake
    function move_snake() {
        // Create the new Snake's head
        const head = {x: snake[0].x + dx2, y: snake[0].y + dy2};
        snake.unshift(head);
        const has_eaten_food = snake[0].x === food_x && snake[0].y === food_y;
        if (has_eaten_food) {
            // Increase score
            score1 += 10;
            // Display score on screen
            document.getElementById('score1').innerHTML = score1;
			document.getElementById("fscore1").value=score1;
		var variableToSend1 = score1;
        $.post('score2.php', {variable1: variableToSend1});
            // Generate new food location
            gen_food();
        } else {
            // Remove the last part of snake body
            snake.pop();
        }

    }

//moving the red snake
    function move_snake1() {
        // Create the new Snake's head
        const head = {x: snake1[0].x + dx1, y: snake1[0].y + dy1};
        snake1.unshift(head);
        const has_eaten_food1 = snake1[0].x === food_x && snake1[0].y === food_y;
        if (has_eaten_food1) {
            // Increase score
            score2 += 10;
            // Display score on screen
            document.getElementById('score2').innerHTML = score2;
			document.getElementById("fscore2").value=score2;
		var variableToSend2 = score2;
        $.post('score2.php', {variable2: variableToSend2});
            // Generate new food location
            gen_food();
        } else {
            // Remove the last part of snake body
            snake1.pop();
        }
    }

</script>
</html>