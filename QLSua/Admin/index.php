<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100">
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
            <div class="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full">
                <div
                    class="border border-gray-300 rounded-lg p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
                    <form class="space-y-4" method="POST">
                        <div class="mb-8">
                            <h3 class="text-gray-800 text-3xl font-extrabold">Sign in</h3>
                            <p class="text-gray-500 text-sm mt-4 leading-relaxed">Đăng nhập để quản lý sản phẩm của cửa
                                hàng Sữa Trường Sơn Dev</p>
                        </div>

                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">User name</label>
                            <div class="relative flex items-center">
                                <input name="username" type="text" required
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="Enter user name" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                    <path
                                        d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Password</label>
                            <div class="relative flex items-center">
                                <input name="password" type="password" required
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="Enter password" req />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-[18px] h-[18px] absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                                    <path
                                        d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                                    Nhớ mật khẩu
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="jajvascript:void(0);" class="text-blue-600 hover:underline font-semibold">
                                    Bạn quên mật khẩu?
                                </a>
                            </div>
                        </div>

                        <div class="!mt-8">
                            <button
                                class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Đăng Nhập
                            </button>
                        </div>

                        <p class="text-sm !mt-8 text-center text-gray-800">Nếu không có tài khoản! <a
                                href="javascript:void(0);"
                                class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Đăng ký tại
                                đây</a></p>
                    </form>
                </div>
                <div class="lg:h-[400px] md:h-[300px] max-md:mt-8">
                    <img src="https://readymadeui.com/login-image.webp"
                        class="w-full h-full max-md:w-4/5 mx-auto block object-cover" alt="Dining Experience" />
                </div>
            </div>
        </div>
    </div>
    <script>
        const code = window.location.search;
        if (code?.split("=") && code?.split("=").length > 0) {
            const codeSucc = code?.split("=")[1];
            if (codeSucc == "1") {
                Swal.fire({
                    title: "Thất Bại",
                    text: "Tài khoản của bạn không tồn tại trong hệ thống!",
                    icon: "info",
                    showConfirmButton: true,
                }).then(() => {
                    const url = new URL(window.location.href);
                    const param = 'code';
                    url.searchParams.delete(param);
                    window.history.pushState({}, document.title, url.toString());
                });
            }

            if (codeSucc == "2") {
                Swal.fire({
                    title: "Thất Bại",
                    text: "Xin lỗi mật khẩu của bạn nhập bị sai!",
                    icon: "info",
                    showConfirmButton: true,
                }).then(() => {
                    const url = new URL(window.location.href);
                    const param = 'code';
                    url.searchParams.delete(param);
                    window.history.pushState({}, document.title, url.toString());
                });
            }

            if (codeSucc == "0") {
                Swal.fire({
                    title: "Chúc Mừng",
                    text: "Bạn đã đăng nhập thành công!",
                    icon: "success",
                    showConfirmButton: true,
                }).then(() => {
                    window.location.href = "dashboard.php?code=200";
                });
            }

            if (codeSucc == "403") {
                Swal.fire({
                    title: "Cảnh báo",
                    text: "Bạn phải đăng nhập trước khi thao tác!",
                    icon: "success",
                    showConfirmButton: true,
                }).then(() => {
                    window.location.href = `index.php`;
                })
            }
        }
    </script>
</body>

</html>

<?php
session_start();

if (!empty($_SESSION['username'])) {
    ?>
    <script>
        window.location.href = "dashboard.php";
    </script>
    <?php
}

if (!empty($_POST)) {
    include "../connect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "select * from admin where username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows < 1) {
        ?>
        <script>
            window.location.href = `index.php?code=1`; 
        </script>
        <?php
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];

            ?>
            <script>
                window.location.href = `index.php?code=0`; 
            </script>
            <?php

        } else {
            ?>
            <script>
                window.location.href = `index.php?code=2`; 
            </script>
            <?php
        }
    }
}
?>