<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Create a MongoDB connection
    $mongoClient = new MongoDB\Client('mongodb://localhost:27017');

    // Select the database and collection
    $database = $mongoClient->selectDatabase('my_database');
    $collection = $database->selectCollection('contacts');

    // Create a new document with the form data
    $document = [
        'name' => $name,
        'email' => $email
    ];

    // Insert the document into the collection
    $result = $collection->insertOne($document);

    if ($result->getInsertedCount() === 1) {
        // Send a success response
        http_response_code(200);
        echo "Form submitted successfully!";
    } else {
        // Send an error response
        http_response_code(500);
        echo "Failed to submit the form.";
    }
} else {
    // Send an error response
    http_response_code(400);
    echo "Invalid request.";
}
?>