<?php
// Check if the request method is set and is equal to "POST"
if ($_SERVER["REQUEST_METHOD"] ?? '' == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Ensure that required fields are not empty
    if (!empty($fullname) && !empty($email) && !empty($message)) {
        // Create a string with the form data
        $response = "Full Name: $fullname\n";
        $response .= "Email: $email\n";
        $response .= "Message: $message\n";
        
        // Store the response in a text file
        $file = 'responses.txt';
        file_put_contents($file, $response, FILE_APPEND | LOCK_EX);
        
        // Optionally, send an email notification
        $to = "brittytino@email.com";
        $subject = "New Contact Form Submission";
        $headers = "From: $email\r\n";
        mail($to, $subject, $response, $headers);
        
        // Redirect user to a thank you page
        header("Location: thank_you.html");
        exit();
    } else {
        // Handle case where required fields are empty
        echo "Please fill out all required fields.";
    }
} else {
    // Handle case where form is not submitted via POST method
    echo "Form submission method not allowed.";
}
?>
