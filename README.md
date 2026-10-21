# Rimiga v2

A Steam game discovery platform rebuilt in Laravel. Browse featured games, check game details with trailers and screenshots, save favourites, browse by genre, and search.

This is a Laravel rewrite of the original Rimiga (v1), which was built in raw PHP.

## Features

- **Authentication**: register, log in, log out
- **Homepage**: featured carousel, top sellers, specials, coming soon, and new releases
- **Game details**: video trailers (HLS streaming), screenshots, requirements, price, PEGI rating
- **Favourites**: add and remove games, view your full list
- **Genre browsing**: browse games by genre with pagination
- **Search**: find games by name

## Tech Stack

- **Backend:** Laravel 13, PHP 8.2+
- **Database:** MySQL
- **Frontend:** Blade templates, Bootstrap 5, custom CSS, HLS.js
- **Data source:** Steam Store API (no game data is stored locally)

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL

### Installation

1. Clone the repo:
```bash
   git clone https://github.com/spartanryorix/rimiga-v2.git
   cd rimiga-v2
```

2. Install PHP and JS dependencies:
```bash
   composer install
   npm install
```

3. Set up your environment file:
```bash
   cp .env.example .env
   php artisan key:generate
```

4. Create an empty MySQL database called `rimiga_v2`, then add your credentials to `.env`:
DB_DATABASE=rimiga_v2
DB_USERNAME=root
DB_PASSWORD=your_password



5. Run the migrations:
```bash
   php artisan migrate
```

6. Start the app (in two terminals):
```bash
   npm run dev
   php artisan serve
```

7. Open `http://localhost:8000`

## Notes

- Game data comes live from the Steam Store API, so it's always current.
- The database only stores user accounts and favourites.
- This is a learning project, not affiliated with Valve or Steam.

## Credits

- Game data: [Steam Store API](https://store.steampowered.com/)
- Original v1 design and CSS: built by me, rebuilt here with Laravel