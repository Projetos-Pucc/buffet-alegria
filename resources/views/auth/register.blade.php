<html>

<head>
	<meta charset="UTF-8">
	<title>BUFFET ALEGRIA</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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

		#cabecalho {
			text-align: center;
			background-color: #ffffff;
			padding: 0%;
			margin: 10px;
		}

		.buttons {
			inline-size: flex;
			text-align: right;
		}

		#registro {
			background-color: white;
			padding: 10%;
			margin: 2.5%;
		}

		::placeholder {
			color: black
		}
	</style>

</head>

<body class="h-full">
	<div class=" min-h-full">

		<!-- Cabeçalho -->

		<h1 id="cabecalho" class="font-sans text-5xl font-semibold leading-tight tracking-normal antialiased text-aling-center">
			BUFFET ALEGRIA
		</h1>

		<div class="buttons">

			<button class="bg-cyan-100 hover:bg-cyan-300 text-cyan-950 font-bold py-2 px-4 rounded-l">
				<a href="{{route('login')}}">Logar </a>
			</button>
			<button class="bg-cyan-100 hover:bg-cyan-300 text-cyan-950 font-bold py-2 px-4 rounded-r">
				<a href="#registro">Registrar</a>
			</button>
		</div>

		<!-- Fim cabeçalho-->

		<!-- Calendário -->
		<div>

			<link rel="dns-prefetch" href="//unpkg.com" />
			<link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
			<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
			<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

			<style>
				[x-cloak] {
					display: none;
				}
			</style>

			<div class="antialiased sans-serif h-screen">
				<div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak id="container-calendario">
					<div class="container mx-auto px-4 py-2 md:py-24">

						<!-- <div class="font-bold text-gray-800 text-xl mb-4">
				Schedule Tasks
			</div> -->

						<div class="bg-white rounded-lg shadow overflow-hidden">

							<div class="flex items-center justify-between py-2 px-6">
								<div>
									<span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
									<span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
								</div>
								<div class="border rounded-lg px-1" style="padding-top: 2px;">
									<button type="button" class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" :class="{'cursor-not-allowed opacity-25': month == 0 }" :disabled="month == 0 ? true : false" @click="month--; getNoOfDays()">
										<svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
										</svg>
									</button>
									<div class="border-r inline-flex h-6"></div>
									<button type="button" class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" :class="{'cursor-not-allowed opacity-25': month == 11 }" :disabled="month == 11 ? true : false" @click="month++; getNoOfDays()">
										<svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
										</svg>
									</button>
								</div>
							</div>

							<div class="-mx-1 -mb-1">
								<div class="flex flex-wrap" style="margin-bottom: -40px;">
									<template x-for="(day, index) in DAYS" :key="index">
										<div style="width: 14.26%" class="px-2 py-2">
											<div x-text="day" class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
										</div>
									</template>
								</div>

								<div class="flex flex-wrap border-t border-l">
									<template x-for="blankday in blankdays">
										<div style="width: 14.28%; height: 120px" class="text-center border-r border-b px-4 pt-2"></div>
									</template>
									<template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
										<div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
											<div @click="showEventModal(date)" x-text="date" class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100" :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"></div>
											<div style="height: 80px;" class="overflow-y-auto mt-1">
												<!-- <div 
										class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
										x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
										x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

												<template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">
													<div class="px-2 py-1 rounded-lg mt-1 overflow-hidden border" :class="{
												'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
												'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
												'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
												'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
												'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
											}">
														<p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
													</div>
												</template>
											</div>
										</div>
									</template>
								</div>
							</div>
						</div>
					</div>
				</div>

				<script>
					const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
					const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

					const SITEURL = "{{ url('/') }}";

					async function getEvents() {
						const csrf = document.querySelector('meta[name="csrf-token"]').content
						const data = await axios.get(SITEURL + '/bookings/calendar', {
							headers: {
								'X-CSRF-TOKEN': csrf
							}
						})
						const events = data.data.map((dt) => {
							const date = new Date(dt.party_start);
							const minutes = date.getMinutes() > 9 ? date.getMinutes() : `0${date.getMinutes()}`
							return {
								event_date: date,
								event_title: "Ocupado - " + date.getHours() + ":" + minutes,
								event_theme: 'red'
							}
						})
						return events;
					}

					function app() {
						return {
							month: '',
							year: '',
							no_of_days: [],
							blankdays: [],
							days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
							events: [],
							async inicializar() {
								try {
									const registros = await getEvents();
									this.events = registros;
									console.log('Página carregada. Eventos:', this.eventos);
								} catch (error) {
									console.error('Erro na inicialização:', error);
								}
							},

							event_title: '',
							event_date: '',
							event_theme: 'blue',

							themes: [{
									value: "blue",
									label: "Blue Theme"
								},
								{
									value: "red",
									label: "Red Theme"
								},
								{
									value: "yellow",
									label: "Yellow Theme"
								},
								{
									value: "green",
									label: "Green Theme"
								},
								{
									value: "purple",
									label: "Purple Theme"
								}
							],

							openEventModal: false,

							initDate() {
								let today = new Date();
								this.month = today.getMonth();
								this.year = today.getFullYear();
								this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
							},

							isToday(date) {
								const today = new Date();
								const d = new Date(this.year, this.month, date);

								return today.toDateString() === d.toDateString() ? true : false;
							},

							showEventModal(date) {
								// open the modal
								this.openEventModal = true;
								this.event_date = new Date(this.year, this.month, date).toDateString();
							},

							addEvent() {
								if (this.event_title == '') {
									return;
								}

								const obj = {
									event_date: new Date(2023, 9, 1),
									event_title: `dasda`,
									event_theme: this.event_theme
								}

								this.events.push(obj);

								console.log(this.events);

								// clear the form data
								this.event_title = '';
								this.event_date = '';
								this.event_theme = 'blue';

								//close the modal
								this.openEventModal = false;
							},

							getNoOfDays() {
								let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

								// find where to start calendar day of week
								let dayOfWeek = new Date(this.year, this.month).getDay();
								let blankdaysArray = [];
								for (var i = 1; i <= dayOfWeek; i++) {
									blankdaysArray.push(i);
								}

								let daysArray = [];
								for (var i = 1; i <= daysInMonth; i++) {
									daysArray.push(i);
								}

								this.blankdays = blankdaysArray;
								this.no_of_days = daysArray;
							}
						}
					}
				</script>
			</div>

			<!-- Fim calendário -->

			<!-- Registro -->

			<div id="registro" class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
				<div class="sm:mx-auto sm:w-full sm:max-w-sm">
					<img class="mx-auto h-10 w-auto" src="https://img.freepik.com/vetores-premium/balao-de-helio-voando-em-bolas-de-ar-isoladas-no-fundo-branco-feliz-aniversario-feriado_458444-964.jpg?w=826" alt="Your Company">
					<h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Registro</h2>
				</div>

				<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
					<form class="space-y-6" action="{{route('register_post')}}" method="POST">
						@csrf

						<div>
							<label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
							<div class="mt-2">
								<input id="name" name="name" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
							</div>
							<x-input-error :messages="$errors->get('name')" class="mt-2" />
						</div>

						<div>
							<label for="surname" class="block text-sm font-medium leading-6 text-gray-900">Sobrenome</label>
							<div class="mt-2">
								<input id="surname" name="surname" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
							</div>
						</div>

						<div>
							<label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
							<div class="mt-2">
								<input id="email" name="email" type="email" autocomplete="email" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
							</div>
							<x-input-error :messages="$errors->get('email')" class="mt-2" />
						</div>

						<div>
							<div class="flex items-center justify-between">
								<label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
							</div>
							<div class="mt-2">
								<input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
							</div>
							<x-input-error :messages="$errors->get('password')" class="mt-2" />
						</div>

						<div>
							<div class="flex items-center justify-between">
								<label for="password" class="block text-sm font-medium leading-6 text-gray-900">Confirmação da senha</label>
							</div>
							<div class="mt-2">
								<input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required class="block w-full bg-cyan-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-cyan-950 sm:text-sm sm:leading-6">
							</div>
							<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
						</div>

						<div class="mt-2">
							<button type="submit" class="flex w-full justify-center rounded-md bg-cyan-300 px-3 py-1.5 text-sm font-semibold leading-6 text-cyan-950 shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-200">Registrar</button>
						</div>
					</form>

					<p class="mt-10 text-center text-sm text-gray-700">
						Já registrado?
						<a href="{{route('login')}}" class="font-semibold leading-6 text-cyan-400 hover:text-cyan-950">Entrar</a>
					</p>
				</div>
			</div>
			<!-- Fim registro -->
</body>

</html>