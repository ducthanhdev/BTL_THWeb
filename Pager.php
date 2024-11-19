<?php
class Pager {
    private $totalItems;
    private $itemsPerPage;
    private $currentPage;

    public function __construct($totalItems, $itemsPerPage = 5) {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    }

    public function getStartIndex() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getOffset() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getTotalPages() {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    public function displayPageNumbers() {
        $totalPages = $this->getTotalPages();
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $this->currentPage) {
                echo "<strong>$i</strong> ";
            } else {
                echo "<a href='?page=$i'>$i</a> ";
            }
        }
    }

    public function displayNavigation() {
        $totalPages = $this->getTotalPages();
        if ($this->currentPage > 1) {
            echo "<a href='?page=" . ($this->currentPage - 1) . "'>Quay về</a> ";
        }
        if ($this->currentPage < $totalPages) {
            echo "<a href='?page=" . ($this->currentPage + 1) . "'>Tiếp tục</a> ";
        }
    }


    public function renderLinks() {
        $totalPages = $this->getTotalPages();
        $output = "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $this->currentPage) {
                $output .= "<span class='current-page'>$i</span> ";
            } else {
                $output .= "<a href='?page=$i'>$i</a> ";
            }
        }
        $output .= "</div>";
        return $output;
    }
}
?>
