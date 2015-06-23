-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2015 at 12:23 AM
-- Server version: 5.5.43
-- PHP Version: 5.4.41-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `video_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre_tb`
--

CREATE TABLE IF NOT EXISTS `genre_tb` (
  `genre_id` int(2) NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `genre_tb`
--

INSERT INTO `genre_tb` (`genre_id`, `genre`) VALUES
(1, 'Romance'),
(2, 'Sci-fi'),
(3, 'Fantasy'),
(4, 'War'),
(5, 'Horror'),
(6, 'Comedy'),
(7, 'Adventure'),
(8, 'Mystery'),
(9, 'Action'),
(10, 'Political'),
(11, 'Historical');

-- --------------------------------------------------------

--
-- Table structure for table `lang_tb`
--

CREATE TABLE IF NOT EXISTS `lang_tb` (
  `lang_id` int(1) NOT NULL AUTO_INCREMENT,
  `lang` varchar(20) NOT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lang_tb`
--

INSERT INTO `lang_tb` (`lang_id`, `lang`) VALUES
(1, 'English'),
(2, 'Korean'),
(3, 'Japanese'),
(4, 'Chinese'),
(6, 'Taiwanese');

-- --------------------------------------------------------

--
-- Table structure for table `testing_tb`
--

CREATE TABLE IF NOT EXISTS `testing_tb` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `intro` longtext NOT NULL,
  `year` year(4) NOT NULL,
  `type_id` int(1) NOT NULL,
  `genre_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `type_tb`
--

CREATE TABLE IF NOT EXISTS `type_tb` (
  `type_id` int(1) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `type_tb`
--

INSERT INTO `type_tb` (`type_id`, `type`) VALUES
(1, 'Drama'),
(2, 'Movie'),
(3, 'Mini-Series'),
(4, 'Documentry'),
(5, 'Anime-drama');

-- --------------------------------------------------------

--
-- Table structure for table `video_genre_tb`
--

CREATE TABLE IF NOT EXISTS `video_genre_tb` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `video_id` int(4) NOT NULL,
  `genre_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `video_genre_tb`
--

INSERT INTO `video_genre_tb` (`id`, `video_id`, `genre_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 2),
(5, 2, 3),
(6, 3, 2),
(7, 4, 1),
(8, 4, 2),
(9, 5, 1),
(10, 5, 2),
(11, 5, 3),
(12, 6, 1),
(13, 6, 3),
(14, 6, 8),
(15, 7, 1),
(16, 7, 3),
(17, 7, 6),
(18, 8, 1),
(19, 8, 9),
(20, 9, 1),
(21, 9, 4),
(22, 9, 10),
(23, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `video_tb`
--

CREATE TABLE IF NOT EXISTS `video_tb` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `intro` longtext NOT NULL,
  `year` year(4) NOT NULL,
  `type_id` int(1) NOT NULL,
  `lang_id` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `video_tb`
--

INSERT INTO `video_tb` (`id`, `title`, `intro`, `year`, `type_id`, `lang_id`) VALUES
(1, 'Secret Garden ', 'The drama tells the story of Kim Joo Won (Hyun Bin), an arrogant and eccentric CEO who maintains the image of seeming perfection, and Gil Ra Im (Ha Ji Won), a poor and humble stuntwoman whose beauty and body are the object of envy amongst top actresses. Their accidental meeting, when Joo Won mistakes Ra Im for actress Park Chae Rin, marks the beginning of a tense, bickering relationship, through which Joo Won tries to hide a growing attraction to Ra Im that both confuses and disturbs him. To complicate matters further, a strange sequence of events results in them swapping bodies.', 2010, 1, 2),
(2, 'My Love From Another Star ', 'Do Min Joon is an alien who lands in the Joseon era, and then lives through the next four hundred years to the present day where he works as university professor and falls in love with a haughty top actress, Chun Song Yi. ', 2013, 1, 2),
(3, 'Continuum', 'A detective from the year 2077 finds herself trapped in present day Vancouver and searching for ruthless criminals from the future.', 2012, 1, 1),
(4, 'Beauty and the Beast', 'Beauty and the Beast was described as "a modern-day romantic love story with a procedural twist". Detective Catherine Chandler is a smart, no-nonsense homicide detective. Several years earlier, Catherine witnessed the murder of her mother at the hands of two gunmen. Catherine would have been killed too, but someone—or something—saved her. No one has ever believed her, but she knows it wasn''t an animal that attacked the assassins...it was human. Years have passed, and Catherine is a strong, confident, capable police officer, working alongside her equally talented partner, Tess. While investigating a murder, Catherine discovers a clue that leads her to a handsome doctor named Vincent Keller, who was reportedly killed by enemy fire while serving in Afghanistan in 2002. Catherine learns that Vincent is actually still alive and that it was he who saved her many years before. For mysterious reasons that have forced him to live outside of traditional society, Vincent has been in hiding for the past 10 years to guard his secret—when he is enraged, he becomes a terrifying beast, unable to control his super-strength and heightened senses. Catherine agrees to protect his identity in return for any insight he may have into her mother''s murder. Thus begins a complex relationship between Catherine and Vincent, who are powerfully drawn to each other yet understand that their connection is extremely dangerous for both of them.', 2012, 1, 1),
(5, 'Spider Man', 'When bitten by a genetically modified spider, a nerdy, shy, and awkward high school student gains spider-like abilities that he eventually must use to fight evil as a superhero after tragedy befalls his family.', 2002, 2, 1),
(6, 'Ghost in your Arms Again', 'Nanami Hoshino (Nanako Matsushima), a wealthy entrepreneur, marries Korean potter Kim Jun-ho (Song Seung-heon), and they both live a seemingly happy life. Then, one year after their marriage, Nanami is killed by a biker on her way home. This tragedy leaves Jun-ho completely devastated. At the hospital, Nanami’s ghost arises from her body, and upon meeting a ghost child (Mana Ashida), she realizes that she is a ghost whose presence cannot be seen. She then realizes that her death was no coincidence and Jin-ho is in imminent danger. Unable to communicate with normal humans, Nanami seeks help from the elderly psychic Unten (Kirin Kiki) in hopes of saving Jin-ho’s life.', 2010, 2, 3),
(7, 'The Familiar of Zero', 'Louise is a noble girl who is terrible at magic, as her attempts usually result in an explosion. She is nicknamed "Zero Louise" by her classmates, due to the inability to use any of the four magic elements. Early in the school year at the Tristain Academy of Magic, the second year students perform a special ritual where they summon their familiar, which serves as their eternal protector and partner, and is usually some sort of magical creature. But Louise summons Saito Hiraga, an ordinary teenage boy from Japan, leaving her totally humiliated.', 2006, 5, 3),
(8, 'City Hunter ', '‘City Hunter’ is an original script based on the world-famous novel by Japan’s Tsukasa Hojo. Since it became public that Korea would be the first remake of this story into a drama, ‘City Hunter’ has been receiving worldwide attention. ‘City Hunter’ has switched the setting from Tokyo 1980 to Seoul 2011, and according to the original story structure, the protagonist becomes a city hunter and his character develops while resolving gratifying', 2011, 1, 2),
(9, 'Empress Ki ', 'A Historical drama depicts the love and battle of a woman in Goryeo Dynasty who becomes the conqueror of Yuan Empire. ', 2013, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
