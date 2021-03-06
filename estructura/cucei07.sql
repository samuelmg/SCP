--
-- Base de datos: `cucei07`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_benef`
--

CREATE TABLE IF NOT EXISTS `tbl_benef` (
  `benef_id` int(5) NOT NULL AUTO_INCREMENT,
  `benef` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`benef_id`),
  UNIQUE KEY `benef` (`benef`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1199 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cheques`
--

CREATE TABLE IF NOT EXISTS `tbl_cheques` (
  `fecha` date NOT NULL,
  `cta_b` smallint(5) NOT NULL,
  `cheque` mediumint(5) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `cta` mediumint(5) NOT NULL,
  `benef_id` int(5) NOT NULL,
  `monto` double(12,3) NOT NULL,
  `obs` varchar(80) DEFAULT NULL,
  `id` char(10) NOT NULL DEFAULT '',
  `estatus` char(15) DEFAULT NULL,
  `oficio` char(20) DEFAULT NULL,
  `seguimiento` varchar(30) DEFAULT NULL,
  `responsable` char(10) DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  PRIMARY KEY (`cta_b`,`cheque`,`proy`,`cta`,`id`),
  KEY `proy` (`proy`),
  KEY `cta` (`cta`),
  KEY `benef_id` (`benef_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cheques_4448`
--

CREATE TABLE IF NOT EXISTS `tbl_cheques_4448` (
  `fecha` date NOT NULL,
  `cheque` mediumint(5) NOT NULL,
  `benef_id` int(5) NOT NULL,
  `monto` double(11,3) DEFAULT NULL,
  `concepto` char(10) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `destino` char(10) NOT NULL,
  PRIMARY KEY (`cheque`,`concepto`),
  KEY `benef_id` (`benef_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cta_b`
--

CREATE TABLE IF NOT EXISTS `tbl_cta_b` (
  `cta_b` smallint(5) NOT NULL,
  `d_cta_b` char(20) NOT NULL,
  PRIMARY KEY (`cta_b`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cuentas`
--

CREATE TABLE IF NOT EXISTS `tbl_cuentas` (
  `cta` mediumint(5) NOT NULL,
  `d_cta` char(45) NOT NULL,
  PRIMARY KEY (`cta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_egresos`
--

CREATE TABLE IF NOT EXISTS `tbl_egresos` (
  `fecha` date NOT NULL,
  `tipo` char(20) NOT NULL,
  `monto` double(12,3) DEFAULT NULL,
  `no_t` char(20) NOT NULL,
  `benef_id` int(5) NOT NULL,
  `cta_b` smallint(5) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `cta` mediumint(5) NOT NULL,
  `id` char(10) DEFAULT NULL,
  `cmt` varchar(40) DEFAULT NULL,
  `estatus` char(15) DEFAULT NULL,
  `oficio` char(20) DEFAULT NULL,
  `seguimiento` varchar(30) DEFAULT NULL,
  `responsable` char(10) DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  KEY `tipo` (`no_t`),
  KEY `proy` (`proy`),
  KEY `cta` (`cta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ejes`
--

CREATE TABLE IF NOT EXISTS `tbl_ejes` (
  `eje` smallint(3) NOT NULL,
  `d_eje` char(25) NOT NULL,
  PRIMARY KEY (`eje`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fondos`
--

CREATE TABLE IF NOT EXISTS `tbl_fondos` (
  `fondo` mediumint(6) NOT NULL,
  `d_fondo` char(20) NOT NULL,
  `tipo` char(5) NOT NULL,
  PRIMARY KEY (`fondo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gxc`
--

CREATE TABLE IF NOT EXISTS `tbl_gxc` (
  `invoice` mediumint(7) NOT NULL,
  `t` mediumint(7) NOT NULL,
  `fecha` date NOT NULL,
  `cargo` double(12,3) NOT NULL,
  `abono` double(12,3) NOT NULL,
  `saldo` double(12,3) NOT NULL,
  `d_t` varchar(60) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  PRIMARY KEY (`t`,`invoice`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ingresos`
--

CREATE TABLE IF NOT EXISTS `tbl_ingresos` (
  `fecha` date NOT NULL,
  `monto` double(12,3) DEFAULT NULL,
  `tipo` char(20) NOT NULL,
  `cta_b` smallint(5) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `cta` mediumint(5) NOT NULL,
  `id` char(10) DEFAULT NULL,
  `cmt` varchar(40) DEFAULT NULL,
  KEY `tipo` (`tipo`),
  KEY `proy` (`proy`),
  KEY `cta` (`cta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_participables`
--

CREATE TABLE IF NOT EXISTS `tbl_participables` (
  `id` char(10) NOT NULL,
  `benef_id` int(5) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `monto` double(12,3) NOT NULL,
  `t` mediumint(7) DEFAULT NULL,
  `obs` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`proy`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programas`
--

CREATE TABLE IF NOT EXISTS `tbl_programas` (
  `prog` mediumint(6) NOT NULL,
  `d_prog` char(50) NOT NULL,
  PRIMARY KEY (`prog`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proyectos`
--

CREATE TABLE IF NOT EXISTS `tbl_proyectos` (
  `ures` mediumint(6) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `d_proy` char(45) NOT NULL,
  `monto` double(12,3) DEFAULT NULL,
  `fondo` mediumint(6) NOT NULL,
  `quin` smallint(2) NOT NULL,
  `prog` mediumint(6) NOT NULL,
  `eje` smallint(3) NOT NULL,
  PRIMARY KEY (`proy`),
  KEY `fk_proyectos_ures` (`ures`),
  KEY `fk_proyectos_fondo` (`fondo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_quincenas`
--

CREATE TABLE IF NOT EXISTS `tbl_quincenas` (
  `proy` mediumint(6) NOT NULL,
  `cta` mediumint(5) NOT NULL,
  `quin` smallint(2) NOT NULL,
  `monto` double(12,3) DEFAULT NULL,
  PRIMARY KEY (`proy`,`cta`,`quin`),
  KEY `cta` (`cta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recursos`
--

CREATE TABLE IF NOT EXISTS `tbl_recursos` (
  `proy` mediumint(6) NOT NULL,
  `cta` mediumint(5) NOT NULL,
  `monto` double(12,3) NOT NULL,
  `t` mediumint(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`proy`,`cta`,`t`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_req`
--

CREATE TABLE IF NOT EXISTS `tbl_req` (
  `n_req` varchar(10) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `cta` mediumint(5) NOT NULL,
  `monto` double(12,3) DEFAULT NULL,
  `id` char(10) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`n_req`),
  KEY `proy` (`proy`),
  KEY `cta` (`cta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipos`
--

CREATE TABLE IF NOT EXISTS `tbl_tipos` (
  `tipo` char(20) NOT NULL,
  PRIMARY KEY (`tipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_transferencias`
--

CREATE TABLE IF NOT EXISTS `tbl_transferencias` (
  `t` mediumint(7) NOT NULL,
  `invoice` mediumint(7) NOT NULL,
  `fecha` date NOT NULL,
  `monto` double(12,3) NOT NULL,
  `d_t` varchar(60) NOT NULL,
  `proy` mediumint(6) NOT NULL,
  `d_inv` char(15) DEFAULT NULL,
  `cta_b` smallint(5) NOT NULL,
  PRIMARY KEY (`t`,`invoice`),
  KEY `proy` (`proy`),
  KEY `cta_b` (`cta_b`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ures`
--

CREATE TABLE IF NOT EXISTS `tbl_ures` (
  `ures` mediumint(6) NOT NULL,
  `d_ures` char(50) NOT NULL,
  PRIMARY KEY (`ures`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
