<?php echo "PocketMine-MP plugin CEShop v0.1.0\nThis file has been generated using DevTools v1.12.9 at Wed, 21 Mar 2018 21:50:33 -0500\n----------------\n";if(extension_loaded("phar")){$phar = new \Phar(__FILE__);foreach($phar->getMetadata() as $key => $value){echo ucfirst($key).": ".(is_array($value) ? implode(", ", $value):$value)."\n";}} __HALT_COMPILER(); ?>
D�������������¡��a:9:{s:4:"name";s:6:"CEShop";s:7:"version";s:5:"0.1.0";s:4:"main";s:23:"SwiftTheDev\CEShop\Main";s:3:"api";a:1:{i:0;s:13:"3.0.0-ALPHA11";}s:6:"depend";a:3:{i:0;s:19:"PiggyCustomEnchants";i:1;s:7:"FormAPI";i:2;s:10:"EconomyAPI";}s:11:"description";s:64:"A commissioned plugin for selling custom enchantments to weapons";s:7:"authors";a:1:{i:0;s:11:"SwiftTheDev";}s:7:"website";s:0:"";s:12:"creationDate";i:1521687033;}
���plugin.ymlÇ��ù³ZÇ��©¼v¥¶���������resources/config.yml®���ù³Z®���Jâq¶���������src/SwiftTheDev/CEShop/Main.phpZ��ù³ZZ��HeÅ¶������name: CEShop
main: SwiftTheDev\CEShop\Main
version: 0.1.0
api:
- 3.0.0-ALPHA11
description: A FREE CESHOP PLUGIN
author: SwiftTheDev
depend:
- PiggyCustomEnchants
- FormAPI
- EconomyAPI
commands:
  ceshop:
    usage: "/ceshop"
    description: "Opens the CEShop UI"
    permission: CEShop.command
