<!DOCTYPE html>
<html lang="en">
	<head>
		<title>KPRI GRAFIKA</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/assets/logo_kpri.png') }}">
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ asset('build/assets/app-DZE8fvpm.css') }}">
		<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
		<link rel="stylesheet" href="{{ asset('css/login.css') }}">
	</head>
	<body>
		<div class="flex justify-center items-center mx-4 h-screen">
			<div class="w-[500px] rounded-lg bg-[#FFFFFF]">
				<div class="m-10 flex flex-col gap-3 justify-center items-center">
					<div class="flex items-center mb-5">
						<img src="{{ asset('storage/assets/logo_kpri.png') }}" class="w-[100px]" alt="" />
						<h3 class="font-semibold">KPRI Grafika</h3>
					</div>
					<div class="flex flex-col gap-6 w-full">
            <div 
							id="error-alert" 
							class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" 
							role="alert"
						>
							<span class="block sm:inline">Username atau password tidak boleh kosong!</span>
							<span id="close-alert" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
								<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
									<title>Close</title>
									<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.03a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
								</svg>
							</span>
						</div>
						@error('error')
							<div class="flex items-center p-4 mb-0 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
									<svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
											<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
									</svg>
									<span class="sr-only">Info</span>
									<div>
											<span class="font-medium">{{ $message }}</span>
									</div>
							</div>
						@enderror
            <form action="{{ route('admin.login.proses') }}" method="POST" id="loginForm">
              @csrf
              {{-- <div class="relative mb-5">
                <input
                  id="username"
                  name="username"
                  type="text"
                  placeholder="Username"
                  class="w-full h-[50px] rounded-lg bg-gray-200 p-3 pl-12"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 " 
									required
                />
                <i
                  data-lucide="user"
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                ></i>
              </div> --}}
							<div class="relative mb-6">
								<div class="absolute inset-y-0 start-0 flex items-center ps-2.5 pointer-events-none">
									<svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
										<path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
									</svg>									
								</div>
								<input 
									type="text" 
									id="username" 
									name="username"
									class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" 
									placeholder="Username"
									required
								>
							</div>
							<div class="relative mb-2">
								<div class="absolute inset-y-0 start-0 flex items-center ps-2.5 pointer-events-none">
									<svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
									</svg>							
								</div>
								<input 
									type="password" 
									id="password" 
									name="password"
									class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" 
									placeholder="Password"
									required
								>
							</div>
              {{-- <div class="relative mb-5">
                <input
                  id="password"
                  name="password"
                  type="password"
                  placeholder="Masukan Password"
                  class="w-full h-[50px] rounded-lg bg-gray-200 p-3 pl-12"
									required
                />
                <i
                  data-lucide="lock"
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                ></i>
              </div> --}}
							<div class="w-full flex justify-end gap-3 mb-5">
								<input type="checkbox" name="" id="my-checkbox" />
								<label for="my-checkbox" class="text-sm text-gray-500">Show Password</label>
							</div>
							<div class="w-full">
								<button
									type="submit"
									class="bg-[#7CD759] p-4 rounded-lg w-full text-white"
								>
									Login
								</button>
							</div>
            </form>
					</div>
				</div>
			</div>
		</div>
		<script>
			function showPassword() {
        const checkbox = document.getElementById("my-checkbox");
        const passwordInput = document.getElementById("password");

        if (checkbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
			}

			document.getElementById("my-checkbox").addEventListener("change", showPassword);

			// lucide.createIcons();

			// function validateLogin() {
			// 	const username = document.getElementById('username').value;
			// 	const password = document.getElementById('password').value;
			// 	const errorAlert = document.getElementById('error-alert');

			// 	if (username.trim() === '' || password.trim() === '') {
			// 		errorAlert.classList.remove('hidden');
			// 		return;
			// 	}

			// 	errorAlert.classList.add('hidden');
			// 	// window.location.href = '/pages/dashboard.html';
			// }

			// // Close alert functionality
			// document.getElementById('close-alert').addEventListener('click', function() {
			// 	document.getElementById('error-alert').classList.add('hidden');
			// });

			// // Add event listener for Enter key press
			// document.addEventListener('keydown', function(event) {
			// 	if (event.key === 'Enter') {
			// 		validateLogin();
			// 	}
			// });
		</script>
		{{-- <script src="assets/js/dropdown.js"></script> --}}
	</body>
</html>