<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmasi Halaman</title>
</head>

<body>

    <div id="result"></div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetchData();
        })

        const fetchData = () => {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = () => {
                if (xmlhttp.status == 200) {
                    const response = JSON.parse(xmlhttp.responseText)
                    console.log(response[3].answers);
                    // document.getElementById("result").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "getdata.php", true)
            xmlhttp.send();
        }
    </script>
</body>

</html>