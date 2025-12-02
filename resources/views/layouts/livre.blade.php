<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Website')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-third">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <x-header/>

    <section class="secondary-color py-16">
        <div class="container mx-auto px-4">
            @yield('hero-section')
        </div>
    </section>

    @yield('content')

    <x-footer/>

    <script>
        // Helper function to show messages
        function showMessage(message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
            messageDiv.style.position = 'fixed';
            messageDiv.style.top = '20px';
            messageDiv.style.right = '20px';
            messageDiv.style.zIndex = '9999';
            messageDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="this.parentElement.remove()"></button>
            `;
            document.body.appendChild(messageDiv);
            
            setTimeout(() => messageDiv.remove(), 3000);
        }

        // Function to increment cart item
        function incrementCartItem(itemId) {
            fetch(`/panier/${itemId}/increment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success');
                    // Update quantity display if needed
                    const quantityElement = document.querySelector(`#quantity-${itemId}`);
                    if (quantityElement) {
                        quantityElement.textContent = parseInt(quantityElement.textContent) + 1;
                    }
                } else {
                    showMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Une erreur est survenue', 'error');
            });
        }
    </script>
</body>
</html>