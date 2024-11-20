<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sữa Trường Sơn</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="">
    <div class="flex h-screen">
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold">Chào mừng đến với Dashboard</h1>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-full mr-4">
                    <span>Admin</span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tổng Sản Phẩm</h3>
                    <p class="text-2xl font-bold">150</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tổng Đơn Hàng</h3>
                    <p class="text-2xl font-bold">500</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tổng Doanh Thu</h3>
                    <p class="text-2xl font-bold">₫1,500,000</p>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div id="recent-activity" class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4">Hoạt Động Gần Đây</h3>
                <ul>
                    <li class="mb-4">
                        <span class="font-semibold">Đơn hàng #1023</span> - Đã được hoàn thành.
                        <span class="text-gray-500 text-sm">2 giờ trước</span>
                    </li>
                    <li class="mb-4">
                        <span class="font-semibold">Khách hàng #789</span> - Đã đăng ký.
                        <span class="text-gray-500 text-sm">5 giờ trước</span>
                    </li>
                    <li class="mb-4">
                        <span class="font-semibold">Sản phẩm #456</span> - Đã được thêm vào hệ thống.
                        <span class="text-gray-500 text-sm">1 ngày trước</span>
                    </li>
                </ul>
            </div>

            <!-- Footer -->
            <footer class="text-center text-gray-500 py-6">
                <p>&copy; 2024 Sữa Trường Sơn. All Rights Reserved.</p>
            </footer>
        </div>
    </div>

</body>

</html>