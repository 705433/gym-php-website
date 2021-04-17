<h2>Register</h2>
<form action="signup.php" method="post">
    <span class="required">* Denotes Required Field</span>
    <div class="form-group">
        <label>Customer name*</label>
        <input type="text" name="customername" class="form" required>
    </div>
    <div class="form-group">
        <label>Phone number*</label>
        <input type="text" name="phone" class="form" required>
    </div>
    <div class="form-group">
        <label>E-mail address*</label>
        <input type="text" name="email" class="form" required>
    </div>
    <div class="form-group">
        <label>Street</label>
        <input type="text" name="street" class="form" required>
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" class="form" required>
    </div>
    <div class="form-group">
        <label>Post code</label>
        <input type="text" name="postcode" class="form" required>
    </div>
    <div class="form-group">
        <label>Username*</label>
        <input type="text" name="username" class="form" required>
    </div>
    <div class="form-group">
        <label> Password*</label>
        <input type="password" name="password" class="form" required>
    </div>
    <div class="form-group">
        <label> Repeat Password*</label>
        <input type="password" name="password2" class="form" required>
    </div>
    <button type="submit" name="submit" class="submit">Register</button>
</form>
