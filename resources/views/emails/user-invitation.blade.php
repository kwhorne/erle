<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velkommen til InsideNext Intranett</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        h1 {
            color: #1f2937;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .credentials-box {
            background-color: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .credentials-table {
            width: 100%;
            border-collapse: collapse;
        }
        .credentials-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .credentials-table td:first-child {
            font-weight: 600;
            color: #374151;
            width: 140px;
        }
        .credentials-table td:last-child {
            color: #1f2937;
            word-break: break-all;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .warning {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            color: #92400e;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .steps {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .steps ol {
            margin: 0;
            padding-left: 20px;
        }
        .steps li {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .footer .contact-info {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">InsideNext</div>
        </div>
        
        <h1>Hei {{ $userName }},</h1>
        
        <p>Det er en glede å ønske deg velkommen til vårt interne digitale samlingspunkt! Intranettet er laget for å gjøre hverdagen din litt enklere – her finner du alt fra nyheter og viktige dokumenter til gode kollega­historier og smarte verktøy.</p>
        
        <h2>Dine påloggingsdetaljer</h2>
        
        <div class="credentials-box">
            <table class="credentials-table">
                <tr>
                    <td>Nettadresse:</td>
                    <td><strong>https://intranett.insidenext.no</strong></td>
                </tr>
                <tr>
                    <td>Brukernavn:</td>
                    <td><strong>{{ $userEmail }}</strong></td>
                </tr>
                <tr>
                    <td>Midlertidig passord:</td>
                    <td><strong>{{ $password }}</strong></td>
                </tr>
            </table>
        </div>
        
        <div class="warning">
            <strong>Viktig:</strong> Av sikkerhetshensyn ber vi deg endre passordet ditt første gang du logger inn.
        </div>
        
        <h2>Slik kommer du i gang</h2>
        
        <div class="steps">
            <ol>
                <li>Klikk på lenken til intranettet og logg inn med brukernavn og midlertidig passord.</li>
                <li>Følg veilederen som automatisk starter og velg et nytt passord.</li>
                <li>Ta en liten titt rundt – legg spesielt merke til:
                    <ul>
                        <li><strong>"Min Side":</strong> oppdater kontaktinformasjon og meld deg på relevante grupper.</li>
                        <li><strong>Nyhetsstrømmen:</strong> her deler vi små og store høydepunkter fra hele organisasjonen.</li>
                        <li><strong>Verktøykassen:</strong> snarveier til de mest brukte systemene våre.</li>
                    </ul>
                </li>
            </ol>
        </div>
        
        <p style="text-align: center;">
            <a href="https://intranett.insidenext.no" class="button">Gå til Intranett</a>
        </p>
        
        <h2>Trenger du hjelp?</h2>
        
        <p>Ikke nøl med å kontakte IT-servicedesken på <a href="mailto:support@insidenext.no">support@insidenext.no</a> eller telefon <strong>00 11 22 33</strong>. Vi sitter klare til å hjelpe deg mandag–fredag 08–16.</p>
        
        <p>Vi håper intranettet blir et verdifullt verktøy for deg, og at du finner både informasjon og inspirasjon der. Lykke til med oppstarten – vi gleder oss til å se deg på innsiden!</p>
        
        <div class="footer">
            <p><strong>Med vennlig hilsen,</strong><br>
            IT & Digital utvikling<br>
            InsideNext AS</p>
            
            <div class="contact-info">
                <p>Telefon: 00 11 22 34<br>
                E-post: <a href="mailto:it@insidenext.no">it@insidenext.no</a></p>
            </div>
        </div>
    </div>
</body>
</html>
