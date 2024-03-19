<form action="index.php" method="post" id="tech_logout" class="logout">
    <input type="hidden" name="action" value="logout">
    <p class="instructions">You are logged in as <?php echo $_SESSION['customer_email']; ?></p>
    <input class="submitButtonNoIndent" type="submit" value="Logout">
</form>