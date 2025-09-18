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

Tại sao ta tăng width ds-head-shape thì nó đẩy cả phần tử .ds-hank đi là sao 

giá trị file svg của phần cuộn ../assets/hank.svg
giá trị file svg của phần bút chì là ../assets/pencil.svg
giá trị file svg của phần đuôi dây là ../assets/tail.svg
giá trị file svg của phnà đầu dây là ../assets/head.svg
bây giờ tao muốn rằng thiết kế cho ta phần giao diện như hình mẫu này bằng html css js (jquery kiểu document ready viết theo dạng hàm và trigger), gồm các yêu cầu và gợi ý theo ý tưởng của ta mô tả về hình mẫu như này ha! hình mẫu chỉ có 4 phần và ta thì muốn 5 phần ! Và giao diện này đang trình bày về những kiến thức quan trọng mà các học viên sẽ được nhận trong từng giai đoạn học tập nhá! Lựa icons và nội dung mô tả phần tiêu đề cho hợp lý với phần yêu như sau:
1/ đầu tiên là phần bút chì ta cần nó phải nằm ở giữa (và nó là 1 dạng shape có giá trị là svg ../assets/pencil.svg) sau đó cho nó độ rộng và độ cao chính là theo div cha riêng chứa div mang giá trị của nó (nghĩa là có 1 div cha có sẵn giá trị độ rộng và độ cao) và sau đó bên trong là chứa 1 div khác mang dạng shape theo kiểu  css là giá trị file svg đó. chia như này là dùng cho cả việc khác nữa là phần đổ màu nền cho giá trị svg và màu bóng đổ của riêng cây bút chì này ha!, tiếp tục là phần đầu bút chì là phải 1 màu đậm rõ nét hơn phần màu bút chì bình thường (dùng lớp giả để tạo nên phần này, và phần này chính là tạo cảm giác cho người dùng nhìn như thể đó phần cục gôm tẩy của bút chì) và tương tự vậy phần cuối cùng của shape ../assets/pencil.svg này chính là đầu bút chì nên cho lớp màu đen theo đùa bút( bằng việc là dùng chính stroke để tô riêng phần cuối cùng nằm ở dưới cùng bút chì của nó, và có riêng bóng đổ màu sẫm bạc đen cho phần đầu bút chì này nữa)
2/tiếp theo là 5 phần  shape nằm bên trái nó cũng là cần 1 div chứa riêng nó và shape này có giá trị là ../assets/head.svg ha (và div này cũng cần có giá trị width và height ha )!. và chính cái phần shape này phải cũng phải có 1 div cha bọc nó lại, và div cha này phải có giá vị trí nằm sát khít vào phần div cha (chứa div của shape cây bút chì ở yêu cầu 1), tiếp tục phần div cha này bên trong nó phải chứa 1 div tiện css stroke (đường viền theo dạng shape ../assets/head.svg này) và 1 div thì dùng để chứa hình thù hình dạng của chính giá trị ../assets/head.svg này đồng thời 1 div khác chứa các giá trị nội dung, div chứa nội dung này phải gồm 2 phần! 1 là icons nằm bên trái và 1 div thì gồm tiêu đề và mô tả (2 phần con này nữa thì nên thẳng hàng dọc) và 2 cái này đều nằm về bên phải ! và div cha này phải được nằm vừa khít trong vùng hình dạng hình thù của thằn div đang mang giá trị svg ../assets/head.svg này ha! đồng thời dùng drop shadow để đổ bóng cho div mang dạng shape này ../assets/head.svg nhá. (lưu ý phần shape bên trái này là trong hình mẫu chỉ 4 cái tôi cần là tận 5 cái và 5 dạng shape đều như nhau đều là ../assets/head.svg, nhưng màu viền và màu bóng đổ của chúng phải là khác nhau như nha!)

3/ phần shape nằm ngay trên phần giao diện cây bút chì! phần này cũng vậy cũng là gồm 5 shape có hình thù như nhau giá trị file nó mang giá trị là ../assets/hank.svg nghĩa là nó tạo cảm giác cho người dùng là nó là 1 phần dọc được cuộn vào thanh bút chì!. thiết kế html css cái này cũng vậy bạn cũng cần có 1 div cha chứa riêng cái div của chính nó, div cha chứa nó là dùng để mà thiết lập được vị trí của shape này phải nằm trên phần element shape bút chì kia và 5 cái cái này cũng vậy cũng phải giãn cách trên và dưới ra nhằm mục đích để người dùng còn được thấy phần bút chì chứ mà trên và dưới mà dính khít nhau là sai ! và div chứa hình dạng shape này ../assets/hank.svg thì chỉ việc mang giá trị svg là ../assets/hank.svg và đồng thời css sao cho cái shape này phải được nằm lọt trên phần giao diện shape bút chì ha và nhớ cũng có 1 div để đổ bóng cho phần shape này nhá, ngoài ra phần shape này có độ width bằng vừa khít với phần width chính phần giao diện shape bút chì kia ha, Đồng thời shape này phiar nằm thẳng hàng ngang với shape nằm bên trái kia ha!, màu sắc 5 cái shape này cũng là màu sắc tương ứng với 5 cái shape bên trái kia (thẳng hàng với nhau thì cùng màu viền với nhau và cả màu bóng đổ với nhau)

4/cuối cùng là phần bên phải là cũng 1 dạng shape khác có giá trị ../assets/tail.svg đây là phần shape chính là đuôi của dây quấn vào bút chì! nghĩa là đầu tiên nó phải nằm bên phải và cũng phải thẳng hàng ngang với shape nằm trên giao diện shape bút chì (tức là shape có giá trị ../assets/hank.svg) và cả shape ../assets/head.svg và cũng có màu viền và màu bóng đổ tương tự như 2 shape cùng hàng với chính cái shape ../assets/tail.svg trong 1 hàng này ha! height nó cũng có độ bằng với độ height của 2 shape cùng thẳng với nó (để tạo cho người dùng cảm giác là 1 dây quấn đều về phần kích thước độ cao ha!) và width phải vừa khít với phần div chứa nội dung của riêng nó ! là lúc này phần shape gồm 1 div cha chứa toàn bộ và bên trong là 1 div để tiện css cho đường viền xung quanh cái shape và 1 div dùng để css ra dạng shape này ../assets/tail.svg và 1 div là chứa nội dung cho từng cái item shape này ha ! div cha thì nên có drop shadow dùng làm bóng đổ từng shape và tiếp tục phần div nội dung kia thì nó phải được css làm sao cho nội dung là được nằm vừa fit bên trong độ rộng của phần shape này ! nội dung là gồm bên trái là mũi tên icons chỉ về bên trái và bên phải là số thứ tự ha! 