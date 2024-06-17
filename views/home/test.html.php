<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Form</title>
    <style>
        /* Basic styling for popup */
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .popup-overlay {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
<button id="openPopup">Open Popup</button>

<div id="popupOverlay" class="popup-overlay"></div>
<div id="popup" class="popup">
    <form id="popupForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Submit</button>
        <button type="button" id="closePopup">Close</button>
    </form>
</div>

<script>
    document.getElementById('openPopup').addEventListener('click', function() {
        document.getElementById('popupOverlay').style.display = 'block';
        document.getElementById('popup').style.display = 'block';
    });

    document.getElementById('closePopup').addEventListener('click', function() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.getElementById('popup').style.display = 'none';
    });

    document.getElementById('popupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Form submitted successfully!');
                document.getElementById('popupOverlay').style.display = 'none';
                document.getElementById('popup').style.display = 'none';
            }
        };
        xhr.send('name=' + encodeURIComponent(name) + '&email=' + encodeURIComponent(email));
    });
</script>
</body>
</html>
