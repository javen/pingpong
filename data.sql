-- +++++++++++++++++++++++++++ '结果'属性表 ++++++++++++++++++++++++++++++
-- agroup: Kou Xiaodong, Javen Chen, Jack Liu, Adam Kong
-- start_time: 开始时间
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `a_group` varchar(250) DEFAULT NULL,
    `b_group` varchar(250) DEFAULT NULL,
    `c_group` varchar(250) DEFAULT NULL,
    `d_group` varchar(250) DEFAULT NULL,
    `e_group` varchar(250) DEFAULT NULL,
    `start_time` date NOT NULL,
    `end_time` date DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
