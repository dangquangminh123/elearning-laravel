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

animation-duration quyết định thời lượng.
animation-delay quyết định khi nào bắt đầu.
animation-iteration-count quyết định số lần lặp.
animation-direction quyết định hướng/đảo vs không.
animation-fill-mode quyết định trạng thái giữ lại sau khi dừng.

Keyword thì half doughnut chart, padAngle
ô tròn segment

vấn đề kích thước các biểu đồ tròn không được bị che, đồng thời vấn đề hướng cong lõm theo đâu gốc quay xoay như thế nào 
phần chia các đường tròn ra làm sao 

Cứ mỗi 1 hàng là gồm 4 item nằm ngang căn chỉnh từ 2 phía tràn ra, nghĩa là bình thường nếu số lượng item ít thì cứ căn đều vào chính giữa 2 bên và khi item nhiều ra thì căn tràn ra từ chính giữa ra 2 bên màn hình đó bạn nha! Tiếp tục mỗi item luôn có số thứ tự riêng của nó, ô số thứ tự thì chữ số màu trắng nền nó màu cam vàng nhạt và màu nền này phải được css thành hình tròn bạn nhá ! Và chữ số phải nằm chính giữa của ô tròn đó, và phần bên dưới là đầu tiên là có 1 đường sọc xanh lục bao trùm lên toàn bộ và phải được border cả 4 gốc! Tiếp tục là  có thành phần như phong bì thư vậy đó (coi cho nó chuẩn xác hình mẫu vào ) đầu tiên là  là phần sọc nếp gấp màu xanh đậm như hình ảnh phải được border tròn và dày hơn ở dưới 2 gốc trái và phải còn bên trên 2 gốc trên thì border ít hơn 2 gốc dưới nhưng nó vẫn được border tròn như 2 gốc cuối của chính item (của chính 2 gốc dưới cùng item chứ ko phải 2 gốc của lá nếp gập đó bạn nha) và trong phần nếp gấp này có tiêu đề mỗi item là 1 tiêu đề đó bạn chữ đó phải được đậm lên 1 chút và có màu được nổi trong 1 màu xanh lục này và nó phải nằm ở giữa! Và sau đó cuối cùng là các nội dung mô tả bên trong cho từng item và được chia theo dạng ul li để có dấu . Đầu từng câu đó bạn! Dùng html css jquery js thiết kế cho chuẩn vào ha