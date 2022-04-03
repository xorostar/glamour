-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2022 at 11:02 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glamour`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `administrator_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`administrator_id`, `username`, `role`, `password`) VALUES
(1, 'admin', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`) VALUES
(3, 1),
(4, 7),
(5, 4),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `product_id`, `quantity`, `product_price`, `total_price`) VALUES
(1, 3, 5, 1, 1470, 1470),
(2, 3, 20, 1, 1470, 1470),
(3, 5, 7, 1, 1470, 1470),
(5, 6, 7, 1, 1470, 1470);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subscriber` tinyint(1) NOT NULL,
  `shipping_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `created_at`, `first_name`, `last_name`, `middle_name`, `contact_no`, `email_id`, `password`, `subscriber`, `shipping_address`) VALUES
(1, '2019-05-11 18:24:03', 'Aswad', 'Ali', '', '', 'aswadali@gmail.com', '$2y$10$crNLOfB8eIOeg1YBrgN1curmYWGC4hH0LUBSeWGUdwjrTI1LAItG2', 0, '11 Baker Street New York City'),
(4, '2019-05-11 18:24:03', 'John', 'Doe', '', '', 'jd@gmail.com', '$2y$10$Ik553164iFAthTh/eACxhO3h2b8XnHHwd51pUkBJgZRA41NJNbgTm', 1, '11 Baker Street New York City'),
(7, '2019-05-13 18:01:47', 'Mary', 'Janet', '', '', 'maryjanet@gmail.com', '$2y$10$tzFkD1pyxEBg.5XOdY6pq.9YE6Ua9lkBEwazPfPNz7PTjMkAQaT2G', 1, '11 Baker Street New York City'),
(8, '2020-07-30 12:51:05', 'Aswad', 'Ali', '', '', 'aswad.fsquad@gmail.com', '$2y$10$RmHh0VJOZopIynwRNlgp4uAUgHeSXMzGoSn0Ypgj8sViR5sW1SSdW', 1, 'House 11 Street 1 Block JJ Phase 5 DHA');

-- --------------------------------------------------------

--
-- Table structure for table `featured_items`
--

CREATE TABLE `featured_items` (
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featured_items`
--

INSERT INTO `featured_items` (`item_id`, `item_type`) VALUES
(3, 'menu'),
(5, 'menu'),
(1, 'submenu'),
(3, 'submenu'),
(4, 'menu'),
(1, 'menu');

-- --------------------------------------------------------

--
-- Table structure for table `menu_images`
--

CREATE TABLE `menu_images` (
  `menu_item_id` int(11) NOT NULL,
  `image_uri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_images`
--

INSERT INTO `menu_images` (`menu_item_id`, `image_uri`) VALUES
(1, '5cdc8ad6b2d03.jpg'),
(2, '5cdd07ee0ff3b.jpg'),
(3, '5cdd07fd46f76.jpg'),
(4, 'Category_Bannerkfekowmcwm_9934e81a4d40ae748625f70e3e3f3145.jpg'),
(5, 'Cat-Banner-Unst-19.jpg'),
(6, 'men-Home-unstitched_2_5cdfeed8f7c4db415cc0cb669f4da3ae.jpg'),
(7, 'gls-19-119-_2__1.jpg'),
(8, '5cdf10df2f6af.jpg'),
(10, '5cdc9afcd17f0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `menu_item_id` int(11) NOT NULL,
  `menu_item_name` varchar(255) NOT NULL,
  `menu_item_order` int(11) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`menu_item_id`, `menu_item_name`, `menu_item_order`, `featured`) VALUES
(1, 'Sale', 8, 1),
(2, 'Lawn', 2, 0),
(3, 'New Arrivals', 3, 1),
(4, 'Unstitched', 4, 1),
(5, 'Women', 5, 1),
(6, 'Men', 6, 0),
(7, 'Accessories', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `total_amount` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `status`, `total_amount`, `date`, `customer_id`) VALUES
(3, 'Aswad Ali', 'Pending', 19453, '2019-05-14 08:06:07', 1),
(4, 'Aswad Ali', 'Delivered', 14316.5, '2019-05-14 19:13:16', 1),
(5, 'Aswad Ali', 'Delivered', 7188, '2019-05-14 20:15:04', 1),
(6, 'Aswad Ali', 'Refunded', 17150, '2019-05-16 15:23:49', 1),
(7, 'Aswad Ali', 'Delivered', 3986.5, '2019-05-20 09:24:06', 1),
(8, 'Aswad Ali', 'Pending', 1470, '2020-08-04 13:43:08', 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `product_price`, `total_price`) VALUES
(3, 2, 3, 2450, 7350),
(3, 5, 4, 1715, 6860),
(3, 7, 1, 1470, 1470),
(3, 17, 2, 1886.5, 3773),
(4, 3, 4, 1715, 6860),
(4, 17, 3, 1886.5, 5659.5),
(4, 19, 1, 1797, 1797),
(5, 19, 4, 1797, 7188),
(6, 5, 5, 1715, 8575),
(6, 7, 5, 1715, 8575),
(7, 7, 1, 1470, 1470),
(7, 18, 1, 2516.5, 2516.5),
(8, 7, 1, 1470, 1470);

-- --------------------------------------------------------

--
-- Table structure for table `other_subscribers`
--

CREATE TABLE `other_subscribers` (
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_subscribers`
--

INSERT INTO `other_subscribers` (`email`) VALUES
('aswadgemini11@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_body`) VALUES
(1, 'Shipping Policy', '&lt;h3&gt;Shipping Policy&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(2, 'Services', '&lt;h2&gt;Services&lt;/h2&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(3, 'Company', '&lt;h3&gt;Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(4, 'Careers', '&lt;h3&gt;Careers&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta numquam adipisci, rem atque ut reiciendis deleniti in cumque! Magni reprehenderit consequatur quis dignissimos quaerat sed veniam itaque ex obcaecati quisquam cum corrupti impedit sint fuga officia cumque maiores praesentium quia, ratione, suscipit minima eos. Provident impedit magni asperiores placeat officiis? Quisquam, quod adipisci minus excepturi autem, esse eaque officiis iure blanditiis ipsa laboriosam totam reprehenderit voluptate eos commodi repellat nulla impedit repellendus accusantium. Sint, pariatur accusantium? Temporibus debitis accusamus nisi fuga odio magni minima illum veritatis enim maiores aperiam illo perspiciatis itaque dolores, alias repudiandae voluptatum ullam id consequatur corporis consequuntur quaerat? At repudiandae placeat necessitatibus nisi pariatur perspiciatis. Accusantium aperiam neque provident quam sed error numquam, id repellendus consequuntur asperiores ipsa quisquam totam consectetur, cum nesciunt, voluptas omnis eveniet voluptatibus ut temporibus quia aliquam! Sunt minus, voluptates ea illo consequatur, fuga est corrupti minima voluptatem rem voluptate. Maiores, soluta!Sint unde laborum iusto minus provident enim tempora suscipit obcaecati optio modi perspiciatis numquam eius inventore nihil.&lt;/p&gt;&lt;p&gt;Error eligendi necessitatibus iste quam facere nisi possimus rerum. Ratione suscipit iusto a dolorum minus reprehenderit dignissimos quia dolor consectetur optio quisquam rerum tempora omnis deleniti odio laudantium repellat tenetur pariatur quod voluptatum, beatae illum qui eligendi labore! Aliquid ea cumque numquam et aut eius soluta nam optio vero voluptatum, esse, dolorem aspernatur. Libero deserunt aperiam eum provident tenetur ad voluptatibus nisi vitae saepe recusandae dolores enim hic consequuntur, laborum incidunt nesciunt? Deserunt blanditiis a possimus provident, dolorum, alias quia, facere minus ducimus iste rem sapiente? Ratione magni, officiis, nesciunt neque cum maiores eius consectetur iure ut sed ullam repellat molestiae, suscipit ea distinctio aut vero praesentium sunt? Veniam quibusdam maxime magni sed hic eius iusto repellendus numquam quas consequuntur quam commodi at nostrum facere quisquam eligendi quod, voluptates accusamus harum eos amet.&lt;/p&gt;&lt;h3&gt;Work for us now&lt;/h3&gt;&lt;figure class=&quot;table&quot;&gt;&lt;table&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Job Title&lt;/th&gt;&lt;th&gt;Last Date To Apply&lt;/th&gt;&lt;th&gt;Education&lt;/th&gt;&lt;th&gt;Experience&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;Software Engineer&lt;/td&gt;&lt;td&gt;&amp;nbsp;27/05/2019&lt;/td&gt;&lt;td&gt;BSCS&lt;/td&gt;&lt;td&gt;1 Year&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;Web Developer&lt;/td&gt;&lt;td&gt;&amp;nbsp;27/05/2019&lt;/td&gt;&lt;td&gt;BSCS&lt;/td&gt;&lt;td&gt;1 Year&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;UI/UX Designer&lt;/td&gt;&lt;td&gt;&amp;nbsp;27/05/2019&lt;/td&gt;&lt;td&gt;BSCS&lt;/td&gt;&lt;td&gt;1 Year&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;Senior Software Engineer&lt;/td&gt;&lt;td&gt;&amp;nbsp;27/05/2019&lt;/td&gt;&lt;td&gt;MSCS&lt;/td&gt;&lt;td&gt;5 Years&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;/figure&gt;'),
(5, 'FAQ', '&lt;h3&gt;Shipping Policy&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(6, 'Contact Us', '&lt;h3&gt;Shipping Policy&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(7, 'Our Policy', '&lt;h3&gt;Shipping Policy&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(8, 'Store Locator', '&lt;h3&gt;Shipping Policy&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;'),
(9, 'About', '&lt;h3&gt;Shipping Policy&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Glamour&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;&lt;h3&gt;About Our Company&lt;/h3&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus repellat, beatae nam laboriosam saepe, eos provident distinctio sapiente architecto dolores quae! At cupiditate aut id delectus voluptate alias eius nisi libero ut facere? Omnis qui sapiente, autem rem accusamus commodi ratione excepturi dolores perferendis nesciunt doloremque quaerat cumque facilis quisquam molestias, necessitatibus enim odit amet, dicta quibusdam. Cum molestiae consequatur consectetur, expedita veniam enim rem quas nobis facere dicta. Voluptatibus rem, maiores odio pariatur exercitationem assumenda ex quis, quidem eaque enim provident rerum voluptatum dignissimos repellendus eius harum. Nemo ducimus dolorum enim amet nobis maxime libero, suscipit sed odit necessitatibus.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `top_menu_item_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `sale_item` tinyint(1) NOT NULL DEFAULT 0,
  `discount_rate` float NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `visibility` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `top_menu_item_id`, `menu_item_id`, `sale_item`, `discount_rate`, `price`, `quantity`, `created_at`, `description`, `SKU`, `product_type`, `views`, `visibility`) VALUES
(1, 'Lawn Shirt GLS-19-37', 0, 1, 0, 0, 2450, 100, '2019-05-05 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197188 -P', '1PC', 1, 1),
(2, 'Lawn Shirt GLS-19-38', 0, 1, 0, 0, 2450, 100, '2019-05-06 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197189 -P', '2PC', 1, 1),
(3, 'Lawn Shirt GLS-19-39', 0, 1, 1, 30, 2450, 100, '2019-05-07 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197190 -P', '3PC', 0, 1),
(4, 'Lawn Shirt GLS-19-40', 0, 1, 1, 30, 2450, 100, '2019-05-08 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197191-P', '1PC', 2, 1),
(5, 'Lawn Shirt GLS-19-41', 0, 1, 1, 30, 2450, 100, '2019-05-09 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197192-P', '2PC', 12, 1),
(6, 'Shirt GLS-19-42', 0, 1, 1, 30, 5000, 100, '2019-05-07 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197193 -P', '1PC', 4, 1),
(7, 'Shirt GLS-19-43', 0, 1, 1, 30, 2100, 100, '2019-05-08 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197194-P', '2PC', 29, 1),
(8, 'Shirt GLS-19-44', 0, 1, 1, 30, 3000, 100, '2019-05-09 00:00:00', 'Multi-colored, printed lawn shirt', 'W-AP-19-197195-P', '3PC', 1, 1),
(17, 'Multi Casual Shirt CM-YD-2452 CS', 0, 3, 1, 30, 2695, 0, '0000-00-00 00:00:00', 'Multi Colored Shirt For Men', ' M-AP-18-178372 -P', '1PC', 0, 1),
(18, 'Khaki Basic SKP-751', 0, 3, 1, 30, 3595, 100, '2019-05-14 01:42:00', 'Poly Viscose Regular Fit Basic Suit   ', 'M-AP-19-198834 -P', '2PC', 11, 1),
(19, 'Multi Red Casual Shirt Checked CM-YD-2663', 0, 3, 1, 40, 2995, 100, '2019-05-14 01:42:00', 'Cotton Checked Modern Classic Fit Casual Shirt', 'M-AP-19-191651 -P', '1PC', 3, 1),
(20, 'Lawn Shirt GLS-19-115 DP', 0, 3, 1, 30, 2233, 100, '2019-05-14 01:42:00', 'Multi-colored, printed and embroidered lawn shirt with hand work', 'W-AP-19-199232 -P', '2PC', 5, 1),
(21, 'Lawn Shirt GLS-19-119 DP', 0, 3, 1, 30, 2233, 100, '2019-05-14 01:42:00', 'Multi-colored, printed and embroidered lawn shirt with over-lapping front panel', ' W-AP-19-199260 -P', '3PC', 0, 1),
(25, 'Lawn Shirt GLS-19-124', 0, 7, 0, 10, 3490, 65, '2019-05-15 15:07:45', 'Multi-colored, printed lawn shirt with organza details and hand work           ', ' W-AP-19-199295-P', '', 10, 1),
(26, 'Silken Pearl PS-06', 0, 6, 0, 25, 7500, 70, '2019-05-16 00:35:54', 'â€¢ Bamber Printed Dupatta â€“ 2.5 Meters\r\nâ€¢ Karandi Embroidered Shirt - 3 Meters\r\nâ€¢ Cotton Dyed Pants â€“ 1.5 Meters\r\nâ€¢ Buttons', 'W-FB-19-FM-191524', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_id` int(11) NOT NULL,
  `image_uri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_id`, `image_uri`) VALUES
(1, 'Cat-Banner-EASTERN_19.jpg'),
(2, 'product-2.jpg'),
(3, 'gls2-19-37_dp_1_.jpg'),
(3, 'gls2-19-37_dp_2_.jpg'),
(3, 'gls2-19-37_dp_3_.jpg'),
(4, 'product-3.jpg'),
(5, 'gls-18-08_2_.jpg'),
(6, '0a9a5224.jpg'),
(6, '0a9a5257.jpg'),
(6, '0a9a5266.jpg'),
(7, '_s5a1247.jpg'),
(8, '0a9a4997.jpg'),
(17, 'cm-yd-2452-cs-_3_.jpg'),
(18, '5cdc79bb0dc20.jpg'),
(18, '5cdc79bb24dcf.jpg'),
(19, 'cm-yd-2663_1_.jpg'),
(19, 'cm-yd-2663_2_.jpg'),
(19, 'cm-yd-2663_3_.jpg'),
(20, 'gls-19-115-_1_.jpg'),
(20, 'gls-19-115-_2_.jpg'),
(20, 'gls-19-115-_4_.jpg'),
(21, 'gls-19-119-_1__1.jpg'),
(21, 'gls-19-119-_2__1.jpg'),
(21, 'gls-19-119-_3__1.jpg'),
(25, '5cdc9f3091c19.jpg'),
(25, '5cdc9f30c7d09.jpg'),
(25, '5cdc9f30e83d8.jpg'),
(25, '5cdc9f3101940.jpg'),
(26, '5cdc6a1a3cc53.jpg'),
(26, '5cdc6a1a4cf2a.jpg'),
(26, '5cdc6a1a62930.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_summary` text NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`customer_id`, `product_id`, `review_summary`, `review`, `created_at`) VALUES
(1, 1, 'Hi Guys !!', '100% RECOMMENDED. Definitely one of the best brands in the market right now.', '2019-05-12 15:40:16'),
(1, 2, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem commodi amet veritatis, dolorum natus dolores ullam sit. Dolorum a delectus saepe ratione est soluta, nesciunt voluptates molestiae rerum tempora quas consequuntur, quos odit animi, cum eligendi earum sit corporis praesentium velit. Odit excepturi culpa fugiat, deleniti perspiciatis magni reiciendis porro.', '2019-05-12 02:00:14'),
(1, 6, 'Hi Guys !!', 'The best quality ever. 100% Recommended over any other brand in the market right now.', '2019-05-12 15:37:22'),
(1, 25, 'Hi Guys !!', 'This is awesome stuff!! 100% RECOMMENDED', '2019-05-15 15:09:41'),
(4, 2, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem commodi amet veritatis, dolorum natus dolores ullam sit. Dolorum a delectus saepe ratione est soluta, nesciunt voluptates molestiae rerum tempora quas consequuntur, quos odit animi, cum eligendi earum sit corporis praesentium velit. Odit excepturi culpa fugiat, deleniti perspiciatis magni reiciendis porro.', '2019-05-12 02:00:14'),
(5, 2, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem commodi amet veritatis, dolorum natus dolores ullam sit. Dolorum a delectus saepe ratione est soluta, nesciunt voluptates molestiae rerum tempora quas consequuntur, quos odit animi, cum eligendi earum sit corporis praesentium velit. Odit excepturi culpa fugiat, deleniti perspiciatis magni reiciendis porro.', '2019-05-12 02:00:14'),
(1, 25, 'Hi Guys !!', 'Absolutely', '2019-05-15 15:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `image_uri` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `slide_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `image_uri`, `link`, `slide_order`) VALUES
(1, 'banner-1.jpg', 'http://localhost/glamour/products/menu/3', 1),
(2, '5cdf102f45860.jpg', 'http://localhost/glamour/products/menu/2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `google_plus_link` varchar(255) NOT NULL,
  `vimeo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `email_id`, `logo`, `facebook_link`, `instagram_link`, `twitter_link`, `youtube_link`, `google_plus_link`, `vimeo_link`) VALUES
(1, 'Glamour', 'officials@glamour.com', '5cdd3ced5f324.jpg', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `submenu_images`
--

CREATE TABLE `submenu_images` (
  `submenu_item_id` int(11) NOT NULL,
  `image_uri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu_images`
--

INSERT INTO `submenu_images` (`submenu_item_id`, `image_uri`) VALUES
(1, 'pret-salt-home-cat_1.jpg'),
(2, 'gls-19-119-_2__1.jpg'),
(3, 'Cat-Banner-EASTERN_19.jpg'),
(4, 'gls-19-115-_2_.jpg'),
(7, '5cdc9c7bf0382.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `submenu_items`
--

CREATE TABLE `submenu_items` (
  `menu_item_id` int(11) NOT NULL,
  `submenu_item_id` int(11) NOT NULL,
  `submenu_item_name` varchar(255) NOT NULL,
  `submenu_item_order` int(11) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu_items`
--

INSERT INTO `submenu_items` (`menu_item_id`, `submenu_item_id`, `submenu_item_name`, `submenu_item_order`, `featured`) VALUES
(3, 1, 'Women', 2, 1),
(3, 2, 'Men', 3, 0),
(3, 3, 'Unstitched', 1, 1),
(3, 4, 'Ideas Home', 4, 0),
(1, 7, 'Lawn', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`administrator_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`,`cart_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `menu_images`
--
ALTER TABLE `menu_images`
  ADD UNIQUE KEY `menu_item_id` (`menu_item_id`,`image_uri`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `other_subscribers`
--
ALTER TABLE `other_subscribers`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_title` (`page_title`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD UNIQUE KEY `SKU` (`SKU`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_id`,`image_uri`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`product_id`,`size`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu_images`
--
ALTER TABLE `submenu_images`
  ADD PRIMARY KEY (`submenu_item_id`,`image_uri`);

--
-- Indexes for table `submenu_items`
--
ALTER TABLE `submenu_items`
  ADD PRIMARY KEY (`submenu_item_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`customer_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `administrator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `menu_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submenu_items`
--
ALTER TABLE `submenu_items`
  MODIFY `submenu_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
