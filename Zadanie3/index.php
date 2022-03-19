<?php include 'header-footer/header.php' ?>

    <form action="register.php" method="post" enctype="multipart/form-data">        
        <div>
            <label for="userName">User name: *</label><br>
            <input type="text" name="userName" required><br>
            
            <label for="name">Email: *</label><br>
            <input type="email" name="email" required><br>
        </div>
        
        <div>
            <label for="name">Password: *</label><br>
            <input type="password" name="password" id="password" required><br>
            
            <label for="name">Confirm password: *</label><br>
            <input type="password" name="passwordConfirmation" id="passwordConfirmation" required><br>
        </div>

        <div>
            <label for="name">Name:</label><br>
            <input type="text" name="name"><br>
            
            <label for="name">Surname:</label><br>
            <input type="text" name="surname"><br>
        </div>

        <input onclick="passwordCheck(event)" type="submit" value="Sign Up" id="submit">
        <br><a href="login.php">Login</a>
    </form>

<?php include 'header-footer/footer.php' ?>