-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: repair
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.22.04.1

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
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Technology','technology','2025-07-27 08:59:49','2025-07-27 08:59:49'),(2,'Lifestyle','lifestyle','2025-07-27 08:59:49','2025-07-27 08:59:49'),(3,'Fashion','fashion','2025-07-27 08:59:49','2025-07-27 08:59:49'),(4,'Art','art','2025-07-27 08:59:49','2025-07-27 08:59:49'),(5,'Food','food','2025-07-27 08:59:49','2025-07-27 08:59:49'),(6,'Architecture','architecture','2025-07-27 08:59:49','2025-07-27 08:59:49'),(7,'Adventure','adventure','2025-07-27 08:59:49','2025-07-27 08:59:49');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_comments_blog_id_foreign` (`blog_id`),
  KEY `blog_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `blog_comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`),
  CONSTRAINT `blog_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `author_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`),
  KEY `blogs_category_id_foreign` (`category_id`),
  KEY `blogs_author_id_foreign` (`author_id`),
  CONSTRAINT `blogs_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (2,6,1,'Cumque assumenda illo nihil rerum dolore et et.','autem-adipisci-cumque-et-officiis-repellendus-est-tempora','Repudiandae corrupti natus et quae id iure. Porro at accusantium ullam qui recusandae beatae molestiae.','Optio id omnis aut omnis non incidunt exercitationem. Quisquam id consequatur et sunt.\n\nQuam repudiandae in eligendi sit illum iste rerum. Rerum corporis cum quod id. Sit excepturi qui porro maiores eos.\n\nVeritatis dolor ad aspernatur impedit. Itaque ea voluptate eum et. Aut similique officia quo.\n\nNecessitatibus corporis voluptatum qui. Laborum eligendi dolores quae quas soluta asperiores. Quidem quasi aut quibusdam cum et. Error excepturi sed ducimus non.\n\nAnimi voluptate eos non dolorem et officiis at. Alias enim praesentium id quia sapiente consequuntur. Qui laborum autem eum eum. Non quam aliquid amet qui est neque.\n\nAmet et quas iste aut dolores qui. Deleniti eligendi omnis aut rem aut id. Fugit voluptatem est earum adipisci ipsa. Exercitationem sed et perspiciatis eligendi.\n\nVoluptatem sed qui rem omnis. Omnis placeat quasi aspernatur autem pariatur sint. Vel beatae odit deserunt omnis iure cupiditate et.\n\nAtque quo laboriosam qui nulla deserunt aliquam. Id fuga molestiae optio dignissimos qui illo quis. Voluptates distinctio error consectetur nam placeat pariatur dolor. Eligendi alias ut officia hic. Soluta eos iure non adipisci.\n\nPossimus adipisci et porro quam non. Voluptatem voluptatem aut et officiis voluptatem consectetur. Minus quis minima magnam eos autem beatae. Suscipit fuga sint velit.\n\nEnim et cumque repellat et rerum qui. Ex iure aut repudiandae in a rem cum. Consectetur et alias ab et amet.','img/blog/main-blog/m-blog-5.jpg',1337,'2025-07-27 08:59:50','2025-07-29 17:23:26',NULL),(3,5,1,'Aliquam dolorem dolorem distinctio alias voluptatem.','esse-eveniet-in-harum-enim-dolores-veniam','Sequi placeat quis possimus aut. Qui placeat sit qui minima sit dolores debitis.','Animi qui eius ullam velit modi culpa. Facilis minima adipisci sed non. Quisquam fugiat at voluptates nihil laudantium. Libero excepturi quam et sint quia dicta.\n\nEt optio esse quos iste quo quo. Non dolores et aut assumenda molestiae. Quasi doloremque maxime quos porro blanditiis repellendus. Assumenda dolor enim perferendis.\n\nEnim culpa nobis provident laboriosam est rerum. Libero id est qui minima eius debitis. Placeat eum voluptas sit occaecati molestiae.\n\nQuo similique dicta eos ab vel sapiente. Tempora beatae et aliquid officia aut velit. Quasi ad quos doloribus mollitia eos necessitatibus error.\n\nDucimus facere expedita atque at vel et consequuntur. Libero provident dolores natus exercitationem. Qui doloremque et consectetur quaerat vel fugit mollitia.\n\nConsequatur fuga ex eaque necessitatibus enim ab ipsam. Inventore voluptatum corrupti vel nulla doloremque est. Quis sint fugit eveniet consequuntur dolor praesentium. Veritatis dicta temporibus laborum aut similique.\n\nDeserunt sed fuga laudantium voluptatem a sed veritatis. Ad perspiciatis aspernatur voluptate doloribus non est saepe. Reiciendis consequatur quam eaque debitis. Illum distinctio est ullam magni nulla.\n\nAut error molestiae facilis vitae. Eum dolor sunt aperiam hic aut repudiandae. Animi perspiciatis eum eius. Quo fugiat aliquid iste est. Et numquam neque minus.\n\nAliquam facilis velit praesentium quam sint. Nemo id molestiae beatae impedit illum dignissimos aut.\n\nMaiores impedit doloremque officia qui ut. Voluptatibus maiores quis voluptas ducimus hic eos suscipit. Sint vel qui similique et provident distinctio. Molestiae eaque rerum sed est tempore. Nam voluptate culpa maxime ut maxime officiis consequatur.','img/blog/main-blog/m-blog-1.jpg',2746,'2025-07-27 08:59:50','2025-07-29 17:23:26',NULL),(4,4,1,'Voluptatibus assumenda distinctio blanditiis labore eaque.','dolorum-ut-a-et','Dolore cumque sequi officiis quasi sed. Vel quaerat nisi iusto debitis. Et voluptatem velit quae unde.','Qui dolorem in sequi delectus. Aut voluptas dolor rerum sequi voluptate eius. Odit totam voluptate eius animi quaerat. Amet corrupti velit ut accusantium qui omnis quas.\n\nQuis non aspernatur et amet assumenda perspiciatis repudiandae quia. Quis rerum doloribus architecto nemo qui velit. Sequi eum facilis voluptatum ut autem omnis. Laboriosam dignissimos impedit odio aut molestiae.\n\nConsequatur atque adipisci facere molestiae. Sint incidunt molestias fugit autem beatae ut. Quo laboriosam nihil et.\n\nSit beatae ducimus velit eos. Sed error maxime odio ipsam. Error vel exercitationem eligendi reprehenderit eos facilis eligendi.\n\nRem aliquam ullam quia iste voluptatem dolores. Velit nesciunt nihil sed ullam. Occaecati aut est aperiam.\n\nId ratione aut rerum molestiae eum molestias error. Ex autem quia quibusdam error voluptatum ea ea. Enim aliquam porro voluptates ex pariatur fuga laborum.\n\nEt eum quis enim quo placeat. Nihil est sint qui rem sint.\n\nQuod illum quia modi sunt. Qui repudiandae nisi eligendi praesentium. Libero esse architecto explicabo odit.\n\nSequi dignissimos id consequatur dolor deleniti soluta. Natus nulla ea quaerat autem consequatur temporibus maxime. Nesciunt iste qui quo perferendis eligendi dolorem. Soluta et sit perferendis expedita.\n\nLaborum autem repellendus repellat qui occaecati. Porro ipsa explicabo minus. Recusandae aliquid ut velit architecto consequatur labore et.','img/blog/main-blog/m-blog-2.jpg',1221,'2025-07-27 08:59:50','2025-07-29 17:23:26',NULL),(5,2,1,'Perspiciatis excepturi numquam eos pariatur voluptas libero.','sint-necessitatibus-quibusdam-quaerat-accusamus-non-sint-quas-quidem','Vel libero pariatur perspiciatis deserunt quis laboriosam. Maxime est cupiditate voluptate nemo.','Tenetur et fugit ut rem aut qui sint. Doloribus quod iure id hic. Iure eos aut eaque vel soluta corrupti est.\n\nIpsa omnis animi numquam doloremque reprehenderit. Voluptatibus distinctio doloremque voluptatem consequuntur minus. Est fugit doloribus vero qui vitae a. Incidunt repellat est voluptatem pariatur.\n\nAt iste temporibus deleniti rem cumque. Animi sint consequatur ut quod eum qui et. Ad reiciendis tenetur non neque molestiae ex quia.\n\nMaiores unde rerum sit temporibus id. Blanditiis sed illum ut soluta fugiat. Illo minima illum sit quos odit non.\n\nConsequatur nihil vero ipsa itaque autem nisi. Eos delectus autem rem facilis rerum ipsa beatae.\n\nFugit inventore et illum assumenda eos ut. Voluptatibus non porro rem officiis aperiam. Voluptas optio expedita pariatur quae esse possimus corporis.\n\nNon eos quia dolorum ut quasi recusandae enim. Tempora consectetur illum consectetur exercitationem. Eligendi voluptates officiis quia.\n\nEst quia nisi ex ut. Esse doloribus consequuntur hic aut occaecati. Quam perferendis qui suscipit molestiae. Quos in minus et.\n\nEt ex deleniti fugiat et. Ullam rerum id ea voluptatum. Consequatur fugit et itaque aliquam beatae. Occaecati perspiciatis et officiis ut est aspernatur.\n\nMinus nulla id enim perspiciatis perferendis blanditiis. Id rem at et dolorem magnam sunt explicabo similique. Non illum consectetur sunt qui fugiat. Esse dolor ut consequuntur.','img/blog/main-blog/m-blog-5.jpg',421,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(6,6,1,'Sunt deleniti eveniet aperiam et quia tempore.','a-ipsum-unde-similique-iure-fugit-quis-ratione','Quis libero omnis architecto officiis aut repellendus. Aut non quod quasi et qui.','Sit sequi officiis quia iusto qui eos. Soluta voluptatibus facilis illum nostrum doloremque. Recusandae ut et quidem dolorum harum dolore.\n\nAutem temporibus unde quod libero. Quis sed omnis molestiae delectus dolor saepe. Harum earum quisquam cum perferendis aut. Aperiam quas quod dolorem.\n\nOfficia ipsa iure sequi ut corrupti. Ex incidunt est impedit ut corrupti. Aperiam nam deserunt praesentium pariatur amet quos dolores. Sequi qui est et odit eaque numquam et.\n\nEst praesentium nihil velit ea veniam incidunt distinctio. Saepe voluptatum rerum quaerat consequuntur nemo. Ipsa accusamus doloremque ut tenetur quis molestiae ipsam. Et in unde et aperiam velit iusto omnis sapiente.\n\nVeniam placeat ea vero aliquid asperiores vel. Quae architecto repudiandae recusandae id. Ab quo consectetur sint delectus quibusdam explicabo et. Nihil sint voluptas quis qui reprehenderit.\n\nConsequatur consequatur hic vel deserunt. Et nihil laudantium omnis error perferendis. In at aut praesentium ratione beatae praesentium mollitia. Odio veritatis voluptatibus omnis asperiores error.\n\nConsequatur vel rem similique dolores voluptas. Ipsam voluptate amet dolorum provident. Tempora eum facilis et error qui rerum.\n\nCorporis maiores qui soluta nesciunt. Voluptates enim dolorem velit vero laudantium quae.\n\nEa at quae quibusdam aliquam. Unde provident voluptatibus voluptas. Totam ea suscipit repudiandae ducimus doloremque non est. Odio excepturi quo dolore nam tenetur voluptas sunt.\n\nTenetur est blanditiis tempora corrupti illo possimus exercitationem repudiandae. Omnis nam tenetur sequi quis. Corporis ipsum impedit nisi quae delectus. Doloremque consequatur voluptatum molestias et.','img/blog/main-blog/m-blog-2.jpg',1725,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(7,7,1,'Numquam soluta modi dolores at ad dolores facilis.','consequatur-veritatis-voluptate-rerum-eveniet-nemo-pariatur','Optio beatae temporibus ea unde praesentium quam ut. Recusandae provident asperiores et vero. Officia enim perspiciatis numquam quibusdam atque.','Beatae saepe quo cupiditate est culpa tempora culpa. Veniam et in aut maxime quo nobis eveniet rerum. Nisi consequuntur laudantium aliquid non aut. Alias rerum veritatis rerum ipsa. Et omnis nihil ea aut.\n\nQuae enim ducimus totam. Unde omnis dolorem et. Voluptas rerum fugiat nostrum ut laboriosam dolores ut non.\n\nVoluptates in esse quisquam. Voluptas illo veniam et a placeat commodi. Ea rerum sequi nobis incidunt a. Ex inventore ab iusto quis excepturi est quaerat inventore.\n\nEt velit ab vel enim. Consequatur accusantium et sint est. Aut consequatur non quam eius ea. Explicabo ipsam vel accusantium praesentium.\n\nCommodi omnis sit vel iste et maiores. Odit error aut dolores et minus quaerat ipsam aperiam. Possimus sapiente commodi et aliquam in.\n\nQuae numquam reprehenderit ea provident animi. Reiciendis odio qui ut quia repellat quo. Quas totam adipisci architecto id sed iure soluta.\n\nVel quibusdam qui animi quia illo debitis qui. Dolor architecto voluptatem nostrum quae autem animi velit laboriosam. Nihil distinctio voluptatem ducimus in reprehenderit.\n\nVel ea hic enim iusto deleniti esse. Nulla perspiciatis autem minima a harum. Fuga voluptatem perspiciatis aperiam ex tempora ea vel. Voluptate quidem ut in autem voluptatem blanditiis id. Odio in maiores sint dolor iusto.\n\nQui eligendi sapiente quo debitis eaque aliquid. Rerum nostrum occaecati sed officiis. Eaque excepturi praesentium et. Sunt deleniti voluptatem ut debitis ad tempore et.\n\nTempore quia tempora enim labore. Ex voluptatem consequatur aut doloremque. Accusamus minus non quisquam quia saepe qui et. Sint animi quia excepturi enim ut aspernatur.','img/blog/main-blog/m-blog-2.jpg',4011,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(8,6,1,'Totam neque dolorem dolor ut eos et harum.','esse-non-laudantium-rerum-velit','Voluptatum dolor fugiat debitis rerum dolores eligendi aliquid. Et voluptatem sint beatae itaque aut minus. Omnis deserunt in vero amet aliquam.','Quo asperiores nihil dignissimos ut dolorum ea. Doloremque maiores atque quas molestias sequi. Illum illo officia rerum alias quis ullam a. Voluptate natus doloremque necessitatibus.\n\nEum laborum perferendis cumque natus dolor fugit minus a. Accusantium repudiandae laborum corporis eos. Voluptatem autem voluptatem reiciendis quis.\n\nVoluptate nihil sit odio numquam excepturi incidunt. Et soluta rerum asperiores libero. Optio magni sit delectus blanditiis aliquam qui.\n\nOfficia nobis id ullam dolorem eius ut neque. Accusamus laboriosam quidem repellendus modi. Ipsum illo beatae aliquid harum dolores.\n\nItaque ex consequatur laboriosam commodi. Cumque iure aut optio pariatur. Ipsam asperiores cupiditate magnam nemo. Autem explicabo labore quisquam magnam. Ut enim consectetur esse autem ipsam.\n\nMinima beatae dolorem qui. Deleniti sed non qui quos et repudiandae. Voluptas culpa voluptatem reprehenderit est.\n\nEt quis autem sed fuga. Nemo et aliquid dolorem. Totam ut corrupti non reprehenderit aut cum cupiditate.\n\nFacere voluptatem minus labore at et. Voluptatum ut illo est et quisquam dolorum. Sint ut deleniti dolorum voluptate. Quas et soluta maiores error reprehenderit molestias fuga.\n\nNeque numquam sunt architecto accusantium ut et repudiandae. Saepe minus ea vel facilis recusandae consequatur maiores quo. Rerum animi id doloremque repudiandae voluptates labore reprehenderit. Sed porro sunt et mollitia tempora.\n\nConsequuntur omnis eum quo aperiam. Voluptas dolores est impedit perspiciatis ab ex est.','img/blog/main-blog/m-blog-3.jpg',4940,'2025-07-27 08:59:50','2025-07-27 09:46:41',NULL),(9,3,1,'Sit exercitationem labore illum fugit.','qui-quos-sit-animi-harum-sit-cupiditate','Quam esse hic nisi. Debitis ipsam maiores labore. Quisquam iusto aliquam voluptatum nisi enim pariatur.','Vero voluptate qui vitae. Laboriosam repellat illum similique quas voluptates sint ullam consequatur. Doloribus incidunt quas sunt delectus et. Repellat error facere ut modi quia.\n\nVel enim eligendi illo. Sed incidunt laudantium sit. Non accusantium iste voluptas fugiat assumenda eveniet et.\n\nRerum numquam ipsam veniam nihil debitis. Consequatur velit ut ipsam reiciendis et. Optio molestiae dolorem est sit voluptatem vel.\n\nQui aut sit nihil et eveniet est nobis excepturi. Tempora quia maiores quo ducimus deleniti eligendi delectus et.\n\nSaepe sint earum qui quas nihil. Vitae possimus minima quis consequuntur. Et consectetur est asperiores sit ullam eveniet. Officia sint sit ipsum.\n\nEt ut laborum doloremque atque. Atque et incidunt voluptatem accusamus atque non. Eum porro consequatur voluptatem quidem consectetur ut dolor. Suscipit magni aut dolore soluta.\n\nQuod omnis eligendi eum nesciunt quae ut. Ea cupiditate dolor qui quibusdam ab dolore repellat.\n\nEa inventore pariatur rerum asperiores et inventore. Iure et culpa tenetur qui sit ut voluptas. Incidunt dolorum et vitae voluptates est nam ea.\n\nEst corporis hic non officiis ullam praesentium sint rerum. Consequatur temporibus illo beatae fugiat.\n\nDolore vero non et fugit. Explicabo impedit laboriosam necessitatibus ut. Ullam aliquam est omnis voluptatem quasi iure nihil.','img/blog/main-blog/m-blog-2.jpg',2423,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(10,1,1,'Voluptatem et numquam porro dolorem reiciendis beatae.','et-quo-ipsam-quaerat-ut-illo','Rerum quos sequi et ratione libero enim labore tempore. Dolor excepturi inventore dolor necessitatibus nihil.','Numquam aut sit qui iure. Consectetur dolores non tempora doloribus quae. Id autem accusantium sit. Voluptatum perspiciatis enim ducimus perspiciatis est ut ab. Rerum ea sunt amet.\n\nDebitis dolores nobis eaque ullam suscipit. Neque aut enim inventore tenetur nisi amet. Beatae rem quaerat omnis ipsa optio aut.\n\nOfficiis autem vitae sunt ut. Ea saepe eaque qui voluptatem eum vero soluta. Aut recusandae aut consequatur facere illo ut corporis.\n\nIncidunt quia sunt porro dolor. Non fuga occaecati non consequuntur aut temporibus. Est culpa aut eligendi qui. Enim inventore et corrupti nisi ducimus qui.\n\nEst id quisquam totam adipisci et cupiditate magni. Laudantium labore odio magnam est. Illo dolores repudiandae similique.\n\nAnimi voluptate porro quia omnis illum. Numquam ducimus non eaque commodi in. Qui explicabo rerum minima explicabo vitae voluptatem inventore.\n\nAtque facere voluptatem veritatis omnis facilis dicta. Officiis pariatur cum illo dolorum veritatis voluptates. Placeat autem repudiandae quibusdam sed ex ipsam. Et quidem quasi vel et est sequi.\n\nAut omnis et fugit. Alias pariatur asperiores nulla eos architecto fuga. Eum corrupti cum aut atque. Quod et a repudiandae illum. Minima eveniet consectetur ab labore soluta iure quod.\n\nUllam exercitationem quam nesciunt veritatis. Laudantium id aliquam perspiciatis. Fugit deleniti possimus ut hic blanditiis.\n\nNumquam est accusamus ratione excepturi occaecati expedita omnis. Rem fugit inventore ipsam officiis dolores quam amet est. Autem alias qui quae.','img/blog/main-blog/m-blog-5.jpg',915,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(11,3,1,'Alias ut aut laboriosam dignissimos fugit.','dolor-laborum-tempora-et-nobis','Saepe quo consequatur vero aut ducimus vel dicta. Quo iusto hic laborum quaerat quibusdam molestias repellat rem.','Temporibus necessitatibus ullam ducimus sit voluptas quia. Veniam eum non atque nostrum sunt. Qui eligendi et autem voluptatum nesciunt reiciendis est.\n\nUt et impedit et odio aperiam. Iure delectus esse ut vero commodi mollitia omnis. Tenetur iste est ipsa ab minima quasi ipsam. Molestias non praesentium et est id consectetur quod itaque.\n\nModi qui facilis perferendis. Similique pariatur et et qui. Quia sit ex quo sint. Aut aliquam dolorum dignissimos cumque neque.\n\nEt sed et qui sed placeat exercitationem explicabo. Illo earum debitis tenetur cupiditate est consequuntur. Est provident nihil eligendi sed quidem quaerat similique nulla.\n\nAccusamus quo et earum quo. Expedita perferendis nulla nulla minima at consequuntur. Aspernatur vel esse id. Accusamus repellat animi eos iusto nam qui tempora. Quasi qui aspernatur ratione optio rerum.\n\nOfficia molestiae dolores eius rerum. Possimus qui dignissimos repellat distinctio dolorem ea voluptatibus.\n\nAut incidunt voluptatem necessitatibus in. Quae ipsum iste esse vel. Veritatis consectetur culpa tempora quo nisi aut. Qui quas reprehenderit labore asperiores illo.\n\nConsequatur possimus maxime consectetur eos consequatur. Velit consequatur aliquam iste qui illum rerum voluptas. Quaerat cumque velit ut accusamus consequatur. Voluptates magnam debitis voluptatem molestias est eligendi. Quaerat totam nihil occaecati omnis at sit.\n\nVoluptate labore dignissimos est maiores repellendus et dolorem. Repellat officiis quo et aspernatur id repudiandae sunt. Perspiciatis at soluta et ea. Est aut qui commodi enim id.\n\nTempora molestias quia est dolorum iusto quaerat corporis qui. Aspernatur vero dolore accusamus impedit accusamus molestias et asperiores. Ipsa quia esse vel laborum veniam architecto. Sit error ut est eaque qui quos alias.','img/blog/main-blog/m-blog-1.jpg',1038,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(12,2,1,'Sunt possimus corporis animi id quo eligendi.','et-eum-culpa-aliquam','Dolor et nihil pariatur ad. Iste facere dolorem nobis sint voluptas libero doloribus. Itaque beatae voluptatem illo recusandae praesentium eum qui.','Est officiis voluptatem praesentium. Aliquid delectus maxime omnis nobis molestias voluptatem. Distinctio dolor et fugiat et quis sunt.\n\nVel illo dolor minima maiores consequatur eius voluptatem. Officia facilis corporis eveniet ipsam et nemo voluptas. Ea qui deleniti ut dolores deserunt iusto quia et. Officia velit omnis temporibus autem.\n\nQuasi voluptatibus doloremque repellat placeat sed. Doloremque quod reiciendis repellendus cupiditate iste. Quam doloremque et veniam.\n\nRerum quidem qui soluta quidem ipsum. Asperiores inventore ducimus laudantium voluptas voluptatem laudantium. Vel et vero labore iste beatae non porro at. Rerum voluptatibus dolore sunt quia.\n\nNecessitatibus qui aperiam aut saepe. Aut consectetur nam incidunt quaerat deserunt voluptas qui. Aperiam harum qui dolor error accusantium nihil.\n\nVoluptatem iste dolor reprehenderit nobis sit. Voluptates quis voluptatem enim doloribus itaque corporis enim. Nisi qui quaerat veritatis natus sit. Ut sit non ut neque quaerat iure ex.\n\nEst id laborum odio voluptatem deleniti molestiae veritatis. Ullam veniam sint impedit. Eius fugit eligendi consectetur molestiae numquam quod.\n\nRem et provident quisquam enim corporis accusamus. Quae atque aut laboriosam sit. Doloremque qui recusandae et laudantium itaque. Ipsam cum laboriosam quia ipsa est.\n\nUnde blanditiis sapiente quia molestiae dolor consectetur aut. Delectus modi quia velit totam. Earum doloribus ipsam numquam nemo ut quo eum voluptatem. Voluptatem voluptatem et sed id.\n\nLabore et vero sed. Eum doloribus non deserunt molestias.','img/blog/main-blog/m-blog-4.jpg',1939,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(13,2,1,'Atque aperiam assumenda id.','aut-quidem-non-adipisci-est-ut-deserunt-ratione','Consequatur voluptate itaque nulla voluptatem. Earum assumenda voluptate ut labore impedit temporibus. Quia rerum tempora ut.','Sint aut libero praesentium sunt quia aut magnam. Qui non tempore illo omnis voluptas. Blanditiis error cum voluptatem incidunt qui enim. In saepe atque architecto culpa eveniet fugit.\n\nAsperiores quidem dolorem minima. Corrupti modi dolorem ullam omnis minima. Unde aut mollitia modi quis quidem.\n\nLabore necessitatibus consequatur eum. Velit iusto quos qui mollitia numquam officia sit. Consequuntur soluta aliquam et. Sunt reprehenderit voluptas consequatur culpa.\n\nEum beatae consectetur et. Et voluptatem a dolorum ipsa. Est dolore quo pariatur.\n\nOmnis explicabo recusandae saepe. Ut sequi voluptatibus perferendis sed non aliquid. Explicabo nihil saepe optio officia neque delectus similique explicabo.\n\nVoluptates et sunt fugiat fugiat aut voluptates non. Cupiditate sint nemo est numquam et et ea. Quae qui dolorem officiis et at. Voluptate enim accusamus ea id.\n\nEst sit et doloribus dolores. Odio numquam dolor quia quaerat non repellendus et. Tempora assumenda quasi nisi. Doloribus ut sequi sed.\n\nOfficiis aliquam harum dolores. Voluptatem ut dolore provident saepe. Dolore corporis quas vero voluptatem. Iusto at eaque iste accusamus.\n\nFugit placeat quam architecto cupiditate sed exercitationem doloribus. Fugiat similique natus ea iste. Explicabo aut est facere. Voluptatem similique autem autem repellat recusandae.\n\nUt accusamus et maiores aut dicta animi beatae. Placeat et consequatur quia est suscipit et. Quam ut pariatur voluptas earum amet voluptas.','img/blog/main-blog/m-blog-4.jpg',3501,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(14,3,1,'Culpa adipisci sunt debitis dolor quas beatae eius expedita.','provident-porro-veritatis-praesentium-consequatur','Non nisi optio placeat in aut placeat culpa. Accusantium doloribus aut odit nihil ut voluptas. Perspiciatis provident dolorem veritatis dolorum.','Rerum ab voluptatibus necessitatibus illum accusantium. Impedit in quidem voluptatem deleniti consequuntur. Odio reiciendis voluptas qui est eius odio saepe. Odio quidem corporis et quis necessitatibus.\n\nAperiam accusamus quos ratione aperiam accusamus doloremque dignissimos. Aut tenetur ab quia autem. Aliquam est pariatur porro soluta dolor. Odio natus id debitis accusamus deserunt in tempore. Iusto et ipsam eveniet et.\n\nOfficia placeat architecto voluptas laboriosam omnis modi. Praesentium consequatur et ea veritatis reiciendis magni voluptatem unde. Fugit maiores quis quia.\n\nEt corporis ipsum dolorem nemo aut est. Non delectus aut consequatur corporis praesentium harum. Qui dolor est dolores voluptatem quia amet ullam.\n\nVoluptates excepturi dolor non quia quo soluta omnis. Beatae error voluptatem voluptas totam veritatis numquam rerum. Qui voluptatem provident quo eum natus. Explicabo explicabo occaecati sit.\n\nIste cumque commodi amet ut laudantium blanditiis consequuntur velit. Voluptatem deleniti a aspernatur ea dolore reprehenderit asperiores. Possimus veritatis qui eveniet molestiae. Cum vitae ducimus dicta odit totam expedita eius fugiat.\n\nPerferendis unde sunt in et. Aut molestias ea error vel recusandae ut.\n\nArchitecto in sint quas accusamus. Aliquid odit sed aut nihil velit qui aperiam ut. Quo sed quod commodi adipisci et ut quia. Veritatis facilis autem ut porro dolor vero omnis.\n\nAsperiores a omnis corporis voluptate natus natus. Et dolores laborum sit. Facere et qui ut iste ut voluptatum.\n\nPlaceat quis voluptas dolorem id distinctio. Et deserunt ad sit voluptatum. Sit ea tempore tenetur quam voluptatem autem officiis.','img/blog/main-blog/m-blog-4.jpg',4655,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(15,7,1,'Voluptatum ut exercitationem natus repellendus dolores placeat.','cum-est-magni-sint-sint-corporis-sint-at','Quam modi maxime iure omnis ratione. Reprehenderit atque id aperiam autem sapiente aliquam. Nesciunt repellat a minus id.','Nostrum optio est eius non dolor et est. Omnis perspiciatis dolores qui facere. Earum voluptatibus temporibus consequatur rerum nihil qui voluptatem.\n\nEst et in deleniti quibusdam atque. Optio adipisci voluptate alias temporibus delectus praesentium eos aut. Quisquam totam ea velit neque hic qui animi. Sequi provident amet sit deserunt.\n\nEnim voluptatem autem possimus et neque. Debitis eligendi saepe qui ab excepturi enim unde.\n\nVero nihil nihil optio illum non ea consectetur. Enim eos expedita ut atque. Vel fugit autem consequatur ea quo eos.\n\nNumquam voluptatibus numquam voluptatem labore doloremque omnis veritatis. Vero itaque est omnis inventore eveniet qui. Incidunt voluptas enim nisi eos veritatis.\n\nDoloremque nostrum ut aliquam dolor. Dolorum quia quo dolorum blanditiis laudantium ratione ad ut. Nam saepe sunt explicabo iusto atque. Voluptate expedita esse et aspernatur incidunt aspernatur quia.\n\nVoluptatem ad expedita repudiandae iure et inventore rerum modi. Voluptatem omnis voluptas enim molestias velit tempore recusandae. Quia impedit facilis ut voluptas laudantium qui ut. Iusto expedita rerum beatae eos excepturi dignissimos.\n\nCommodi at libero aut consequatur quia natus. Consectetur et quo omnis laborum ullam. Placeat voluptatem nesciunt ea molestiae unde. Est ab minus aut. Accusamus aperiam aperiam cupiditate quibusdam eos.\n\nPlaceat laudantium officiis nostrum ipsam. Distinctio ullam id ipsam alias cupiditate dolorum.\n\nIpsa in aut iure. Voluptatum aut enim fuga soluta. Tenetur fuga repellendus tempora ut atque. Vitae pariatur consequatur temporibus magnam.','img/blog/main-blog/m-blog-5.jpg',3911,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(16,2,1,'Quibusdam soluta incidunt soluta ducimus dolor et beatae ut.','nemo-nisi-est-tenetur-velit-deleniti','Non odio ullam est beatae unde accusamus eveniet. Aperiam sed dolorem voluptatem inventore minus illo distinctio et. Recusandae officia fuga ratione itaque dolores.','Sed rerum hic incidunt dolorum inventore sequi. Reprehenderit qui nostrum eius et dolorem accusantium et dicta. At enim et velit dicta deserunt vitae autem.\n\nHarum aspernatur necessitatibus vero voluptates rerum neque dolor rerum. Eius rerum numquam omnis aut dolore nisi est. Sunt consectetur molestiae et numquam totam. Et quo laborum in perspiciatis voluptas vero.\n\nDebitis laboriosam est rerum fugiat sequi. Eum omnis aliquam ducimus nihil eos delectus.\n\nNostrum neque commodi veniam reiciendis. Eveniet id molestias est autem suscipit quod. Ab atque iusto consectetur minima cupiditate fugit nesciunt. Temporibus sed aperiam non nihil.\n\nNon quidem temporibus magnam esse. Saepe blanditiis veniam sit optio tempora corporis ad provident.\n\nOdit earum soluta vel. Facere est quas deleniti non tempore sed. Consequuntur debitis quo pariatur consectetur eos dolores omnis. Quos provident et ut eum tempora veniam.\n\nMolestiae velit eos voluptatem porro voluptatum repellat. Consequatur et aliquid quos omnis laudantium numquam. Ut dolorum laboriosam excepturi.\n\nEt non ut et dolorem ut voluptas sed. Autem dignissimos eos id quasi harum atque qui. Est quia autem autem culpa a nulla.\n\nIpsam est magnam voluptas. Est sit nam omnis nihil quis expedita in voluptatem. Ut nisi quo maiores in sit. Dignissimos vel non sit sed quia. Consequuntur facilis omnis ex illum dolore tempora ea quod.\n\nVoluptate totam eveniet expedita totam eveniet rerum eveniet qui. Omnis sit quae qui itaque vel. Ut perferendis voluptatem laudantium quidem.','img/blog/main-blog/m-blog-5.jpg',1680,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(17,2,1,'Maxime repudiandae minus et et sit unde aut.','tenetur-et-velit-maxime-laborum-numquam','Est animi hic ea harum a quia. Maxime nam qui natus.','Consectetur modi odio voluptas quis soluta. Quis eum vitae delectus qui odit illo. Nisi quod perferendis ratione neque eaque quia saepe. Aut repudiandae perferendis ea assumenda.\n\nEligendi molestiae pariatur non ut est quasi. Aut laudantium qui odio tempore aut aliquam praesentium asperiores.\n\nConsequatur temporibus quibusdam voluptatem quas. Aut cupiditate consequatur quis similique mollitia veritatis temporibus. Quod dolores aut minus labore non autem eos aut.\n\nEos exercitationem accusamus explicabo molestiae. Ut provident eum ducimus aliquam molestias velit iure. Hic rerum occaecati architecto similique et. Ab cumque voluptatem enim blanditiis provident.\n\nEa animi delectus eum aliquid. Exercitationem corporis dolorem tempore et soluta et labore. Totam nihil nobis praesentium. Consequatur dicta ut totam corrupti qui veritatis. Laborum est quibusdam illo et rerum odit rerum quia.\n\nTempore dolores est dignissimos non eum dicta. Nisi omnis numquam explicabo unde adipisci animi quaerat.\n\nSint non aut est enim eveniet impedit. Sed occaecati libero et magnam ut sed voluptatum. Eaque a autem illum sit voluptas molestias ut.\n\nSint dolores ut facere dolores debitis laboriosam. Corporis assumenda magni voluptatem illum illo eaque sunt sed. Atque eveniet quas ut quo reprehenderit. Eligendi eligendi ea laboriosam.\n\nAb sit odit consequatur placeat quis consequatur et. Et ducimus rerum alias dolores et odit suscipit. Autem earum delectus libero consectetur ex non. Saepe tenetur alias consequatur qui et.\n\nDolore et illo quia debitis fugiat. Voluptas libero dolores adipisci culpa ut magni. Consequatur laborum quisquam non et aut quia nostrum. Occaecati impedit et iusto accusantium cum ea.','img/blog/main-blog/m-blog-5.jpg',1560,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(18,1,1,'Laudantium illo odio sit maxime.','maxime-voluptas-sapiente-a-maxime-rerum-quia-id','Dolores magnam ut et inventore. Eligendi vel et et veritatis veniam facere.','Facilis pariatur nihil possimus. Quam modi alias cumque.\n\nNumquam ipsa sunt velit alias voluptatem. Aut eaque quia nostrum dolor. Voluptates officiis consequatur aut. Qui nam qui dolor eum. Laborum architecto ut nostrum ea eos dolores voluptate.\n\nQuisquam quam ipsam blanditiis blanditiis modi aliquid. Aperiam sit eaque sed suscipit. Doloremque eos fugit voluptatem eveniet. Qui qui ut tempore.\n\nOmnis necessitatibus quo sint impedit fugit eaque saepe. Rerum et sit dolorum libero velit. Error ullam quia cumque aliquid. Eveniet consequatur reprehenderit corporis sed perspiciatis aut.\n\nVoluptatem quo molestiae repudiandae qui. Molestiae non esse facere alias sunt quisquam. Qui debitis quo velit ut exercitationem.\n\nNon incidunt sequi reprehenderit et. Voluptatem corporis repellendus aliquid et. Non optio laudantium quia non temporibus praesentium et.\n\nPariatur adipisci sit consequatur nesciunt. Numquam nihil non quas facere corporis quia.\n\nRepellendus tempora occaecati corrupti quis vero possimus omnis dignissimos. Delectus et et minus. Asperiores enim omnis veniam qui et.\n\nVoluptatem exercitationem velit in reiciendis ut et. Dolorum autem corrupti unde quia. Quia consequatur impedit qui consequatur.\n\nMagnam veniam ipsam nobis itaque exercitationem. Pariatur fugit est amet optio consequuntur dolor quod. Reiciendis sunt adipisci tempore qui. Amet modi molestias ab sit facere sit.','img/blog/main-blog/m-blog-4.jpg',2693,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(19,4,1,'Numquam modi nihil nam molestiae aliquid illum.','ipsam-voluptatum-tempora-amet-aspernatur-provident-tempora','Modi quisquam vel nobis molestiae esse. Ut atque ea numquam temporibus rerum natus amet deserunt.','Consequatur et aliquid officiis. Sed doloribus expedita rem fugiat. Dolor neque vitae et sequi aliquam facere.\n\nEaque magnam quisquam perspiciatis odit dolorem ut. Tempore quia quia itaque voluptas temporibus adipisci velit. Omnis pariatur cumque blanditiis qui sit adipisci.\n\nAccusamus laborum veritatis in et harum maiores rem. Recusandae architecto amet nihil unde voluptatibus. Ut hic culpa dolore ut ullam.\n\nDoloribus dolor nemo in minima officiis id. Et fuga laborum qui quisquam nostrum eos dolores numquam. Id vero totam ullam sapiente.\n\nFacilis velit quos cupiditate dicta assumenda laborum ad nihil. Rem molestiae non minus eius accusantium ducimus deserunt. Rerum nemo excepturi nesciunt adipisci rerum aut deserunt. Et perferendis minus cumque non fuga.\n\nPorro consectetur ratione officiis quia fugiat maiores. Laboriosam dolores quia veniam provident reiciendis dolorem.\n\nId est voluptatem quia aperiam harum. Explicabo consectetur eveniet repellendus ea est. Eligendi placeat inventore autem mollitia.\n\nQuas est ipsam id quasi quia voluptatem quam quo. Aut vero aspernatur harum illum impedit. Deleniti dolorem asperiores aut consequuntur.\n\nId voluptatem velit ut ab rem. Qui debitis explicabo error accusamus vel. Cum dolor quod occaecati natus aut.\n\nOdio aut accusamus eum reprehenderit. Sed consequatur recusandae voluptatibus non tenetur non. Nesciunt quae est facere sequi quo distinctio ea. Quisquam voluptas necessitatibus qui. Cum sapiente dolore consequatur numquam aliquid aut temporibus quis.','img/blog/main-blog/m-blog-3.jpg',2213,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(20,4,1,'Quas illo sit maiores animi qui.','qui-eos-tempore-eos-error-expedita','Officiis cupiditate harum minus id. Voluptatibus magnam omnis voluptatem voluptas.','Sunt sed repudiandae voluptatem expedita maiores. Sunt eum asperiores quidem assumenda sed sit atque vitae. Minus exercitationem odio quis vitae facere.\n\nVel qui autem nulla quibusdam pariatur. Voluptatem aut assumenda totam omnis ut rem doloremque et. Eos est laboriosam mollitia ut voluptates officiis voluptatem.\n\nSed voluptates sed magni impedit minima mollitia. Provident sunt dolorem natus fugiat. Qui dignissimos ut vero provident.\n\nUt sit doloremque ad voluptatem aspernatur voluptas est. Possimus voluptatem velit enim et nemo excepturi quo. Officiis quo facilis ratione unde itaque ut.\n\nOfficia magni ut sed distinctio dolor dicta odio. Ea dolorum nemo laborum cumque enim commodi dignissimos et. Ipsa aut blanditiis totam ipsum saepe natus id.\n\nFugiat officia sit quibusdam nihil et et officiis. Repellat aut vel voluptatem dolorem. Voluptatum quod quo mollitia enim laudantium.\n\nConsequatur illo quibusdam consequatur sunt aut qui magnam. Tenetur repellendus nulla ducimus temporibus ullam. Consequatur aut dolores vel. Id quibusdam voluptas qui omnis asperiores animi.\n\nEnim natus iste sunt nemo eligendi unde reprehenderit. Delectus magni ex laborum qui facilis eius.\n\nEt sint consequuntur aut quibusdam reprehenderit. Quis dignissimos deleniti nemo est. Enim et qui culpa architecto ut incidunt. Fugiat doloremque sed totam eos est aut et.\n\nDolor eos esse non itaque enim cupiditate. Iure quaerat earum ad est. Ea molestiae veniam cumque corrupti non sapiente. Placeat architecto aut pariatur error voluptas cupiditate. Ab rerum facilis delectus neque vero consequatur.','img/blog/main-blog/m-blog-1.jpg',2810,'2025-07-27 08:59:50','2025-07-27 08:59:50',NULL),(21,4,1,'Aspernatur nam deleniti impedit quidem occaecati rerum.','voluptas-earum-temporibus-nihil-tenetur-porro','Eligendi fugiat aut voluptatibus sit praesentium quia et. Consequuntur accusamus natus ut aut velit. Sed omnis voluptas iure placeat soluta sint.','Consequatur sed labore eos facere ut assumenda repudiandae ut. Eius eum tenetur esse quas veniam.\n\nNecessitatibus molestiae asperiores tenetur. Illo voluptas quis nam quo nisi aut quo. Accusamus ut et ut quo voluptas officia. Amet ut soluta facilis. Non alias totam ea ab.\n\nNam dolorem aut voluptates. Ea explicabo molestiae dolorem nostrum. Doloribus voluptate facere similique est aperiam.\n\nEa ratione dolorem maiores velit eos. Natus optio ducimus incidunt. Tenetur eveniet quos quas nulla excepturi illum. Voluptatum eaque beatae ipsum.\n\nEius aut fugit sint distinctio. Aspernatur enim occaecati distinctio asperiores officiis ut et. Culpa suscipit autem assumenda voluptatem. Deserunt similique incidunt optio molestiae sed aut ut facilis.\n\nEos culpa aut consequuntur eos labore et. Optio qui vel necessitatibus nostrum eaque dolorum. Ea nihil expedita dolores.\n\nQui similique fugit facilis nulla. Sunt quia est qui quasi explicabo.\n\nHarum beatae amet et facilis dicta. Aliquid dolore non eos qui qui. Iusto dolor et dignissimos.\n\nEarum hic voluptas reprehenderit consectetur temporibus dicta qui natus. Dicta doloribus sit sed sunt sed. Fugit dolor inventore voluptatibus. Ut aut accusantium rerum hic consequuntur dolorem doloribus.\n\nAut exercitationem eum a earum aut ducimus modi. Eius error quibusdam in architecto accusamus consequatur asperiores. At ipsum vitae ducimus voluptas officia.','img/blog/main-blog/m-blog-1.jpg',4008,'2025-07-27 08:59:51','2025-07-27 09:06:21',NULL);
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'фывфыв','2025-07-27 10:29:01','2025-07-27 10:29:01');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Москва','2025-07-26 17:22:29','2025-07-26 17:22:29'),(2,'Санкт-Петербург','2025-07-26 17:22:30','2025-07-26 17:22:30'),(3,'Новосибирск','2025-07-26 17:22:30','2025-07-26 17:22:30'),(4,'Екатеринбург','2025-07-26 17:22:30','2025-07-26 17:22:30'),(5,'Казань','2025-07-26 17:22:30','2025-07-26 17:22:30'),(6,'Нижний Новгород','2025-07-26 17:22:30','2025-07-26 17:22:30'),(7,'Челябинск','2025-07-26 17:22:30','2025-07-26 17:22:30'),(8,'Самара','2025-07-26 17:22:30','2025-07-26 17:22:30'),(9,'Омск','2025-07-26 17:22:30','2025-07-26 17:22:30'),(10,'Ростов-на-Дону','2025-07-26 17:22:30','2025-07-26 17:22:30');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_settings`
--

DROP TABLE IF EXISTS `contact_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Название компании',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Полный адрес',
  `map_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ссылка на карты (Google/Yandex)',
  `phone_primary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Основной телефон',
  `phone_secondary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Дополнительный телефон',
  `email_primary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Основной email',
  `email_secondary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Дополнительный email',
  `work_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Часы работы (например: Пн-Пт 9:00-18:00)',
  `social_links` text COLLATE utf8mb4_unicode_ci COMMENT 'JSON соцсети: {vk: "", telegram: ""}',
  `additional_info` text COLLATE utf8mb4_unicode_ci COMMENT 'Дополнительная информация',
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Путь к логотипу',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_settings`
--

LOCK TABLES `contact_settings` WRITE;
/*!40000 ALTER TABLE `contact_settings` DISABLE KEYS */;
INSERT INTO `contact_settings` VALUES (1,'ТехноПартнерs','г. Москва, ул. Промышленная, д. 42, офис 305','https://yandex.ru/maps/org/12345','+7 (495) 123-45-67','+7 (800) 123-45-67','info@tehnopartner.ru','sales@tehnopartner.ru','Пн-Пт: 9:00-18:00, Сб-Вс: выходной','\"{\\\"vk\\\":\\\"https:\\\\\\/\\\\\\/vk.com\\\\\\/tehnopartner\\\",\\\"telegram\\\":\\\"https:\\\\\\/\\\\\\/t.me\\\\\\/tehnopartner\\\",\\\"whatsapp\\\":\\\"https:\\\\\\/\\\\\\/wa.me\\\\\\/74951234567\\\"}\"','Реквизиты: ИНН 1234567890, ОГРН 1234567890123',NULL,'2025-07-26 17:44:53','2025-07-26 17:46:16');
/*!40000 ALTER TABLE `contact_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_request_items`
--

DROP TABLE IF EXISTS `customer_request_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_request_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_request_id` bigint unsigned NOT NULL,
  `item_number` int NOT NULL COMMENT 'Порядковый номер',
  `brand_id` bigint unsigned NOT NULL,
  `article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `quality_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Оригинал/Аналог/OEM/REMAN',
  `price` decimal(10,2) DEFAULT NULL,
  `delivery_days` int DEFAULT NULL COMMENT 'Срок поставки в кал.днях',
  `manufacturer_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_request_items_customer_request_id_foreign` (`customer_request_id`),
  KEY `customer_request_items_brand_id_foreign` (`brand_id`),
  KEY `customer_request_items_manufacturer_id_foreign` (`manufacturer_id`),
  CONSTRAINT `customer_request_items_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `customer_request_items_customer_request_id_foreign` FOREIGN KEY (`customer_request_id`) REFERENCES `customer_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_request_items_manufacturer_id_foreign` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_request_items`
--

LOCK TABLES `customer_request_items` WRITE;
/*!40000 ALTER TABLE `customer_request_items` DISABLE KEYS */;
INSERT INTO `customer_request_items` VALUES (1,2,1,1,'123123','еуые',1,'Оригинал',NULL,NULL,1,NULL,NULL,'2025-07-27 10:29:01','2025-07-27 10:29:01');
/*!40000 ALTER TABLE `customer_request_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_requests`
--

DROP TABLE IF EXISTS `customer_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_requests_city_id_foreign` (`city_id`),
  KEY `customer_requests_user_id_foreign` (`user_id`),
  CONSTRAINT `customer_requests_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `customer_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_requests`
--

LOCK TABLES `customer_requests` WRITE;
/*!40000 ALTER TABLE `customer_requests` DISABLE KEYS */;
INSERT INTO `customer_requests` VALUES (1,'еуые',1,'уеые',NULL,4,'2025-07-27 10:28:22','2025-07-27 10:29:53','2025-07-27 10:29:53'),(2,'еуые',1,'уеые',NULL,4,'2025-07-27 10:29:01','2025-07-27 10:29:01',NULL),(3,'Нужны Тормозные колодки',1,'Повторивши это раза три, он попросил хозяйку приказать заложить его бричку. Настасья Петровна тут же продиктовать их. Некоторые крестьяне несколько изумили его своими фамилиями, а еще более.','requests/file1.pdf',2,'2025-07-29 15:26:06','2025-07-29 15:26:06',NULL),(4,'Нужны Тормозные колодки',7,'У меня скоро закладывают. — Так лучше ж ты их — перевешал за это! Ты лучше человеку не «дай есть, а что? — Да какая просьба? — Ну, теперь мы сами доедем, — сказал Манилов, — у меня кузнец, такой.','requests/file1.pdf',5,'2025-07-29 15:26:37','2025-07-29 15:26:37',NULL),(5,'Нужны Тормозные колодки',10,'Да, — отвечал Чичиков, усмехнувшись, — чай, не заседатель, — а — Заманиловки никакой нет. Она зовется так, то есть не станете, когда — свинина — всю ночь мне снился окаянный. Вздумала было на нем.','requests/file1.pdf',9,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(6,'Нужны Амортизаторы',9,'Пока приезжий господин жил в городе, там вам черт — знает уже, какая шарманка, но должен был услышать еще раз, каким — образом поехал в поход поехал» неожиданно завершался каким-то давно знакомым.',NULL,15,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(7,'Нужны Свечи зажигания',3,'Да кто же говорит, что они живы, так, как у тоненьких, зато в шкатулках благодать божия. У тоненького в три ручья катился по лицу его, видно, были очень приятны, ибо ежеминутно оставляли после себя.',NULL,9,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(8,'Нужны Воздушный фильтр',4,'Подобная игра природы, впрочем, случается на разных исторических картинах, неизвестно в какое хотите предприятие, менять все что хочешь. Уж так — сказать, выразиться, негоция, — так нарочно.','requests/file4.pdf',13,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(9,'Нужны Масляный фильтр',4,'Уже по одному собачьему лаю, составленному из таких уст; а где-нибудь в конце города дом, купленный на имя жены, потом в другую, потом, изменив и образ нападения и сделавшись совершенно прямым.',NULL,8,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(10,'Нужны Ремень ГРМ',10,'Селифан, казалось, сам смекнул, но не говорил ни слова. — Что, барин? — отвечал Фемистоклюс. — А тебе барабан; не правда ли, тебе барабан? — продолжал Ноздрев, — этак и я его обыграю. Нет, вот.',NULL,15,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(11,'Нужны Генератор',5,'Чичиков. — Ну, хочешь, побьемся об заклад! — сказал Ноздрев, — этак и я вам пеньку продам. — Да вот этих-то всех, что умерли. — Да не нужно мешкать, вытащил тут же со слугою услышали хриплый бабий.','requests/file7.pdf',12,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(12,'Нужны Стартер',7,'Был с почтением у губернатора, и у полицеймейстера обедал, и познакомился с коллежским советником Павлом Ивановичем Чичиковым: преприятный человек!» На что Чичиков тут же провертел пред ними.',NULL,13,'2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(13,'Нужны Аккумулятор',4,'Между тем псы заливались всеми возможными голосами: один, забросивши вверх голову, выводил так протяжно и с мелким табачным торгашом, хотя, конечно, в душе поподличает в меру перед первым. У нас не.',NULL,12,'2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(14,'Нужны Фары',3,'Манилов никак не была так велика, и иностранцы справедливо удивляются… Собакевич все слушал, наклонивши голову, — и что, однако же, — заметить: поступки его совершенно не мог изъяснить себе, и все.','requests/file10.pdf',13,'2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(15,'Нужны Стекло лобовое',9,'После нас приехал какой-то князь, послал в лавку за — тем неизвестно чего оглянулся назад. — Как милости вашей будет угодно, — отвечал зять. — Ну, вот тебе постель готова, — сказала старуха, однако.',NULL,6,'2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(16,'Нужны Диски колесные',2,'Чичиков, как покатили мы в первые — дни! Правда, ярмарка была отличнейшая. Сами купцы говорят, что — никогда в жизни так не будет никакой доверенности относительно контрактов или — вступления в.',NULL,15,'2025-07-29 15:28:30','2025-07-29 15:28:30',NULL);
/*!40000 ALTER TABLE `customer_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manufacturers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_original` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'еуые',0,'2025-07-27 10:29:01','2025-07-27 10:29:01');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'2014_10_12_000000_create_users_table',1),(14,'2014_10_12_100000_create_password_reset_tokens_table',1),(15,'2014_10_12_100000_create_password_resets_table',1),(16,'2019_08_19_000000_create_failed_jobs_table',1),(17,'2019_12_14_000001_create_personal_access_tokens_table',1),(18,'2025_07_26_193633_create_cities_table',1),(19,'2025_07_26_193652_create_brands_table',1),(20,'2025_07_26_193705_create_manufacturers_table',1),(21,'2025_07_26_193751_create_products_table',1),(22,'2025_07_26_194652_create_customer_requests_table',1),(23,'2025_07_26_194708_create_customer_request_items_table',1),(24,'2025_07_26_194723_create_seller_responses_table',1),(25,'2025_07_26_200720_create_contact_settings_table',1),(26,'2025_07_27_115514_create_blog_categories_table',2),(27,'2025_07_27_115514_create_blogs_table',2),(28,'2025_07_27_115515_create_blog_comments_table',2),(29,'2025_07_28_174336_add_status_to_seller_responses_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint unsigned NOT NULL,
  `article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `manufacturer_id` bigint unsigned NOT NULL,
  `city_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `price_updated_at` date NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_manufacturer_id_foreign` (`manufacturer_id`),
  KEY `products_city_id_foreign` (`city_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `products_manufacturer_id_foreign` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`),
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'BRK-1265','Тормозные колодки',32,1,5,6528.00,'2025-06-04',5,'2024-09-05 22:45:24','2025-01-13 21:11:11'),(2,1,'SHK-5593','Амортизаторы передние',9,1,5,11717.00,'2025-02-17',5,'2024-11-23 00:45:58','2025-02-08 10:08:21'),(3,1,'SPK-5495','Свечи зажигания',31,1,6,6338.00,'2025-01-12',3,'2025-02-12 14:10:37','2024-09-21 07:50:41'),(4,1,'AIR-3401','Воздушный фильтр',40,1,4,9952.00,'2024-12-29',5,'2025-03-03 12:08:56','2025-07-15 14:20:56'),(5,1,'OIL-8038','Масляный фильтр',15,1,6,3676.00,'2024-12-29',5,'2025-05-09 03:07:53','2025-06-18 14:25:31'),(6,1,'TMB-3493','Ремень ГРМ',41,1,10,18588.00,'2024-08-13',3,'2024-11-15 15:02:15','2024-11-10 22:06:15'),(7,1,'GEN-8111','Генератор',40,1,9,4371.00,'2025-01-04',5,'2025-07-27 07:35:40','2025-06-12 14:25:38'),(8,1,'STR-9090','Стартер',36,1,8,7603.00,'2025-03-03',3,'2025-06-12 03:49:02','2025-01-13 02:08:58'),(9,1,'BAT-3217','Аккумулятор 60Ah',18,1,2,4995.00,'2024-11-29',3,'2024-12-14 23:24:44','2025-01-06 00:21:29'),(10,1,'LHP-5635','Фара передняя левая',48,1,4,11590.00,'2025-01-25',3,'2025-03-20 21:59:14','2025-04-16 16:57:40'),(11,1,'WSH-5562','Стекло лобовое',44,1,2,896.00,'2025-06-07',3,'2025-04-27 19:50:10','2024-11-07 05:49:53'),(12,1,'WHL-7227','Диски колесные 16\"',20,1,5,6920.00,'2025-03-02',3,'2024-09-04 22:51:09','2025-05-02 03:33:40'),(13,1,'FUP-4275','Топливный насос',6,1,2,15344.00,'2025-01-03',3,'2024-10-16 11:50:21','2024-09-26 10:27:03'),(14,1,'THS-9439','Термостат',10,1,3,14042.00,'2024-10-17',5,'2024-09-24 13:38:48','2024-12-23 00:54:47'),(15,1,'WBR-6015','Ступичный подшипник',43,1,7,13275.00,'2025-05-28',3,'2025-03-08 12:13:51','2024-09-29 04:13:19');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seller_responses`
--

DROP TABLE IF EXISTS `seller_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seller_responses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_request_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `response_text` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responded_items` json DEFAULT NULL COMMENT 'JSON с ID позиций на которые ответили',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new' COMMENT 'Статус отклика: new, completed, canceled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_responses_customer_request_id_foreign` (`customer_request_id`),
  KEY `seller_responses_user_id_foreign` (`user_id`),
  CONSTRAINT `seller_responses_customer_request_id_foreign` FOREIGN KEY (`customer_request_id`) REFERENCES `customer_requests` (`id`),
  CONSTRAINT `seller_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seller_responses`
--

LOCK TABLES `seller_responses` WRITE;
/*!40000 ALTER TABLE `seller_responses` DISABLE KEYS */;
INSERT INTO `seller_responses` VALUES (1,2,5,'test','response_files/leqPZEcHBdUX4iLs1XO9I2H3zqxFT7zdM88ZOBWZ.png','[\"1\"]','new','2025-07-28 15:06:29','2025-07-28 15:06:29',NULL),(3,5,16,'Манилов никак не хотевшая угомониться, и долго еще потому свистела она одна. Потом показались трубки — деревянные, глиняные, пенковые, обкуренные и.','responses/offer1.pdf','\"{\\\"item\\\":\\\"\\\\u0422\\\\u043e\\\\u0440\\\\u043c\\\\u043e\\\\u0437\\\\u043d\\\\u044b\\\\u0435 \\\\u043a\\\\u043e\\\\u043b\\\\u043e\\\\u0434\\\\u043a\\\\u0438\\\",\\\"brand\\\":\\\"KYB\\\",\\\"price\\\":8524,\\\"quantity\\\":3}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(4,6,21,'Не сделай я сам своими руками супруга, снабжая приличными наставлениями, как закутываться, а холостым — наверное не могу судить, но свиные — котлеты.',NULL,'\"{\\\"item\\\":\\\"\\\\u0410\\\\u043c\\\\u043e\\\\u0440\\\\u0442\\\\u0438\\\\u0437\\\\u0430\\\\u0442\\\\u043e\\\\u0440\\\\u044b\\\",\\\"brand\\\":\\\"KYB\\\",\\\"price\\\":7149,\\\"quantity\\\":1}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(5,7,25,'Если бы Чичиков прислушался, то узнал бы много подробностей, относившихся лично к нему; но мысли его так скоро купить? — Как милости вашей будет.',NULL,'\"{\\\"item\\\":\\\"\\\\u0421\\\\u0432\\\\u0435\\\\u0447\\\\u0438 \\\\u0437\\\\u0430\\\\u0436\\\\u0438\\\\u0433\\\\u0430\\\\u043d\\\\u0438\\\\u044f\\\",\\\"brand\\\":\\\"Mann\\\",\\\"price\\\":7450,\\\"quantity\\\":4}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(6,8,23,'Или, пожалуй, продайте. Я вам даже не везде видывано. После небольшого послеобеденного сна он приказал подать умыться и чрезвычайно долго тер мылом.',NULL,'\"{\\\"item\\\":\\\"\\\\u0412\\\\u043e\\\\u0437\\\\u0434\\\\u0443\\\\u0448\\\\u043d\\\\u044b\\\\u0439 \\\\u0444\\\\u0438\\\\u043b\\\\u044c\\\\u0442\\\\u0440\\\",\\\"brand\\\":\\\"Brembo\\\",\\\"price\\\":1740,\\\"quantity\\\":2}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(7,9,25,'Тебе привезу саблю; хочешь саблю? — Хочу, — отвечал Чичиков. — Вот видишь, отец мой, без малого восемьдесят, — сказала супруга Собакевича. — А.','responses/offer5.pdf','\"{\\\"item\\\":\\\"\\\\u041c\\\\u0430\\\\u0441\\\\u043b\\\\u044f\\\\u043d\\\\u044b\\\\u0439 \\\\u0444\\\\u0438\\\\u043b\\\\u044c\\\\u0442\\\\u0440\\\",\\\"brand\\\":\\\"Bosch\\\",\\\"price\\\":3882,\\\"quantity\\\":4}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(8,10,19,'Манилов посмотрел на него в некотором отношении исторический человек. Ни на одном собрании, где он был, как кровь с молоком; здоровье, казалось, так.',NULL,'\"{\\\"item\\\":\\\"\\\\u0420\\\\u0435\\\\u043c\\\\u0435\\\\u043d\\\\u044c \\\\u0413\\\\u0420\\\\u041c\\\",\\\"brand\\\":\\\"KYB\\\",\\\"price\\\":2295,\\\"quantity\\\":2}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(9,11,20,'Хотя почтмейстер был очень порядочный человек. Все чиновники были довольны приездом нового лица. Губернатор об нем изъяснился, что он почтенный и.',NULL,'\"{\\\"item\\\":\\\"\\\\u0413\\\\u0435\\\\u043d\\\\u0435\\\\u0440\\\\u0430\\\\u0442\\\\u043e\\\\u0440\\\",\\\"brand\\\":\\\"Bosch\\\",\\\"price\\\":4854,\\\"quantity\\\":1}\"','completed','2025-07-29 15:28:29','2025-07-29 15:28:29',NULL),(10,12,22,'Участие мужиков возросло до невероятной степени. Каждый наперерыв совался с советом: «Ступай, Андрюшка, проведи-ка ты пристяжного, что с трудом.',NULL,'\"{\\\"item\\\":\\\"\\\\u0421\\\\u0442\\\\u0430\\\\u0440\\\\u0442\\\\u0435\\\\u0440\\\",\\\"brand\\\":\\\"Brembo\\\",\\\"price\\\":2194,\\\"quantity\\\":2}\"','completed','2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(11,13,25,'Чичиков хладнокровно и, — подошедши к окну, на своего товарища. — А для какие причин вам это нужно? — Уж это, точно, случается и что такого помещика.','responses/offer9.pdf','\"{\\\"item\\\":\\\"\\\\u0410\\\\u043a\\\\u043a\\\\u0443\\\\u043c\\\\u0443\\\\u043b\\\\u044f\\\\u0442\\\\u043e\\\\u0440\\\",\\\"brand\\\":\\\"KYB\\\",\\\"price\\\":2318,\\\"quantity\\\":1}\"','completed','2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(12,14,21,'Как ни придумывал Манилов, как ему быть и что такого помещика вовсе нет. Там прямо на горе увидишь — дом, каменный, в два часа таким звуком, как бы.',NULL,'\"{\\\"item\\\":\\\"\\\\u0424\\\\u0430\\\\u0440\\\\u044b\\\",\\\"brand\\\":\\\"KYB\\\",\\\"price\\\":1237,\\\"quantity\\\":1}\"','completed','2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(13,15,23,'Дай прежде слово, что исполнишь. — Да какая просьба? — Ну, душа, вот это так! Вот это хорошо, постой же, я тебя поцелую за — тем неизвестно чего.',NULL,'\"{\\\"item\\\":\\\"\\\\u0421\\\\u0442\\\\u0435\\\\u043a\\\\u043b\\\\u043e \\\\u043b\\\\u043e\\\\u0431\\\\u043e\\\\u0432\\\\u043e\\\\u0435\\\",\\\"brand\\\":\\\"KYB\\\",\\\"price\\\":9437,\\\"quantity\\\":4}\"','completed','2025-07-29 15:28:30','2025-07-29 15:28:30',NULL),(14,16,21,'Ноздревым при зяте насчет главного предмета. Все-таки зять был человек лет под сорок, бривший бороду, ходивший в сюртуке и, по-видимому, проводивший.',NULL,'\"{\\\"item\\\":\\\"\\\\u0414\\\\u0438\\\\u0441\\\\u043a\\\\u0438 \\\\u043a\\\\u043e\\\\u043b\\\\u0435\\\\u0441\\\\u043d\\\\u044b\\\\u0435\\\",\\\"brand\\\":\\\"Mann\\\",\\\"price\\\":5196,\\\"quantity\\\":1}\"','completed','2025-07-29 15:28:30','2025-07-29 15:28:30',NULL);
/*!40000 ALTER TABLE `seller_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contacts` text COLLATE utf8mb4_unicode_ci,
  `about` text COLLATE utf8mb4_unicode_ci,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@example.com',NULL,'$2y$12$ZUezWfN3M1Mj0QEiYsyFpuyEzaSRbdH8rZiHEqAA1Qc539AfoP7iu','admin','+79999999999',NULL,NULL,'Администрация',NULL,1,NULL,NULL,'2025-07-26 17:22:30','2025-07-26 17:22:30'),(2,'Manager','manager@example.com',NULL,'$2y$12$qjxecyvoVtKBQoS.Pp7zBuXZ06.6PYzqQ8YIJulS7Ag25X421WqK6','manager','+78888888888',NULL,NULL,'Отдел продаж',NULL,1,NULL,NULL,'2025-07-26 17:22:30','2025-07-26 17:22:30'),(3,'test test','ryzhakovalexeynicol@gmail.com',NULL,'$2y$12$zes5WWUIfrx5lHD4MWBsYOULLLUbfXa9LGPVJrAOnlF630Eaici6O','supplier',NULL,NULL,NULL,'test','7842349892',1,NULL,NULL,'2025-07-27 09:36:58','2025-07-27 09:43:27'),(4,'Test Test','acquiring@gmail.com',NULL,'$2y$12$7tgu3TiBFvGxUqkQbnPDqOC5xU/Wxwt4Q.LfRNvTr/PfRKDKdlS3a','user','753345',NULL,'test','Test',NULL,NULL,NULL,NULL,'2025-07-27 09:47:58','2025-07-27 09:48:33'),(5,'test test','test@example.com',NULL,'$2y$12$/CYrT2SC4KOpC.QIUUoo8uKHxXnXkRXzUbK2RxbJ2ad3reaROltva','supplier',NULL,NULL,NULL,'test','7842349892',2,NULL,NULL,'2025-07-28 14:26:03','2025-07-28 14:26:12'),(6,'Mr. Emerald Jakubowski V','christ.lang@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'bDnqSEQyeN',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(7,'Ayden Murray','daisha.vandervort@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'RIUp1Ao5cr',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(8,'Myrtice O\'Hara','jamel.fahey@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'JCBEuuSYvz',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(9,'Mrs. Laurie Hill IV','alegros@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'T8gFm8ZJuV',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(10,'Dr. Ivory Kirlin','ikunde@example.com','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'IsOO2dHgd4',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(11,'Miss Bridie Upton MD','skylar56@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'3g5479rssb',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(12,'Randal Watsica','joyce.kuhic@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'8tSgpqbwBm',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(13,'Miss Audie Mertz','bailey.aaron@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'EiJKmGZD0C',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(14,'Mckenna Waters','wintheiser.rosalia@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'U3fLAt3WbU',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(15,'Dr. Nathen Hegmann','clair.ledner@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','buyer',NULL,NULL,NULL,'test',NULL,NULL,'cJU6EcU7rm',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(16,'Collin Hickle','pmraz@example.com','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'fXLly0w1VS',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(17,'Raquel Smitham III','becker.delbert@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'aAeeWzbSkj',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(18,'Bernadine Beatty','boreilly@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'WfjvhaCld9',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(19,'Dr. Clifton Medhurst PhD','marlen.gottlieb@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'h3xp6Ypdro',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(20,'Prof. Hans Borer V','zheathcote@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'j0gaG8ad8k',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(21,'Kari Kerluke','xmurphy@example.net','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'XmW5FeMIBh',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(22,'Elisabeth Homenick MD','ibatz@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'Acy7TNid5c',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(23,'Nadia Roberts II','idell79@example.com','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'R6wjFfxIbF',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(24,'Jeanette Walsh','jordane08@example.com','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'bqkpoCFaEg',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29'),(25,'Darius Becker','goldner.orpha@example.org','2025-07-29 15:28:29','$2y$12$VuF4idNeo9ykjXoRRbEtCeQ2WKWFFD66psIkOI6IrZ7u4oOUVsj6u','seller',NULL,NULL,NULL,'test',NULL,NULL,'mdf3aX3YnS',NULL,'2025-07-29 15:28:29','2025-07-29 15:28:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-03 20:23:41
