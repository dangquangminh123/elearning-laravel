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

Giờ tiếp tục bên trái là 1 hình ảnh của giảng viên trung tâm sau hình ảnh đó là 1 lớp background được css thiết kế lại là hình tròn nằm đằng sau hiện rõ ra nha thưa bạn và còn hình ảnh giảng viên đó thì có giá trị sức clients/assets/hoangan.jpg Như này, css cho giống thật hình mẫu vào ! Đồng thời bên phải là có các item xếp hàng thành dọc nhưng không thẳng thẳng hàng dọc nhau nha 2 item đầu và cuối thì lại nằm căn đều dọc nhau còn 2 item giữa thì lại thẳng cùng nhau đó bạn nha ! Mỗi item thì đều được background border 4 gốc và đồng thời bên trong có icons được tô background xanh lục và được bo tròn và bên phải là nội dung cho từng item đó gồm tiêu đề và phân mô tả ở dưới ! Tiếp tục phần cuối cùng rất quan trọng chính là phần đường cong lỏm từ trên xuống đường cong này lỏm về hướng bên phải bạn ha ! Đồng thời nó xoay từ trên xuống nghĩa là 90 độ tới -90 độ bạn ha! Và gần sát mép bên trái (tức gần sát mép màu background tròn bên trái) và ngoài ra các item bên phải phải đường kẻ nối từ các item đó tới đường cong lỏm tròn đó ! Và nối bằng đường đi nét đứt bạn ha ! Khi nối tới thì khi dính tại đường cong lỏm đó thì phải có phân đợt chấm to lên bạn ha ! Liệu css và thiết kế html và dùng jquery cho thật sự chuẩn xác vào ! 