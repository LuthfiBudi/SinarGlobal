-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 02:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(3, 'admin1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(16, 'admin2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pesanan Tertunda'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(47, 10, 'Adventsen', '131321', 'advent12@gmail.com', 'Bank Transfer', 'Simpang Selayang, Medan, Sumatera Utara, Indonesia - 12313, Langsung Kirim Min', 'Rexus X8 Xierra Macro Gaming (Rp132.000 x 1)', 132000, '2025-12-08', 'Pesanan Dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`) VALUES
(16, 'Oppo Find X7 Ultra', '📱 Layar AMOLED LTPO 6,8 inci beresolusi 2K dengan refresh rate adaptif hingga 120Hz, menghadirkan visual yang tajam dan halus.\r\n⚡ Chipset MediaTek Dimensity 9300 memberikan performa terbaik untuk gaming dan multitasking.\r\n📸 Kamera Utama 108 MP dengan teknologi Ultra-Clear Lens, didukung kamera periskop zoom optik hingga 10x.\r\n🔋 Baterai 5000mAh dengan pengisian cepat 100W SuperVOOC, hanya butuh 20 menit untuk terisi penuh.\r\n🌟 Desain Premium dengan bodi ultra-tipis dan kaca berlapis matte.', 18999999, 'OPPO Find X7 Ultra pricing.jpg', 'OPPO Find X7 Ultra.jpg', 'OPPO Find X7.jpg', 'smartphone'),
(17, 'Acer Nitro 5', '💻 Layar 15,6 inci FHD IPS dengan refresh rate hingga 144Hz, memberikan visual halus dan jernih, ideal untuk gaming dan multimedia.\r\n⚡ Prosesor Intel Core i7 Generasi ke-13 atau AMD Ryzen 7, mendukung performa tinggi untuk multitasking dan gaming intensif.\r\n🎮 Kartu Grafis NVIDIA GeForce RTX 4060 dengan teknologi ray tracing untuk pengalaman gaming yang imersif.\r\n🔋 Baterai Tahan Lama dengan daya hingga 8 jam, didukung pengisian cepat.\r\n❄️ Sistem Pendingin CoolBoost untuk menjaga suhu tetap optimal', 16999999, 'Screenshot 2024-11-25 122041.png', 'Screenshot 2024-11-25 122053.png', 'Screenshot 2024-11-25 122124.png', 'laptop'),
(18, 'MacBook Pro M1', '💻 Layar Retina 13,3 inci dengan True Tone, menghasilkan warna akurat dan detail tajam, ideal untuk pekerjaan kreatif dan hiburan.\r\n⚡ Chip Apple M1 dengan CPU 8-core dan GPU 8-core, menawarkan performa luar biasa, efisiensi daya, dan kecepatan yang mengesankan.\r\n🎥 Kamera 720p FaceTime HD dengan kualitas video lebih jernih, ditambah mikrofon kualitas studio untuk percakapan lebih jelas.\r\n🔋 Baterai Tahan Lama hingga 20 jam penggunaan video pemutaran, memberikan daya tahan lebih lama sepanjang hari.', 21999999, 'Screenshot 2024-11-25 1230562.png', '2.jpg', 'Screenshot 2024-11-25 123124.png', 'laptop'),
(20, 'Asus ROG Strix G16', '💻 Layar 16 inci QHD+ Nebula Display dengan refresh rate 240Hz dan respon 3ms, menghadirkan visual tajam, halus, dan warna akurat.\r\n⚡ Prosesor Intel Core i9 Generasi ke-13 atau AMD Ryzen 9, dirancang untuk performa gaming dan multitasking terbaik.\r\n🎮 Kartu Grafis NVIDIA GeForce RTX 4070 dengan DLSS 3 untuk pengalaman gaming dan rendering grafis maksimal.\r\n🔋 Baterai 90Wh dengan pengisian cepat hingga 50% dalam 30 menit, cocok untuk gaming saat bepergian.\r\n❄️ Sistem Pendingin ROG Intelligent Coolin', 25999000, '1.jpg', '2.png', '3.png', 'laptop'),
(21, 'Garmin Forerunner 165', '⌚ Layar AMOLED 1,2 inci dengan resolusi tinggi, mendukung Always-On Display untuk kemudahan membaca.\r\n🏃‍♂️ Pelacakan Aktivitas Lengkap termasuk lari, berenang, bersepeda, dan latihan kekuatan, dilengkapi metrik canggih seperti VO2 Max dan Recovery Advisor.\r\n🌍 GPS Presisi Tinggi memastikan akurasi jalur dan jarak yang lebih baik untuk olahraga luar ruangan.\r\n🔋 Baterai Tahan Lama hingga 14 hari dalam mode smartwatch dan 20 jam dalam mode GPS aktif.\r\n💧 Tahan Air 5 ATM,cocok digunakan untuk berenang', 4999999, '1 - Copy.png', '2.png', '3.png', 'Jam Tangan'),
(22, 'Itel ISW 001', '⌚ Layar Sentuh 1,7 inci beresolusi tinggi dengan desain bezel tipis, memberikan tampilan modern dan elegan.\r\n💓 Pemantauan Kesehatan 24/7, termasuk detak jantung, kadar oksigen darah (SpO2), dan pelacakan tidur.\r\n🏃‍♂️ Mode Olahraga Multi-Fungsi, mendukung hingga 10 jenis aktivitas seperti lari, bersepeda, dan yoga.\r\n🔋 Baterai Tahan Lama, mampu bertahan hingga 10 hari dalam sekali pengisian daya.\r\n💧 Tahan Cipratan Air (IP68), aman digunakan dalam kondisi hujan atau saat berolahraga.', 799000, 'itel ISW 011.png', 'Screenshot 2024-11-25 121559.png', 'Screenshot 2024-11-25 121621.png', 'Jam Tangan'),
(23, 'Xiaomi S1 Active', '⌚ Layar AMOLED 1,43 inci dengan resolusi tinggi dan mode Always-On Display, memberikan tampilan cerah dan jernih di berbagai kondisi cahaya.\r\n🏋️ 117 Mode Olahraga, termasuk pelacakan aktivitas seperti lari, berenang, bersepeda, dan latihan intensitas tinggi.\r\n💓 Fitur Kesehatan Lengkap, seperti pemantauan detak jantung, SpO2 (kadar oksigen darah), dan pelacakan tidur otomatis.\r\n🔋 Baterai Tahan Lama hingga 12 hari dalam mode normal dan 24 hari dalam mode hemat daya.\r\n🌍 GPS Dengan Presisi Tinggi.', 2499000, 'Screenshot_2024-11-25_121008-removebg-preview.png', 'Screenshot_2024-11-25_121028-removebg-preview.png', 'Xiami_smarth_watch_s1_active-removebg-preview.png', 'Jam Tangan'),
(24, 'Kulkas Merek LG', '❄️ Kapasitas 170 Liter, ideal untuk ruang kecil atau penggunaan sehari-hari, memberikan penyimpanan yang efisien untuk kebutuhan keluarga.\r\n🌿 Teknologi Inverter Linear Compressor yang hemat energi, mengurangi konsumsi daya sekaligus menjaga kestabilan suhu di dalam kulkas.\r\n🔄 Sistem Pendinginan Even Cooling memastikan suhu yang merata untuk menjaga kesegaran makanan lebih lama.\r\n🍉 Rak Kaca Tempered yang kuat, tahan lama, dan mudah dibersihkan, menawarkan ruang penyimpanan yang fleksibel.', 2499000, 'kulkas-2-pintu-lg-inverter-202l-gn-b202sqib-2.jpg', 'kulkas-2-pintu-lg-inverter-202l-gn-b202sqib-3.jpg', 'kulkas-2-pintu-lg-inverter-202l-gn-b202sqib-5 - Copy.jpg', 'kulkas'),
(25, 'Polytron Kulkas 2 Pintu 320L', '❄️ Kapasitas 320 Liter yang luas, ideal untuk menyimpan berbagai kebutuhan makanan dan minuman keluarga.\r\n🌿 Teknologi Low Energy yang hemat energi, membantu mengurangi konsumsi listrik dan menjaga tagihan lebih terjangkau.\r\n🔄 Sistem Pendinginan Multi Air Flow memastikan suhu di seluruh ruang kulkas tetap merata, menjaga kesegaran makanan lebih lama.\r\n🍉 Rak Kaca Tempered yang kuat dan tahan lama, memberikan ruang penyimpanan yang fleksibel untuk berbagai jenis makanan.', 3799000, 'PRS-451-Y-FRONT-FILLED-CONTENT-REV-2-768x683.jpg', 'PRS-451-Y-FRONT-PERS-300x300.jpg', 'PRS-451-Y-PERS-1-768x683.jpg', 'kulkas'),
(26, 'Kulkas Sharp', '❄️ Kapasitas 330 Liter yang cukup luas untuk menyimpan berbagai bahan makanan dan minuman keluarga.\r\n🌿 Teknologi Plasmacluster Ion yang membantu menjaga kesegaran dan mengurangi bau tidak sedap dalam kulkas.\r\n🔄 Sistem Pendinginan Hybrid Cooling memastikan suhu dalam kulkas lebih stabil dan menjaga kualitas makanan lebih lama.\r\n🍉 Rak Kaca Tempered yang kuat dan tahan lama, menawarkan fleksibilitas untuk menyusun barang dengan rapi.\r\n🧊 Fasilitas Pembuat Es Otomatis untuk kenyamanan Anda.', 4399000, 'Screenshot 2024-11-25 125651 - Copy - Copy.png', 'SHARP - KULKAS 2 PINTU SMALL (172L) - SJ-197ND-VP2 - Copy - Copy - Copy.png', 'Screenshot 2024-11-25 125707 - Copy.png', 'kulkas'),
(27, 'Lenovo Gaming LQQ', '💻 Layar 15,6 inci Full HD IPS dengan refresh rate 165Hz, menghadirkan visual tajam dan gerakan halus untuk pengalaman gaming yang imersif.\r\n⚡ Prosesor Intel Core i7 Generasi ke-12 atau AMD Ryzen 7, memberikan kinerja optimal untuk bermain game dan bekerja dengan lancar.\r\n🎮 Kartu Grafis NVIDIA GeForce RTX 3060 dengan Ray Tracing dan DLSS, memungkinkan pengalaman visual yang luar biasa dan realistik.\r\n🔋 Baterai 80Wh yang mendukung penggunaan panjang, ideal untuk gaming atau bekerja tanpa khawatir.', 15999000, '1212.jpg', 'Screenshot 2024-11-25 122627.png', 'Screenshot 2024-11-25 122642.png', 'laptop'),
(28, 'MSI Raider GE67', '💻 Layar 15,6 inci QHD+ OLED dengan refresh rate 240Hz dan waktu respons 3ms, memberikan pengalaman visual yang luar biasa dengan warna dan kontras tajam.\r\n⚡ Prosesor Intel Core i9 Generasi ke-13 dan NVIDIA GeForce RTX 4080, menghadirkan performa gaming dan konten kreatif yang tak tertandingi.\r\n🎮 Kartu Grafis NVIDIA GeForce RTX 4080 dengan Ray Tracing dan DLSS 3, memberikan grafis yang sangat realistis dan performa maksimal.\r\n🔋 Baterai 99.9Wh dengan daya tahan lama, mendukung pengisian cepat.', 29999000, 'MSI Raider GE67 Core i9 12900HX.jpg', 'Screenshot_2024-11-25_123501-removebg-preview.png', 'Screenshot_2024-11-25_123433-removebg-preview.png', 'laptop'),
(29, 'iPhone 15 Pro Max', '📱 Layar Super Retina XDR dengan teknologi LTPO OLED, resolusi 2796 x 1290, dan refresh rate ProMotion 120Hz untuk tampilan yang sangat halus.\r\n⚡ Performa Kencang berkat chip A17 Pro 3nm, dirancang untuk gaming kelas konsol dan multitasking super cepat.\r\n📸 Kamera Utama 48 MP dengan sistem tetrapixel, zoom optik hingga 5x, serta peningkatan low-light untuk foto dan video yang lebih tajam.\r\n🔋 Baterai Tahan Lama dengan efisiensi tinggi, penggunaan hingga seharian penuh dan dukungan fast charging.', 17999999, 'ip putih.png', 'iPhone 15 Prommax Black Titanium.jpg', 'iPhone 15 Prommax Blue Titanium.jpg', 'smartphone'),
(30, 'Samsung Galaxy S24 Ultra', '📱 Layar Dynamic AMOLED 2X dengan resolusi QHD+ dan refresh rate adaptif hingga 120Hz untuk tampilan super halus.\r\n⚡ Performa Cepat berkat Exynos 2400 atau Snapdragon 8 Gen 3, dirancang untuk multitasking dan gaming tanpa lag.\r\n📸 Kamera Utama 200 MP dengan kemampuan zoom hingga 100x Space Zoom untuk hasil foto dan video luar biasa.\r\n🔋 Baterai Tahan Lama 5000mAh dengan pengisian cepat 45W, bertahan hingga 24 jam penggunaan aktif.\r\n🌊 Tahan Air dan Debu dengan sertifikasi IP68.', 18999999, 'Samsung Galaxy S24 Ultra Titanium.jpg', 'Galaxy S24 Ultra.jpg', 'Galaxy S24 Ultra Violet.jpg', 'smartphone'),
(31, 'Vivo V40', '📱 Layar AMOLED 6,67 inci beresolusi FHD+ dengan refresh rate 120Hz, memberikan pengalaman visual yang halus dan tajam.\r\n⚡ Chipset MediaTek Dimensity 8200 untuk performa cepat dan efisiensi daya optimal.\r\n📸 Kamera Utama 64 MP dengan fitur Night Mode, didukung kamera ultrawide dan makro untuk fotografi serbaguna.\r\n🔋 Baterai 4600mAh dengan pengisian cepat 66W, terisi penuh hanya dalam 30 menit.\r\n🎵 Audio Hi-Res untuk pengalaman suara berkualitas tinggi saat mendengarkan musik atau menonton film.', 6999999, 'Screenshot 2024-11-25 111834.png', 'Screenshot 2024-11-25 111822.png', 'VIVO V40.png', 'smartphone'),
(32, 'Xiaomi 14T', '📱 Layar AMOLED 6,67 inci dengan resolusi 1.5K, mendukung refresh rate hingga 144Hz untuk tampilan yang super mulus.\r\n⚡ Chipset Snapdragon 7s Gen 2 memberikan performa tinggi dengan efisiensi daya optimal.\r\n📸 Kamera Utama 108 MP dengan teknologi OIS (Optical Image Stabilization) dan kamera ultrawide 8 MP untuk hasil foto yang profesional.\r\n🔋 Baterai 5000mAh dengan pengisian cepat HyperCharge 120W, hanya 19 menit untuk terisi penuh.\r\n🎨 Desain Premium dengan kaca anti gores dan frame metalik.', 10999999, 'xiaomi_14t_pro_gray_01.jpg', 'xiaomi_14t_black_1.jpg', 'images.jpg', 'smartphone'),
(33, 'Canon EOS R100', '📷 Kamera Mirrorless Entry-Level yang ringkas dengan sensor APS-C 24.2MP.\r\n🎥 Perekaman Video 4K dan HD 120p, ideal untuk vlogging dan konten kreator pemula.\r\n📶 Bluetooth dan Wi-Fi untuk remote control dan berbagi foto instan.', 8999000, 'Canon EOS R100 - 1.png', 'Canon EOS R100 - 2.webp', 'Canon EOS R100 - 3.webp', 'camera'),
(34, 'Sony Alpha A7 IV', '📸 Kamera Mirrorless Full-Frame dengan sensor 33MP dan kemampuan video 4K 60p.\r\n💡 Stabilisasi Gambar 5-axis dalam bodi, mengurangi guncangan saat memotret atau merekam.\r\n🌐 Konektivitas Wi-Fi untuk transfer gambar cepat ke smartphone.', 39999000, 'Sony Alpha A7 IV - 2.jpg', 'Sony Alpha A7 IV - 1.jpg', 'Sony Alpha A7 IV - 3.jpeg', 'camera'),
(35, 'IPhone 15 ', '🏝️ Dynamic Island menampilkan notifikasi dan aktivitas langsung secara interaktif di bagian atas layar.\r\n📸 Kamera Utama 48MP dengan resolusi super tinggi untuk foto yang detail dan tajam.\r\n🚀 Chip A16 Bionic performa kencang untuk multitasking berat dan efisiensi baterai seharian.', 11999999, 'iPhone 15 - 1.webp', 'iPhone 15 - 3.webp', 'iPhone 15 - 2.webp', 'smartphone'),
(36, 'LG Kulkas 2 Pintu GN-B202SQIB', '🌡️ Multi Air Flow sirkulasi udara dingin dari berbagai arah memastikan pendinginan cepat dan merata.\r\n🥦 Moist Balance Crisper menjaga tingkat kelembapan optimal agar sayur dan buah tetap segar.\r\n🏋️ Rak Tempered Glass kuat menahan beban berat hingga 150kg.', 4199999, 'LG Kulkas 2 Pintu GN-B202SQIB - 1.jpg', 'LG Kulkas 2 Pintu GN-B202SQIB - 2.jpg', 'LG Kulkas 2 Pintu GN-B202SQIB - 3.jpg', 'kulkas'),
(37, 'Samsung Kulkas 2 Pintu RT19', '❄️ All-Around Cooling mendinginkan setiap sudut kulkas secara merata untuk menjaga kesegaran makanan.\r\n🔌 Digital Inverter bekerja lebih efisien, senyap, dan hemat energi serta tahan lama.\r\n🧊 Big Guard rak pintu yang lebih dalam untuk menampung botol minuman besar.', 3999000, 'Samsung Kulkas 2 Pintu RT19 - 1.webp', 'Samsung Kulkas 2 Pintu RT19 - 2.webp', 'Samsung Kulkas 2 Pintu RT19 - 3.webp', 'kulkas'),
(38, 'Asus TUF Gaming F15', '🎮 GPU NVIDIA RTX 3050 grafis bertenaga untuk menjalankan game modern dengan lancar.\r\n🌪️ Self-Cleaning Cooling sistem pendingin yang membuang debu agar laptop tetap dingin dan awet.\r\n⌨️ Keyboard Backlit RGB dirancang khusus untuk gaming dengan ketahanan tombol tingkat tinggi.', 12499999, 'Asus TUF Gaming F15 - 3.webp', 'Asus TUF Gaming F15 - 1.jpg', 'Asus TUF Gaming F15 - 2.webp', 'laptop'),
(39, 'MacBook Air M2 (13 Inch)', '⚡ Chip Apple M2 memberikan performa CPU dan GPU yang sangat cepat namun tetap hemat daya.\r\n🖥️ Layar Liquid Retina tampilan cerah dan kaya warna, ideal untuk desain grafis dan menonton film.\r\n🔋 Baterai 18 Jam daya tahan baterai luar biasa untuk penggunaan seharian tanpa perlu charger.', 14999000, 'MacBook Air M2 (13 Inch) - 1.jpg', 'MacBook Air M2 (13 Inch) - 3.jpg', 'MacBook Air M2 (13 Inch) - 2.jpg', 'laptop'),
(40, 'LG Top Loading Smart Inverter', '⚡ Smart Inverter Motor meminimalisir suara bising dan getaran serta menghemat konsumsi listrik.\r\n🌀 TurboDrum semprotan air kuat dan putaran drum berlawanan arah untuk hasil cuci yang lebih bersih.\r\n📱 Smart Diagnosis mendeteksi masalah pada mesin cuci melalui aplikasi smartphone tanpa perlu memanggil teknisi.', 4399000, 'LG Top Loading Smart Inverter - 3.jpg', 'LG Top Loading Smart Inverter - 2.jpg', 'LG Top Loading Smart Inverter - 1.jpg', 'Mesin Cuci'),
(41, 'Samsung Front Load AI Ecobubble', '🧼 EcoBubble Technology mengubah deterjen menjadi busa mikro yang menembus kain lebih cepat untuk membersihkan kotoran.\r\n🤖 AI Control memepelajari kebiasaan mencuci Anda dan menyarankan siklus yang paling sesuai.\r\n💨 Hygiene Steam menggunakan uap panas untuk membunuh 99.9% bakteri dan alergen pada pakaian.', 6899000, 'Samsung Front Load AI Ecobubble - 1.jpg', 'Samsung Front Load AI Ecobubble - 2.jpg', 'Samsung Front Load AI Ecobubble - 3.jpg', 'Mesin Cuci'),
(42, 'Logitech MX Master 3S', '🖱️ Sensor 8K DPI yang presisi, dapat bekerja di permukaan kaca sekalipun.\r\n🤫 Quiet Click mengurangi kebisingan klik hingga 90% sehingga tidak mengganggu orang sekitar.\r\n⚙️ MagSpeed Scroll Wheel roda scroll elektromagnetik yang sangat cepat dan hening.', 1689000, 'Logitech MX Master 3S - 1.jpg', 'Logitech MX Master 3S - 2.jpg', 'Logitech MX Master 3S - 3.jpg', 'mouse'),
(43, 'Razer DeathAdder V3 Pro', '🎮 Desain Ultra-Ringan hanya 63g, dirancang khusus untuk kenyamanan ergonomis atlet esports.\r\n⚡ Razer HyperSpeed Wireless koneksi nirkabel ultra-cepat dengan latensi rendah.\r\n🎯 Sensor Optik Focus Pro 30K memberikan akurasi pelacakan terbaik di kelasnya.', 2499000, 'Razer DeathAdder V3 Pro - 3.webp', 'Razer DeathAdder V3 Pro - 2.webp', 'Razer DeathAdder V3 Pro - 1.webp', 'mouse'),
(44, 'LG OLED Evo C3 42 Inch', '⚫ Teknologi OLED EVO memberikan warna hitam pekat dan kontras tak terbatas untuk pengalaman sinematik.\r\n⚡ Prosesor AI α9 Gen6 memaksimalkan kualitas gambar dan suara secara otomatis.\r\n🎮 Optimizer Game & 120Hz sangat cocok untuk gaming dengan respons cepat dan dukungan G-Sync.', 16999000, 'LG OLED Evo C3 42 Inch - 2.webp', 'LG OLED Evo C3 42 Inch - 3.webp', 'LG OLED Evo C3 42 Inch - 1.webp', 'televisi'),
(45, 'Samsung Crystal UHD 4K', '📺 Crystal Processor 4K yang meningkatkan warna dan kontras untuk tampilan gambar yang tajam dan hidup.\r\n🎨 Dynamic Crystal Color menghadirkan variasi warna yang realistis agar setiap detail terlihat jelas.\r\n🏠 Smart Hub Tizen memudahkan akses ke berbagai aplikasi streaming seperti Netflix dan YouTube dalam satu tempat.', 6499000, 'Samsung Crystal UHD 4K (CU8000) - 1.jpeg', 'Samsung Crystal UHD 4K (CU8000) - 2.jpeg', 'Samsung Crystal UHD 4K (CU8000) - 3.jpeg', 'televisi'),
(46, 'Xiaomi TV A Pro 75 2026', '📺 Layar QLED 4K UHD dengan resolusi 3840×2160, menampilkan warna sangat kaya (DCI-P3 94%) dan kedalaman warna hingga 1,07 miliar, cocok untuk gambar tajam dan hidup.\r\n🎨 Gamut warna luas + HDR10+ / Filmmaker Mode & MEMC 4K membuat kontras lebih nyata dan detail gambar optimal — ideal untuk film, serial, maupun streaming.\r\n🏠 Google TV + Google Assistant + dukungan Casting & AirPlay memudahkan akses ke Netflix, YouTube, Prime Video, dan aplikasi streaming lain langsung dari TV.', 11999000, 'download 112.jpg', 'download 212.jpg', 'download 312.jpg', 'televisi'),
(47, 'Steelseries Aerox 5 Wireless', '🖱️ Ultra-lightweight hanya 74 gram, ringan banget untuk gerakan cepat dan presisi saat main game.\r\n🎯 Sensor TrueMove Air dengan sensitivitas hingga 18.000 CPI untuk tracking super akurat di FPS maupun MOBA.\r\n⚙️ 9 tombol custom termasuk side-buttons untuk akses makro dan action yang lebih cepat.\r\n🔋 Baterai tahan lama hingga 180 jam (Bluetooth) dan 80 jam (2.4 GHz) + fast charging.\r\n📡 Dual Wireless 2.4 GHz & Bluetooth 5.0, stabil dan low-latency.', 1470000, 'download 11111.jpg', '11.jpg', '1212.jpg', 'mouse'),
(49, 'LG 24 kg Front Loading Mesin Cuci', '🧼 Fitur Steam™ + 6 Motion + AI DD — mencuci lebih higienis, kurangi alergen, dan perlakukan kain sesuai jenisnya untuk menjaga tekstur dan warna.\r\n⚙️ Inverter Direct Drive + TurboWash — motor efisien & kuat, cuci lebih cepat dan hemat tenaga, sekaligus tahan lama.\r\n📶 ThinQ Wi-Fi + kontrol pintar — bisa kontrol & pantau via aplikasi, download siklus cuci tambahan, fleksibel sesuai kebutuhan rumah tangga.', 13299000, 'download 2.jpg', 'download 3.jpg', 'download 4.jpg', 'Mesin Cuci'),
(50, 'Rexus X8 Xierra Macro Gaming', '🖱️ 7 tombol + fitur Macro — bisa atur fungsi tombol sesuai kebutuhan, cocok untuk gaming atau penggunaan PC sehari-hari.\r\n🎯 DPI 800–7200 — fleksibel, bisa disesuaikan untuk game FPS, MOBA, atau tugas biasa.\r\n💡 LED RGB — memberi tampilan keren pada setup gaming kamu.\r\n🎮 Sensor Instant A704F + polling 125 Hz — responsif untuk game ringan sampai menengah.', 132000, 'download MOUSE 2.jpg', 'download MOUSE 3.jpg', 'download MOUSE.jpg', 'mouse'),
(51, 'Sony FDR-AX43 UHD 4K Handycam', '📹 Rekam video dengan kualitas 4K UHD — cocok buat kamu yang ingin hasil video jernih dan detail, ideal untuk vlog, dokumenter, atau kenangan keluarga.\r\n🎥 Sensor dan lensa dirancang untuk menghasilkan image stabil & warna natural, sehingga hasil rekaman tetap halus bahkan saat merekam sambil bergerak.\r\n🔊 Built-in mikrofon + fitur audio otomatis — menangkap suara dengan jernih tanpa harus pakai mic eksternal, cocok untuk kebutuhan sehari-hari atau travel.', 6999000, '313131.jpg', '3113.jpg', '111231.jpg', 'camera');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(10, 'Adventsen', 'advent12@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
