-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: suaschool
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Sua`
--

DROP TABLE IF EXISTS `Sua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Sua` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `thumbnail` longtext,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sua`
--

LOCK TABLES `Sua` WRITE;
/*!40000 ALTER TABLE `Sua` DISABLE KEYS */;
INSERT INTO `Sua` VALUES (5,'Sữa tươi Australia’s OWN A2 nhập từ Úc thùng 24 hộp',500,14444,1,'https://file.hstatic.net/200000700229/article/1114510-15583224785381977809742-1_bf76d1d336f64efd8b2193a7678b41e9.jpg','✅Được chế biến 100% từ sữa bò nguyên chất, sữa tươi tiệt trùng nguyên kem Australia\'s Own có được hương vị thơm ngon, béo ngậy tự nhiên và nguồn dinh dưỡng tối ưu. Sản phẩm đặc biệt tốt cho trẻ đang độ tuổi phát triển hoặc những người gầy. Nếu đã thừa cân, bạn không nên sử dụng thường xuyên dòng sữa này để tránh dư thừa dinh dưỡng\r\n✅Australia’s Own là thương hiệu sữa nổi tiếng đến từ Úc, được nhiều người ưa chuộng bởi các dòng sữa dinh dưỡng tốt cho sức khỏe người dùng. Đây là nhãn hàng danh tiếng thuộc tập đoàn Freedom Food Group nổi tiếng của đất nước này. Với hệ thống phân phối toàn cầu, không khó để bạn bắt gặp các sản phẩm mang tên thương hiệu này trên kệ của các cửa hàng tiện lợi hay siêu thị lớn ở nhiều quốc gia trên thế giới. Tại Việt Nam, Australia’s Own luôn nằm trong top những loại sữa nhập khẩu được người tiêu dùng yêu thích nhất.\r\n✅Với sự phong phú và đa dạng của các dòng sản phẩm, Australia\'s Own cũng sử dụng những nguồn nguyên liệu khác nhau. Trong đó tất cả đều được kiểm soát chặt chẽ từ khâu chọn lựa, nuôi trồng, thu hoạch cho đến khi tạo ra sản phẩm cuối cùng. Nhờ vậy những đánh giá sữa Australia\'s Own về nguyên liệu hay thành phần đều đạt được kết quả tích cực.\r\n\r\n✅Đối với sữa động vật, nguồn nguyên liệu chính là sữa tươi được vắt trực tiếp từ những con bò trong trang trại thuộc sở hữu của hãng. Chúng được chọn lựa kỹ lưỡng về giống và nuôi tại môi trường lý tưởng về dinh dưỡng, khí hậu, cách chăm sóc. Kết hợp với quy trình sản xuất hiện đại, được kiểm định chặt chẽ và bảo quản khoa học, sữa không chỉ thơm ngon về hương vị mà còn có giá trị cao về dinh dưỡng\r\n✅Với các thành phần phong phú và tốt cho sức khỏe, uống sữa tươi sạch mỗi ngày là cách giúp cả gia đình bổ sung thêm canxi, vitamin D, protein, vitamin và hàng loạt khoáng chất cần thiết cho cơ thể. Tùy từng dòng sản phẩm mà thích hợp với mỗi đối tượng cụ thể, từ trẻ em cho tới người cao tuổi.');
/*!40000 ALTER TABLE `Sua` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'truongsondev','truongson2003');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-08 15:54:58
