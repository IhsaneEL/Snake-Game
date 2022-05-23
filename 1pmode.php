
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'user_m1.php'; ?>
<?php include 'score1.php';?>
</head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="form.css">
<body >
<style>
body {
background-color: #000000;
}
#score{
	color: white;
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
input[type=text]{
	color: white;
	background-color: black;
	width: 30px;
	box-shadow: 0 0 15px rgba(0, 200, 255, 0.8);
	text-align: center;
 }
 #scr{
	color: white;
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
	 font-size: 40px;
     text-align: center;
	 bottom: 10%;
	left: 40%;
 }

</style>

<div id="score" >0</div><br>
<div id="game"></div>
<div id="user"> &nbsp; &nbsp;  Users: <br>
<?php include 'user_info.php';?></div>

<label id="scr" for="user"> &nbsp; &nbsp;  score : </label>
<input id="fscore" type="text" value='0'><br><br>
<button id="showData" > top 10</button>
<div id="table-container"></div>
<script type="text/javascript" src="ajax-script.js"></script>


<canvas id="snakeboard" width="400" height="400"style="border:2px solid #FFFAFA ; box-shadow: 0 0 20px rgba(0, 200, 255, 0.8);"></canvas>
<a href="firstpage.php" id="replay"  role="button" > Play again</a>

<script>

	const board_border = 'black';
    const board_background = "black";
    const snake_col = 'red';
    const snake_border = 'darkblue';
	

    let snake = [
        {x: 200, y: 200},
        {x: 190, y: 200},
        {x: 180, y: 200},
        {x: 170, y: 200},
        {x: 160, y: 200}
    ]

    let score = 0;
    // True if changing direction
    let changing_direction = false;

    let food_x;
    let food_y;
    // Horizontal velocity
    let dx = 10;
    // Vertical velocity
    let dy = 0;


    // Get the canvas element
    const snakeboard = document.getElementById("snakeboard");
    // Return a two dimensional drawing context
    const snakeboard_ctx = snakeboard.getContext("2d");

    // Start game
	
    main();

    gen_food();

    document.addEventListener("keydown", change_direction);
	
    // main function called repeatedly to keep the game running
	function main() {

        if (has_game_ended())
		{ 
	      var variableToSend = score;
           $.post('score1.php', {variable: variableToSend});
		   document.getElementById("fscore").value=score;
	      return  document.getElementById("game").innerHTML = "GAME OVER" ;
		}
        changing_direction = false;

        setTimeout(function onTick() {
            clear_board();
            drawFood();
            move_snake();
            drawSnake();
            // Repeat
            main();
        }, 100)
    }

    // edit the canvas
    function clear_board() {
        snakeboard_ctx.fillStyle = board_background;
        snakeboard_ctx.strokestyle = board_border;
        snakeboard_ctx.fillRect(0, 0, snakeboard.width, snakeboard.height);
        snakeboard_ctx.strokeRect(0, 0, snakeboard.width, snakeboard.height);
    }

    // Draw the snake on the canvas
    function drawSnake() {
        // Draw each part
        snake.forEach(drawSnakePart)
    }
    // Draw one snake part
    function drawSnakePart(snakePart) {
        snakeboard_ctx.fillStyle = snake_col;
        snakeboard_ctx.strokestyle = snake_border;
        snakeboard_ctx.fillRect(snakePart.x, snakePart.y, 10, 10);
        snakeboard_ctx.strokeRect(snakePart.x, snakePart.y, 10, 10);
    }

    function drawFood() {
        snakeboard_ctx.fillStyle = 'lightgreen';
        snakeboard_ctx.strokestyle = 'darkgreen';
        snakeboard_ctx.fillRect(food_x, food_y, 10, 10);
        snakeboard_ctx.strokeRect(food_x, food_y, 10, 10);
    }


    //GAME OVER CONDITIONS
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
    }
    //key codes in variables
    function change_direction(event) {
        const LEFT_KEY = 37;
        const RIGHT_KEY = 39;
        const UP_KEY = 38;
        const DOWN_KEY = 40;

        // Prevent the snake from moving in the opposite direction

        if (changing_direction) return;
        changing_direction = true;
        const keyPressed = event.keyCode;
        const goingUp = dy === -10;
        const goingDown = dy === 10;
        const goingRight = dx === 10;
        const goingLeft = dx === -10;
        if (keyPressed === LEFT_KEY && !goingRight) {
            dx = -10;
            dy = 0;
        }
        if (keyPressed === UP_KEY && !goingDown) {
            dx = 0;
            dy = -10;
        }
        if (keyPressed === RIGHT_KEY && !goingLeft) {
            dx = 10;
            dy = 0;
        }
        if (keyPressed === DOWN_KEY && !goingUp) {
            dx = 0;
            dy = 10;
        }
    }

    function move_snake() {
        // Create the new Snake's head
        const head = {x: snake[0].x + dx, y: snake[0].y + dy};
        // Add the new head to the beginning of snake body
        snake.unshift(head);
        const has_eaten_food = snake[0].x === food_x && snake[0].y === food_y;
        if (has_eaten_food) {
            // Increase score
            score += 10;
            // Display score on screen
            document.getElementById('score').innerHTML = score;
            // Generate new food location
            gen_food();
        } else {
            // Remove the last part of snake body
            snake.pop();
        }
    }
   
	
	
</script>


</body>
</html>