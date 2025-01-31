<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="font-sans  dark:bg-secondary dark:text-white/50">

    <div class="container my-5">
        <a type="button" class="btn btn-primary float-end" href="{{route('index')}}">Add User</a>

        <h3 class="text-center">All Users</h3>
        @include('common.alert')
        @if ($users->isNotEmpty())
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            @php
                                $userData = json_decode($user->data);
                            @endphp
                            <td>{{ $userData->name }}</td>
                            <td>{{ $userData->email }}</td>
                            <td>{{ $userData->address }}</td>
                            <td>

                                <img src="{{ asset('storage/' . $userData->image) }}"
                                    alt="User Image" class="img-fluid"
                                    style="
                                        width:50px;
                                        height:50px;
                                        border-radius: .2rem;
                                        ">
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{route('edit',$user->id)}}">Edit</a>
                            
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div
                class="text-center text-warning text-lg font-size-24 font-semibold d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <span class="mx-3">
                    No Users to show <br>

                </span>
            </div>
        @endif

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
