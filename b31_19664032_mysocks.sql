-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql211.byethost31.com
-- Generation Time: Jun 17, 2017 at 06:52 AM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b31_19664032_mysocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(2) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `category`) VALUES
(1, 'New'),
(2, 'Old'),
(3, 'Sale'),
(4, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `colorID` int(2) NOT NULL AUTO_INCREMENT,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`colorID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`colorID`, `color`) VALUES
(1, 'black'),
(2, 'blue'),
(3, 'brown'),
(4, 'gray'),
(5, 'green'),
(6, 'orange'),
(7, 'pink'),
(8, 'purple'),
(9, 'red'),
(10, 'white'),
(11, 'yellow'),
(12, 'rainbow');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faqID` int(11) NOT NULL AUTO_INCREMENT,
  `faqQuestion` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faqAnswer` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`faqID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faqID`, `faqQuestion`, `faqAnswer`) VALUES
(1, 'Do you have a physical store location?', 'We sure do! We hang our hat in our Downtown Belgrade, where we house thousands of pairs of socks to sell to locals.'),
(2, 'Which size sock should I order?', 'Luckily for you, we here at The Sock Drawer are sock sizing connoisseurs. Make sure you get the perfect fit for your feet by checking out our new sock sizing guide. Sigh, if only everything was this simple.'),
(3, 'Where are your socks made?', 'We have loads of manufacturers in different area codes. The Sock Drawer partners with businesses across the world, including right here in the good ole'' U S of A. check out our Made in the SRB collections.'),
(4, 'Can I order custom socks?', 'Unfortunately there isn''t enough coffee or chocolate in the world that could bribe us into taking custom sock orders at this time. Come back with a hefty amount of wine and some fine cheese - then maybe we could talk.'),
(5, 'I haven''t seen any verification email in my inbox.', 'Do not panic. We repeat, do not panic. First, check your spam folder. For some reason our amazing emails sometimes end up in the dump, but fear not. If you find the information you need there problem solved.'),
(6, 'How do I unsubscribe to the My socks Newsletter?', '<a href=''index.php?page=7''>Click here</a> to find out how to unsubscribe.');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `materialID` int(2) NOT NULL AUTO_INCREMENT,
  `material` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`materialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`materialID`, `material`) VALUES
(1, 'Nylon'),
(2, 'Polyester'),
(3, 'Cotton'),
(4, 'Wool');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE IF NOT EXISTS `meni` (
  `meniID` int(2) NOT NULL AUTO_INCREMENT,
  `meni` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`meniID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`meniID`, `meni`, `link`) VALUES
(1, 'HOME', 'index.php?page=1'),
(2, 'MEN''S SOCKS', 'index.php?page=11&forKid=0'),
(3, 'LADIES SOCKS', 'index.php?page=11&forKid=0'),
(4, 'KIDS SOCKS', 'index.php?page=11&forKid=1'),
(5, 'SALE', 'index.php?page=11');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `newsLetterID` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unsub` int(1) NOT NULL,
  PRIMARY KEY (`newsLetterID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`newsLetterID`, `email`, `unsub`) VALUES
(1, 'test@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE IF NOT EXISTS `orderhistory` (
  `orderHistoryID` int(10) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `productID` int(10) NOT NULL,
  `sizeID` int(2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `orderTime` int(12) NOT NULL,
  PRIMARY KEY (`orderHistoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orderhistory`
--

INSERT INTO `orderhistory` (`orderHistoryID`, `userID`, `productID`, `sizeID`, `quantity`, `orderTime`) VALUES
(1, 1, 1, 4, 1, 1486159215),
(2, 1, 1, 4, 6, 1486159305),
(3, 1, 2, 7, 5, 1486409274);

-- --------------------------------------------------------

--
-- Table structure for table `pattern`
--

CREATE TABLE IF NOT EXISTS `pattern` (
  `patternID` int(2) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`patternID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pattern`
--

INSERT INTO `pattern` (`patternID`, `pattern`) VALUES
(1, 'Animal'),
(2, 'Art'),
(3, 'Culture'),
(4, 'Dot'),
(5, 'Food & Drink'),
(6, 'Solid'),
(7, 'Stripes');

-- --------------------------------------------------------

--
-- Table structure for table `pollanswer`
--

CREATE TABLE IF NOT EXISTS `pollanswer` (
  `pollAnswerID` int(4) NOT NULL AUTO_INCREMENT,
  `pollAnswer` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pollQuestionID` int(4) NOT NULL,
  `vote` int(10) NOT NULL,
  PRIMARY KEY (`pollAnswerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pollanswer`
--

INSERT INTO `pollanswer` (`pollAnswerID`, `pollAnswer`, `pollQuestionID`, `vote`) VALUES
(1, 'Yes', 1, 3),
(2, 'No', 1, 1),
(11, 'beeee', 4, 0),
(12, 'ce', 4, 0),
(15, 'd', 4, 0),
(16, 'a', 4, 0),
(17, 'Da', 5, 0),
(18, 'Da', 5, 0),
(19, 'Da', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pollquestion`
--

CREATE TABLE IF NOT EXISTS `pollquestion` (
  `pollQuestionID` int(2) NOT NULL AUTO_INCREMENT,
  `pollQuestion` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onOff` int(1) NOT NULL,
  PRIMARY KEY (`pollQuestionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pollquestion`
--

INSERT INTO `pollquestion` (`pollQuestionID`, `pollQuestion`, `onOff`) VALUES
(1, 'Do you like our website?', 1),
(4, 'Test Questiona', 0),
(5, 'Da li volit Gorana?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pollvotes`
--

CREATE TABLE IF NOT EXISTS `pollvotes` (
  `pollVotesID` int(10) NOT NULL AUTO_INCREMENT,
  `pollQuestionID` int(4) NOT NULL,
  `pollAnswerID` int(4) NOT NULL,
  `ipAddress` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pollVotesID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pollvotes`
--

INSERT INTO `pollvotes` (`pollVotesID`, `pollQuestionID`, `pollAnswerID`, `ipAddress`) VALUES
(1, 1, 1, '::1'),
(2, 1, 1, '212.200.65.124'),
(3, 1, 2, '109.93.200.235'),
(4, 1, 1, '77.46.208.150');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(10) NOT NULL AUTO_INCREMENT,
  `productName` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(6) NOT NULL,
  `colorID` int(2) NOT NULL,
  `imgLink` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgAlt` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materialID` int(2) NOT NULL,
  `patternID` int(2) NOT NULL,
  `userAddID` int(10) NOT NULL,
  `timeProductAdd` int(12) NOT NULL,
  `timeLastChange` int(12) NOT NULL,
  `forMWK` int(1) NOT NULL,
  `categoryID` int(2) NOT NULL,
  `saleProcent` int(2) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `price`, `colorID`, `imgLink`, `imgAlt`, `description`, `materialID`, `patternID`, `userAddID`, `timeProductAdd`, `timeLastChange`, `forMWK`, `categoryID`, `saleProcent`, `quantity`) VALUES
(1, 'Trooper 2 Socks', 2199, 10, 'images/socks/1485987989trooper_2.jpg', 'StarWars Troopers 2', 'Admit it, the Empire music always gave you chills. Its OK. Its doesnt mean youve gone over to the Dark Side. It is pretty awesome.', 3, 3, 1, 1485982730, 1485987989, 1, 4, 0, 580),
(2, 'Darth Vader', 2500, 1, 'images/socks/1486405709darth_vader.jpg', 'Darth Vader socks image', 'Darth Vader, also known by his birth name Anakin Skywalker, is a fictional character in the Star Wars film franchise.', 4, 3, 1, 1486405709, 1486406149, 1, 3, 20, 150),
(3, 'Van Gogh Self Portrait', 1200, 2, 'images/socks/1486584775VanGogh_Self_Portrait.jpg', 'Van Gogh Self Portrait', 'With almost 40 self portraits of the talented artist, its no wonder that at least one of them made it onto a cool and colorful pair of socks like these. ', 4, 2, 1, 1486584775, 1486584775, 1, 1, 0, 222),
(4, 'Mona Lisa', 1200, 5, 'images/socks/1486584974mona_lisa.jpg', 'Leonardo Da Vincis Mona Lisa', 'With a smile that says I know something you dont know, Leonardo Da Vincis Mona Lisa is considered the most famous painting of all time. ', 1, 2, 1, 1486584974, 1486584974, 1, 1, 0, 52),
(5, 'Birth of Venus', 1200, 2, 'images/socks/1486585092birth_of_venus.jpg', 'Birth of Venus', 'Walk into the party like, what up, Im on a big shell. Depicting Venus, the goddess of love, emerging from the ocean by being blown by Zephyr.', 2, 2, 1, 1486585092, 1486585092, 1, 1, 0, 63),
(6, 'Starry Night', 1200, 2, 'images/socks/1486585186starry_night.jpg', 'Starry Night', 'This painting needs no introduction. Van Goghs famous Starry Night was painted from his view at the insane asylum, although he chose to omit the metal bars covering his window from the picture.', 3, 2, 1, 1486585186, 1486585186, 1, 1, 0, 45),
(7, 'Wheat Field with Cypress', 1200, 11, 'images/socks/1486585279wheat_field_with_cypress.jpg', 'Wheat Field with Cypress', 'You would never know from looking at Wheat Field with Cypresses that Vincent Van Gogh painted it during a bout with mental illness.', 1, 2, 1, 1486585279, 1486585279, 1, 1, 0, 45),
(8, 'The Scream', 1200, 9, 'images/socks/1486585357the_scream.jpg', 'The Scream', 'I scream, you scream, we all scream for Edvard Munchs modern interpretation of agony!', 2, 2, 1, 1486585357, 1486585357, 1, 1, 0, 39),
(9, 'Composition8 Masterpiece Series', 2500, 7, 'images/socks/1486586347somposition8_sasterpiece_series.jpg', 'Composition8 Masterpiece Series', 'Wassily Kandinsky was a master of taking simple forms and splashes of color and turning them into emotional expressions.', 3, 2, 1, 1486586347, 1486586347, 2, 3, 30, 66),
(10, 'Starry Night Knee High', 1400, 2, 'images/socks/1486586732starry_night_knee_high.jpg', 'Starry Night Knee High', 'Whether a storm is brewing or the sun is shining outside your window, looking down at your knee high socks, there will always be a Starry Night. ', 4, 2, 1, 1486586732, 1486586732, 2, 1, 0, 85),
(11, 'Mona Lisa', 1400, 1, 'images/socks/1486586820mona_lisa.jpg', 'Mona Lisa', 'With a smile that says I know something you dont know, Leonardo Da Vincis Mona Lisa is considered the most famous painting of all time.  ', 1, 2, 1, 1486586820, 1486586820, 2, 1, 0, 85),
(12, 'The Scream', 1400, 9, 'images/socks/1486586905the_scream.jpg', 'The Scream', 'I scream, you scream, we all scream for Edvard Munchs modern interpretation of agony! ', 2, 2, 1, 1486586905, 1486586905, 2, 1, 0, 33),
(13, 'David', 1400, 2, 'images/socks/1486586982david.jpg', 'David', 'Talk about a masterpiece! On these awesome David sculpture socks, Michelangelos 17foot depiction of the ideal male form is shrunken down to fit on your leg.', 2, 2, 1, 1486586982, 1486586982, 2, 1, 0, 41),
(14, 'Girl With a Pearl Earring', 1400, 8, 'images/socks/1486587064girl_with_a_pearl_earring.jpg', 'Girl With a Pearl Earring', 'At 350 years old, the Girl With a Pearl Earring doesnt look a day over 25! ', 3, 2, 1, 1486587064, 1486587064, 2, 1, 0, 37),
(15, 'Wheat Field With Cypress', 1400, 11, 'images/socks/1486587149wheat_field_with_cypress.jpg', 'Wheat Field With Cypress', 'Vincent van Goghs brilliance wasnt appreciated until after his death, and there is no way he ever imagined his art would end up on socks.', 1, 2, 1, 1486587149, 1486587149, 2, 1, 0, 37),
(16, 'Starry Night', 1400, 1, 'images/socks/1486587247starry_night.jpg', 'Starry Night', 'This painting needs no introduction. Van Goghs famous Starry Night was painted from his view at the insane asylum, although he rightfully chose to omit the metal bars covering his window from the picture.', 1, 2, 1, 1486587247, 1486587247, 2, 1, 0, 66),
(17, 'Lincoln', 1000, 1, 'images/socks/1486591117lincoln.jpg', 'Lincoln', 'Abraham Lincoln once said, In the end, its not the years in your life that count. Its the life in your years.', 1, 3, 1, 1486591117, 1486591117, 1, 1, 0, 125),
(18, 'Burger', 1150, 3, 'images/socks/1486591315burger.jpg', 'Burger', 'Ooey gooey cheese, crisp lettuce, ripe tomatoes, fresh onion, a toasted bun, and a juicy burger.', 2, 5, 1, 1486591315, 1486591315, 1, 1, 0, 125),
(19, 'Pug', 1000, 3, 'images/socks/1486591438pug.jpg', 'Pug', 'Did you know a pack of pugs is called a grumble. And you thought these little dogs couldnt get any cuter.', 3, 1, 1, 1486591438, 1486591438, 2, 1, 0, 124),
(20, 'Larimer Wool', 2395, 4, 'images/socks/1486591666larimer_wool.jpg', 'Larimer Wool', 'These unique Smartwool socks are far from the scratchy wool that once covered your Winter socks. ', 4, 6, 1, 1486591666, 1486591666, 1, 1, 0, 70),
(21, 'Cashmere Dot', 1800, 5, 'images/socks/1486591825cashmere_dot.jpg', 'Cashmere Dot', 'Threadbare socks in boring neutral colors really arent cutting it anymore.', 4, 4, 1, 1486591825, 1486591825, 2, 1, 0, 67),
(22, 'Super Juicy Knee High', 2199, 12, 'images/socks/1486591998super_juicy_knee_high.jpg', 'Super Juicy Knee High', 'Sometimes everybody needs to inject a little color into her life! Emerging through the clouds of boring socks are these awesome rainbow striped knee highs, perfect for brightening up a dull day! ', 3, 7, 1, 1486591998, 1486591998, 2, 4, 0, 100),
(23, 'Mermaid', 799, 2, 'images/socks/1486592335mermaid.jpg', 'Mermaid', 'Your little mermaid may be disappointed to be part of your world, stuck with two feet instead of one long tailfin, but at least these fun mermaid socks for kids can help!', 2, 3, 1, 1486592335, 1486592335, 3, 1, 0, 80),
(24, 'Stripe Bolt', 900, 2, 'images/socks/1486592396stripe_bolt.jpg', 'Stripe Bolt', 'Your little mermaid may be disappointed to be part of your world, stuck with two feet instead of one long tailfin, but at least these fun mermaid socks for kids can help!', 2, 7, 1, 1486592396, 1486592396, 3, 1, 0, 80),
(25, 'Bees Knees', 900, 11, 'images/socks/1486592472bees.jpg', 'Bees Knees', 'Although this fun saying may be lost on them, these sock are still the epitome of cool for your kids.', 1, 1, 1, 1486592472, 1486592472, 3, 1, 0, 97),
(26, 'Super Hero', 650, 2, 'images/socks/1486592807super_hero.jpg', 'Super Hero', 'Super cool, super awesome, super cute and now, super fashionable.', 2, 3, 1, 1486592807, 1486592807, 3, 1, 0, 45),
(27, 'Relatively Cute', 650, 6, 'images/socks/1486592905relatively_cute.jpg', 'Relatively Cute', 'For when those baby Einstein videos dont seem to be enough, cool baby Einstein socks are sure to do the trick.', 3, 3, 1, 1486592905, 1486592905, 3, 1, 0, 45),
(28, 'Cameow Knee High', 950, 7, 'images/socks/1486594051cameow_knee_high.jpg', 'Cameow Knee High', 'We all go through unique little phases as a kid, and for your kid its kittens.', 2, 2, 1, 1486594051, 1486594051, 3, 1, 0, 35),
(29, 'Cupcake Knee High', 950, 5, 'images/socks/1486594129cupcake_knee_high.jpg', 'Cupcake Knee High', 'Now that your little one isnt so little, they like to do grown up things like bake.', 3, 5, 1, 1486594129, 1486594129, 3, 1, 0, 92),
(30, 'One Small Step Knee High', 950, 11, 'images/socks/1486594220one_small_step_knee_high.jpg', 'One Small Step Knee High', 'Perfect for when your child is learning about Neil Armstrong in class, and learning to do the cool moon walk on the playground.', 4, 3, 1, 1486594220, 1486594220, 3, 1, 0, 92),
(31, 'Billy Jean', 1000, 10, 'images/socks/1486594295billy_jean.jpg', 'Billy Jean', 'Although Billy Jean may not be your lover you sure will love these cool, patterned socks that are perfect for your kid. ', 4, 7, 1, 1486594295, 1486594295, 3, 1, 0, 92),
(32, 'Shark Attack Knee High', 1000, 2, 'images/socks/1486594362shark_attack_knee_high.jpg', 'Shark Attack Knee High', 'Every child is naturally curious, so why not spark their interest in sea animals with these awesome knee high shark socks.', 2, 1, 1, 1486594362, 1486594362, 3, 1, 0, 92),
(33, 'Ice Cream Dream Knee High', 1000, 6, 'images/socks/1486594434ice_cream_dream_knee_high.jpg', 'Ice Cream Dream Knee High', 'I scream, you scream, we all scream for the perfect pair of soft serve socks make just for kids!', 4, 1, 1, 1486594434, 1486594434, 3, 1, 0, 125);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleID` int(2) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `role`) VALUES
(1, 'Administrator'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingbaglist`
--

CREATE TABLE IF NOT EXISTS `shoppingbaglist` (
  `shoppingBagListID` int(10) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `productID` int(10) NOT NULL,
  `sizeID` int(2) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`shoppingBagListID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shoppingbaglist`
--

INSERT INTO `shoppingbaglist` (`shoppingBagListID`, `userID`, `productID`, `sizeID`, `quantity`) VALUES
(3, 7, 13, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `sizeID` int(2) NOT NULL AUTO_INCREMENT,
  `size` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forKids` int(1) NOT NULL,
  PRIMARY KEY (`sizeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeID`, `size`, `forKids`) VALUES
(1, '0 - 4 y', 1),
(2, '5 - 10 y', 1),
(3, '11 - 15 y', 1),
(4, 'S', 0),
(5, 'M', 0),
(6, 'L', 0),
(7, 'XL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `statusID` int(2) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `status`) VALUES
(1, 'Verified'),
(2, 'Banned'),
(3, 'Waiting'),
(4, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleID` int(2) NOT NULL,
  `timeOfReg` int(12) NOT NULL,
  `verificationCode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusID` int(2) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `roleID`, `timeOfReg`, `verificationCode`, `statusID`) VALUES
(1, 'Goran', 'Urukalo', 'dev@dev.com', '6d145195c7fd2607327b79b546c48a32', 1, 1485624738, 'devgudevgudevgudevgu', 1),
(2, 'Pera', 'Peric', 'pera.peric@gmail.com', 'cb0e5b0cc394cc8377903407c5ea507c', 2, 1485959712, 'D9f7B7u2QjUuC6C2S2j3', 1),
(3, 'Nena', 'Nenic', 'nena.nenic@gmail.com', '5059c6ab4299fdfbe1710ec325b3d8ae', 2, 1485960326, 'nina1nina2nina3nina4', 1),
(4, 'Vera', 'Veric', 'vera.veric@gmail.com', '5a528a84b3f59f9706d9309a95d57307', 2, 1485961652, 'UOVPq1dfbKSee6157mxJ', 1),
(5, 'Milos', 'Milosevic', 'milos.milosevic@gmail.com', '8f5760430016bcaae1d6a2c2dc6638b8', 2, 1485963776, 'uvKERM6Yc9E0Mwk0h331', 3),
(6, 'Ana', 'Anic', 'ana.anic@gmail.com', '9350b345df58bf054f5adceb28b1d7c2', 2, 1485963802, 'VNpEpZe5Zr22k0o0F76w', 4),
(7, 'Nikola', 'Mihajlovic', 'nikola.mihajlovic@ict.edu.rs', '61a4992422b8b204a97a510c3b32be1a', 1, 1486995646, '8NT8C9Rs8wnKg4MDDf8S', 1),
(8, 'Proba', 'Proba', 'proba@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1487521237, 'vzBN62MGgI4u5sUjibJE', 3);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `visitID` int(50) NOT NULL AUTO_INCREMENT,
  `time` int(12) NOT NULL,
  PRIMARY KEY (`visitID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=281 ;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visitID`, `time`) VALUES
(6, 1486213914),
(7, 1486213984),
(8, 1486225089),
(9, 1486225544),
(10, 1486228189),
(11, 1486230660),
(12, 1486237565),
(13, 1486387787),
(14, 1486488052),
(15, 1486578381),
(16, 1486583952),
(17, 1486584031),
(18, 1486586604),
(19, 1486586605),
(20, 1486663027),
(21, 1486663027),
(22, 1486664908),
(23, 1486678201),
(24, 1486678203),
(25, 1486995284),
(26, 1486996248),
(27, 1486999065),
(28, 1487007859),
(29, 1487012279),
(30, 1487012284),
(31, 1487013858),
(32, 1487018607),
(33, 1487062676),
(34, 1487079762),
(35, 1487083072),
(36, 1487093506),
(37, 1487093507),
(38, 1487101004),
(39, 1487101333),
(40, 1487104093),
(41, 1487120057),
(42, 1487120057),
(43, 1487165297),
(44, 1487165297),
(45, 1487181614),
(46, 1487183709),
(47, 1487190693),
(48, 1487204808),
(49, 1487246087),
(50, 1487262909),
(51, 1487264967),
(52, 1487265668),
(53, 1487268775),
(54, 1487271159),
(55, 1487272999),
(56, 1487324927),
(57, 1487342909),
(58, 1487352174),
(59, 1487352174),
(60, 1487352211),
(61, 1487353628),
(62, 1487360640),
(63, 1487364153),
(64, 1487365859),
(65, 1487375598),
(66, 1487375598),
(67, 1487375608),
(68, 1487410277),
(69, 1487421933),
(70, 1487425658),
(71, 1487425694),
(72, 1487426603),
(73, 1487426747),
(74, 1487436663),
(75, 1487437695),
(76, 1487455826),
(77, 1487456567),
(78, 1487456640),
(79, 1487456704),
(80, 1487456705),
(81, 1487456706),
(82, 1487456748),
(83, 1487456808),
(84, 1487457492),
(85, 1487470580),
(86, 1487471953),
(87, 1487477881),
(88, 1487499878),
(89, 1487507897),
(90, 1487510753),
(91, 1487512360),
(92, 1487521111),
(93, 1487524805),
(94, 1487528115),
(95, 1487528199),
(96, 1487529390),
(97, 1487530578),
(98, 1487530578),
(99, 1487533456),
(100, 1487546002),
(101, 1487551893),
(102, 1487551893),
(103, 1487598195),
(104, 1487598195),
(105, 1487601130),
(106, 1487602389),
(107, 1487607181),
(108, 1487617444),
(109, 1487680577),
(110, 1487682026),
(111, 1487682026),
(112, 1487701598),
(113, 1487762363),
(114, 1487762363),
(115, 1487862294),
(116, 1487862294),
(117, 1487892943),
(118, 1487925522),
(119, 1487976638),
(120, 1488015022),
(121, 1488019074),
(122, 1488024303),
(123, 1488043377),
(124, 1488282645),
(125, 1488317153),
(126, 1488413152),
(127, 1488413767),
(128, 1488420889),
(129, 1488460572),
(130, 1488466687),
(131, 1488635124),
(132, 1488641200),
(133, 1488641201),
(134, 1488742061),
(135, 1488744227),
(136, 1488818645),
(137, 1488829301),
(138, 1488840666),
(139, 1488893133),
(140, 1488893133),
(141, 1489006087),
(142, 1489006087),
(143, 1489060754),
(144, 1489091482),
(145, 1489133408),
(146, 1489149916),
(147, 1489154488),
(148, 1489159939),
(149, 1489180791),
(150, 1489182686),
(151, 1489258782),
(152, 1489316170),
(153, 1489316171),
(154, 1489324636),
(155, 1489324636),
(156, 1489351407),
(157, 1489362466),
(158, 1489513883),
(159, 1489515874),
(160, 1489521183),
(161, 1489692945),
(162, 1489692945),
(163, 1489759461),
(164, 1489759461),
(165, 1489837682),
(166, 1489837682),
(167, 1489941196),
(168, 1489962015),
(169, 1490018549),
(170, 1490120663),
(171, 1490247972),
(172, 1490247972),
(173, 1490271048),
(174, 1490271053),
(175, 1490571588),
(176, 1490571588),
(177, 1490827982),
(178, 1490827982),
(179, 1490946669),
(180, 1490946687),
(181, 1490946735),
(182, 1490946766),
(183, 1491251473),
(184, 1491518527),
(185, 1491518527),
(186, 1491555903),
(187, 1491555903),
(188, 1491588010),
(189, 1491588029),
(190, 1491706168),
(191, 1491706226),
(192, 1491706245),
(193, 1491706245),
(194, 1491738964),
(195, 1491738964),
(196, 1492716563),
(197, 1492716569),
(198, 1492788185),
(199, 1492788185),
(200, 1492807537),
(201, 1493175151),
(202, 1493175151),
(203, 1493334581),
(204, 1493469873),
(205, 1493469878),
(206, 1493469885),
(207, 1493479273),
(208, 1493637289),
(209, 1493637295),
(210, 1493637298),
(211, 1493642365),
(212, 1493796044),
(213, 1493796047),
(214, 1493796710),
(215, 1493796713),
(216, 1494080094),
(217, 1494080097),
(218, 1494088119),
(219, 1494214370),
(220, 1494218703),
(221, 1494291220),
(222, 1494291225),
(223, 1494291231),
(224, 1494344417),
(225, 1494344429),
(226, 1494442843),
(227, 1494445610),
(228, 1494449325),
(229, 1494478332),
(230, 1494478335),
(231, 1494478530),
(232, 1494757344),
(233, 1494757348),
(234, 1494757361),
(235, 1494757364),
(236, 1494761038),
(237, 1494767228),
(238, 1494767234),
(239, 1494879269),
(240, 1494879282),
(241, 1494890005),
(242, 1494890022),
(243, 1494890031),
(244, 1494890032),
(245, 1495025858),
(246, 1495025870),
(247, 1495078549),
(248, 1495078555),
(249, 1495138730),
(250, 1495193324),
(251, 1495309383),
(252, 1495309388),
(253, 1495315298),
(254, 1495315312),
(255, 1495315481),
(256, 1495315542),
(257, 1495375174),
(258, 1495541194),
(259, 1495541199),
(260, 1495541205),
(261, 1495541208),
(262, 1495544883),
(263, 1495549944),
(264, 1495739832),
(265, 1495739838),
(266, 1495778264),
(267, 1495778428),
(268, 1495794712),
(269, 1495794716),
(270, 1495794721),
(271, 1495794721),
(272, 1495876812),
(273, 1495876812),
(274, 1496059955),
(275, 1496059961),
(276, 1496059967),
(277, 1497162587),
(278, 1497270357),
(279, 1497413559),
(280, 1497435959);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
