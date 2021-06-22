<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Email</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{$name}}!</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>For change your passsword click belwo link. <br>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Email: {{$email}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><a href="{{route('change', $email)}}">Change</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thanks & Regards</td>
        </tr>
        <tr>
            <td>
                E-com Website
            </td>
        </tr>
    </table>

</body>
</html>
