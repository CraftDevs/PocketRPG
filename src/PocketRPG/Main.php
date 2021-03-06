<?php

namespace PocketRPG;

use PocketRPG\commands\QuestCommands;
use PocketRPG\commands\RpgCommands;
use PocketRPG\eventlistener\EventListener;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;
use pocketmine\permission\Permission;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\level\Position;

class Main extends PluginBase implements Listener {
  
  public function onEnable() {
    $this->getLogger()->info(TF:: GREEN . "Enabling PocketRPG");
    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    $this->getCommand("rpg")->setExecutor(new RpgCommands($this));
    $this->getCommand("quest")->setExecutor(new QuestCommands($this));
    
    @mkdir($this->getDataFolder());
    $this->saveResource("config.yml");
    $this->config = new Config($this->getDataFolder(). "config.yml", Config::YAML);
    $config = $this->config->getAll();
    @mkdir($this->getDataFolder());
    $this->saveResource("party.yml");
    $this->party = new Config($this->getDataFolder(). "party.yml", Config::YAML);
  }

  public function onDisable() {
    $this->getLogger()->info(TF:: RED . "Disabling PocketRPG");
  }
}
