/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - dbtraveleis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbtraveleis` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `dbtraveleis`;

/*Table structure for table `biayalayanan` */

DROP TABLE IF EXISTS `biayalayanan`;

CREATE TABLE `biayalayanan` (
  `fakturlayanan` varchar(20) DEFAULT NULL,
  `biayalayanan` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `biayalayanan` */

LOCK TABLES `biayalayanan` WRITE;

insert  into `biayalayanan`(`fakturlayanan`,`biayalayanan`) values 
('TRK-1602230003',7000),
('TRK-1602230004',10000),
('TRK-1602230005',15000);

UNLOCK TABLES;

/*Table structure for table `jam` */

DROP TABLE IF EXISTS `jam`;

CREATE TABLE `jam` (
  `idjam` int(11) NOT NULL AUTO_INCREMENT,
  `idrutejam` int(11) DEFAULT NULL,
  `tgljam` date DEFAULT NULL,
  `namajam` varchar(50) DEFAULT NULL,
  `bangku` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idjam`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jam` */

LOCK TABLES `jam` WRITE;

insert  into `jam`(`idjam`,`idrutejam`,`tgljam`,`namajam`,`bangku`) values 
(2,1,'2023-02-16','08:00','7'),
(3,1,'2023-02-16','10:00','7'),
(4,1,'2023-02-16','12:00','7'),
(5,1,'2023-02-16','14:00','7'),
(6,1,'2023-02-16','16:00','7');

UNLOCK TABLES;

/*Table structure for table `paketw` */

DROP TABLE IF EXISTS `paketw`;

CREATE TABLE `paketw` (
  `idpaketwisata` int(11) NOT NULL AUTO_INCREMENT,
  `namapaket` varchar(20) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpaketwisata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `paketw` */

LOCK TABLES `paketw` WRITE;

UNLOCK TABLES;

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `usenamepelanggan` varchar(20) NOT NULL,
  `namapelanggan` varchar(50) DEFAULT NULL,
  `alamatpelannggan` varchar(50) DEFAULT NULL,
  `hppelanggan` varchar(50) DEFAULT NULL,
  `passwordpelanggan` varchar(50) DEFAULT NULL,
  `userlevelid` int(11) DEFAULT NULL,
  `poinpelanggan` int(11) DEFAULT NULL,
  PRIMARY KEY (`usenamepelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

LOCK TABLES `pelanggan` WRITE;

insert  into `pelanggan`(`usenamepelanggan`,`namapelanggan`,`alamatpelannggan`,`hppelanggan`,`passwordpelanggan`,`userlevelid`,`poinpelanggan`) values 
('baru123','Baru Sibaru','cupak','6283181755570','123',4,18000);

UNLOCK TABLES;

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `pengid` varchar(20) NOT NULL,
  `pengnama` varchar(50) DEFAULT NULL,
  `pengpass` varchar(200) DEFAULT NULL,
  `penglevel` int(1) DEFAULT NULL,
  PRIMARY KEY (`pengid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengguna` */

LOCK TABLES `pengguna` WRITE;

insert  into `pengguna`(`pengid`,`pengnama`,`pengpass`,`penglevel`) values 
('ADMIN','IQBAL','$2y$10$6Nyy8619FtmX9kqWsaidJOtqkg.5nG8BPB5bLpFsmX47pb6XaVoW.',1);

UNLOCK TABLES;

/*Table structure for table `pihaktravel` */

DROP TABLE IF EXISTS `pihaktravel`;

CREATE TABLE `pihaktravel` (
  `idpihaktravel` varchar(50) DEFAULT NULL,
  `idlevel` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `namapihaktravel` varchar(50) DEFAULT NULL,
  `alamatpihaktravel` varchar(50) DEFAULT NULL,
  `telppihaktravel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pihaktravel` */

LOCK TABLES `pihaktravel` WRITE;

insert  into `pihaktravel`(`idpihaktravel`,`idlevel`,`password`,`namapihaktravel`,`alamatpihaktravel`,`telppihaktravel`) values 
('iqbaltravel123',2,'123','IQBAL TRAVEL','SOLOK','6283181755570'),
('bukit123',2,'123','Bukittinggi Travel','bukittinggi','6283181755570');

UNLOCK TABLES;

/*Table structure for table `rute` */

DROP TABLE IF EXISTS `rute`;

CREATE TABLE `rute` (
  `idrute` bigint(20) NOT NULL AUTO_INCREMENT,
  `asal_tujuan` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlahpesanan` int(11) DEFAULT NULL,
  `idtravel` varchar(30) DEFAULT NULL,
  `totalpointulasan` double DEFAULT NULL,
  `jumlahulasan` int(11) DEFAULT NULL,
  `mobil` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idrute`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rute` */

LOCK TABLES `rute` WRITE;

insert  into `rute`(`idrute`,`asal_tujuan`,`harga`,`jumlahpesanan`,`idtravel`,`totalpointulasan`,`jumlahulasan`,`mobil`) values 
(1,'SOLOK - PADANG',30000,NULL,'iqbaltravel123',4,1,'AVANZA'),
(2,'PADANG - SOLOK',35000,2,'iqbaltravel123',NULL,0,'AVANZA'),
(3,'PADANG - PARIAMAN',50000,6,'iqbaltravel123',4,1,'AVANZA'),
(4,'PARIAMAN - PADANG',50000,NULL,'iqbaltravel123',NULL,0,'AVANZA'),
(5,'PADANG - PESSEL',50000,NULL,'iqbaltravel123',NULL,0,'AVANZA'),
(6,'BUKITTTINGGI - PADANG',70000,NULL,'bukit123',NULL,0,'Nissan Evalia'),
(7,'PADANG - BUKITTINGGI',75000,1,'bukit123',NULL,0,'Nissan Evalia');

UNLOCK TABLES;

/*Table structure for table `transaksitravel` */

DROP TABLE IF EXISTS `transaksitravel`;

CREATE TABLE `transaksitravel` (
  `faktur` varchar(20) NOT NULL,
  `tgl` date DEFAULT NULL,
  `idpelanggan` varchar(20) DEFAULT NULL,
  `idpaketw` varchar(20) DEFAULT NULL,
  `idrutetransakasi` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sisuang` int(11) DEFAULT NULL,
  `jumlahuang` int(11) DEFAULT NULL,
  `jam` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksitravel` */

LOCK TABLES `transaksitravel` WRITE;

insert  into `transaksitravel`(`faktur`,`tgl`,`idpelanggan`,`idpaketw`,`idrutetransakasi`,`status`,`total`,`sisuang`,`jumlahuang`,`jam`) values 
('TRK-1602230001','2023-02-16','baru123',NULL,1,'Pesanan Selesai',30000,20000,50000,NULL),
('TRK-1602230002','2023-02-16','baru123',NULL,2,'Pesanan Dibatalkan',20000,0,0,'10:00'),
('TRK-1602230003','2023-02-16','baru123',NULL,2,'Pesanan Dibatalkan',35000,0,0,'08:00'),
('TRK-1602230004','2023-02-16','baru123',NULL,3,'Pesanan Selesai',50000,0,0,'08:00'),
('TRK-1602230005','2023-02-16','baru123',NULL,7,'Pesanan Dikirim',75000,0,0,'10:00');

UNLOCK TABLES;

/*Table structure for table `ulasanrute` */

DROP TABLE IF EXISTS `ulasanrute`;

CREATE TABLE `ulasanrute` (
  `idrute` int(11) DEFAULT NULL,
  `ulasan` varchar(20) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `ulasanrute` */

LOCK TABLES `ulasanrute` WRITE;

insert  into `ulasanrute`(`idrute`,`ulasan`,`nama`,`nilai`) values 
(1,'bagus','Baru Sibaru',4),
(3,'bgasu','Baru Sibaru',4);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
