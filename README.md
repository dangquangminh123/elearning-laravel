ý tưởng dự án là tính chất đặc trưng mà dự án trung tâm chúng tôi giảng dạy manglại cho học viên
Tôi có 4 SVG đặt cùng thư mục:
- bong.svg        → bóng đèn (hiển thị bên trái).
- thanhsoc.svg    → THANH SỌC CHÍNH (ribbon chính, sắc nét) là nền chứa số + caption.
- socmo.svg       → MẢNH NỐI, dùng cho cả “đầu nối bên trái” (.head-left) và “đuôi nối dưới-bên phải” (.tail-right).
- thanhngang.svg  → THANH NGANG PHỤ, nối liền phía bên phải của thanh chính, tạo kéo dài (.bar-extend).

👉 Mục tiêu: Sinh ra **index.html, styles.css, app.js (jQuery)** với bố cục và hiệu ứng y hình mẫu (ảnh Powerpoint ideas).

---

## 1. Bố cục (layout)
- Nền trang: `#f3f3f3`.
- Căn giữa khối chính: max-width ~1200px, dùng **flex** (không grid, không float).
- 2 cột:
  - Trái: bóng đèn (`bong.svg`).
  - Phải: `<ul class="steps">` chứa 4 `<li class="step">` xếp dọc.

---

## 2. Cấu trúc HTML mỗi step
Mỗi `<li class="step">` có dạng:

```html
<li class="step">
  <div class="head-left">
    <img src="socmo.svg" alt="" />
  </div>
  <div class="bar">
    <span class="step-no">01</span>
    <div class="step-text">
      <h3 class="step-title">Caption 1</h3>
      <p class="step-desc">This is an editable slide with all your needs</p>
    </div>
    <img class="bar-extend" src="thanhngang.svg" alt="" />
  </div>
  <div class="tail-right">
    <img src="socmo.svg" alt="" />
  </div>
</li>

3. Màu sắc

Áp dụng đồng nhất cho .bar, .bar-extend, .tail-right của từng step:

Step 1: #0E8F57 (xanh lá)

Step 2: #8F2334 (đỏ rượu)

Step 3: #2C3E50 (xanh navy)

Step 4: #C06B06 (cam)

Text mặc định: chữ trắng (#fff), có thể thêm gradient khi hover.
4. Quy tắc che phủ (Occlusion)

Head-left:

Step #1: hiển thị rõ ràng.

Step #2: bị bar của #1 che một phần bên trái.

Step #3: bị bar của #2 che.

Step #4: bị bar của #3 che.

Tail-right:

Step #1: bị bar của #2 che một phần.

Step #2: bị bar của #3 che.

Step #3: bị bar của #4 che.

Step #4: hiển thị đầy đủ (không bị che).

Bar-extend: luôn nối liền mạch với .bar, dài khoảng 1/3–1/2 chiều bar.

Z-index:

bar #1 = 40, bar #2 = 30, bar #3 = 20, bar #4 = 10.

head-left và tail-right mỗi step nằm dưới bar của step ngay sau.

Nội dung text (.step-title, .step-desc, .step-no) luôn có z-index cao nhất, không bị shape che.

5. Typography

Tiêu đề trang: <h1>Powerpoint ideas</h1> – Arial, 28px, bold, căn trái.

Trong bar:

.step-no: font bold, 18–20px, canh trái, có letter-spacing nhẹ.

.step-title: bold 16–18px, màu trắng hoặc gradient.

.step-desc: font 13–14px, màu trắng nhạt.

6. Kích thước & căn chỉnh

Step cao ~78–82px, cách nhau 18–22px.

Head-left: thò ra trái 8–12px.

Bar-extend: dài thêm 35–50% so với bar.

Tail-right: lệch phải + xuống 8–12px.

Nội dung text: padding-left ~70px (để nhường chỗ số)

---

7. Hiệu ứng hover

Hover .step: thêm class .active.

Khi active:

bar, bar-extend, tail-right sáng hơn (brightness +15%).

Thêm drop-shadow rõ hơn (shadow lớn hơn, blur hơn).

step-title và step-desc đổi màu gradient (linear-gradient, text-shadow sáng).

Nội dung text không bị che bởi shape.

---

## 8. Data API + jQuery

HTML đã chứa sẵn số, caption, desc → không để trong data-*.

Có thể thêm data-color để đổi màu shape.

jQuery trong $(function(){}):

Đọc data-color để set --step-color.

Set z-index cho từng step.

Hover: toggle .active.

Click: alert("Bạn đã click Step {no}").
---


## 9. Responsive

≤768px:

2 cột gộp thành 1 (bóng đèn trên, steps dưới).

Step cao ~64px, font giảm 1–2pt.

Vẫn giữ đúng occlusion head-left và tail-right.


## 10. Bàn giao
- File: index.html, styles.css, app.js.
- Không dùng framework ngoài jQuery.
- Code phải clean, semantic, có role/aria cho accessibility.

👉 Yêu cầu: Code sinh ra **giống hệt ảnh mẫu**, kể cả vị trí head-left bị che, bar-extend ăn khớp, tail-right thò đúng chỗ, drop-shadow mềm mại, màu sắc chuẩn hex.


Công thức rút ra (cho mọi shape):

Khung cha (wrap) có width/height đúng shape.

Layer dưới cùng: path/svg fill gradient, stroke.

Layer trung: viền/stroke hoặc glow (pseudo).

Layer trên cùng: content (icon/text) → gradient chữ, không mask.

Drop-shadow ở wrap để bóng theo shape.

Hover:

đổi gradient fill,

đổi shadow (màu + cường độ),

text đổi gradient hoặc sáng hơn,

có thể scale/translate để nổi khối.

JS link: hover shape A → đồng thời bật class ở shape B.