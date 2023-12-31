<head>
  <meta charset="UTF-8">
  <title>BUFFET ALEGRIA</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <style>
    body {
      background-image: url("https://img.elo7.com.br/product/zoom/1E8793D/papel-de-parede-bolinhas-coloridas-1331-promocao-em-papel-de-parede-bolinhas-coloridas.jpg");
      background-size: cover;
      display: flex;
      justify-content: center;
      /* Centraliza horizontalmente */
      scroll-behavior: smooth;
    }

    #logar {
      background-color: #ffffff;
      width: 100%;
      margin: 2.5%;
      max-width: 800px;
    }
  </style>

</head>

<body class="h-full">

  <!-- Logar -->

  <div id="logar" class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://img.freepik.com/vetores-premium/balao-de-helio-voando-em-bolas-de-ar-isoladas-no-fundo-branco-feliz-aniversario-feriado_458444-964.jpg?w=826" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Logar</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{route('login_post')}}" method="POST">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
          <div class="mt-2">
            <input placeholder="Insira seu e-mail" id="email" name="email" type="email" autocomplete="email" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
          </div>
          <div class="mt-2">
            <input placeholder="Insira sua senha" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
          <div class="text-sm">
            <a href="#" class="font-semibold text-cyan-400 hover:text-cyan-950">Esqueceu a senha?</a>
          </div>
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
            </label>
        </div>

        <div class="mt-2">
          <button type="submit" class="flex w-full justify-center rounded-md bg-cyan-300 px-3 py-1.5 text-sm font-semibold leading-6 text-cyan-950 shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-200">Logar</button>
        </div>
      </form>



    </div>
  </div>
  <!-- Fim registro -->