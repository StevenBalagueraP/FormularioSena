<!DOCTYPE html>
<head>
    <title>Verifica tu correo electrónico</title>
    <style>
        .button {
            background-color: #39A900;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .button:hover {
            background-color: #007832;
        }
        </style>
</head>
<body>
    <table width="100%" cellpadding="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <img src="{{ $logo }}" alt="Logo SENA" style="max-width: 150px; margin-bottom: 20px;">
                <h2>¡hola!</h2>
                <p>Gracias por registrarte. Por favor, haz clic en el botón de abajo para verificar tu dirección de correo electrónico.</p>
                <a href="{{ $verificationUrl }}" class="button">Verificar correo electrónico</a>
                <p>Si no creaste una cuenta, puedes ignorar este correo.</p>
                <p>Saludos,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
