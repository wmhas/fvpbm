<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-color: #181818;
            }

            .mainbox {
                background-color: #181818;
                margin: auto;
                height: 600px;
                width: 600px;
                position: relative;
            }

            .err {
                color: #ffffff;
                font-family: 'Nunito Sans', sans-serif;
                font-size: 11rem;
                position: absolute;
                left: 20%;
                top: 8%;
            }

            .far {
                position: absolute;
                font-size: 8.5rem;
                left: 42%;
                top: 15%;
                color: #ffffff;
            }

            .err2 {
                color: #ffffff;
                font-family: 'Nunito Sans', sans-serif;
                font-size: 11rem;
                position: absolute;
                left: 68%;
                top: 8%;
            }

            .msg {
                text-align: center;
                font-family: 'Nunito Sans', sans-serif;
                font-size: 1.6rem;
                position: absolute;
                left: 16%;
                top: 45%;
                width: 75%;
            }

            a {
                text-decoration: none;
                color: white;
            }

            a:hover {
                text-decoration: underline;
            }

        </style>
    </head>

<body>
    <div class="mainbox">
        <div class="err">4</div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">3</div>
        <div class="msg">You can't go beyond here.<p>Let's go <a href="{{ url()->previous() }}">Go Back</a> and try from there.</p>
        </div>
    </div>
</body>

</html>
