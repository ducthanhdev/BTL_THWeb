<?php
include './connect.php';
$product_id = isset($_GET['sp']) ? (int) $_GET['sp'] : 0;
$query = "select * from Sua where id = $product_id";
$result = mysqli_query($conn, query: $query);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">
                <a href="index.php">Shop Sữa Trường Sơn</a>
            </div>
            <div class="flex space-x-4">
                <input type="text" class="p-2 rounded-lg" placeholder="Tìm kiếm sản phẩm...">
                <button class="bg-blue-800 p-2 rounded-lg">
                    <a href="admin/index.php">Đăng nhập</a>
                </button>
            </div>
        </div>
    </header>
    <div class="container mx-auto p-5">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <div class="border rounded overflow-hidden">
                        <img src="<?php echo htmlspecialchars($product['thumbnail']); ?>"
                            alt="<?php echo htmlspecialchars($product['title']); ?>" class="object-cover w-full h-96">
                    </div>
                </div>
                <div class="w-full md:w-1/2 md:pl-6">
                    <h1 class="text-3xl font-semibold text-gray-900 mb-4">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </h1>
                    <p class="text-2xl font-bold text-red-500 mb-4">$<?php echo number_format($product['price'], 2); ?>
                    </p>
                    <div class="flex items-center mb-4">
                        <p class="text-gray-600">Weight: <?php echo number_format($product['weight'], 2); ?> kg</p>
                        <?php if ($product['is_active']): ?>
                            <span class="ml-4 px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded">In
                                Stock</span>
                        <?php else: ?>
                            <span class="ml-4 px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded">Out of
                                Stock</span>
                        <?php endif; ?>
                    </div>
                    <div class="text-gray-700 mb-6">
                        <?php echo nl2br(htmlspecialchars($product['content'])); ?>
                    </div>
                    <button class="w-full py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-blue-600 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Shop Sữa Trường Sơn. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>