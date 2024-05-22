<!DOCTYPE html>
<html>
<head>
    <title>Temperature History</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <section class="container temperature-section">
        <h1>Temperature History</h1>
        <form id="temperatureForm">
            @csrf
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" required>
            <input type="hidden" id="token" value="{{ config('services.weather.x_token') }}">
            <button type="submit">Get Temperature</button>
        </form>
        <div id="temperatureData"></div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/temperature.js') }}"></script>

</body>
</html>
