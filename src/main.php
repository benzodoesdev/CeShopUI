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
permissions:
  CEShop.command:
    default: true
    description: "Allows access to the CEShop"unbreaking:  # Enchantment Name
- 0  # Enchantment Level
- 0  # Enchantment Price
declare(strict_types=1);
namespace SwiftTheDev\CEShop;

class Main extends PluginBase {
	/** @var Enchantment[] $enchantments */
	private static $enchantments;
	/** @var self $instance */
	private static $instance;

	/**
	 * @return self
	 */
	public static function getInstance() : Main {
		return self;
	}

	public function onEnable() {
		$this->saveDefaultConfig();
		self::$instance = $this;
	}

	/**
	 * @param CommandSender $sender
	 * @param Command $command
	 * @param string $label
	 * @param array $args
	 *
	 * @return bool
	 */
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		if($sender instanceof Player) {
			/** @var FormAPI $formAPI */
			$formAPI = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formAPI->createSimpleForm(function(Player $player, $data) {
				if(!isset($data))
					return;

				/** @var FormAPI $formsAPI */
				$formsAPI = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");

				$enchantment = Main::getEnchantments()[$data];
				$enchData = Main::getInstance()->getConfig()->get(strtolower($enchantment->getName()), [1, 0]);
				$enchantment = new EnchantmentInstance($enchantment, $enchData[0] + 1);
				$cost = $enchData[1];

				$economy = EconomyAPI::getInstance();
				$money = $economy->myMoney($player);
				if($money - $cost < 0) {
					$form = $formsAPI->createCustomForm();
					$form->addLabel(TextFormat::RED."You don't have enough money to buy that!");
				}else{
					$form = $formsAPI->createModalForm(function(Player $player, $data) use($enchantment, $cost) {
						if(!isset($data))
							return;
						if($data) {
							$inventory = $player->getInventory();
							$item = $inventory->getItemInHand();
							$item->addEnchantment($enchantment);
							$inventory->setItemInHand($item);
							$inventory->sendHeldItem($inventory->getHolder()->getLevel()->getPlayers());
							$inventory->sendContents($inventory->getHolder());
							EconomyAPI::getInstance()->reduceMoney($player, $cost, false, "CEShop");
							$player->sendMessage(TextFormat::GREEN."Enchantment Purchased!");
						}
					});
					$form->setContent("Do you accept your charge of " . $economy->getMonetaryUnit() . $cost . "?");
					$form->setButton1(TextFormat::GREEN."Yes, I accept the charge");
					$form->setButton2(TextFormat::RED."No, I don't want to pay for this");
				}
				$form->setTitle(TextFormat::AQUA."CEShop");
				$form->sendToPlayer($player);
			});
			$this->getConfig()->reload();
			/**
			 * @var int[] $data
			 */
			foreach($this->getConfig()->getAll() as $enchantmentName => $data) {
				$enchantment = CustomEnchants::getEnchantmentByName($enchantmentName) ?? Enchantment::getEnchantmentByName($enchantmentName);
				if($enchantment !== null) {
					self::$enchantments[] = $enchantment;
					$form->addButton($enchantment->getName()." ".Main::getRomanNumber($data[0]));
				}else{
					$this->getLogger()->debug("Enchantment '$enchantmentName' is invalid!");
				}
			}
			$form->setTitle(TextFormat::AQUA."CEShop");
			$form->setContent("Choose an enchantment to add to your item");
			$form->sendToPlayer($sender);
		}
		return true;
	}

	/**
	 * @return Enchantment[]
	 */
	public static function getEnchantments() : array {
		return static::$enchantments;
	}

	/**
	 * @param int $integer
	 *
	 * @return string
	 */
	public static function getRomanNumber(int $integer) : string {
		$characters = [
			'M' => 1000,
			'CM' => 900,
			'D' => 500,
			'CD' => 400,
			'C' => 100,
			'XC' => 90,
			'L' => 50,
			'XL' => 40,
			'X' => 10,
			'IX' => 9,
			'V' => 5,
			'IV' => 4,
			'I' => 1
		];
		$romanString
		while ($integer > 0) {
				}
			}
		}
