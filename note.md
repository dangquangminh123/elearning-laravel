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

4 biểu đồ half doughnut chart, padAngle tách biệt* với tỉ lệ lần lượt: 20%, 40%, 60%, 80%. 
Mỗi biểu đồ được *chia thành đúng 5 phần bằng nhau* (mỗi phần = 20%) tương ứng các mốc: 0, 20, 40, 60, 80 → full 100.

Yêu cầu chi tiết:
1) Hình dạng & layout
- Half donut: startAngle=180, endAngle=0 (nửa vòng trên).
- innerRadius≈60%, outerRadius≈90% (donut dày vừa).
- paddingAngle=4 (khoảng hở quan sát được).
- *cornerRadius=0* cho mọi lát.
- 4 biểu đồ render độc lập, sắp xếp dạng grid responsive (2 cột trên màn hình nhỏ, 4 cột trên desktop).

2) Chia lát theo mốc 20%
- Dữ liệu của MỖI biểu đồ là 5 lát có value bằng nhau (20,20,20,20,20) để tạo 5 “bậc”.
- Số lát được tô màu = ceil(clamp(percent,0,100) / 20). Ví dụ:
- 20% → 1 lát màu, 4 lát xám
- 40% → 2 lát màu, 3 lát xám
- 60% → 3 lát màu, 2 lát xám
- 80% → 4 lát màu, 1 lát xám
- 0% → 0 lát màu (tất cả xám)
- Các lát chưa đạt mốc dùng *xám nhạt* (#E5E7EB).

3) Quy tắc màu theo ngưỡng phần trăm
- ≤20%: *blue* (#3B82F6)
- >20% và ≤40%: *green* (#10B981)
- >40% và ≤60%: *orange* (#F59E0B)
- >80%: *red* (#EF4444)
- Lưu ý: *=80%* vẫn là *orange*.

4) Nhãn giữa & UX
- Hiển thị *nhãn giữa biểu đồ* (center label) dạng “{percent}%”.
- Tooltip cho từng lát; *không cần Legend*.

5) API component
- Tạo component tái sử dụng HalfDoughnutSteps:
props: 
   - percent: number (0–100, clamp nếu vượt)
   - title?: string
   - height?: number (mặc định 180)
- Tạo component FourHalfDoughnutsSteps gọi HalfDoughnutSteps cho 20, 40, 60, 80. Export default FourHalfDoughnutsSteps.

Sử dụng SVG: Tôi sẽ tạo một SVG cho mỗi biểu đồ. Các lát (path) của biểu đồ sẽ được vẽ bằng SVG, cho phép điều khiển chính xác startAngle, endAngle, padAngle, và cornerRadius như bạn yêu cầu.

Logic màu sắc: Tôi sẽ viết lại logic JavaScript để tính toán và áp dụng màu sắc (xanh lam, xanh lá, cam, đỏ) dựa trên ngưỡng phần trăm của từng biểu đồ.

Vòng tròn nét đứt: Vòng tròn nét đứt sẽ được vẽ độc lập bằng một path SVG khác, đảm bảo nó là một hình tròn hoàn chỉnh.

Nhãn phần trăm: Nhãn sẽ được đặt chính xác ở trung tâm của biểu đồ, có màu sắc đồng bộ với màu của biểu đồ.


