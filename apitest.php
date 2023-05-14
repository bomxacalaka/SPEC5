<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button id="submitBtn">Add Job</button>
    <button id="getJob">Get Job</button>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function () {
            // Define your JSON data
            let jsonData = {
                "client_name": "John Doe",
                "date": "2021-09-01",
                "visit_duration": "60",
                "carer_name": "John Doe",
                "job_description": "test",
                "tasks": [
                    ["clean thistest69", false],
                    ["clean that420", true]
                ],
                "address": "test"
            };

            // Send the data
            fetch('add_job.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        });

        document.getElementById('getJob').addEventListener('click', function () {
            fetch('get_job.php?id=128')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // JSON data retrieved from the server
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        });
    </script>
</body>

</html>