Tạo Module
php artisan make:module TenModule

Tạo Controller
php artisan module:make-controller TenController TenModule

Tạo Middleware
php artisan module:make-middleware TenMiddleware TenModule

Tạo Request
php artisan module:make-request TenRequest TenModule

Tạo Model
php artisan module:make-model TenModel TenModule

Tạo Migration
php artisan module:make-migration TenMigration TenModule

Tạo Seeder
php artisan module:make-seeder TenSeeder TenModule


1/ nếu discount_type là percent thì lúc này phải validate discount_value total_condition rằng
discount_value có giá trị 0 tới 5 thì total_condition nhỏ hơn 200 000
discount_value có giá trị 5 tới 10 thì total_condition phải là. từ  200 000 tới 499000
discount_value có giá trị 10 tới 12 thì total_condition nhỏ hơn 500 000 tới 999 000
discount_value có giá trị 12 tới 15 thì total_condition nhỏ hơn 1000 000 tới 1999000
discount_value có giá trị 15 tới 20 thì total_condition nhỏ hơn 2 000 000 tới 4999 000
discount_value có giá trị 20 tới 30 thì total_condition lớn hơn 5 000 000
và discount_value nhỏ hơn 30 

2/
discount_value có giá trị 90 000 150000 thì total_condition nhỏ hơn 800 000
discount_value có giá trị 160000 đến 360000 thì total_condition từ  800 000 tới 1400000
discount_value có giá trị 370000 đến 500000 thì total_condition từ 1499000 tới 1999000
discount_value có giá trị 500 000 đến 699000 thì total_condition nhỏ hơn 2000000 tới 2 999 000
discount_value có giá trị 799 000  thì total_condition lớn hơn 3 000 000


MERN  structure 2025
project-root/
├── client/                        # React app
│   ├── public/
│   ├── src/
│   │   ├── components/           # UI components
│   │   ├── modules/              # Modular Feature-based folders
│   │   │   ├── Coupons/          # Coupons module in frontend
│   │   │   │   ├── pages/
│   │   │   │   ├── components/
│   │   │   │   ├── services/
│   │   │   │   └── hooks/
│   │   ├── routes/
│   │   ├── store/                # Redux / Zustand / Context
│   │   └── App.jsx
│
├── server/                       # Express.js backend
│   ├── config/                   # DB, environment, constants
│   ├── core/                     # Middlewares, response utils, error handling
│   ├── modules/                 # Modular features like Laravel Modules
│   │   ├── coupons/
│   │   │   ├── controllers/
│   │   │   ├── routes/
│   │   │   ├── services/        # Business logic (SOLID: single responsibility)
│   │   │   ├── models/
│   │   │   ├── validators/      # Joi/Zod, similar to Laravel Requests
│   │   │   └── repository/      # Data access abstraction
│   │   └── users/
│   ├── database/
│   │   ├── mongoose.js
│   └── index.js                 # App entry point
│
├── .env
├── package.json
└── README.md

Modular (theo kiểu Laravel Modules)
Modules/
├── Coupons/
│   ├── Config/
│   ├── Helpers/
│   ├── Migrations/
│   ├── Resources/
│   ├── Routes/
│   ├── src/
│   │   ├── Commands/
│   │   ├── Models/
│   │   ├── Repositories/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   ├── Requests/
│   │   │   ├── Middlewares/
Lấy apikey
openssl rand -hex 32

ngrok http http://localhost:8080
ngrok http 80 --url=<YOUR_STATIC_DOMAIN>
awaited-reindeer-strictly.ngrok-free.app

cặp linear gradient này    'linear-gradient(135deg, #D63031, #FF7675)',
                'linear-gradient(135deg, #C0392B, #E74C3C)' thì bạn đổi sang hệ linear gradient này #C3272B cho tôi
                và cái text thì ['#FAD390', '#FFEAA7'] đổi sang mã màu #426666
tiếp tục cặp này  bg: [
                'linear-gradient(135deg, #2ECC71, #55EFC4)',
                'linear-gradient(135deg, #00B894, #1DD1A1)'
            ], thì đổi sang hệ linear gradient  #146654
            và màu text này text: ['#ffffff', '#DFF9FB'] thì đổi sang mã màu #f05510
Tiếp tục là phần     bg: [
                'linear-gradient(135deg, #FDCB6E, #FFEAA7)',
                'linear-gradient(135deg, #EAB543, #F8EFBA)'
            ], này  đổi sang hệ linear gradient #564232
   màu  text: ['#2D3436', '#1E272E'] đổi sang mã màu  #327A58

Và còn phần  bg: [
                'linear-gradient(135deg, #6C5CE7, #A29BFE)',
                'linear-gradient(135deg, #4834D4, #686DE0)'
            ], thì đổi sang hệ linear gradient #4781C3
  và màu text như này           text: ['#FDCB6E', '#FFEAA7'] đổi qua màu #DE7565
    
    và tiếp tục phần có bg: [
                'linear-gradient(135deg, #0984E3, #74B9FF)',
                'linear-gradient(135deg, #0A79DF, #25CCF7)'
            ], thì đổi sang hệ linear gradient này cho tôi #6F9Bc6
            text: ['#DFF9FB', '#EAF0F1'] thì đổi qua màu #F3993A

Cuối cùng phần này 'linear-gradient(135deg, #681414, #8B0000)', đổi sang hệ linear #F7BDCB và    colors: [
                    '#D7CCB6',  ] thì sang #5654A2 

        