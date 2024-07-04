PROJECT INSTALLATION
--------------------------------------------------------------------------
Clone the Repository
git clone https://github.com/IsaMarianaQF/Activos.git
cd activos

Install Dependencies
composer install
npm install

Configure Environment File
Configure the database and other necessary environment variables in the .env file.
Name database TigoDB 

Generate Application Key
php artisan key:generate

Run migrate Database
php artisan migrate

Compile Frontend Assets
npm run dev
php artisan serve

Additional Notes
Make sure you have PHP, Composer, Node.js, and npm installed on your system.
