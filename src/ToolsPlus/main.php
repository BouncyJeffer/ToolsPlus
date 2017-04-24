<?php
namespace ServerTools;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\level\Position;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\level\particle\HeartParticle;
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
			case "heal":
			$player = $this->getServer()->getPlayer($args[0]);
			if($player instanceof Player){
				$player->heal($player->getMaxHealth(), new EntityRegainHealthEvent($player, $player->getMaxHealth() - $player->getHealth(), EntityRegainHealthEvent::CAUSE_CUSTOM));
        		$player->getLevel()->addParticle(new HeartParticle($player->add(0, 2), 4));
        		$sender->sendMessage(TextFormat::YELLOW.$player." has been healed.");
        	} else {
        		$sender->sendMessage(TextFormat::RED."You must define a player.");
        	}
        	break;
			case "xyz":
			$sender->sendMessage(TextFormat::YELLOW."X: ".TextFormat::RED.explode(".", $sender->getX()).TextFormat::YELLOW." Y: ".TextFormat::RED.explode(".", $sender->getY()).TextFormat::YELLOW." Z: ".TextFormat::YELLOW.explode(".", $sender->getZ()));
			break;
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
