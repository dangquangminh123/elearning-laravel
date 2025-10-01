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

PROMPT (dán nguyên khối cho AI sinh code)

Hãy tạo giao diện web HTML + CSS + jQuery ($function) tái hiện đúng bố cục “Business Service Elements” như mockup.
Yêu cầu TUYỆT ĐỐI: chỉ dùng Flexbox (display:flex, flex-direction, flex-wrap, gap, align-items/justify-content). Không dùng CSS Grid,không được css vào body
mà thay vào đó cho 1 div chứa toàn bộ phần giao diện này rồi css vào div tổng đó và nhớ cách trên và dưới ra ha
1. Bố cục tổng

Trang chia làm 2 cột flex (.wrap):

Cột trái (.copy): tiêu đề phụ, tiêu đề chính, 2 đoạn lorem ipsum.

Cột phải (.visual): cụm “cây bong bóng” + giọt nước đỉnh + điện thoại + sợi dây.

2. Thành phần SVG

    Đỉnh trên: dùng dinh.svg (giọt nước trên cùng có bóng).

    8 bong bóng: dùng bong.svg.

    Các bong bóng bên phải thì để nguyên.

    Các bong bóng bên trái thì xoay gương ngang (CSS transform: scaleX(-1);).

    Điện thoại: đặt phone.svg ở dưới cùng, bên trái.

    Sợi dây: đặt day.svg nối từ điện thoại tới trục giữa bong bóng.

3. Cấu trúc bong bóng (quan trọng)

    .Div cha .leaf:

    Quy định độ rộng, độ cao, vị trí bằng flex.

    Thêm bóng đổ (box-shadow) dựa trên màu nền.

    Có class phân loại màu (.leaf--elearn, .leaf--bank …).

    Div con .leaf__shape:

    Chứa file bong.svg, ăn theo width/height cha.

    Nếu bong bóng ở bên trái thì CSS transform: scaleX(-1) để lật ngược.

    Div .leaf__content:

    Đặt icon + text nằm lọt bên trong bong bóng.

    Dùng position:absolute; inset:0; display:flex; align-items:center; padding-inline:20px; justify-content:flex-start|flex-end tùy hướng.

4. Nội dung trong bong bóng

.tree flex column, căn giữa.

Đỉnh .drop-top (dinh.svg).

4 hàng .row, mỗi .row flex với 2 bong bóng (.leaf--left và .leaf--right).

    Các bong bóng đối xứng trục giữa, không chồng chéo (dùng gap).

    Mỗi .leaf--left và .leaf--right (bong bóng) là 1 flex container:

    Bên trong gồm .leaf__icon (SVG icon nhỏ, ví dụ lấy lại bong.svg scaled nhỏ hoặc icon khác), và .leaf__label (text).

    Icon + text phải nằm lọt bên trong vùng bong bóng (dùng padding và align-items:center).

    8 nhãn text lần lượt:

    E-Learning

    Banking

    Ticket Online

    Insurance

    24h Service

    Cyber Service

    Stock Exchange

    Business

5. Màu sắc

Gán class riêng cho từng .leaf và tô màu nền theo mẫu:

.leaf--elearn #0D47A1

.leaf--bank #1976D2

.leaf--ticket #FB8C00

.leaf--insure #C62828

.leaf--24h #43A047

.leaf--cyber #F9A825

.leaf--stock #E53935

.leaf--biz #AD1457

Text trong bong bóng luôn màu trắng (#fff).

6. jQuery xử lý

Trong $(function(){...}):

Sinh 8 bong bóng .leaf tự động, gán label từ mảng text.

Nếu index là bong bóng bên trái, thêm class .leaf--left để CSS flip svg.

Đảm bảo .leaf__shape img auto fit vào div cha (width:100%; height:100%).

Hover .leaf: transform:scale(1.03); box-shadow:0 12px 28px rgba(0,0,0,.3).

7. Điện thoại & sợi dây
phone.svg (điện thoại) đặt bên trái dưới.

day.svg đặt position:absolute, nối từ điện thoại lên cụm bong bóng.

8. Responsive
≥1200px: 4 hàng × 2 bong bóng.

≤768px: chỉ hiển thị 1 cột bong bóng (ẩn trái hoặc phải).


maax width là 390px
max height 200px