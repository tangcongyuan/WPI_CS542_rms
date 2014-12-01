<!DOCTYPE html>
<html lang="en">

<body>
    <h1>Simple Sign Up with CodeIgniter</h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('verifyregister'); ?>
    <label for="email">Email:</label>
    <input type="text" size="20" id="email" name="email"/>
    <br/>
    <label for="password">Password:</label>
    <input type="password" size="20" id="password" name="password"/>
    <br/>
    <label for="firstname">First name:</label>
    <input type="text" size="20" id="firstname" name="firstname"/>
    <br/>
    <label for="lastname">Last name:</label>
    <input type="lastname" size="20" id="lastname" name="lastname"/>
    <br/>
    <input type="submit" value="Sign up"/>
  </form>
</body>
</html>
