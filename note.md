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


1 mã giảm giá có thể dùng cho rất nhiều khoá, và 1 khoá chỉ được sử dụng duy nhất 1 mã,
và tiếp tục 1 mã có thể cho nhiều học viên, và mọi học viên đều có thể có các mã giảm giá đó

1 coupon chỉ là 1 coupon duy nhất không được trùng nhau về mã code 
1/ nếu discount_type là percent thì lúc này phải validate discount_value total_condition rằng
discount_value có giá trị 0 tới 5 thì total_condition nhỏ hơn 200 000
discount_value có giá trị 5 tới 10 thì total_condition phải là. từ  200 000 tới 499000
discount_value có giá trị 10 tới 12 thì total_condition nhỏ hơn 500 000 tới 999 000
discount_value có giá trị 12 tới 15 thì total_condition nhỏ hơn 1000 000 tới 1999000
discount_value có giá trị 15 tới 20 thì total_condition nhỏ hơn 2 000 000 tới 4999 000
discount_value có giá trị 20 tới 30 thì total_condition lớn hơn 5 000 000
và discount_value nhỏ hơn 30 

trường hợp thứ 2 rằng nếu discount_type là value thì lúc này validate discount_value total_condition phải được validate rằng

discount_value có giá trị 90 000 150000 thì total_condition nhỏ hơn 800 000
discount_value có giá trị 160000 đến 360000 thì total_condition từ  800 000 tới 1400000
discount_value có giá trị 370000 đến 500000 thì total_condition từ 1499000 tới 1999000
discount_value có giá trị 500 000 đến 699000 thì total_condition nhỏ hơn 2000000 tới 2 999 000
discount_value có giá trị 799 000  thì total_condition lớn hơn 3 000 000
 ngoài ra validate rằng giá trị start_date phải nhỏ hơn giá trị end_date ít nhất là 2 ngày

Bây giờ tôi đang thực hiện tính năng là xoá huỷ bỏ 1 coupon
đầu tiên phải kiểm tra rằng là coupon đang muốn xoá có tồn tại trong các bảng order hay không ?nếu coupon này đã có ở trong vài bảng  orders thì buộc phải
kiểm tra tiếp các order_id đó có status_id true không ? nếu order_id kia có status_id là true rồi thì không được xoá coupon này, trả về thông báo rằng
"coupon này đã được sử dụng cho đơn hàng đã hoàn thành, không xoá được" ! còn khi status_id của các order_id đang là false thì lúc này bắt đầu xoá ở 
bảng orders_detail chứa các order_id đó trước ! Xoá xong bảng orders_detail thì tiếp tục xoá hết các order_id đang chứa coupon cần xoá kia trong bảng orders. Sau khi xong ở các bảng orders_detail và orders thì tiếp tục mới bắt đầu tiếp ở CouponsRepository rằng kiểm tra coupon đang cần xoá đã có ở trong bảng coupons_usage, coupons_students, coupons_courses hay không ? Nếu có thì bắt đầu xoá hết  coupon_id đó tại 3 bảng coupons_usage, coupons_students, coupons_courses này rồi sau đó cuối cùng thì xoá ở bảng coupon này bạn nha ! xong xuôi thì trả về thông báo là Xóa mã giảm giá thành công! Lưu ý việc kiểm tra coupon đang cần xoá và xoá ở các bảng order và orders_detail thì nên thực hiện tạo 1 hàm trong OrdersRepository bạn nha !