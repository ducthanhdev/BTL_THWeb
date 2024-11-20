<?php
include "../../connect.php";

function paginate($itemsPerPage, $currentPage, $table)
{
    global $conn;
    $totalItemsQuery = "SELECT COUNT(*) FROM $table";
    $result = $conn->query($totalItemsQuery);
    $totalItems = $result->fetch_row()[0];
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Tính vị trí bắt đầu cho truy vấn SQL
    $startPosition = ($currentPage - 1) * $itemsPerPage;

    // Truy vấn SQL lấy dữ liệu với LIMIT và OFFSET
    $sql = "SELECT * FROM $table LIMIT $itemsPerPage OFFSET $startPosition";
    $result = $conn->query($sql);

    // Kiểm tra và hiển thị kết quả
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr class="row_data_customer <?= ($i % 2 != 0) ? 'bg-[#fcddbc] text-[#333] rounded-lg text-[#fff]' : '' ?>">
                <td class="py-2 px-4 border text-center" data-name="Id">
                    <?php echo $row["Id"] ?>
                </td>
                <td focus="true" data-name="FullName" class="py-2 px-4 border text-center">
                    <?php echo $row["FullName"] ?>
                </td>
                <td data-name="Address" class="px-4 py-2 border text-center ">
                    <?php echo $row["Address"] ?>
                </td>
                <td data-name="PhoneNumber" class="py-2 px-4 border text-center">
                    <?php echo $row["PhoneNumber"] ?>
                </td>
                <td data-name="Gender" class="py-2 px-4 border text-center">
                    <p class="opacity-0 h-[0px]"><?php echo $row["Gender"] ?></p>
                    <?php if ($row["Gender"] == '0'): ?>
                        <img class="block mx-auto w-[50px] h-[50px] object-cover"
                            src="https://cdn-icons-png.flaticon.com/512/6833/6833591.png" alt="">
                    <?php else: ?>
                        <img class="block mx-auto w-[50px] h-[50px] object-cover"
                            src="https://cdn-icons-png.flaticon.com/512/1724/1724930.png" alt="">
                    <?php endif; ?>
                </td>
                <td class="py-2 px-4 border text-center">
                    <div class="flex gap-2 items-center">
                        <button
                            class="btn_update text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg></button>
                        <form action="deleteKhachHang.php" method="POST" id="deleteForm">
                            <input type="hidden" value="<?php echo $row["Id"] ?>" name="Id" data-name="Id">
                            <button type="submit" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4
                                            focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                                            dark:focus:ring-yellow-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php
            $i++;
        }

    } else {
        echo "<p class='text-gray-500'>Không có sản phẩm nào.</p>";
    }

}



function paginateBtnNavigate($itemsPerPage, $currentPage, $table)
{
    global $conn;
    $totalItemsQuery = "SELECT COUNT(*) FROM $table";
    $result = $conn->query($totalItemsQuery);
    $totalItems = $result->fetch_row()[0];
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Tính vị trí bắt đầu cho truy vấn SQL
    $startPosition = ($currentPage - 1) * $itemsPerPage;

    // Truy vấn SQL lấy dữ liệu với LIMIT và OFFSET
    $sql = "SELECT * FROM $table LIMIT $itemsPerPage OFFSET $startPosition";
    $result = $conn->query($sql);


    echo "<div class='flex justify-center mt-6'>";
    echo "<ul class='flex space-x-2'>";

    // Quay về (nếu không phải trang đầu tiên)
    if ($currentPage > 1) {
        echo "<li><a href='dashboard.php?route=listKhachHang.php&page=" . ($currentPage - 1) . "' class='px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600'>Quay về</a></li>";
    } else {
        echo "<li><span class='px-4 py-2 bg-gray-300 text-gray-500 rounded-md'>Quay về</span></li>";
    }

    // Hiển thị các số trang
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<li><span class='px-4 py-2 bg-blue-500 text-white rounded-md'>$i</span></li>";
        } else {
            echo "<li><a href='dashboard.php?route=listKhachHang.php&page=$i' class='px-4 py-2 bg-white text-blue-500 rounded-md hover:bg-gray-100'>$i</a></li>";
        }
    }

    // Tiếp tục (nếu không phải trang cuối cùng)
    if ($currentPage < $totalPages) {
        echo "<li><a href='dashboard.php?route=listKhachHang.php&page=" . ($currentPage + 1) . "' class='px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600'>Tiếp tục</a></li>";
    } else {
        echo "<li><span class='px-4 py-2 bg-gray-300 text-gray-500 rounded-md'>Tiếp tục</span></li>";
    }

    echo "</ul>";
    echo "</div>";
}
?>