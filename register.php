<html>

<head>
    <title>Register Component</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@100&display=swap');

    * {
        margin: 0px;
        padding: 0px;
        box-sizing: content-box;
        font-family: "Open Sans", sans-serif;
    }

    #container {
        max-width: 30%;
        box-shadow: 10px 20px 50px grey;
        border-radius: 10px;
        box-sizing: border-box;
        box-shadow: 12px;
        background-color: white;
        margin-top: 2%;
        margin-bottom: 2%;
        margin-left: auto;
        margin-right: auto;
        padding: 10px;
        display: block;
        overflow: hidden;
    }

    #sub-container {
        width: 100%;
        text-align: center;
        padding: 5px;
        box-sizing: border-box;
    }

    .fields {
        padding: 5px;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
        box-sizing: border-box;
        display: block;
        text-align: left;
    }

    input[type="text"],
    input[type="password"],
    input[type="date"] {
        margin-top: 10px;
        width: 100%;
        border-radius: 5px;
        text-decoration: none;
        padding: 5px;
        box-shadow: 2px 2px 10px grey;
        box-sizing: border-box;
        border: 1px solid black;
    }

    .btn {
        margin: 5px;
        width: 60px;
        font-weight: bold;
        font-size: 12px;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none;
        transition-duration: 0.4s;
        background-color: white;
        color: black;
        border: 1px solid #000000;
    }

    .btn:hover {
        background-color: #000000;
        color: white;
    }

    span {
        display: block;
    }

    label {
        font-weight: bold;
    }

    .radio-container {
        display: flex;
        justify-content: center;
        border-radius: 5px;
        border: 1px solid black;
        box-sizing: border-box;
        font-size: 13px;
        padding: 5px;
        margin-top: 10px;
        box-shadow: 2px 2px 10px grey;

    }

    input[type="radio"] {
        margin-top: 3px;
        margin-left: 10px;
        margin-right: 20px;
    }
</style>

<body>

    <div id="container">
        <div id="sub-container">
            <h2> REGISTER </h2>
            <br>
            <hr>
            <br>

            <form method="post" action="register_process.php">
                <div class="fields">
                    <label> ID Number </label>
                    <br>
                    <span><input type="text" name="id" placeholder="id" required /></span>
                    <br>
                    <label> Complete Name </label>
                    <br>
                    <span><input type="text" name="cname" placeholder="complete name" required /></span>
                    <br>
                    <label> Status </label>
                    <br>
                    <div class="radio-container">
                        <label> Regular </label>
                        <input type="radio" name="status" value="Regular" required />
                        <label> Probation </label>
                        <input type="radio" name="status" value="Probation" required />
                    </div>

                    <br>
                    <label> Gender </label>
                    <div class="radio-container">
                        <label> Male </label>
                        <input type="radio" name="gender" value="Male" required />
                        <label> Female </label>
                        <input type="radio" name="gender" value="Female" required />
                    </div>
                    <br>
                    <label> Hire Date </label>
                    <br>
                    <span><input type="date" name="hdate" required /></span>
                    <br>
                    <label> Username </label>
                    <br>
                    <span><input type="text" name="username" placeholder="username" required /></span>
                    <br>
                    <label> Password </label>
                    <br>
                    <span><input type="password" name="pass" placeholder="password" required /></span>

                </div>
                <br>
                <input type="submit" value="Register" name="regBtn" class="btn" />
            </form>

        </div>

    </div>
</body>

</html>