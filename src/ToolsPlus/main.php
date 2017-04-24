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
	}
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED."has been disabled.");
	}
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		switch($command->getName()){
			case "kickall":
			if( isset($args[0])){
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
