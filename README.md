# Laravel Weather Microservice

This microservice fetches and stores temperature data for a specific city every hour and provides an API to retrieve temperature history for a given day.

## Installation

1. Clone the repository:
   git clone <repository_url>
   cd <repository_directory>

2. Install dependencies:
   composer install

3. Copy .env.example to .env and configure your environment variables:
   cp .env.example .env

4. Insert Data to env file:
      WEATHER_API_KEY=1754ac1a38bf062eb9ad47ff1aa96ac1
      WEATHER_CITY=Kyiv
      X_TOKEN=sqF3HdZISaG91XFwXSrHsB1zVygYD7MD
    # To generate the token run:
    # php artisan tinker
    # Str::random(32) 

5. Generate application key:
   php artisan key:generate

6. Set up the database and run migrations:
   php artisan migrate

7. Start the server:
   php artisan serve

8. Fetch Temperature Data:
   php artisan fetch:temperature

9. Setting Up Cron Job. Run the following command to open the crontab file:
 crontab -e
Add the following line to the file and save it:
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

Usage
Fetch Temperature Data
The application will automatically fetch temperature data for the configured city every hour.
You can also manually trigger the fetch using the following command:

    php artisan fetch:temperature

Get Temperature History with calendar: http://localhost:8000/temperature-history

API Endpoint: /api/temperature-history

x-token: 32-character token for authentication.

Example request:
curl -H "x-token:sqF3HdZISaG91XFwXSrHsB1zVygYD7MD" "http://localhost:8000/api/temperature-history?day=2023-05-21"

Running Tests
Run the following command to execute the test suite:
php artisan test

Some comments:
`Laradock was used for the development environment. But was added to .gitignore file.`
`Codesniffer was used for code style checking but not in all files.`
