<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('fav.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ALPINE.JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // thmColor: "#81c784",
                        thmColor: "#6ee7b7",
                    },
                },
            },
        };
    </script>
    <title>Jobatho | Job-At-Home</title>
</head>

<body class="mb-48">
    <nav class="flex justify-between items-center mb-4">
        <a href="/"><img class="w-24" src="{{ asset('images/logos.png') }}" alt="" class="logo"
                style="min-height: 50px; margin-left:10px;" /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth

                <?php
                $user_id = auth()->user()->id;
                $profile = DB::table('jobatho_profile')
                    ->where('jobatho_user_id', $user_id)
                    ->first();
                ?>
                <li>
                    <a href="/profiles">
                        <img class="rounded"
                            src="{{ $profile->image != null ? asset($profile->image) : asset('images/def-profile.jpg') }}"
                            alt="" width="25px" style="float:left;">
                        <span class="font-bold uppercase" style="margin-left:5px;">
                            {{ auth()->user()->name }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/listings/manage" class="hover:text-thmColor"><i class="fa-solid fa-gear"></i> Manage
                        Listings</a>
                </li>
                <li>
                    <form action="/logout" class="inline" method="post">
                        @csrf
                        <button class="text-thmColor" type="submit">
                            <i class="fa-solid fa-arrow-right-to-bracket "></i> Log Out
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="/register" class="hover:text-thmColor"><i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
                <li>
                    <a href="/enter" class="hover:text-thmColor"><i class="fa-solid fa-door-closed"></i>
                        Login</a>
                </li>
            @endauth
        </ul>
    </nav>



    <main>
        {{-- view content --}}
        {{ $slot }}

    </main>

    <x-flash-message />
</body>

</html>
