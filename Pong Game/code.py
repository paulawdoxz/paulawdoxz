import turtle
import time

wn = turtle.Screen()
wn.title("Pong voor Paula - Variatie")
wn.bgcolor("black")
wn.setup(width=800, height=600)
wn.tracer(0)

# Paddle
paddle = turtle.Turtle()
paddle.shape("square")
paddle.color("white")
paddle.shapesize(stretch_wid=6, stretch_len=1)
paddle.penup()
paddle.goto(-350, 0)

def paddle_up(): 
    y = paddle.ycor() 
    if y < 250: 
        y += 20 
        paddle.sety(y)

def paddle_down():   
    y = paddle.ycor() 
    if y > -250: 
        y -= 20 
        paddle.sety(y)

# Toetsenbordbinding
wn.listen()
wn.onkeypress(paddle_up, 'w')
wn.onkeypress(paddle_down, 's')

# Bal
ball = turtle.Turtle()
ball.shape("square")
ball.color("white")
ball.penup()
ball.goto(0, 0)
ball.dx = 0.1
ball.dy = -0.1

# Score en levens
score = 0
levens = 3

# Pen voor tekst
pen = turtle.Turtle()
pen.speed(0)
pen.color("white")
pen.penup()
pen.hideturtle()
pen.goto(0, 260)
pen.write("Score: 0  Levens: 3", align="center", font=("Courier", 24, "normal"))

def update_score():
    pen.clear()
    pen.goto(0, 260)
    pen.write("Score: {}  Levens: {}".format(score, levens), align="center", font=("Courier", 24, "normal"))

def game_over():
    pen.goto(0, 0)
    pen.write("GAME OVER", align="center", font=("Courier", 36, "normal"))

while True:
    wn.update()
    
    ball.setx(ball.xcor() + ball.dx)
    ball.sety(ball.ycor() + ball.dy)

    if ball.ycor() > 290:
        ball.sety(290)
        ball.dy *= -1

    if ball.ycor() < -290:
        ball.sety(-290)
        ball.dy *= -1

    if ball.xcor() > 390:
        ball.setx(390)
        ball.dx *= -1

    if (ball.dx < 0 and ball.xcor() < -350):  
        if (paddle.ycor() - 60 < ball.ycor() < paddle.ycor() + 60):  
            ball.dx *= -1
            ball.dy *= -1
            score += 1

            # elke 5 punten wordt de bal 10% sneller, alleen een ifje nodig terwijl ik was beetje te veel aan het denken over deze opdracht
            if score % 5 == 0:
                ball.dx *= 1.1
                ball.dy *= 1.1

            update_score()
        else:
            levens -= 1
            update_score()

            if levens == 0:
                ball.dx = 0
                ball.dy = 0
                game_over()
                break
            else:
                ball.goto(0, 0)
                ball.dx = 0.1
                ball.dy = -0.1
                time.sleep(3)




input("Press any key to continue...")