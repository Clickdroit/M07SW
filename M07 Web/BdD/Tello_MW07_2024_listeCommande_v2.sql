SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `listeCommande` (`idlisteCommande`, `nom`) VALUES
(1, 'command'),
(2, 'takeoff'),
(5, 'land'),
(6, 'emergency'),
(7, 'up'),
(8, 'down'),
(9, 'forward'),
(10, 'back'),
(11, 'cw'),
(12, 'ccw'),
(13, 'flip'),
(14, 'go'),
(15, 'curve'),
(16, 'NULL'),
(17, 'streamon'),
(18, 'streamoff'),
(19, 'emergency'),
(20, 'speed'),
(21, 'rc'),
(22, 'speed?'),
(23, 'battery?'),
(24, 'time?'),
(25, 'height?'),
(26, 'temp?'),
(27, 'attitude?'),
(28, 'baro?'),
(29, 'acceleration?'),
(30, 'tof?'),
(31, 'wifi?');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
