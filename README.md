# Laravel Weather Microservice

This microservice periodically fetches and stores temperature data for a specified city. It provides an API endpoint and a simple web interface to retrieve the temperature history for a given day.

## Features

- **Automated Temperature Fetching:** Hourly retrieval of temperature data from OpenWeatherMap API.
- **Historical Data Storage:** Persists temperature records in a database for future reference.
- **API Endpoint:** RESTful API to access temperature history using a secure token.
- **Web Interface:** User-friendly interface to view temperature history by selecting a date.
- **Scalable:** Designed with scalability in mind for potential future expansion.

## Installation

1.  **Clone the Repository:**

    ``` 
    git clone https://github.com/alexxmintopenergy/temperature.git
    cd weather-service
    ```

2.  **Install Dependencies:**

    ```bash
    composer install
    ```

3.  **Environment Setup:**
    -   Copy `.env.example` to `.env`.
    -   Fill in the following values in your `.env` file:

    ** Never insert API keys and other creds to GIT! :-) **
    ```
    WEATHER_API_KEY=
    WEATHER_CITY=
    X_TOKEN= 
    ```

    -   To generate a new secure token, run:

    ```bash
    php artisan tinker
    Str::random(32)
    ```

    Paste the generated token into your `.env` file.

4.  **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

5.  **Database Setup:**

    -   Create a database for the project.
    -   Update your `.env` file with the database credentials.
    -   Run migrations:

    ```bash
    php artisan migrate
    ```

6.  **Start the Server:**

    ```bash
    php artisan serve
    ```

7.  **Fetch Temperature Data (Manual):**

    ```bash
    php artisan fetch:temperature
    ```

8.  **Schedule Hourly Temperature Fetch (Automatic):**

    -   Edit your crontab file:

    ```bash
    crontab -e
    ```

    -   Add the following line (replace `/path-to-your-project` with the actual path):

    ```
    * * * * * cd /weather-service && php artisan schedule:run >> /dev/null 2>&1
    ```

    This will run the scheduler every minute, which in turn will trigger the `fetch:temperature` command hourly as configured in the application's scheduler.

## Usage

### Web Interface

Access the temperature history by visiting:
```
http://localhost:8000/temperature-history
```
### API Endpoint

-   **Endpoint:** `/api/temperature-history`
-   **Method:** GET
-   **Parameters:**
    -   `day` (required): Date in `Y-m-d` format.
-   **Headers:**
    -   `x-token` (required): Your secure token from the `.env` file.

**Example Request (using curl):**

```bash
curl -H "x-token:your_secure_token" "http://localhost:8000/api/temperature-history?day=2024-05-21"
