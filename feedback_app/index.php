<?php include_once "inc/header.php"; ?>

<?php

$name = "";
$email = "";
$body = "";
$date = "";

$nameErr = "";
$emailErr = "";
$bodyErr = "";
$dateErr = "";

// Form submit
if (isset($_POST["submit"])) {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required.";
    } else {
        $name = filter_input(
            INPUT_POST,
            "name",
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else {
        $email = filter_input(
            INPUT_POST,
            "email",
            FILTER_SANITIZE_EMAIL
        );
    }

    // Validate body
    if (empty($_POST["body"])) {
        $bodyErr = "Feedback is required.";
    } else {
        $body = filter_input(
            INPUT_POST,
            "body",
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
        // Add to database
        $sql_add =
            "INSERT INTO 
                feedback (name, email, body)
            VALUES 
                ('$name', '$email', '$body')";

        if (mysqli_query($conn, $sql_add)) {
            // Success
            header("Location: feedback.php");
        } else {
            // Error
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>

<img src="/php-crash/feedback/img/logo.png" class="w-25 mb-3" alt="">
<h2>Feedback</h2>
<p class="lead text-center">Leave feedback for Traversy Media</p>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-4 w-75" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?= !empty($nameErr) ? "is-invalid" : "" ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
            <?= $nameErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?= !empty($emailErr) ? "is-invalid" : "" ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
            <?= $emailErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?= !empty($bodyErr) ? "is-invalid" : "" ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
            <?= $bodyErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
    </div>
</form>

<?php include_once "inc/footer.php"; ?>