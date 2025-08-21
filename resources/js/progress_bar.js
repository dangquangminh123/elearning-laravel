// Cần phải nhúng thư viện jQuery trước khi chạy đoạn mã này
// Ví dụ: <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

$(function() {
    if ($('.progress-section').length) {
        
        // Hàm tính toán tọa độ từ góc và bán kính
        function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
            const angleInRadians = (angleInDegrees) * Math.PI / 180.0;
            return {
                x: centerX + (radius * Math.cos(angleInRadians)),
                y: centerY + (radius * Math.sin(angleInRadians))
            };
        }
        
        // Hàm tạo và vẽ biểu đồ bán nguyệt
        function createHalfDoughnutChart(item) {
            const $item = $(item);
            const targetPercent = parseInt($item.data('percent'));
            
            // Xác định màu sắc dựa trên ngưỡng phần trăm
            let color = '';
            if (targetPercent <= 20) {
                color = 'blue';
            } else if (targetPercent <= 40) {
                color = 'green';
            } else if (targetPercent <= 60) {
                color = 'orange';
            } else {
                color = 'red';
            }
            // Cập nhật thuộc tính data-color
            $item.data('color', color);
            
            const segmentsCount = 5;
            const innerRadius = 60; 
            const outerRadius = 90; 
            const padAngle = 4;
            const startAngle = -180;
            const endAngle = 0;
            const totalAngle = Math.abs(endAngle - startAngle);
            const anglePerSegment = totalAngle / segmentsCount;
            
            const $svg = $item.find('svg');
            const centerX = 100;
            const centerY = 100;
            
            $svg.empty();

            // 1. Vẽ vòng tròn nét đứt hoàn chỉnh
            const outerDashedCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            outerDashedCircle.setAttribute('cx', centerX);
            outerDashedCircle.setAttribute('cy', centerY);
            outerDashedCircle.setAttribute('r', 95); 
            outerDashedCircle.setAttribute('class', 'outer-dashed-circle');
            $svg.append(outerDashedCircle);

            // 2. Vẽ các lát của biểu đồ
            let currentAngle = startAngle;
            for (let i = 0; i < segmentsCount; i++) {
                const segment = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                
                const segmentStartAngle = currentAngle + anglePerSegment;
                const pathStartAngle = currentAngle + (padAngle / 2);
                const pathEndAngle = segmentStartAngle - (padAngle / 2);
                
                const startInner = polarToCartesian(centerX, centerY, innerRadius, pathStartAngle);
                const endInner = polarToCartesian(centerX, centerY, innerRadius, pathEndAngle);
                const startOuter = polarToCartesian(centerX, centerY, outerRadius, pathStartAngle);
                const endOuter = polarToCartesian(centerX, centerY, outerRadius, pathEndAngle);

                const pathData = `
                    M ${startOuter.x},${startOuter.y}
                    A ${outerRadius},${outerRadius} 0 0 1 ${endOuter.x},${endOuter.y}
                    L ${endInner.x},${endInner.y}
                    A ${innerRadius},${innerRadius} 0 0 0 ${startInner.x},${startInner.y}
                    Z
                `;
                
                segment.setAttribute('d', pathData);
                segment.setAttribute('class', 'chart-segment');
                segment.setAttribute('fill', 'var(--grey)'); // Ban đầu tô màu xám
                $svg.append(segment);
                
                currentAngle = segmentStartAngle;
            }

            // Gọi hàm animate để tô màu từ từ
            animateChart($item, targetPercent, color);
        }

        // Hàm animation
        function animateChart($item, targetPercent, color) {
            const segments = $item.find('.chart-segment');
            const segmentsFill = Math.ceil(targetPercent / 20);
            const percentLabel = $item.find('.percent');
            
            // Cài đặt nhãn phần trăm ban đầu
            let currentPercent = 0;
            percentLabel.text(currentPercent + '%');
            
            // Animation tô màu từng lát
            segments.each(function(index) {
                const $segment = $(this);
                if (index < segmentsFill) {
                    setTimeout(() => {
                        $segment.css('fill', `var(--${color})`);
                        // Cập nhật nhãn phần trăm
                        const newPercent = (index + 1) * 20;
                        percentLabel.text(newPercent + '%');
                        
                        // Nếu là lát cuối cùng, cập nhật đúng giá trị cuối
                        if (index === segmentsFill - 1) {
                             // Sử dụng jQuery.animate để tạo hiệu ứng đếm số
                             $({Counter: newPercent}).animate({Counter: targetPercent}, {
                                 duration: 500,
                                 easing: 'swing',
                                 step: function (now) {
                                     percentLabel.text(Math.ceil(now) + '%');
                                 }
                             });
                         }

                    }, 250 * index); // 250ms delay cho mỗi lát
                }
            });
        }

        // Kích hoạt animation khi cuộn
        $(window).on('scroll', function() {
            $('.stat-item').each(function() {
                const $this = $(this);
                if ($this.data('animated') !== true && ($(window).scrollTop() + $(window).height() >= $this.offset().top + $this.outerHeight() / 2)) {
                    $this.data('animated', true);
                    createHalfDoughnutChart(this);
                }
            });
        });

        // Kích hoạt animation khi tải trang
        $(window).trigger('scroll');
    }
});
