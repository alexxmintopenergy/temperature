document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('temperatureForm');
    const temperatureData = document.getElementById('temperatureData');

    form.addEventListener('submit', async(e) => {
        e.preventDefault();

        const date = document.getElementById('date').value;
        const token = document.getElementById('token').value;
        const csrfToken = document.querySelector('input[name="_token"]').value;

        try {
            const response = await axios.get('/api/temperature-history', {
                params: { day: date },
                headers: {
                    'x-token': token,
                }
            });

            if (response.data.data.length > 0) {
                temperatureData.innerHTML = `Temperature: ${response.data.data[0].temperature}°C`;
            } else {
                temperatureData.innerHTML = 'No data available for this date.';
            }
        } catch (error) {
            console.error(error);
            temperatureData.innerHTML = 'There are no data available for this date.';
        }
    });
});
