<?php
namespace ServerTools;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
class main extends PluginBase {
	public function onLoad(){
		$this->getLogger()->info(TextFormat::AQUA."currently being loaded.");
	}
	public function onEnable(){
		$this->getLogger()->info(TextFormat::GREEN."has been successfully loaded.");
		if(!is_dir($this->getDataFolder())){
			@mkdir($this->getDataFolder());
		} 
		if(!file_exists($this->getDataFolder()."config.json")){
			$config = new Config($this->getDataFolder()."config.json", CONFIG::JSON);
		}
	}
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED."has been disabled.");
	}
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		$config = new Config($this->getDataFolder()."config.json", CONFIG::JSON);
		switch($command->getName()){
			case "alert":
			if(count($args) < 1){
				foreach($this->getServer()->getOnlinePlayers() as $p){
					$p->sendMessage(TextFormat::YELLOW.TextFormat::BOLD."Alert: ".TextFormat::RESET.TextFormat::AQUA.implode(" ", $args));
					$p->sendPopup(TextFormat::YELLOW."Open chat to see the recent alert!");
				}
			} else {
				$sender->sendMessage(TextFormat::RED."You must add a message.");
			}
			break;
			case "kickall":
			if(count($args) < 1){
				$reason = implode(" ", $args);
				} else {
					$reason = "Unknown.";
				}
			}
			foreach($players as $p){
				if($p !== $sender){
					$p->kick($reason, true);
				}
			}
			$sender->sendMessage(TextFormat::YELLOW."All other players have been kicked.");
			break;
		}
	}
}
