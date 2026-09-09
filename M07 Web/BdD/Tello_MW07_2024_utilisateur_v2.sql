SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `utilisateur` (`idutilisateur`, `nom`, `prenom`, `email`, `naissance`, `pseudo`, `mdp`) VALUES
(2, '﻿Sébastien', 'Jacques', 'Sébastien.Jacques@yahoo.com', '1970-12-12', 'login2', 'mdp2'),
(3, '﻿Sophie', 'Humbert', 'Sophie.Humbert@yahoo.com', '1989-09-09', 'login3', 'mdp3'),
(4, '﻿Gabrielle', 'Roy', 'Gabrielle.Roy@yahoo.com', '1994-06-06', 'login4', 'mdp4'),
(5, '﻿Stéphane', 'Mace', 'Stéphane.Mace@yahoo.com', '2001-10-02', 'login5', 'mdp5'),
(6, '﻿Victoire', 'Deschamps', 'Victoire.Deschamps@yahoo.com', '1998-08-08', 'login6', 'mdp6'),
(7, '﻿Madeleine', 'Auger', 'Madeleine.Auger@yahoo.com', '1976-08-02', 'login7', 'mdp7'),
(8, '﻿Camille', 'Fernandes', 'Camille.Fernandes@yahoo.com', '1995-11-06', 'login8', 'mdp8'),
(9, '﻿Dominique', 'Munoz', 'Dominique.Munoz@yahoo.com', '1978-04-04', 'login9', 'mdp9'),
(10, '﻿Vincent', 'Joubert', 'Vincent.Joubert@yahoo.com', '1975-11-01', 'login10', 'mdp10'),
(11, 'Tom', 'Eigeri', 'tom.eigeri@yopmail.com', '1985-03-01', 'login11', 'mdp11'),
(12, 'Anne', 'Hemie', 'anne.hamie@yopmail.com', '1985-03-01', 'login12', 'mdp12'),
(13, 'Sarah', 'Freichie', 'sarah.freichie@yopmail.com', '1985-04-11', 'login13', 'mdp13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
