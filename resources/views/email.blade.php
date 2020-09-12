<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <style>
        .card {
            margin-left:42.5%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 25%;
            border-radius: 5px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        img {
            border-radius: 5px 5px 0 0;
        }

        .container {
            padding: 2px 16px;
        }
    </style>
</head>

<body>

    <div class="card" style="text-align: center;">
        <img src="http://cadeobusao.com/imagens/logo.png" style="height: 150px; width:250px" alt="Avatar" style="width:100%">
        <div class="container">
            <h4>Você está recebendo esse E-Mail por que <b>{{$nome}} não estava presente na chamada.</b></h4>
        </div>
    </div>

</body>

</html>