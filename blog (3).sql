-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 04:18 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(9, 'Html'),
(10, 'Css'),
(11, 'Javascript'),
(12, 'Python'),
(13, 'Php');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `message`, `status`) VALUES
(1, '13', 'John Doe', 'Hey, This is a another test comment to your blog ... i love you Leblib', 'Approve'),
(2, '13', 'Caleb Joseph', 'This is a dummy blog post', 'Approve'),
(3, '12', 'Mark West', 'This is another Comment for this post', 'Approve'),
(4, '14', 'Chika Okorie', 'This is a wonderful content you have here, I look forward to you building my companies website', 'Approve'),
(6, '13', 'Mark Smith', 'my name is Mark Smith i really love your contents', 'Approve'),
(7, '15', 'JohnDoe', 'This is a dummy comment', 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT ' uncategorized',
  `views` varchar(255) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Draft',
  `image` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT 'Leblib',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `category`, `views`, `body`, `status`, `image`, `author`, `created_at`, `updated_at`) VALUES
(9, NULL, 'This Is A Css Post ', 'Css', '0', 'CSS stands for Cascading Style Sheets with an emphasis placed on “Style.” While HTML is used to structure a web document (defining things like headlines and paragraphs, and allowing you to embed images, video, and other media), CSS comes through and specifies your document’s style—page layouts, colors, and fonts are all determined with CSS. Think of HTML as the foundation (every house has one), and CSS as the aesthetic choices (there’s a big difference between a Victorian mansion and a mid-century modern home).\r\n\r\n', 'publish', '5e948a439e3350.94831554.jpg', 'Leblib', '2020-04-13 15:50:27', '2020-04-18 12:52:59'),
(10, NULL, 'What Is Javascript', 'Javascript', '0', 'JavaScript was initially created to “make web pages alive”.\r\n\r\nThe programs in this language are called scripts. They can be written right in a web page’s HTML and run automatically as the page loads.\r\n\r\nScripts are provided and executed as plain text. They don’t need special preparation or compilation to run.\r\n\r\nIn this aspect, JavaScript is very different from another language called Java.', 'publish', '5e948a67dbf492.88130418.jpg', 'Leblib', '2020-04-13 15:51:03', '2020-04-18 12:52:56'),
(11, NULL, 'This Is An Uncatigorised Post', 'uncategorised', '0', 'Lorem ipsum eque Lorem ipsum eque Lorem ipsum eque Lorem ipsum eque ', 'publish', '5e948a80c8b7d9.59938835.jpg', 'Leblib', '2020-04-13 15:51:28', '2020-04-18 12:52:53'),
(12, NULL, 'What Is Python', 'Python', '0', 'Python is an interpreted, object-oriented, high-level programming language with dynamic semantics.\r\n\r\nIt has built-in data structures, combined with dynamic typing and dynamic binding, making it very attractive for rapid application development, scripting, or as a glue language to connect existing components together.\r\n\r\nPython was originally created in 1991 by Guido van Rossum.\r\n\r\n<b>Main uses of Python:</b>\r\n<ul>\r\n<li>Server-side web development</li>\r\n<li>Software development</li>\r\n<li>System scripting</li>\r\n<li>Machine learning</li>\r\n</ul>\r\n', 'publish', '5e94a799d20014.87212789.jpg', 'Leblib', '2020-04-13 17:55:38', '2020-04-18 12:52:49'),
(13, NULL, 'Basic Html Elements', 'Html', '0', '<b>The basic elements of an HTML page are:</b>\r\n\r\n<li>A text header, denoted using the <h1>, <h2>, <h3>, <h4>, <h5>, <h6> tags.</li>\r\n<li>A paragraph, denoted using the <p> tag.</li>\r\n<li>A horizontal ruler, denoted using the <hr> tag.</li>\r\n<li>A link, denoted using the <a> (anchor) tag.</li>\r\n<li>A list, denoted using the <ul> (unordered list), <ol> (ordered list) and <li> (list element) tags.</li>\r\n<li>An image, denoted using the <img> tag</li>\r\n<li>A divider, denoted using the <div> tag</li>\r\n<li>A text span, denoted using the <span> tag</li>\r\nThe next few pages will give an overview of these basic HTML elements.\r\n\r\nEach element can also have attributes - each element has a different set of attributes relevant to the element. There are a few global elements, the most common of them are:\r\n<ul>\r\n  <li>id - Denotes the unique ID of an element in a page. Used for locating elements by using links, JavaScript, and more.</li>\r\n <li> class - Denotes the CSS class of an element. Explained in the CSS Basics tutorial.</li>\r\n <li> style - Denotes the CSS styles to apply to an element. Explained in the CSS Basics tutorial.</li>\r\n <li> data-x attributes - A general prefix for attributes that store raw information for programmatic purposes. Explained in detailed in the Data Attributes section.</li>\r\n</ul>\r\n<h2>Text headers and paragraphs</h2>\r\nThere are six different types of text header you can choose from, h1 being the topmost heading with the largest text, and h6 being the most inner heading with the smallest text. In general, you should have only one h1 tag with a page, since it should be the primary description of the HTML page.\r\n\r\nAs we\'ve seen in the last example, a paragraph is a block of text separated from the rest of the text around it.\r\n\r\nLet\'s see an example of the <h1>, <h2> and <p> tags in action:\r\n\r\n\r\n   ', 'publish', '5e9607add75b25.72752637.jpg', 'Leblib', '2020-04-14 18:57:49', '2020-04-18 12:52:46'),
(14, NULL, 'Hyper Text Markup Language', 'Html', '0', 'HTML stands for Hypertext Markup Language. It allows the user to create and structure sections, paragraphs, headings, links, and blockquotes for web pages and applications.\r\n\r\nHTML is not a programming language, meaning it doesn’t have the ability to create dynamic functionality. Instead, it makes it possible to organize and format documents, similarly to Microsoft Word.\r\n\r\nWhen working with HTML, we use simple code structures (tags and attributes) to mark up a website page. For example, we can create a paragraph by placing the enclosed text within a starting <p> and closing </p> tag.', 'publish', '5e9607d3bce623.97054572.jpg', 'Leblib', '2020-04-14 18:58:27', '2020-04-18 12:52:44'),
(15, NULL, 'What Is Php', 'Php', '0', '\r\nWhat is PHP?\r\nPHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages.\r\n\r\nPHP scripts can only be interpreted on a server that has PHP installed.\r\n\r\nThe client computers accessing the PHP scripts require a web browser only.\r\n\r\nA PHP file contains PHP tags and ends with the extension \".php\".', 'publish', '5e98ec3595b839.52353615.jpg', 'Leblib', '2020-04-16 23:37:25', '2020-04-18 12:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Guest',
  `created_at` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
(3, 'Caleb Joseph', 'chislimjoe12@gmail.com', '$2y$10$KfG64XDYeUFAP5KSqb7yCOlVTDQkRYaxsBuaqpJucGuuDywp/AqO6', '08132565989', 'Guest', '2020-04-18 14:05:16'),
(10, 'Leblib', 'info@leblib.com', '$2y$10$Zo.2oW/pvYkRw5dRT/QNj.fZU546s0E6py./xnNKnvJmA9HokbBDe', '08132565989', 'Guest', '2020-04-18 14:59:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
