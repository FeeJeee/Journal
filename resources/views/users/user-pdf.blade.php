<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <style>
        table,
        td {
            width: 200px;
            border: 1px solid #333;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="2">{{ $user->fullName }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Surname:</td>
                <td>{{ $user->surname }}</td>
            </tr>
            <tr>
                <td>Patronymic:</td>
                <td>{{ $user->patronymic }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Birthdate:</td>
                <td>{{ $user->birthdate }}</td>
            </tr>
            <tr>
                <td>Group:</td>
                <td>{{ $user->group->title }}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{ $user->fullAddress }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
