<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            background: #dbdbdb;
        }

        .taks {
            display: flex;
            justify-content: space-around;
        }

        h1 {
            text-align: center;
            padding: 1rem;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            background: #fff;
            padding: 1rem;
            box-shadow: 1px 1px 1px 1px #74747460;
            border-radius: 5px;
        }

        i {
            color: rgb(207, 0, 0);
            font-size: 1.3rem;
        }

        button {
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            background: #fff;
            padding: 1rem;
            box-shadow: 1px 1px 1px 1px #74747460;
            border-radius: 5px;
            width: 40rem;
            text-align: center;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
        .pagination{
            margin-top: 1rem;
        }
        .done{
            background: #008000;
            color: #fff;
        }
        .no-done{
            background: #800000;
            color: #fff;
        }
    </style>
    <title>Tarefas</title>
</head>

<body>
    <header>
        <h1>Tarefas com Laravel</h1>
    </header>
    <section class="taks">
        <section>
            <form method="POST" action="/create" class="form border-solid border-2 border-sky-500 rounded">
                @csrf
                <h1>Nova tarefa</h1>
                <label for="name"><i>*</i> Nome:</label>
                <input id="name" type="text" name="name" class="border-solid border-2 border-sky-500 rounded" required>

                <label for="description">Description:</label>
                <input id="description" type="text" name="description" class="border-solid border-2 border-sky-500 rounded">

                <button type="submit" class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">CREATE</button>
            </form>
        </section>
        <section>
            <table class="border-solid border-2 border-sky-500 rounded">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Update</th>
                        <th>Complete</th>
                        <th>Check</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarefas as $tarefa)
                        <tr>
                            <td>{{ $tarefa->id }}</td>
                            <td>{{ $tarefa->name }}</td>
                            <td>
                                @if ($tarefa->description == "")
                                    -
                                @else
                                    {{ $tarefa->description }}
                                @endif
                            </td>
                            <td>{{ $tarefa->updated_at }}</td>
                            <td class="@if ($tarefa->done)
                                done
                                @else
                                no-done
                            @endif">
                                @if ( $tarefa->done == "0" )
                                    No
                                @elseif ($tarefa->done == "1")
                                    Yes
                                @else
                                    Indefined
                                @endif
                            </td>
                            <td>
                                <form action="/update" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$tarefa->id}}" name="id">
                                    <input type="hidden" value="
                                    @if ($tarefa->done)
                                        0
                                        @else
                                        1
                                    @endif
                                    " name="done">
                                    <Button class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"><i class="bi bi-check2"></i></Button>
                                </form>
                            </td>
                            <td>
                                <form action="/destroy" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$tarefa->id}}" name="id">
                                    <Button class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"><i class="bi bi-eraser"></i></Button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $tarefas->links()}}
            </div>
        </section>
    </section>
</body>

</html>
