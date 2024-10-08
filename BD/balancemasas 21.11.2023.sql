-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 14:44:35
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `balancemasas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_componentes`
--

CREATE TABLE `balancemasas_componentes` (
  `id_componente` int(11) NOT NULL,
  `numeroComponente` varchar(200) NOT NULL,
  `descripcionComponente` varchar(200) NOT NULL,
  `unidad` varchar(100) NOT NULL,
  `PesoResinaRealGR` double NOT NULL,
  `RamalPorcentaje` double NOT NULL,
  `ScrapRealPorcentaje` double NOT NULL,
  `PesoRecinaKilogramos` double NOT NULL,
  `PesoScrapKilogramos` double NOT NULL,
  `FechaEdicion` date NOT NULL,
  `estadoComponente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_componentes`
--

INSERT INTO `balancemasas_componentes` (`id_componente`, `numeroComponente`, `descripcionComponente`, `unidad`, `PesoResinaRealGR`, `RamalPorcentaje`, `ScrapRealPorcentaje`, `PesoRecinaKilogramos`, `PesoScrapKilogramos`, `FechaEdicion`, `estadoComponente`) VALUES
(1, '100211', 'prueba componente', 'GR', 1.09, 1.19, 1.21, 1.55, 2.65, '2023-11-20', 1),
(2, '326028198', 'COPOLIMERO DE PROPENO/ETENO (CP401HC)', 'GR', 303.61, 0, 0.9, 0.304, 0.307, '2023-11-21', 1),
(3, '004259220', 'PP HOMO 40% TALCO BAIXA FLUIDEZ', 'GR', 303.61, 0, 0.9, 0.304, 0.307, '2023-11-21', 1),
(4, '326033002', 'PP CROMEX BLANCO', 'GR', 18.8, 0, 0.9, 0.0188, 0.019, '2023-11-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_estados`
--

CREATE TABLE `balancemasas_estados` (
  `id` int(11) NOT NULL,
  `descripcionEstado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_estados`
--

INSERT INTO `balancemasas_estados` (`id`, `descripcionEstado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_inyecciones`
--

CREATE TABLE `balancemasas_inyecciones` (
  `idInyeccion` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `IdProveedor` int(11) NOT NULL,
  `FechaInyeccion` datetime NOT NULL,
  `PesoResinaKG` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_materiales`
--

CREATE TABLE `balancemasas_materiales` (
  `id_material` int(11) NOT NULL,
  `materialid` varchar(50) NOT NULL,
  `denominacion` varchar(200) NOT NULL,
  `FechaEdicion` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_materiales`
--

INSERT INTO `balancemasas_materiales` (`id_material`, `materialid`, `denominacion`, `FechaEdicion`, `estado`) VALUES
(2, 'W10686587', 'ANEL HIDRO INFERIOR HCB (BLANCO)', '2023-11-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_materialescomponentes`
--

CREATE TABLE `balancemasas_materialescomponentes` (
  `MaterialID` int(11) NOT NULL,
  `ComponenteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_materialescomponentes`
--

INSERT INTO `balancemasas_materialescomponentes` (`MaterialID`, `ComponenteID`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4);

-- -----------------------------D� ��V e r  s i o n  = 1  
 E v �n t  T y p ,= �A P C R $�S H�i mN1 3 6 7 9 4 8 4� 2 &5 3v�R Zp ur
e2zC�s !��	1I� di f �Š= b 0 7 �5 }5 - ye �a 	4 d �- %�f�- 8�U0�z�d�5�0�AI���t�1g��a�Qo�Q�@c a�-5�1a׀&�@�I7�z-���9�Ea�K3 c�U�b2�b�1�
c��6�K��W��w���4��o��t��3�"��d4�Q�G u�U�s�S=�d3� N�bA��p N�K��x��p�
-�5A}t@6�o l .@x� ��CS@s�C���i@S=@60� b��f@$-Db@4A�~�-@b8@V2�9�$�0@70�%�cd� A]EAT�r g@t@��%�v= W :kD��1B3Dw�SbU�2@#d@11�sfU@8�}6@	f@1]�3B C+A9�4T !D0@3@XbU�6�'a@bc@7Q@7 5@ 1@1[@A+1@/Ap1@6U�4@ f@d�5�@!6@! �WO=C�F=�AI1 /@ 0�@�6@C1�2:�8Z:@	7B1�B��oW@��VA�9�9�7M`	9 o1s �1�""8`%cs F�6�t` lf�acs�J!J]!w.�e��US�tg� [�$]`M'RN`*m`(r�1 `+e � �Qa� a�	l�u�jc� �`r�+	V;��_=�/�f�1 �+c0��!ic	iv3�a 0� #'�2u�M r Ha!� �`'i�!m�)��c{��R6��ᱩ3�,o1l�0m ��2�u�2o�c�5n� �e��r`�6s�*�
�i�b�4��2����
�w45l4e�#~ ��%i�i�56u�C"3i�!3cGeU�`c�Gp`>i�n�j3#�c9R5�Z7�DpQ>l+z�0 mP9e�r���?���2�Eb�H��Dp�n�c �:�l�!�CS O2?�U:1�.2 26�V1;2R;u5�Rz.S8��	]=�S.�p2SS3��g�zr��M p4eSvaP$��!���=90��?[�F�	nn�mza�P>iR#Q\� 0g����1c�\_W]G}��f�D���!�!2W�]�b�0pl0�p 3�	f�0P�
�qc�a0q ���эe��}Jsd^ ��J7�
3�_W=K��Q6�T�3z_'S'_J��Fa�;�a�A8�a0
Q���50d�c�3��q��q fpqU�[�+�]P�C�\�{� ���1N�Lp#�q�M� �d�5lps�= ��h�
 �oe���DuWN DG�Wp!\0 Y0 TԢM2 \�Qd0=��s ����:��VyиQ�m�K�R�нE�
�.�L� �?o|�7??�\ 9B��E�Q��Q,s1�e�H�uЏ.l�P�_��)??3m�vANp _ w�kn�P�Qs__Su�q�b����?�q_??3�dQ�ae7__�+8�|�� N D O W S \ 0y s  t e m 3 2 �R P C  R T 4 . d l  
 �L o a <e "M d u 2e �[ 9 ] = f�: zW I ��bv Ip iq#c1 0*em �v c� r �%a1�0s���c h�����12�1�b�`y p�b3�0�u�Ie@I�~�04j*w�ynBzu�1 �5jG��I�6�Vg@�êf¼l�17��o��ib8�s@��e�l%f{1�{`S��c�am�%l g{��2�{�!!rg`p�Va�2 �{��SD H �W A��I[�=�[���{Y��T E M"#\ nm�t?��o *��2W����v�r�|i� 3n?�!y|W"z(S x�\� 8 �6 _��i��o`Ho f�5. cdU w�.�o�mU"-�n�r�l�_�5�M5 bU 4 64`�c�f�`d`
!.`E.b-*6� 1 3��2 �7`n"e 6�*b�7 '7�8 �8�!3 c �#U�c��ag�2|��/# s �o��Ur v� ;�2��nI`Du�J.`�L W��I\p?0 k Y F�AW�{gPK JUX�UpV�Z�B Gra UU�u�1p�,q�JE�Rp s k�G�O B�L ?M \���#S ��WU��6�\�m0Am�pJ\00�G\��dpO3\p.0�5p00 1�030 �\��mp	m	vp�_AdPd�4T��w�PpADPLP��"��N�QS ;J�2qC o?�5�T�9��n�P2�90 S1P3�6Pt�;[�W��2S�M�"Lp��,�]WWw� k�c�.i���_��y�8�=c�a�0?��i,?�5��Mt09_?1�\�7sr8�ou�?t҂~mP3??1_�7S��CS0:wk�r2p���pa?}�l�����b�r�UѴP0�i�,i�Bi��XeQ_���&t�� �����I�_Ws�A_-�S_-^3���c_-Պi�,h�P3p���[P]�?�wT�x0S�'�3n�R����@�շR0FCp�Ep���F_Q_�_WU0c�P��qT�F40S�@�u��ѓ30 [ t� 4 4 ] =  C : \ W �I N D O HS xS y s  t e m 3 2 Dc l b c a Tq . d l  
 (L o *d Vd "M d u 6e �[ �5�scd]*a Ix ih n g %m6*mt wP i n�2p�.E�p�;o r�97�9S Y S T\ E�����8d��w���.���7a�s8�9�t��p�ks��9Z͇N@:I�5 0[j0��x��Akp@�t� f�ha��e�p�Ojkf1jC@jA�MUBNs��gg�2��U���m p@ �n@n�?�n5����QM�C R UP UBT A�8E�D�zL��{5|��D��M jP�.��L`;�5� 9���i`Bcih`�vp�4 +[`9��d� �g h`l�3��a�5 ?�)�D U���e�\������Jl`Jh�in �gOU I �f`O[bu.T K�y��v� r��,j�CqV�dl�
�e�1�a<��po
w�{ui
00�l-
b�`@dv)
2`�6�fZ1�3 x'u`?r�i
3�J9`
/!��ms I5�
qad�	za`Fc�S�	��	9�� �0�lqi�~�s�2�5 8o?�/71}opT�[S�Y5 _[P]��=U)s,uT��40��n�	�ym0,��(oP��9�	[0�1n7pPopsp1�ip7e�
6�2�I�1��a5�~_�U��9�4p�4C� �1�3�[�*Q�4�sP_
1P3�����4tpIsp%1�j�. 
1?2�&9/�6 91���u&o�QQ!��y0�?6�!�[6iPU�U?v19�1�/1 �K2��.�7-p Q0�~0��h�)1�t��^s?��_Q�hWr4m��s��6�
��1�9�s v�
l�z����94P5�P+;:�ѹm�]t��_�3���
3hd?��9��0P'0P��q/����:ѷ�2�47�.sb�9�d1?�U�n�7_e�Be��sP-�2�8�Q�kp3>y�'[p[�7Uw�t��s��n����:���:�b��?�"{8�b�a�l�bh?���8q�8��� m i n  �
 O s I � f o [ 2  8 ] . V  a l u e �= 0�9NK B�y Fo �v rVU	�1 U.2 s6 1 u3 5 9 3 	a m d  6 4 f rE W. �i _l� a oe '=0 5�0 +- 1 G5 U]�3 ��b�mi�pd�/l��g ht t�d�_���6Q��C E�P8�=DD C�9 -�1�4�8�HF 7��9�k�m4 A�o�E�8�B�`1�8�1��e��i�Oo��W�n��PP��o�ne���s�l���2J�r@n g�%C
��R@ct@�AS�3L2xx p��Y�
IMP D :@u8@MB�NE F , M��]AA�Q9@v5@�GE@9�3�A[CE2@�)4�)ft c��nV*CI*2U�"7�~2@z8� ,��%,��;@$5����A�2�00� 1�[AA�0@	��7B,�@0�K9��C�A�A4@1BO2@�:7�7�C�1 �a9 4`
�S���0��3�9�!w�a,a3`�g4m�0`a^7f#;��$�u�d�`!!�!a�z3�6`g��9]`g1�
!&+4�1��5� !��7��z��#1 6�0"W��!3�;1�5Wd4'�5`2�6[�g2 �2 4ծ3�3�0` �F�aa44�	a9�G� �m3`� 9�8(}e7��cd�,!4�`!-#c�!�:7��7 �?mc��Y�!��aaU!*�iCaa���
+!7�G��/�U��)!Z3��0�5 "�1�/4`!�!ai%{�!�0bY�V�,!J8�7�/8a��!)�5���4�#g%��;a&�/Ga�t�!�;!����6�M!4�)�����.��,M0����;48�S	�5���J�2�W	��1G8���03��1 ��4+��#�yQV1��,uQ�5����Nq+:+��U�8�QPZ=�TQ��d60@q<��W	Q�YS�;����#��W	���c�40A�0QQ��,q�I0p�lu�H�#1/���'����.�����qe�c�=���$:7��3�J���N>�#S/�0�!���:�s ��PQ3��qhQ2Q��p�:�{QQ!40K?G�Q6��'��Q�Q4��#�u���6�i[	SR	�E�����q�2�e��9����.���Yq����qX�󚓨n0�Q�_�[�46��t y�0�e��R89q�u�v��_Ա��U�sr�vP�c0 1�Q�p���gP ����q	�ū�[�f�ap�u��uPd��tPp0 �nR�Q�b�o�o�� ��FP��[�0(C�b NP Zm�=0��ipu�� p��Q�mpQ��Pptp�= W�R�aPc�Hbp��W-t 2�4 bUpc� b�c�p-�Px@2pfp-6p �a��5�t�p�1ͪeP�0#F��ap��s��1L�F�W6���T�$=P.��Q*&g���. 7\ �\ ?0 C��\pnr�1 ��D��.\���i�ʱs�f��\�Qd� w��� �E R�T��F� E R . a  e c 6 b �f 3 7 -8�2 H4 T3 t- �0 5 L7 0 ��2 �f 1 a 2 5 �t m "p m d �
 F i l �*[ V] 6C Zb 
N 
m *= W A�I n t rU a /M t #d# . x Ql �QP#h K. �Z6 �a �8�a+ ��4 Yb �- �8 �f 9�b�hd 4�e��d]�e�V�h�RF�ja g s�S3 2��6�@2�hT y��e�5�O rՀ�g�n�}l�S�� \ \ ?�C �:�P�o�:r�m D���\ ME�c�s o�=tU�
W�d�w@)\�Df\ T@L�uE�W�4��3@.�|C��