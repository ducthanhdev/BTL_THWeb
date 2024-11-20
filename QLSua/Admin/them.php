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

<body class="bg-gray-100 py-12 flex justify-center items-center px-4 flex-col">
    <div class='h-[100vh]'>
        <div class="w-full bg-white p-8 rounded-lg shadow-lg h-full">
            <h2 class="text-2xl font-bold text-center mb-6">Thêm Sản Phẩm - Quản Lý Sữa</h2>
            <form method="POST" action="">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Tên Sản Phẩm
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="title" name="title" placeholder="Nhập tên sản phẩm... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                            Nhập Đường Dẫn Hình Ảnh
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="url" id="thumbnail" name="thumbnail" placeholder="Nhập hình ảnh... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="weight">
                            Nhập Trọng Lượng Sản Phẩm
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="weight" id="weight" name="weight" placeholder=" Nhập Trọng Lượng Sản Phẩm... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                            Nhập Đơn Giá Cho Sản Phẩm
                        </label>
                        <input
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="price" name="price" placeholder="Nhập Đơn Giá Sản Phẩm... ">
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                            Trạng Thái
                        </label>
                        <select
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            id="status" name="is_active">
                            <option>--- Chọ Trạng Thái ---</option>
                            <option value="true">Hiển Thị</option>
                            <option value="false">Ẩn</option>

                        </select>
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                            Mô Tả Sản Phẩm
                        </label>
                        <textarea required minlength="4"
                            class="w-full px-3 min-h-[300px] py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="content" name="content" placeholder="Nhập Mô tả sản phẩm... "></textarea>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center gap-6 justify-center max-w-[30%] ml-auto">
                        <button
                            class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                            type="submit">
                            Thêm
                        </button>
                        <button
                            class="w-full bg-yellow-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                            type="reset">
                            Clear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include '../connect.php';
    if (!empty($_POST)) {
        try {
            $sql = "INSERT INTO Sua (title, thumbnail, weight, price, content, is_active) VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            // Get POST data
            $title = $_POST["title"];
            $thumbnail = $_POST["thumbnail"];
            $weight = $_POST["weight"];
            $price = $_POST["price"];
            $content = $_POST["content"];
            $is_active = ($_POST["is_active"] == "true") ? 1 : 0;

            // Bind parameters
            $stmt->bind_param("ssddsi", $title, $thumbnail, $weight, $price, $content, $is_active);

            if ($stmt->execute()) {
                ?>
                <script>
                    Swal.fire({
                        title: "Chúc Mừng",
                        text: "Bạn đã thêm thành công sản phẩm!",
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href;
                        }
                    });
                </script>
                <?php
            } else {
                echo "Error: " . $stmt->error;
            }
        } catch (\Throwable $th) {
            ?>
            <script>
                Swal.fire({
                    title: "Có Lỗi",
                    text: "Đã xảy ra lỗi khi thêm sản phẩm vui lòng thử lại!",
                    icon: "info",
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = window.location.href;
                    }
                });
            </script>
            <?php
        }
    }
    ?>
</body>

</html>