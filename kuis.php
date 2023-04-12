<?php
session_start();

if (isset($_SESSION['login'])) {
    '';
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/loading.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Kuis Kuesioner</title>
</head>

<body>
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <div class="content survie">
        <center>
            <div class="row px-5" id="choice-question"></div>
            <div class="content-kuis">
                <div class="bg-primary" style="--bs-bg-opacity: .8; border-radius: 30px; padding: 10px;">
                    <h1 id="question"></h1>
                </div>

                <div class="mt-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="col-sm-12">
                                <input type="radio" name="choice" id="choice0">
                                <label for="choice0" id="choiceText0"></label>
                            </div>
                            <div class="col-sm-12">
                                <input type="radio" name="choice" id="choice1">
                                <label for="choice1" id="choiceText1"></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-sm-12">
                                <input type="radio" name="choice" id="choice2">
                                <label for="choice2" id="choiceText2"></label>
                            </div>
                            <div class="col-sm-12">
                                <input type="radio" name="choice" id="choice3">
                                <label for="choice3" id="choiceText3"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary" onclick="nextQuestion()" style="display: block;" id="btn-next">Next</button>
                    <button onclick="completeQuestion()" style="display: none;" onclick="nextQuestion()" id="btn-complete">Selesai</button>
                </div>
            </div>
        </center>
    </div>
    <script>
        let currentQuestion = 1
        let answerQuestion = []
        let activeQuestion = 0

        document.addEventListener("DOMContentLoaded", (event) => {
            for (let i = 0; i < 10; i++) {
                document.getElementById('choice-question').innerHTML += `<div class="col-3">
                        <div class="box-question" id="question${i}" onclick="onClickQuestion(${i + 1})" data-id="${i}">
                            ${i + 1}
                        </div>
                </div>`
            }
            fetchData()

        })

        const onClickQuestion = (index) => {
            fetchData(index)
        }

        const fetchData = (dataId = currentQuestion) => {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = () => {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    let response = JSON.parse(xmlhttp.responseText)
                    response.forEach((item, index) => {
                        document.getElementById('question').innerText = item.question
                        document.getElementById(`choiceText${index}`).innerText = item.answers
                        document.getElementById(`choice${index}`).setAttribute('data-id', item.point)
                    })
                }
            }
            let parameters = `query_soal=${dataId}`
            // document.getElementById(`question${activeQuestion}`).style.backgroundColor = 'red'
            xmlhttp.open("POST", "getdata.php", true)
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(parameters);
        }

        const nextQuestion = () => {
            if (answerQuestion.length >= 9) {
                document.getElementById('btn-complete').style.display = "block"
                document.getElementById('btn-next').style.display = "none"
            }
            saveAnswer()
            fetchData()
        }

        const saveAnswer = () => {
            const answer = document.querySelector('input[name="choice"]:checked');
            if (answer != null) {
                answerQuestion.push(parseInt(answer.getAttribute('data-id')))
            } else if (answer == null) {
                alert('wajib diisi')
                return
            }
            currentQuestion++
            activeQuestion++
        }
        const completeQuestion = () => {
            let xmlhttp = new XMLHttpRequest();
            let parameters = `responden=${answerQuestion}`
            xmlhttp.open("POST", "saveanswers.php", true)
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(parameters);

            window.location.href = 'http://localhost/kuesioner-app/complete.php';
        }
    </script>
    <script src="./script/loading.js"></script>
</body>

</html>